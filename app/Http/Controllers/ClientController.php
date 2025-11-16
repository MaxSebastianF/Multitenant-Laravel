<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Service;
use App\Models\Specs;
use App\Models\Suscription;
use App\Models\Supplier;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Mostrar la información básica del cliente dueño del usuario
     */
    public function showClient(Request $request)
    {
        $user = $request->user();

        // Traemos el cliente dueño del usuario
        $client = Client::where('id_user', $user->id_user)->first();

        if (!$client) {
            return response()->json(['message' => 'No hay cliente asignado'], 404);
        }

        return response()->json(['client' => $client]);
    }

    /**
     * Todos los servicios del tenant actual
     */
    public function services(Request $request)
    {
        $services = Service::with('specs', 'suscriptions.supplier')->get();
        // ClientScoped filtra automáticamente por el tenant actual
        return response()->json(['services' => $services]);
    }

    /**
     * Todas las suscripciones del tenant
     */
    public function suscriptions(Request $request)
    {
        $suscriptions = Suscription::with('service', 'supplier')->get();
        // ClientScoped filtra automáticamente por id_client
        return response()->json(['suscriptions' => $suscriptions]);
    }


    public function suppliers(Request $request)
    {
        $suppliers = Supplier::all();
        return response()->json(['suppliers' => $suppliers]);
    }

    /**
     * Todos los mantenimientos relacionados con los proveedores del tenant
     */
    public function maintenances(Request $request)
    {
        $maintenances = Maintenance::with('supplier')->get();
        // si Supplier usa ClientScoped, esto solo traerá los del tenant
        return response()->json(['maintenances' => $maintenances]);
    }
}
