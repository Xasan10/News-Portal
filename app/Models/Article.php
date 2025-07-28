<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
        use HasFactory, Searchable;
    
        protected $table = 'articles';


        public function toSearchableArray()
        {
            return [

                'title' => $this->title,
                'description'=> $this->description,

            ];
        }


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
