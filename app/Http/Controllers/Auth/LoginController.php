<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','redirectToProvider', 'handleProviderCallback']);
        $this->middleware('locale');
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')
//            ->scopes(['email', 'user_friends','name'])
            ->redirect();
    }
    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        /*        
        $us = User::where('email', 'ivansantiago868@hotmail.com')->first();
        $users = $us;
        return view('auth/update',compact('users'));
        */
        $user = Socialite::driver('facebook')->user();
        if ($user && $user->getEmail()) {
            if (auth()->check() && ( auth()->user()->email == $user->getEmail() )) {
                $us = auth()->user();
            } else {
                $us = User::where('email', $user->getEmail())->first();
                $usuarioVive = $this->userVivemas($user->getEmail());
                if ($us){
                    if ($usuarioVive == false) 
                    {
                        //auth()->login($us);
                        $users = $us;
                        return view('auth/update',compact('users'));
                    }
                    else
                    {
                        auth()->login($us);
                        return redirect()->intended($this->redirectPath());
                    }
                }else {
                    if ($usuarioVive == false) {
                        $name = $user->getName();
                        $first = trim(substr($name,0,strpos($name,' ')));
                        $last = trim(str_replace($first,'', $name));
                        $us = User::create(['email' => $user->getEmail(), 'name' => $first,'last'=>$last]);
                        //auth()->login($us);
                        $users = $us;
                        return view('auth/update',compact('users'));
                    }
                    else
                    {
                        $name = $user->getName();
                        $first = trim(substr($name,0,strpos($name,' ')));
                        $last = trim(str_replace($first,'', $name));
                        $us = User::create(['email' => $user->getEmail(), 'name' => $first,'last'=>$last]);
                        auth()->login($us);
                    }
                }
            }
        } else {
            return redirect('/login');
        }

    }
    public function userVivemas($email)
    {
        $url = env('VIVE_MAS_URL')."/login/buscarcorreoasignacion";
        $client = new \GuzzleHttp\Client(['headers' => ['Content-Type' => 'application/json']]);
        $response = $client->post($url, [
            'multipart' => [
                [
                    'name'     => 'VIVE_MAS_USER',
                    'contents' => env('VIVE_MAS_USER')
                ],
                [
                    'name'     => 'VIVE_MAS_PASS',
                    'contents' => env('VIVE_MAS_PASS')
                ],
                [
                    'name'     => 'correo',
                    'contents' => $email
                ]
            ]
        ]);
        $contact4 = $response->getBody()->getContents();
        $dataResponse = json_decode($contact4);
        return $dataResponse;
    }
    public function updateUser()
    {
        $this->validate(request(),[
            'password' => 'required|string|min:6|confirmed',
        ]);
        $usuarios = array(
            'password' => request()->get('password'),
            'identification_type' => request()->get('identification_type'),
            'identification' => request()->get('identification'),
            'name' => request()->get('name'),
            'last' => request()->get('last'),
            'email' => request()->get('email'),
            'phone' => request()->get('phone')

        );
        $url = env('VIVE_MAS_URL')."/login/CreateCorreoAsignacion";
        $client = new \GuzzleHttp\Client(['headers' => ['Content-Type' => 'application/json']]);
        $response = $client->post($url, [
            'multipart' => [
                [
                    'name'     => 'VIVE_MAS_USER',
                    'contents' => env('VIVE_MAS_USER')
                ],
                [
                    'name'     => 'VIVE_MAS_PASS',
                    'contents' => env('VIVE_MAS_PASS')
                ],
                [
                    'name' => 'password',
                    'contents' => request()->get('password')
                ],
                [
                    'name'     => 'identification_type',
                    'contents' => request()->get('identification_type')
                ],
                [
                    'name'     => 'identification',
                    'contents' => request()->get('identification')
                ],
                [
                    'name'     => 'name',
                    'contents' => request()->get('name')
                ],
                [
                    'name'     => 'last',
                    'contents' => request()->get('last')
                ],
                [
                    'name'     => 'email',
                    'contents' => request()->get('email')
                ],
                [
                    'name'     => 'phone',
                    'contents' => request()->get('phone')
                ]
            ]
        ]);
        $contact4 = $response->getBody()->getContents();
        $dataResponse = json_decode($contact4);
        if ($dataResponse->estado == true) 
        {
            $us = User::where('email', request()->get('email'))->first();
            $us->identification = request()->get('identification');
            $us->phone = request()->get('phone');
            $us->save();
            auth()->login($us);
            return redirect('/');
        }
    }
}
