<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Dashboard',[
            'urls' => Url::when($request->search, function ($query, $term) {
                $query->where('tag', 'LIKE', '%' . $term .'%');
            })->orderBy('id', 'DESC')->paginate(25)
        ]);
    }
}
