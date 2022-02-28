<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product_name = $this->faker->unique()->words($nb=4, $asText=true);
        $slug = Str::slug($product_name);
        $regular_price = $this->faker->numberBetween(10, 500);
        $sale_price = $regular_price - (($regular_price*10)/100);
        $productImage = 'productImages/digital_'.$this->faker->numberBetween(1, 22).'.jpg';
        return [
            'name' => $product_name,
            'slug' => $slug,
            'short_description' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'regular_price' => $regular_price,
            'sale_price' => $sale_price,
            'sku' => 'DIGI_'.$this->faker->unique()->numberBetween(100, 500),
            'stock_status' => 'instock',
            'quantity' => $this->faker->numberBetween(100, 200),
            'image' => json_encode([$productImage, $productImage]),
            'images' => json_encode([$productImage, $productImage, $productImage, $productImage]),
            'category_id' => $this->faker->numberBetween(1, 11)
        ];
    }
}
