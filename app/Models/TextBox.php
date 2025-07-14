<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TextBox extends Model
{
    use SoftDeletes;

    protected $fillable = ['label','value'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
