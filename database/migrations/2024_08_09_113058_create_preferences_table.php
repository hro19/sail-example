<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())')); 
            $table->unsignedBigInteger('student_id'); 
            $table->string('name');
            $table->timestamps(); // created_at and updated_at columns

            // 外部キー制約を設定 (student_idがstudentsテーブルのidを参照)
            $table->foreign('student_id')->references('id')->on('students'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferences');
    }
};
