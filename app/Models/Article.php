<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
        use HasFactory;
    
        protected $table = 'articles';


        protected $fillable=[

            'title',
            'body',
            'user_id',
            'category_id',
            'thumbnail',
            'views',
    ];


    public function author()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function category()
{
    return $this->belongsTo(Category::class);
}
public function comment()
{
    return $this->hasMany(Comment::class);
}
}
