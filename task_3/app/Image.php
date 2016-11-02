<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'url', 'users_id',
    ];

    /**
     * The attributes that are model table.
     *
     * @var array
     */
    protected $table = 'images';

    public function users() {
        return $this->belongsTo('App\User', 'users_id');
    }
}
