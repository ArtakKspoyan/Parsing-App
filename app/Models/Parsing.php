<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parsing extends Model
{
    use HasFactory;

    protected $fillable = ['title','link','description', 'author', 'pubDate', 'image'];
    protected $casts = [
        'author' => 'array',
        'image' => 'array'
    ];

    public $timestamps = false;

}
