<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerStoreRequest;
use App\Http\Resources\Admin\CustomerResource;
use App\Models\Customer;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Propaganistas\LaravelPhone\PhoneNumber;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::query()->paginate(10);

        return Inertia::render('Admin/Customers/Index', [
            'customers' => CustomerResource::collection($customers),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Customers/Create');
    }

    public function store(CustomerStoreRequest $request)
    {
        $model = Customer::make($request->validated());
        $model->phone_number = PhoneNumber::make($request->validated('phone_number'), ['AUTO', 'UA'])->formatE164();
        $model->save();

        return Redirect::route('admin.customers.index');
    }

}
