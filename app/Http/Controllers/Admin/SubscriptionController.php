<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionStoreRequest;
use App\Http\Requests\Admin\SubscriptionUpdateRequest;
use App\Http\Resources\Admin\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $showDeleted = $request->input('show_deleted');

        $subscriptions = Subscription::query()
            ->withTrashed($showDeleted)
            ->paginate(15);

        return Inertia::render('Admin/Subscriptions/Index', [
            'subscriptions' => SubscriptionResource::collection($subscriptions),
            'showDeleted' => $request->boolean('show_deleted'),
            'message' => Session::get('message'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Subscriptions/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SubscriptionStoreRequest $request
     * @return RedirectResponse
     */
    public function store(SubscriptionStoreRequest $request): RedirectResponse
    {
        $attributes = $request->validated();
        $attributes['price'] = (int)($attributes['price'] * 100);

        $model = Subscription::make($attributes);
        $model->save();

        return Redirect::route('admin.subscriptions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subscription $subscription
     * @return Response
     */
    public function edit(Subscription $subscription): Response
    {
        return Inertia::render('Admin/Subscriptions/Edit', [
            'subscription' => SubscriptionResource::make($subscription),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SubscriptionUpdateRequest $request
     * @param Subscription $subscription
     * @return RedirectResponse
     */
    public function update(SubscriptionUpdateRequest $request, Subscription $subscription): RedirectResponse
    {
        $attributes = $request->validated();
        $attributes['price'] = (int)($attributes['price'] * 100);
        $subscription->fill($attributes)->save();

        return Redirect::route('admin.subscriptions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subscription $subscription
     * @return RedirectResponse
     */
    public function destroy(Subscription $subscription): RedirectResponse
    {
        $subscription->delete();

        return Redirect::back();
    }

    /**
     * @param Subscription $subscription
     * @return RedirectResponse
     */
    public function restore(Subscription $subscription): RedirectResponse
    {
        $subscription->restore();

        return Redirect::back()
            ->with('message', ['text' => __('The subscriptions successfully restored!'), 'type' => 'success']);
    }
}
