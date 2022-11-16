<?php

namespace App\Http\Requests\Admin;

use Illuminate\Routing\Route;

class CustomerUpdateRequest extends CustomerStoreRequest
{
    /**
     * @return Route|object|string|null
     */
    protected function getModel()
    {
        return $this->route('customer');
    }
}
