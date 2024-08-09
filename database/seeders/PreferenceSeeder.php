<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Preference; // Preferenceモデルをインポート
use Illuminate\Support\Facades\DB; // DBファサードをインポート
use Illuminate\Support\Str;

class PreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 10件のデータを生成して挿入
        for ($i = 0; $i < 10; $i++) {
            DB::table('preferences')->insert([
                'id' => Str::uuid(),
                'student_id' => rand(1, 3), // 1から3までのランダムな数値を生成
                'name' => fake()->word(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
