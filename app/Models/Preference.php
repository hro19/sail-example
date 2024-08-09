<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;
    
    // fillableを設定
    protected $fillable = ['student_id', 'name'];

    // studentとのリレーションを定義
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
