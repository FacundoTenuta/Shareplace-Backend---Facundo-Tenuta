<?php

use App\Ability;
use App\Category;
use App\Condition;
use App\Image;
use App\Link;
use App\Loan;
use App\Publication;
use App\Requestion;
use App\User;
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();


        factory(Ability::class, 10)->create();

        factory(User::class, 7)->create()->each(
            function ($user){
                $abilities = Ability::all()->random();

                $user->abilities()->attach($abilities);
            }
        );

        factory(Link::class, 10)->create();

        factory(Category::class, 10)->create();

        factory(Condition::class, 30)->create();

        factory(Publication::class, 11)->create()->each(
            function ($publication){
                $conditions = Condition::all()->random();
                $categories = Category::all()->random();

                $publication->conditions()->attach($conditions);
                $publication->categories()->attach($categories);
            }
        );

        factory(Requestion::class, 6)->create();

        factory(Loan::class, 5)->create();
        
        factory(Image::class, 20)->create();

        // factory(Condition::class, 30)->create()->each(
        //     function ($condition){
        //         $publications = Publication::all()->random()->pluck('id');

        //         $condition->publications()->attach($publications);
        //     }
        // );
    }
}
