<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', // これを追加
        'email', 
        // 他のfillable属性も必要に応じて追加
    ];
    
    use HasFactory;

    // preferencesとのリレーションを定義
    public function preferences()
    {
        return $this->hasMany(Preference::class);
    }
}
