<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ListingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         => $this->faker->sentence(),
            'tags'          => 'laravel, api, backend',
            'company'       => $this->faker->company(),
            'location'      => $this->faker->city(),
            'email'         => $this->faker->email(),
            'website'       => $this->faker->url(),
            'description'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Praesent purus arcu, pharetra eu nisi non, imperdiet commodo nisl. Vivamus venenatis lectus ut sem ultrices dignissim. Quisque suscipit tellus sit amet elit pellentesque, ac faucibus erat euismod. Duis finibus id mauris vitae efficitur. Morbi eu facilisis orci. Sed nec lobortis turpis, id elementum orci. Nam bibendum mattis est non efficitur. Vivamus non congue ligula. Nulla vehicula varius nisi, vitae egestas enim consequat vitae. Vivamus justo urna, pretium ut luctus sit amet, blandit a turpis.
                                Nam posuere laoreet pretium. ',

        ];
    }
}
