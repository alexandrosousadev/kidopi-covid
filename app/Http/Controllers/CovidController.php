<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ApiAccess;

class CovidController extends Controller
{
    public function index()
    {
        $lastAccess = ApiAccess::latest()->first();
        return view('covid.index', compact('lastAccess'));
    }

    public function getCovidData($country)
    {
        $response = Http::get("https://dev.kidopilabs.com.br/exercicio/covid.php?pais=" . $country);
        
        ApiAccess::create([
            'country' => $country,
            'accessed_at' => now()
        ]);

        return response()->json($response->json());
    }
}