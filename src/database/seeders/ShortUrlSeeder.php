<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShortUrl;

class ShortUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sample = new ShortUrl();
        $sample->long_url = 'https://www.youtube.com/php';
        $sample->slug = 'foobar';
        $sample->save();
    }
}
