<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RedirectController extends Controller
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
        $image = QrCode::format('png')
            ->merge('img/t.jpg', 0.1, true)
            ->size(200)->errorCorrection('H')
            ->generate('A simple example of QR code!');
        $output_file = '/img/qr-code/img-' . time() . '.png';
        Storage::disk('local')->put($output_file, $image);

        Validator::make($request->all(), $this->rules )->validate();

        Redirect::create($request->all());

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
            Redirect::find($request->input('id'))->update($request->all());
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
            Redirect::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }

}
