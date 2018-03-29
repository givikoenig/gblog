<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Notifications\ConfirmRegistration;
use Notification;

use Mail;

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function register(Request $request) {

        $messages = [
                        'required' => "Поле :attribute обязательно к заполнению",
                        'email' => "Поле :attribute должно соответствовать email адресу",
                        'min' => "Поле :attribute должно содержать не менее :min символов",
                        'max' => "Поле :attribute должно содержать не более :max символов",
                        'unique' => "Пользователь с таким E-mail уже зарегистрирован"
                        ];

                        $this->validate($request,[
                        'email' => 'required|email|unique:users',
                        'password' => 'required|min:6'
                        ], $messages);

                        $data = $request->all();

                        $created_data = $this->create($data)->toArray();

                        $data['token'] = str_random(25);

                        $user = User::find($created_data['id']);
                        $user->token = $data['token'];

                        if($user->save()) {
                            $user->notify(new ConfirmRegistration($user, $data));
                            return redirect(route('home'))->with('status','На Ваш E-mail было отправлено сообщение для подтверждения регистрации');
                        }
        
    }

    public function confirmation($token) {
        $user = User::where('token', $token)->first();

        if (!is_null($user)) {
            $user->confirmed = 1;
            $user->token = '';
            $user->save();
            return redirect(route('home'))->with('status','Регистрация завершена');

        }
        return redirect(route('home'))->with('status','Регистрация не подтверждена');
    }

}
