<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // truncate this tables before rerunning them to avoid the SQLSTATW[23000]: integrity constraint violation
        
        // first approach
        // User::truncate();
        // Category::truncate();
        // Post::truncate();

        // $user = User::factory(3)->create();

        // $personal = Category::create([
        //     "name" => "Personal",
        //     "slug" => "personals"
        // ]);

        // $work = Category::create([
        //     "name" => "Work",
        //     "slug" => "works"
        // ]);

        // $family = Category::create([
        //     "name" => "Family",
        //     "slug" => "families"
        // ]);

        // Post::create([
        //     "user_id" => $user[0]->id,
        //     "category_id" => $work->id,
        //     "title" => "My Work Post",
        //     "slug" => "my-work-post",
        //     "excerpt" => "Lorem ipsum dolor sit amet. Sed sunt repellendus et doloremque excepturi id",
        //     "body" => "Lorem ipsum dolor sit amet. Sed sunt repellendus et doloremque excepturi id facilis blanditiis. Qui maxime similique ut rerum nemo qui repellendus minus in laborum molestiae qui asperiores facilis est quibusdam quia. Et accusantium consequatur id voluptas itaque aut voluptatum enim. Aut pariatur doloremque eos quisquam quasi sed ipsum nostrum ut alias fuga qui dolorem repellat vel ducimus quia et pariatur mollitia. Ut sapiente suscipit ut voluptatibus adipisci in aliquam commodi qui aspernatur magni id ipsum animi nam nihil necessitatibus. Et minima iure aut tenetur facilis et excepturi magni sit  minus eum corrupti molestias. In nihil cupiditate et deserunt excepturi ea ipsam omnis non obcaecati dolor qui nemo rerum At repellendus sint At totam numquam? Id animi reiciendis ut sapiente praesentium qui magnam officiis. Aut dolores repellat At corrupti rerum et laboriosam repellat hic omnis sunt non omnis omnis! A magni magnam qui nihil deserunt vel deleniti culpa qui veritatis magni est soluta doloremque et doloribus delectus eum laudantium doloremque."
        // ]);

        // Post::create([
        //     "user_id" => $user[1]->id,
        //     "category_id" => $personal->id,
        //     "title" => "My Personal Post",
        //     "slug" => "my-personal-post",
        //     "excerpt" => "Lorem ipsum dolor sit amet. Sed sunt repellendus et doloremque excepturi id",
        //     "body" => "Lorem ipsum dolor sit amet. Sed sunt repellendus et doloremque excepturi id facilis blanditiis. Qui maxime similique ut rerum nemo qui repellendus minus in laborum molestiae qui asperiores facilis est quibusdam quia. Et accusantium consequatur id voluptas itaque aut voluptatum enim. Aut pariatur doloremque eos quisquam quasi sed ipsum nostrum ut alias fuga qui dolorem repellat vel ducimus quia et pariatur mollitia. Ut sapiente suscipit ut voluptatibus adipisci in aliquam commodi qui aspernatur magni id ipsum animi nam nihil necessitatibus. Et minima iure aut tenetur facilis et excepturi magni sit  minus eum corrupti molestias. In nihil cupiditate et deserunt excepturi ea ipsam omnis non obcaecati dolor qui nemo rerum At repellendus sint At totam numquam? Id animi reiciendis ut sapiente praesentium qui magnam officiis. Aut dolores repellat At corrupti rerum et laboriosam repellat hic omnis sunt non omnis omnis! A magni magnam qui nihil deserunt vel deleniti culpa qui veritatis magni est soluta doloremque et doloribus delectus eum laudantium doloremque."
        // ]);

        // second approach
        $category = Category::factory()->create();
        $post = Post::factory(20)->create([
            "category_id" => $category->id,
        ]);
        $comment = Comment::factory(10)->create([
            "post_id" => 1
        ]);
    
        
    }
}
