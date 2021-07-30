<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name', 'slug', 'address', 'vat_number', 'user_id', 'image'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function dishes() 
    {
        return $this->hasMany('App\Dish');
    }

    public function types() 
    {
        return $this->belongsToMany('App\Type');
    }
}
