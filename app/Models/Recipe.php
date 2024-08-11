<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory;
    use SoftDeletes; //論理削除を使うために追加

    protected $casts = [
        'id' => 'string'
    ];

    // fillableを追加
    protected $fillable = [
        'id',
        'user_id',
        'category_id',
        'title',
        'description',
        'image',
    ];

    public function category()
    {
        // return $this->hasOne(Category::class);
        return $this->belongsTo(Category::class);
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);   
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}