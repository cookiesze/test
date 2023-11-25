<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    // Example in Product model
protected $fillable = ['name', 'slug', 'price', 'commission', 'ex_date', 'description', 'name_promotion', 'image', 'status', 'link'];




}
