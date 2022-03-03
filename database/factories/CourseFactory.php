<?php

namespace Database\Factories;



use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => '1',
            'name' => $this->faker->text(20),
            'description'=> $this->faker->text(200),
            'duration'=> $this->faker->randomNumber(2),
            'status' => 'inactive',
        ];
    }
}
