<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmailCertification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\TokenEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     **最初の最初のメール入力画面を表示する
     */
    public function sendPassEmail(): View {
        return view('auth.first-auth');
    }

    /**
     **引数で渡されたメールアドレスとワンタイムトークンをusersテーブルに新規作成
     */
    public static function storeEmailAndToken($email, $onetime_token, $onetime_expiration) {
        EmailCertification::create([
            'email' => $email,
            'onetime_token' => $onetime_token,
            'ontime_expiration' => $onetime_expiration
        ]);
    }

    /**
     **引数で渡されたワンタイムトークンをusersテーブルに追加
     */
    public static function storeToken($email, $onetime_token, $onetime_expiration) {
        EmailCertification::where('email', $email)->update([
            'onetime_token' => $onetime_token,
            'onetime_expiration' => $onetime_expiration
        ]);
    }

    /**
     **ワンタイムトークンが含まれるメールを送信する
     */
    public function sendTokenEmail(Request $request) {
        $email = $request->email;
        $onetime_token = "";

        for ($i = 0; $i < 4; $i++) {
            $onetime_token .= strval(rand(0, 9)); // ワンタイムトークン
        }
        $onetime_expiration = now()->addMinute(30); // 有効期限

        $user = EmailCertification::where('email', $email)->first(); // 受け取ったメールアドレスで検索
        // NULLの場合新規作成、ある場合はトークンをうわがき
        if ($user === null) {
            RegisteredUserController::storeEmailAndToken($email, $onetime_token, $onetime_expiration);
        } else {
            RegisteredUserController::storeToken($email, $onetime_token, $onetime_expiration);
        }

        session()->flash('email', $email); // 認証処理で利用するために一時的に格納
        $request->session()->put('email', $email);
        // dd(session('email'));
        Mail::send(new TokenEmail($email, $onetime_token));

        return view('auth.second-auth');
    }

    /**
     **ワンタイムトークンが正しいか確かめる
     */
    public function auth(Request $request): RedirectResponse {
        $user = EmailCertification::where('email', session('email'))->first();
        $expiration = new Carbon($user['onetime_token']);

        if ($user['onetime_token'] == $request->onetime_token && $expiration > now()) {
            // Auth::login($user);

            $strings = [
                'str_1' => 'test1',
            ];
            return redirect()->route('register')->withInput($strings);
        }
        return redirect()->route('auth.first-auth');
    }

    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        // dd('$redirect_strings');
        $redirect_strings = [
            'redirect_str_1' => $request->old('str_1'),
        ];

        if ($request->old('str_1') != null){
            return view('auth.register');
        } elseif ($request->old('str_1') == null){
            return view('welcome');
        }
    }

    /**
     *会員登録確認画面
     */
    public function show(Request $request): View
    {
        // dd($request);
        $request->validate([
        'account_name' => ['required', 'string', 'max:255'],
        'user_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'gender' => ['required'],
        'birth' => ['required'],
                ]);

        $user = $request;
        $gender = $request['gender'];
        return view('/auth/info_input_conf_show', compact('user', 'gender'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        $request->validate([
            'account_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required'],
            'birth' => ['required'],
        ]);

        $user = User::create([
            'account_name' => $request->account_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'birth' => $request->birth,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
