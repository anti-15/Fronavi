<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    //多対多
    public function reviews()
    {
        return $this->belongsToMany(Review::class)->withTimestamps();
    }

    //1対多
    public function TagReviews(){
        return $this->hasMany(Review::class);
    }
}
