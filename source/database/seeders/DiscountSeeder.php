<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Services\Order\Discount\DiscountForBuyNOrMoreProductFromCategoryGetDiscountService;
use App\Services\Order\Discount\DiscountForBuyNProductFromCategoryGetNFreeService;
use App\Services\Order\Discount\DiscountForNPercentOverNTotalService;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discounts = [
            [
                'name' => 'BUY_6_GET_1_FREE',
                'discount_class' => DiscountForBuyNProductFromCategoryGetNFreeService::class,
                'priority' => 1,
                'relation_id' => 2,
                'decision_limit' => 6,
                'type' => 'free',
                'value' => 0,
            ],
            [
                'name' => 'BUY_2_GET_10_PERCENT_DISCOUNT',
                'discount_class' => DiscountForBuyNOrMoreProductFromCategoryGetDiscountService::class,
                'priority' => 2,
                'relation_id' => 1,
                'decision_limit' => 2,
                'type' => 'percent',
                'value' => 20,
            ],
            [
                'name' => '10_PERCENT_OVER_1000',
                'discount_class' => DiscountForNPercentOverNTotalService::class,
                'priority' => 3,
                'relation_id' => null,
                'decision_limit' => 1000,
                'type' => 'percent',
                'value' => 10,
            ],
        ];

        Discount::insert($discounts);
    }
}
