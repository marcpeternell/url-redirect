<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UrlController extends Controller
{

    private $rules = [
        'tag' => 'required|max:255|unique:urls|min:3',
        'destination' => 'required|min:3|url',
    ];

    private $updateRules = [
        'destination' => 'required|min:3|url',
        'active' => 'required|boolean'
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
        Validator::make($request->all(), $this->rules)->validate();

        $qrUrl = url('/tag') . '/' . $request->tag;

        $path = $this->generateQR($qrUrl, $request->tag);

        Url::create([
            'tag' => $request->tag,
            'destination' => $request->destination,
            'qr_code' => $path
        ]);

        return redirect()->back()
            ->with('message', 'Url Created Successfully.');
    }

    /**
     * @param $url
     * @param $tag
     * @return string
     */
    private function generateQR($url, $tag): string
    {
        // Create a basic QR code
        $qrCode = new QrCode($url);
        $qrCode->setSize(300);
        $qrCode->setMargin(10);

        // Set advanced options
        $qrCode->setWriterByName('png');
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);

        // Round block sizes to improve readability and make the blocks sharper in pixel based outputs (like png).
        // There are three approaches:
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_MARGIN); // The size of the qr code is shrinked, if necessary, but the size of the final image remains unchanged due to additional margin being added (default)
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_ENLARGE); // The size of the qr code and the final image is enlarged, if necessary
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_SHRINK); // The size of the qr code and the final image is shrinked, if necessary

        // Set additional writer options (SvgWriter example)
        $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);

        // Save it to a file
        $path = 'images/qr_code/' . now()->timestamp . '_' . $tag . '.png';
        $qrCode->writeFile(public_path($path));

        return $path;
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
            return redirect()->back()->with('message', 'Url Deleted Successfully.');
        }
    }

}
