<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShareController extends Controller
{
    public function index(Request $request)
    {
        $url = Url::findOrFail($request->shared);

        return Inertia::render('SharedDashboard', [
            'url' => $url
        ]);
    }
}
