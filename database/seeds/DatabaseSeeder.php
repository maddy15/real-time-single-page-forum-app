<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory('App\User',10)->create();
        factory('App\Model\Category',5)->create();
        factory('App\Model\Question',10)->create();
        factory('App\Model\Reply',30)->create()->each(function($reply){
            return $reply->like()->save(factory('App\Model\Like')->make());
        });
    }
}
