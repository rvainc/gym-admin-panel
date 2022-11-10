<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerStoreRequest;
use App\Http\Resources\Admin\CustomerResource;
use App\Models\Customer;
use App\Support\Helper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Propaganistas\LaravelPhone\PhoneNumber;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::query()
            ->when($request->input('search'), function (Customer|Builder $builder, $value) {
                return $builder->smartSearch($value);
            })
            ->paginate(10)
            ->withQueryString();

        $labels = [];

        if($request->has('search')) {
            $labels[] = [
                'title' => $request->input('search'),
                'url' => Helper::removeQueryParams($request->fullUrl(), 'search'),
            ];
        }

        return Inertia::render('Admin/Customers/Index', [
            'customers' => CustomerResource::collection($customers),
            'labels' => $labels,
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
