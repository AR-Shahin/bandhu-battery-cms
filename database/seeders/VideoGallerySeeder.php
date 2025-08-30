<?php

namespace Database\Seeders;

use App\Models\VideoGallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = [
            [
                'title' => 'Company Introduction',
                'video_id' => 'dQw4w9WgXcQ',
                'status' => 'active',
                'is_front' => true
            ],
            [
                'title' => 'Product Demo',
                'video_id' => 'jNQXAC9IVRw',
                'status' => 'active',
                'is_front' => false
            ],
            [
                'title' => 'Customer Testimonial',
                'video_id' => 'J---aiyznGQ',
                'status' => 'active',
                'is_front' => true
            ]
        ];

        foreach ($videos as $video) {
            VideoGallery::create($video);
        }
    }
}
