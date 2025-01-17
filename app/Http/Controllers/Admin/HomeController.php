<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function index()
    {
        return Redirect::route('admin.customers.index');
    }
}
