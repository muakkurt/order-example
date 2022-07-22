<?php

namespace App\Services\Customer;

use App\Models\Customer;

class CustomerService{

    public function setCustomerRevenue(Customer $customer): Customer
    {
        $customer->load('orders');
        $customer->update([
           'revenue' => $customer->orders->sum('total')
        ]);

        return $customer;

    }

}