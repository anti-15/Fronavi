<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [
    'id',
    'created_at',
    'updated_at',
  ];

    // 🔽 追加
    public static function getAllOrderByUpdated_at()
    {
        return 
        self::orderBy('updated_at', 'desc')->get();
        
    }

    public static function getAllOrderByScore()
    {
        return 
        self::orderBy('score', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        
    }
    //多対多
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    //多対1(レビューにユーザーネームを表示)
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
}
