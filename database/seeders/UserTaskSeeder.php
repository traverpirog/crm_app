<?php

namespace Database\Seeders;

use App\Models\UserTask;
use Database\Factories\UserTaskFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserTask::factory(50)->create();
    }
}
