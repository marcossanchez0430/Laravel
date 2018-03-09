<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Browse extends Model
{
    protected $fillable = ['imagePath', 'title', 'description', 'price'];
}
