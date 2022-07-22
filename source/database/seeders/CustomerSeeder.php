<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = Http::get('https://raw.githubusercontent.com/ideasoft/se-take-home-assessment/master/example-data/customers.json');

        $customers = json_decode($customers->body(), true);

        foreach($customers as $customer){
            Customer::create([
                'name' => $customer['name'] ?? null,
                'created_at' => $customer['since'] ?? today(),
                'revenue' => 0,
            ]);
        }
    }
}
