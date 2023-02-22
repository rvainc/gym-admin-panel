<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerStoreRequest;
use App\Http\Requests\Admin\CustomerUpdateRequest;
use App\Http\Resources\Admin\CustomerResource;
use App\Http\Resources\Admin\TransactionResource;
use App\Models\Customer;
use App\Models\Transaction;
use App\Support\Helper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;
use Propaganistas\LaravelPhone\PhoneNumber;

class CustomerController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $showDeleted = $request->input('show_deleted');

        $customers = Customer::query()
            ->withExists('active_transactions')
            ->withTrashed($showDeleted)
            ->when($request->input('search'), function (Customer|Builder $builder, $value) {
                return $builder->smartSearch($value);
            })
            ->paginate(30)
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
            'showDeleted' => $request->boolean('show_deleted'),
            'message' => Session::get('message'),
        ]);
    }

    /**
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Admin/Customers/Create');
    }

    /**
     * @param CustomerStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CustomerStoreRequest $request)
    {
        $model = Customer::make($request->validated());
        $model->phone_number = PhoneNumber::make($request->validated('phone_number'), ['AUTO', 'UA'])
            ->formatE164();
        $model->save();

        return Redirect::route('admin.customers.index');
    }

    /**
     * @param Customer $customer
     * @return Response
     */
    public function show(Customer $customer)
    {
        $customer->loadExists([
            'active_transactions',
        ]);

        $transactions = Transaction::query()
            ->with('subscription', fn($query) => $query->withTrashed())
            ->with('customer', fn($query) => $query->withTrashed())
            ->where('customer_id','=', $customer->id)
            ->latest()
            ->paginate(10);

        return Inertia::render('Admin/Customers/Customer', [
            'customer' => CustomerResource::make($customer),
            'transactions' => TransactionResource::collection($transactions),
        ]);
    }

    /**
     * @param CustomerUpdateRequest $request
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer->fill($request->validated());
        $customer->phone_number = PhoneNumber::make($request->validated('phone_number'), ['AUTO', 'UA'])
            ->formatE164();

        $customer->save();

        return Redirect::route('admin.customers.show', ['customer' => $customer->id]);
    }

    /**
     * @param Customer $customer
     * @return Response
     */
    public function edit(Customer $customer)
    {
        return Inertia::render('Admin/Customers/Edit', [
            'customer' => CustomerResource::make($customer),
        ]);
    }

    /**
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function destroy(Customer $customer)
    {
        $customer->card_number = null;
        $customer->save();
        $customer->delete();

        return Redirect::route('admin.customers.index');
    }

    /**
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function restore(Customer $customer)
    {
        $customer->restore();

        return Redirect::back()
            ->with('message', ['text' => __('The client successfully restored!'), 'type' => 'success']);
    }
}
