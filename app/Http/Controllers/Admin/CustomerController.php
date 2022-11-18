<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerStoreRequest;
use App\Http\Requests\Admin\CustomerUpdateRequest;
use App\Http\Resources\Admin\CustomerResource;
use App\Models\Customer;
use App\Support\Helper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Propaganistas\LaravelPhone\PhoneNumber;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $showDeleted = $request->input('show_deleted');

        $customers = Customer::query()
            ->withTrashed($showDeleted)
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
            'show_deleted' => $showDeleted,
            'message' => Session::get('message'),
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

    public function show(Customer $customer)
    {
        return Inertia::render('Admin/Customers/Customer', [
            'customer' => CustomerResource::make($customer),
        ]);
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer->fill($request->validated())->save();

        return Redirect::route('admin.customers.show', ['customer' => $customer->id]);
    }

    public function edit(Customer $customer)
    {
        return Inertia::render('Admin/Customers/Edit', [
            'customer' => CustomerResource::make($customer),
        ]);
    }

    public function delete(Customer $customer)
    {
        $customer->card_number = null;
        $customer->save();
        $customer->delete();

        return Redirect::route('admin.customers.index');
    }

    public function restore(Customer $customer)
    {
        $customer->restore();

        return Redirect::back()
            ->with('message', ['text' => __('The client successfully restored!'), 'type' => 'success']);
    }
}
