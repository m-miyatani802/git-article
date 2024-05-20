<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'admin_id',
        'title',
        'description',
        'is_delete',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     * DBから取得した値を$castsで型変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_delete' => 'datedime',
    ];

    protected $appends = ['url', 'date'];

    // Relationship
    public function reads() {

        return $this->hasMany(AnnouncementRead::class, 'announcement_id', 'id');

    }
    // Accessor
    public function getUrlAttribute() {

        return route('announcement.show', $this->id);

    }
    public function getDateAttribute() {

        return $this->created_at->format('m月d日');

    }
}
