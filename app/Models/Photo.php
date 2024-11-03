<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $primaryKey = 'fotoID';
    protected $fillable = [
        'judulFoto',
        'deskripsiFoto',
        'tanggalUnggah',
        'lokasiFile',
        'albumID',
        'userID',
    ];

    public function album() {
        return $this->belongsTo(Album::class, 'albumID');
    }

    public function user() {
        return $this->belongsTo(User::class, 'userID');
    }

    public function likes() {
        return $this->hasMany(LikePhoto::class, 'fotoID');
    }

    public function isLikeByAuthUser() {
        return $this->likes()->where('userID', Auth::user()
        ->userID)->exists();
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'fotoID');
    }
}
