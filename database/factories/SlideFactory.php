<?php

namespace Database\Factories;

use App\Models\Slide;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slide>
 */
class SlideFactory extends Factory
{
    protected $model = Slide::class;

    public function definition(): array
    {
        return [
            'tagline' => 'Tagline',
            'title' => 'Title',
            'subtitle' => 'Sub Judul',
            'link' => 'https://example.com',
            'status' => 1,
            'image' => UploadedFile::fake()->image('slide.jpg'),
        ];
    }
}
