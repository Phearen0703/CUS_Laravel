<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'code',
        'ebook',
        'title',
        'author',
        'publisher',
        'published_date',
        'description',
        'image',
        'pdf',
        'category_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public $timestamps = true;

    protected static function booted()
    {
        static::deleting(function ($book) {
            $book->deleted_by = auth()->id();
            $book->saveQuietly();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    protected $casts = [
        'published_date' => 'date',
    ];

    protected $dates = ['deleted_at'];




}
