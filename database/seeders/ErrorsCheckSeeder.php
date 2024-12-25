<?php

namespace Database\Seeders;

use App\Models\ErrorsCheck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ErrorsCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Удаление всех записей в таблице перед заполнением новыми данными
        ErrorsCheck::truncate();

        DB::table('errors_checks')->insert([
            ['was_mistake' => false],
        ]);
    }
}
