<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\View\View;
use App\Models\EmailCertification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Mail\TokenEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    /**
     **最初のメール入力画面を表示する
     */
    public function sendPassEmail(): View {
        return view('admin.first-auth');
    }

    /**
     **引数で渡されたメールアドレスとワンタイムトークンをusersテーブルに新規作成
     */
    public static function storeEmailAndToken($email, $onetime_token, $onetime_expiration) {
        $admin = User::where('email', $email)->first(); // 受け取ったメールアドレスで検索

        if ($admin->admin != null) {
            User::where('email', $email)->create([
                'onetime_token' => $onetime_token,
                'ontime_expiration' => $onetime_expiration
            ]);
        } elseif ($admin->admin == null) {
            return view('admin.first-auth');
        }
    }

    /**
     **引数で渡されたワンタイムトークンをusersテーブルに追加
     */
    public static function storeToken($email, $onetime_token, $onetime_expiration) {
        User::where('email', $email)->update([
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

        $user = User::where('email', $email)->first(); // 受け取ったメールアドレスで検索
        // NULLの場合新規作成、ある場合はトークンをうわがき
        if ($user === null) {
            AdminController::storeEmailAndToken($email, $onetime_token, $onetime_expiration);
        } else {
            AdminController::storeToken($email, $onetime_token, $onetime_expiration);
        }

        session()->flash('email', $email); // 認証処理で利用するために一時的に格納
        $request->session()->put('email', $email);

        Mail::send(new TokenEmail($email, $onetime_token));

        return view('admin.second-auth');
    }

    /**
     **ワンタイムトークンが正しいか確かめる
     */
    public function auth(Request $request): RedirectResponse {
        $user = User::where('email', session('email'))->first();
        $expiration = new Carbon($user['onetime_token']);

        if ($user['onetime_token'] == $request->onetime_token && $expiration > now()) {
            $strings = [
                'str_1' => 'test1',
            ];
            return redirect()->route('adminlogin')->withInput($strings);
        }
        return redirect()->route('admin.first-auth');
    }

    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $redirect_strings = [
            'redirect_str_1' => $request->old('str_1'),
        ];

        if ($request->old('str_1') != null){
            return view('admin.login');
        } elseif ($request->old('str_1') == null){
            return view('admin.first-auth');
        }

    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $admin = User::where('email', $request['email'])->first();

        if ($admin->admin != null) {
            if ($admin->is_delete === null) {

                $request->authenticate();
                $request->session()->regenerate();
                return redirect('/admin/top');

            } elseif ($admin->is_delete !== null) {

                return redirect('/admin/login');
            }
        } elseif ($admin->admin == null) {
            return redirect('/admin/login');
        }
    }

    /**
     * 管理人TOPページ
     */
    public function index(): View
    {
        return view('admin.login');
    }

    /**
     * 管理人お知らせ一覧
     */
    public function allusermessagelist(): View
    {
        $messages = Announcement::latest('updated_at')->get();
        return view('admin.alluser_message_list')->with('messages', $messages);
    }

    /**
     * 管理人お知らせ作成
     */
    public function allusermessagecreate(): View
    {
        return view('admin.alluser_message_create');
    }

    /**
     * 管理人お知らせ作成確認
     */
    public function allusermessagecreateconf(Request $request): View
    {
        $request->validate([
            'message_title' => ['required'],
            'message' => ['required'],
        ]);
        // $auth = Auth::id();
        $message = $request;

        return view('admin.alluser_message_create_conf')->with('message', $message);
    }

    /**
     * 管理人お知らせ作成登録
     */
    public function allusermessagecreatestore(Request $request): RedirectResponse
    {
        $request->validate([
            'message_title' => ['required'],
            'message' => ['required'],
        ]);
        // $auth = Auth::id();

        $message = Announcement::create([
            'admin_id' => Auth::id(),
            'title' => $request->message_title,
            'description' => $request->message,
        ]);

        return redirect('/admin/alluser/message/list')->with('message', '全ユーザへお知らせが送信されました。');
    }

    /**
     * 管理人お知らせ個別表示
     */
    public function allusermessageshow(Request $request): view
    {
        $message = Announcement::where('id', $request['id'])->first();
        return view('admin.alluser_message_show')->with('message', $message);
    }

    /**
     * 管理人お知らせ編集
     */
    public function allusermessageupdate(Request $request): view
    {
        $message = $request;
        return view('admin.alluser_message_update')->with('message', $message);
    }

    /**
     * 管理人お知らせ編集確認
     */
    public function allusermessageupdateconf(Request $request): view
    {
        $message = $request;
        return view('admin.alluser_message_update_conf')->with('message', $message);
    }

    /**
     * 管理人お知らせ編集完了
     */
    public function allusermessageupdatecomplete(Request $request): RedirectResponse
    {
        // $message = $request;
        $now = Carbon::now();

        $auth = Auth::id();
        DB::table('announcements')->where('id', $request->id)->update(['admin_id' => $auth]);
        DB::table('announcements')->where('id', $request->id)->update(['title' => $request->message_title]);
        DB::table('announcements')->where('id', $request->id)->update(['description' => $request->message]);
        DB::table('announcements')->where('id', $request->id)->update(['updated_at' => $now]);

        return redirect()->route('allusermessagelist')->with('message','お知らせの変更が完了しました。');
    }

    /**
     * 管理者ログアウト
     */
    public function destroy(Request $request): RedirectResponse
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
