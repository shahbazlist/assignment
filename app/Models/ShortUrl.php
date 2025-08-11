<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class ShortUrl extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByParentUsers($query)
    {
        return $query->whereIn(
            'user_id',
            User::where('parent_id', Auth::id())->orWhere('id',Auth::id())->pluck('id')
        );
    }
}
