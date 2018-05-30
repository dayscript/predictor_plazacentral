<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $this->middleware('locale');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'                => 'required|string|max:255',
            'last'                => 'required|string|max:255',
            'identification_type' => 'required',
            'identification'      => 'required|unique:users',
            'phone'               => 'required|min:5',
            'email'               => 'required|string|email|max:255|unique:users',
            'password'            => 'required|string|min:6|confirmed',
            'city'                => 'required',
            'gender'              => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'                => $data['name'],
            'identification'      => $data['identification'],
            'identification_type' => $data['identification_type'],
            'last'                => $data['last'],
            'phone'               => $data['phone'],
            'promotions'          => $data['promotions'] ?? 0,
            'city'                => $data['city'],
            'email'               => $data['email'],
            'gender'              => $data['gender'],
            'password'            => Hash::make($data['password']),
        ]);
    }
}
