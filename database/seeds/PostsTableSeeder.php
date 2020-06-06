<?php

use App\Tag;
use App\Post;
use App\User;
use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user 
        $author1= User::create([
            'name'=> 'John Doe',
            'email'=> 'john@doe.com',
            'password'=> Hash::make('destimy12')
        ]);

        $author2= User::create([
            'name'=> 'jane Doe',
            'email'=> 'jane@doe.com',
            'password'=> Hash::make('destimy12')
        ]);

        // Category
        $category1= Category::create([
            'name'=> 'News'
        ]);

        $category2= Category::create([
            'name'=> 'Marketing'
        ]);

        $category3= Category::create([
            'name'=> 'Partnership'
        ]);

        $post1= Post::create([
            'title'=> 'We relocated our office to a new designed garage',
            'description'=> 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis ad natus eaque consectetur voluptates voluptate nihil provident reprehenderit. Odio modi perferendis quia aut, ab quasi suscipit ullam. Similique, voluptatibus non.',
            'content'=> 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore tenetur debitis corrupti obcaecati quisquam vero aperiam consectetur, perferendis nesciunt odit ea quia doloremque nulla expedita officia vitae quod reiciendis cum!',
            'category_id'=> $category1->id,
            'image'=> 'posts/1.jpg',
            'user_id'=> $author1->id
        ]);

        // author2 is creating this post
        $post2= $author2->posts()->create([
            'title'=> 'Top 5 brilliant content marketing strategies',
            'description'=> 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis ad natus eaque consectetur voluptates voluptate nihil provident reprehenderit. Odio modi perferendis quia aut, ab quasi suscipit ullam. Similique, voluptatibus non.',
            'content'=> 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore tenetur debitis corrupti obcaecati quisquam vero aperiam consectetur, perferendis nesciunt odit ea quia doloremque nulla expedita officia vitae quod reiciendis cum!',
            'category_id'=> $category2->id,
            'image'=> 'posts/2.jpg'
        ]);

        
        $post3= $author1->posts()->create([
            'title'=> 'New published books to read by a product designer',
            'description'=> 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis ad natus eaque consectetur voluptates voluptate nihil provident reprehenderit. Odio modi perferendis quia aut, ab quasi suscipit ullam. Similique, voluptatibus non.',
            'content'=> 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore tenetur debitis corrupti obcaecati quisquam vero aperiam consectetur, perferendis nesciunt odit ea quia doloremque nulla expedita officia vitae quod reiciendis cum!',
            'category_id'=> $category3->id,
            'image'=> 'posts/3.jpg'
        ]);

        $post4= Post::create([
            'title'=> 'This is why it\'s time to ditch dress codes at work',
            'description'=> 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis ad natus eaque consectetur voluptates voluptate nihil provident reprehenderit. Odio modi perferendis quia aut, ab quasi suscipit ullam. Similique, voluptatibus non.',
            'content'=> 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore tenetur debitis corrupti obcaecati quisquam vero aperiam consectetur, perferendis nesciunt odit ea quia doloremque nulla expedita officia vitae quod reiciendis cum!',
            'category_id'=> $category2->id,
            'image'=> 'posts/4.jpg',
            'user_id'=> $author2->id
        ]);

        // Tags
        $tag1= Tag::create([
            'name'=>'Jobs'
        ]);

        $tag2= Tag::create([
            'name'=>'Customers'
        ]);

        $tag3= Tag::create([
            'name'=>'Records'
        ]);

        // post_id,Tag_id
        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
    }
}
