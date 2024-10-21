<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship
    public function favorites()
    {
        return $this->belongsToMany(
            Idol::class,    // 結合したいモデル
            'user_idols',   // 中間テーブル名
            'user_id',          // 自分自身（Userモデル）に対応する（中間テーブルの）フィールド
            'idol_id'       // 取得したいテーブルに対応する（中間テーブルの）フィールド
        )->withTimestamps();
    }
        /**
     * $idolIdで指定されたアイドルを推しにする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function favorite($idolId)
    {
        $exist = $this->is_favorites($idolId);
        
        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($idolId);
            return true;
        }
    }
    
    /**
     * $idolIdで指定されたアイドルを推しから外す。
     * 
     * @param  int $userId
     * @return bool
     */
    public function unfavorite($idolId)
    {
        $exist = $this->is_favorites($idolId);
        
        if ($exist) {
            $this->favorites()->detach($idolId);
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 指定された$idolIdのアイドルをこのユーザが推し中であるか調べる。推し中ならtrueを返す。
     * 
     * @param  int $userId
     * @return bool
     */
    public function is_favorites($idolId)
    {
        return $this->favorites()->where('idol_id', $idolId)->exists();
    }

    public function idols()
    {
        return $this->belongsToMany(Idol::class, 'user_idols', 'user_id', 'idol_id');
    }
}
