<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Redirect::all();

        return Inertia::render('Dashboard', ['data' => $data]);
    }
}
