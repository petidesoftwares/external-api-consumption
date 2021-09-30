<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $fillable=[
        'name',
        'isbn',
        'authors',
        'country',
        'number_of_pages',
        'publisher',
        'release_date'
    ];
}
