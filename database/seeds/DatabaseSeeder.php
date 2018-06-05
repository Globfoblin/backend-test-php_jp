<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(TopicSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MessageSeeder::class);
    }
}
