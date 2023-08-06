<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerApiController extends Controller
{
    public function getData()
    {
        $partners = Partner::where('status', 'show')->get();
        $data = [
            'status' => 'success',
            'message' => 'data partners berhasil diambil',
            'data' => $partners
        ];
        return response()->json($data);
    }
}
