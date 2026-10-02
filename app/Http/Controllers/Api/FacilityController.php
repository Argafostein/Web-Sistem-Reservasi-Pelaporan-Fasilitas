<?php

namespace App\Http\Controllers\Api;

use App\Models\Facility;

class FacilityController
{
    public function index()
    {
        $facilities = Facility::with('slots')->orderBy('id')->get();

        return response()->json(
            $facilities->map(fn (Facility $facility) => $facility->toFrontend())->values()
        );
    }
}
