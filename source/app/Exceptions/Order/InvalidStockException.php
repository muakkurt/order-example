<?php

namespace App\Exceptions\Order;

use Exception;

class InvalidStockException extends Exception
{
    private array $errors = [];
    public function __construct(
        string $message = '',
        array $errors,
    ) {
        parent::__construct($message);

        $this->errors = $errors;
    }

    public function errors(){
        return $this->errors;
    }
}
