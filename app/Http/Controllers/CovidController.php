<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CovidController extends Controller
{
    public function index()
    {
        // Obtendo o último acesso
        $lastAccess = \DB::table('api_accesses')->orderBy('accessed_at', 'desc')->first();
        return view('covid.index', ['lastAccess' => $lastAccess]);
    }

    public function fetchData(Request $request)
    {
        $country = $request->input('country');
        $response = Http::get("https://dev.kidopilabs.com.br/exercicio/covid.php?pais=Brazil", [
            'pais' => $country
        ]);
        $data = $response->json();

        // Salvar acesso no banco de dados
        \DB::table('api_accesses')->insert([
            'country' => $country,
            'accessed_at' => now()
        ]);

        return view('covid.show', ['data' => $data]);
    }
}
