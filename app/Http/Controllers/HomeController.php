<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Predictor\Group;
use App\Predictor\Match;
use App\Predictor\Round;
use App\Predictor\Team;
use App\User;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except([
            'index',
            'howToPlay',
            'terms',
            'privacy',
            'support',
            'contact',
            'prizes',
        ]);
        $this->middleware('locale');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = Match::where('date','>=',Carbon::now())->orderBy('date')->take(5)->get();
        $users   = User::orderByDesc('points')->orderby('created_at')->take(5)->get();
        return view('home', compact('matches', 'users'));
    }

    /**
     * Terms and conditions page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms()
    {
        return view('pages.terms');
    }

    /**
     * Privacy policy page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacy()
    {
        return view('pages.privacy');
    }

    /**
     * Support  page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function support()
    {
        return view('pages.support');
    }

    /**
     * Prizes page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function prizes()
    {
        return view('pages.prizes');
    }

    /**
     * How to play page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function howToPlay()
    {
        return view('pages.how_to_play');
    }

    /**
     * Show Ranking page
     *
     * @return \Illuminate\Http\Response
     */
    public function ranking()
    {
        if (!($l = request()->get('l'))) $l = null;
        $rounds  = Round::orderBy('id')->get();
        $leagues = auth()->user()->leagues;
        return view('pages.ranking', compact('leagues', 'l', 'rounds'));
    }

    /**
     * Predictions page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function predictions()
    {
        $letters = [];
        $letters['A'] = [536,1264,1225,837];
        $letters['B'] = [359,118,1057,1042];
        $letters['C'] = [368,575,834,369];
        $letters['D'] = [632,503,535,1216];
        $letters['E'] = [614,497,838,364];
        $letters['F'] = [357,659,361,1041];
        $letters['G'] = [360,1869,1224,114];
        $letters['H'] = [511,1226,832,1266];
        foreach($letters as $letter=>$teams){
            $group = Group::firstOrCreate(['name'=>$letter]);
            $i=1;
            foreach ($teams as $team_id){
                $team = Team::firstOrCreate(['id'=>$team_id]);
                $group->teams()->detach($team->id);
                $group->teams()->attach($team->id,['order'=>$i]);
                $i++;
            }
        }
//        $match = Match::orderBy('date')->first();
        $match = Match::find(958026);
        $groups = Group::orderBy('name')->get();
        $groups->each->append('myprediction');
        return view('pages.predictions',compact('groups','match'));
    }

    /**
     * Mail contact form
     * @return array
     */
    public function contact()
    {
        $this->validate(request(),[
            'name'=>'required|min:3',
            'email'=>'required|email',
            'message'=>'required|min:5',
        ]);
        $data = request()->all();
        Mail::to(['idelvalle@grupo-link.com','jcardenas@dayscript.com'])->send(new ContactMail($data));
        $results = [];
        $results['status'] = 'success';
        $results['message'] = __('contact.information_sent');

        return $results;

    }
}
