<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    protected $fillable = ['product_name', 'full_name', 'description', 'image_path', 'prices', 'id','unique', 'type'];
}
