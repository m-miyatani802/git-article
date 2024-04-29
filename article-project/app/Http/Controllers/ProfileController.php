<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
    * アカウント削除用アンケート入力画面へ
    */
    public function delete_questionnaire(Request $request): View
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $user = $request->user();
        // dd($user->id);
        return view('profile.questionnaire_conf', compact('user'));

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // $request->validateWithBag('userDeletion', [
        //     'password' => ['required', 'current_password'],
        // ]);

        $user = $request->user();
        $why_quit = $request['why_quit'];
        $quit_comment = $request['quit_comment'];

        DB::table('users')->where('id', $user->id)->update(['is_delete' => now()]);
        DB::table('users')->where('id', $user->id)->update(['why_quit' => $why_quit]);
        DB::table('users')->where('id', $user->id)->update(['quit_comment' => $quit_comment]);
        Auth::logout();

        // $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/quit');
    }

    /**
     * 公開プロフィール編集画面へ
     */
    public function open_profile(Request $request): View
    {
        return view('profile.open_profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * 公開プロフィール編集変更
     */
    public function open_profile_store(Request $request)
    {
        $request->validate([
            'user_name' => ['required',  'max:255'],
            'account_name' => ['required', 'max:255'],
        ]);

        $user = $request->user();
        $user_name = $request['user_name'];
        $account_name = $request['account_name'];
        $open_email = $request['open_email'];
        $site_url = $request['site_url'];
        $self_introduction = $request['self_introduction'];

        DB::table('users')->where('id', $user->id)->update(['user_name' => $user_name]);
        DB::table('users')->where('id', $user->id)->update(['account_name' => $account_name]);
        DB::table('users')->where('id', $user->id)->update(['open_email' => $open_email]);
        DB::table('users')->where('id', $user->id)->update(['site_url' => $site_url]);
        DB::table('users')->where('id', $user->id)->update(['self_introduction' => $self_introduction]);

        session()->flash('message', '変更が完了しました。');

        return redirect()->route('open_profile')->with('user', $user);
    }
}
