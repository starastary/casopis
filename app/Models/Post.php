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
        $text = strip_tags($text, "<a><p><h1><h2><h3><h4><h5><h6><i><b><em><strong><s><small><code><div><section><header><main><footer><span><img><ul><ol><li>");
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
