<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Redirect incoming urls do destination url
     *
     * @param $tag
     * @return RedirectResponse
     */
    public function tag($tag)
    {
        $urlQuery = Url::where('tag', $tag)->where('active', true);

        if (empty($urlQuery->first())) {
            abort(404);
        }

        $urlQuery->update([
            'visits' => DB::raw('visits+1'),
        ]);

        return redirect()->away($urlQuery->first()->destination);
    }
}
