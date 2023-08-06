<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceApiController extends Controller
{
    public function getData()
    {
        $services = Service::all();
        $data = [
            'status' => 'success',
            'message' => 'data partners berhasil diambil',
            'data' => $services
        ];
        return response()->json($data);
    }
}
