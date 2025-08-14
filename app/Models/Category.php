<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

     use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'categorys';

    protected $fillable = [
        'name',
        'code',
        'deleted_at',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public $timestamps = false;

    protected static function booted()
    {
        static::deleting(function ($category) {
            $category->deleted_by = auth()->id();
            $category->saveQuietly();
        });
    }
   
}
