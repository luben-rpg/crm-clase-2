<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function clientesPorZona()
    {
        $clientesPorZona = Client::select('zona_geografica as zona')
            ->selectRaw('count(*) as total')
            ->groupBy('zona_geografica')
            ->orderByDesc('total')
            ->get();

        return view('reportes.zonas', [
            'title' => 'Clientes por zona',
            'data' => $clientesPorZona,
        ]);
    }

    public function interaccionesPorAsesor()
    {
        $interaccionesPorAsesor = DB::table('users as u')
            ->leftJoin('clients as c', 'c.user_id', '=', 'u.id')
            ->leftJoin('interactions as i', 'i.client_id', '=', 'c.id')
            ->select('u.name as asesor')
            ->selectRaw('COUNT(i.id) as total_interacciones')
            ->groupBy('u.id', 'u.name')
            ->orderByDesc('total_interacciones')
            ->get();

        return view('reportes.interacciones', [
            'title' => 'Interacciones por asesor',
            'data' => $interaccionesPorAsesor,
        ]);
    }
}
