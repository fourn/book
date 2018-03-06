<?php

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\User;
use App\Models\School;
use App\Models\Category;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        $used = [7,8,9,10];
        $imags = [
            'https://img14.360buyimg.com/n7/jfs/t1705/189/702227414/177982/cc8c12f0/55dab54dN5271c377.jpg',
            'https://img10.360buyimg.com/n7/jfs/t19330/111/465728713/211343/6c0e1661/5a81162fN73b1d1ab.jpg',
            'https://img12.360buyimg.com/n7/jfs/t205/294/1790383960/136276/4aa02705/53b8fb34N0184218f.jpg',
            'https://img13.360buyimg.com/n7/jfs/t3388/63/1414069775/251733/d1ded900/5825258aN0b776483.jpg',
            'https://img13.360buyimg.com/n7/jfs/t6124/187/760955031/570043/ef3f4f4e/592bf16cN9315c9fc.jpg',
        ];
        $user_ids = User::all()->pluck('id')->toArray();
        $category_ids = Category::all()->pluck('id')->toArray();
        $school_ids = School::all()->pluck('id')->toArray();
        $faker = app(Faker\Generator::class);
        $books = factory(Book::class)->times(100)->make()->each(function ($book, $index)
        use ($faker, $user_ids, $category_ids, $school_ids, $used, $imags)
        {
            $book->user_id = $faker->randomElement($user_ids);
            $book->category_id = $faker->randomElement($category_ids);
            $book->school_id = $faker->randomElement($school_ids);
            $book->used = $faker->randomElement($used);
            $book->image = $faker->randomElement($imags);
            if ($index == 0) {
                 $book->user_id = 1;
            }
        });
        Book::insert($books->toArray());
    }

}

