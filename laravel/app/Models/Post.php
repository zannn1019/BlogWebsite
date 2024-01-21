<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'category_id',
        'title',
        'content',
        'slug',
        'thumbnail'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'id');
    }
}
