<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getChiefnameAttribute()
    {
        return User::find($this->chief)->name;
    }

    public function getEditornameAttribute()
    {
        return User::find($this->editor)->name;
    }
}
