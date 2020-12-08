<?php

namespace App\Http\Controllers;

use App\Models\Url;
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
        $data = Url::all();

        return Inertia::render('Dashboard', ['data' => $data]);
    }
}
