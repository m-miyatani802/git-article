<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AnnouncementRead;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AnnouncementController extends Controller
{
    /**
     * ページ上部にお知らせを表示
     *
     * @return void
     */
    public function index() {

        return view('announcement.index');

    }
    /**
     * 未読のお知らせデータを取得
     *
     * @param Request $request
     * @param Announcement $announcement
     * @return void
     */
    public function show(Request $request, Announcement $announcement) {

        $user = $request->user();
        $announcement_read = AnnouncementRead::where('user_id', $user->id)
            ->where('announcement_id', $announcement->id)
            ->first();

        if(!is_null($announcement_read)) {

            $announcement_read->read = true;
            $announcement_read->save();

        }

        return $announcement;

    }

    /**
     * お知らせの詳細
     *
     * @param Request $request
     * @return void
     */
    public function list(Request $request) {

        $user = $request->user();
        return Announcement::whereHas('reads', function($query) use($user){

            $query->where('user_id', $user->id)
                ->where('read', false);

        })
        ->orderBy('created_at', 'desc')
        ->orderBy('id', 'desc')
        ->paginate(7);

    }
}
