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
        $this->call(UsersTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(ImageGalleryTableSeeder::class);
        $this->call(SocialsTableSeeder::class);
    }
}
