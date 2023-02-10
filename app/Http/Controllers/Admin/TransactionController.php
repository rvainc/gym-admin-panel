<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TransactionStoreRequest;
use App\Http\Resources\Admin\CustomerResource;
use App\Http\Resources\Admin\SubscriptionResource;
use App\Http\Resources\Admin\TransactionResource;
use App\Models\Customer;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $transactions = Transaction::query()
            ->with('subscription', fn($query) => $query->withTrashed())
            ->with('customer', fn($query) => $query->withTrashed())
            ->latest()
            ->paginate(15);

        return Inertia::render('Admin/Transactions/Index', [
            'transactions' => TransactionResource::collection($transactions),
        ]);
    }

    /**
     * @param Transaction $transaction
     * @return Response
     */
    public function show(Transaction $transaction)
    {
        $transaction->load([
            'subscription' => fn($query) => $query->withTrashed(),
            'customer' => fn($query) => $query->withTrashed(),
        ]);

        return Inertia::render('Admin/Transactions/Transaction', [
            'transaction' => TransactionResource::make($transaction),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $customer = Customer::query()->findOrFail($request->input('customer'));
        $subscriptions = Subscription::query()->get();

        return Inertia::render('Admin/Transactions/Create', [
            'subscriptions' => SubscriptionResource::collection($subscriptions),
            'customer' => CustomerResource::make($customer),
        ]);
    }

    /**
     * @param TransactionStoreRequest $request
     * @return RedirectResponse
     */
    public function store(TransactionStoreRequest $request)
    {
        $attributes = $request->validated();
        $attributes['amount'] = (int)($attributes['amount'] * 100);

        $model = Transaction::make($attributes);
        $model->save();

        return Redirect::route('admin.customers.show', ['customer' => $model->customer_id]);
    }
}
