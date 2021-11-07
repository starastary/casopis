<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function getChiefnameAttribute()
    {
        return User::find($this->chief)->name;
    }

    public function getEditornameAttribute()
    {
        return User::find($this->editor)->name;
    }

    public function getTextclearAttribute()
    {
        $text = $this->text;
        return $text;
    }

    public function authors()
    {
        return $this->belongsToMany(User::class, 'users_posts');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tags_posts');
    }
}
