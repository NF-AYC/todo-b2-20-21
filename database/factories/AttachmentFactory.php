<?php

namespace Database\Factories;

use App\Models\{Attachment, Task, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        {
            return [
                'user_id' => User::factory(),
                'task_id' => Task::factory(), 
                'file' => base64_encode($this->faker->text),
                'filename' => $this->faker->word . ".txt", 
                'type' => $this->faker->mimeType(),
                'size' => 256,
                'created_at' => now(),
                'updated_at' => now(),
                ];
        }
    }
}