<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $fillable = [ 'id', 'category', 'description', 'url', 'language', 'country' ];
    protected $casts = ['id' => 'string'];
}