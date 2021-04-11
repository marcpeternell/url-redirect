<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class ShareController extends Controller
{
    private $updateRules = [
        'destination' => 'required|min:3|url',
        'active' => 'required|boolean'
    ];

    public function index(Request $request)
    {
        $url = Url::findOrFail($request->shared);

        return Inertia::render('SharedDashboard', [
            'url' => $url
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException|ValidationException
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), $this->updateRules)->validate();

        if ($request->has('id')) {
            Url::find($request->input('id'))->update([
                'active' => $request->active,
                'destination' => $request->destination
            ]);
            return redirect()->back()
                ->with('message', 'Url Updated Successfully.');
        }
    }
}
