<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The table that associated with model
     * 
     * @var string
     */
    protected $table = 'articles';

    /**
     * The model fillables
     * 
     * @var []
     */
    protected $fillable = [
        'title', 'content', 'users_id'
    ];

    /**
     * To required the content
     */
    public static function valid()
    {
        return array(
            'content' => 'required'
        );
    }

    /**
     * Comment Relationship
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'article_id');
    }
}
