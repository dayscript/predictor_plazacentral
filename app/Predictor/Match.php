<?php

namespace App\Predictor;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Match extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Formats date value
     * @param $date
     * @return mixed
     */
    public function getDateAttribute($date)
    {
        setlocale(LC_ALL, 'es_ES');
        return Carbon::parse($date)->formatLocalized('%b %e - %H:%M');
    }

    /**
     * Formats date value
     * @param $date
     * @return mixed
     */
    public function getCarbonDateAttribute()
    {
        return Carbon::parse($this->attributes['date']);
    }

    /**
     * Local team relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function localId()
    {
        return $this->belongsTo(Team::class, 'local_id');
    }

    /**
     * Visitor team relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitId()
    {
        return $this->belongsTo(Team::class, 'visit_id');
    }

    /**
     * Container group
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Updates from opta services
     */
    public function updateOptaData()
    {
        $client       = new Client();
        $url          = 'https://winsports.dayscript.com/matches/' . $this->id . '/summary';
        $res          = $client->get($url);
        $content      = $res->getBody();
        $json_content = json_decode($content);
        if ($json_content->period == 'PreMatch' || $json_content->period == 'Postponed') {
            $this->status = 'pending';
        } else if ($json_content->period == 'FullTime') {
            $this->status = 'finished';
        } else {
            $this->status = 'playing';
        }
        if ($this->date != $json_content->date) $this->date = $json_content->date;
        $team       = Team::firstOrCreate(['id' => $json_content->home->id]);
        $team->name = $json_content->home->name;
        $team->fixName();
        $this->localId()->associate($team);
        if (!$team->image) {
            $url = 'http://images.akamai.opta.net/football/team/badges_150/' . $json_content->home->id . '.png';
            if (url_exists($url) && ($file = file_get_contents($url))) {
                Storage::disk('public')->put('teams/' . $team->id . '/' . str_slug($team->name) . '.png', $file);
                $team->image = 'teams/' . $team->id . '/' . str_slug($team->name) . '.png';
            }
            $team->save();
        }
        $team       = Team::firstOrCreate(['id' => $json_content->away->id]);
        $team->name = $json_content->away->name;
        $team->fixName();
        $this->visitId()->associate($team);
        if (!$team->image) {
            $url = 'http://images.akamai.opta.net/football/team/badges_150/' . $json_content->away->id . '.png';
            if (url_exists($url) && ($file = file_get_contents($url))) {
                Storage::disk('public')->put('teams/' . $team->id . '/' . str_slug($team->name) . '.png', $file);
                $team->image = 'teams/' . $team->id . '/' . str_slug($team->name) . '.png';
            }
            $team->save();
        }
        $local_score = $json_content->home->score;
        $visit_score = $json_content->away->score;
        if ($local_score !== $this->local_score || $visit_score !== $this->visit_score) {
            $this->local_score = $local_score;
            $this->visit_score = $visit_score;
//                $this->calculatePoints();
        }
        $this->save();
    }

    /**
     * Updates group relationship
     */
    public function updateGroup()
    {
        if ($local = $this->localId) {
            if ($group = $local->groups()->first()) {
                $this->group()->associate($group);
                $this->save();
            }
        }
    }

    /**
     * Loads predictions
     * @return array
     */
    public function getMypredictionAttribute()
    {
        return MatchPrediction::firstOrCreate(['user_id' => auth()->user()->id, 'match_id' => $this->id]);
    }

    /**
     * @return string
     */
    public function getVersusAttribute()
    {
        $text = '';
        $text .= __('teams.' . str_slug($this->localId->short));
        $text .= ' vs ';
        $text .= __('teams.' . str_slug($this->visitId->short));
        return $text;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function predictions()
    {
        return $this->hasMany(MatchPrediction::class);
    }

    /**
     * Updates all predictions points
     */
    public function updatePredictionsPoints()
    {
        foreach ($this->predictions as $prediction) {
            $prediction->updatePoints();
        }
    }

    /**
     * @return bool
     */
    public function getActiveAttribute()
    {
        $noteams = [1908, 1909, 1910, 1911, 1912, 1913, 1914, 1915, 1916, 1917, 1918, 1919, 1920, 1921, 1922, 1923, 1936, 1937, 1938, 1939, 5550, 5551, 5552, 5553, 5554, 5555, 5556, 5557, 7977, 7978, 7979, 7980];
        if (!in_array($this->local_id, $noteams)
            && !in_array($this->visit_id, $noteams)
            && $this->status == 'pending'
            && $this->carbon_date->subMinutes(15) > Carbon::now()
        ) return true;
        return false;
    }
}
