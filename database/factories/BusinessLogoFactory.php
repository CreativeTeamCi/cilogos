<?php

namespace Database\Factories;

use App\Models\BusinessLogo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BusinessLogoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BusinessLogo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        $value = $this->faker->company();
        return [
            'name'=>$name,
            'business_name'=>$value,
            'business_name_slug'=>Str::slug($value).Str::random(5),
            'activity_areas_id'=>rand(1,51),
            'email'=>Str::slug($name).'.'.$this->faker->safeEmailDomain(),
            'logo_png'=>$this->faker->imageUrl(640, 480, $value, true),
            'logo_svg'=>$this->faker->imageUrl(640, 480, $value, true),
            'status'=>'valide',
            'url'=>'http://creative-team.ci',
        ];
    }
}
