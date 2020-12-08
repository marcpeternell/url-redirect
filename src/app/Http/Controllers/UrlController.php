<?php

namespace App\Http\Controllers;

use App\Models\Url;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UrlController extends Controller
{

    private $rules = [
        'tag' => 'required|max:255|unique:redirects|min:3',
        'redirect_url' => 'required|unique:redirects|min:3',
    ];

    private $updateRules = [
        'tag' => 'required|max:255|min:3',
        'redirect_url' => 'required|min:3',
    ];

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), $this->rules )->validate();

        Url::create($request->all());

        return redirect()->back()
            ->with('message', 'Url Created Successfully.');

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
        Validator::make($request->all(),$this->updateRules)->validate();

        if ($request->has('id')) {
            Url::find($request->input('id'))->update($request->all());
            return redirect()->back()
                ->with('message', 'Url Updated Successfully.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Url::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }

}
