<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The table that associated with model.
     * @var string
     */
    protected $table = 'comments';

    /**
     * The model fillable
     * 
     * @var []
     */
    protected $fillable = [
        'article_id', 'content', 'user'
    ];

    /**
     * To required the content
     */
    public static function valid() {
        return array(
            'content' => 'required'
        );
    }

    /**
     * Article Relationship
     */
    public function article() {
        return $this->belongsTo('App\Article', 'article_id');
    }
}
