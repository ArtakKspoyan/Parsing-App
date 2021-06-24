<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParsingLog extends Model
{
    use HasFactory;

    protected $fillable = ['date','request_method','request_url','response_http_code','response_body'];
    protected $casts = [
        'response_body' => 'array'
    ];

    public $timestamps = false;
}
