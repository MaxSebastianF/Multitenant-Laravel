<?php

namespace Database\Seeders\Test;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;
use App\Models\Service;
use App\Models\Specs;
use App\Models\Supplier;
use App\Models\Maintenance;
use App\Models\Suscription;
use Spatie\Permission\Models\Role;

class GlobalSeeder extends Seeder
{
   public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        Role::firstOrCreate(['name' => 'client_user', 'guard_name' => 'api']);
        // --- Admin global ---
        $admin = User::create([
            'name' => 'Super Admin',
            'lastname' => 'Master',
            'email' => 'admin@example.com',
            'phone' => '70000000',
            'username' => 'superadmin',
            'status' => 'active',
            'password' => Hash::make('admin123'),
        ]);
        $admin->assignRole('admin');

        // --- Proveedores globales ---
        $suppliers = [];
        for ($i = 1; $i <= 3; $i++) {
            $suppliers[] = Supplier::create([
                'supplier_name' => "Proveedor $i",
                'ip_direction' => "192.168.0.$i",
                'url' => "https://proveedor$i.com",
                'description' => "Proveedor de ejemplo $i",
                'linked_email' => "contacto$i@proveedor.com",
                'cut_date' => now()->addMonths($i),
                'estimated_cost' => rand(1000, 5000),
                'pay_type' => $i % 2 == 0 ? 'mensual' : 'anual',
                'status' => 'activo',
            ]);
        }

        // --- Clientes / Tenants ---
        for ($i = 1; $i <= 2; $i++) {

            // usuario dueño del cliente
            $owner = User::create([
                'name' => "Owner $i",
                'lastname' => "Client $i",
                'email' => "owner$i@client.com",
                'phone' => '70000' . rand(100,999),
                'username' => "owner$i",
                'status' => 'active',
                'password' => Hash::make('secret123'),
            ]);
            $owner->assignRole('client_user');

            // cliente
            $client = Client::create([
                'code' => "CL00$i",
                'company_name' => "Cliente $i SRL",
                'nit_or_ci' => rand(1000000,9999999),
                'direction' => "Calle $i",
                'country' => "Bolivia",
                'city' => "Cochabamba",
                'id_user' => $owner->id_user,
            ]);

            // Servicios del cliente
            $services = [];
            for ($j = 1; $j <= 2; $j++) {
                $services[] = Service::create([
                    'code' => "SVC{$i}{$j}",
                    'service_name' => "Servicio $j Cliente $i",
                    'type_plan' => ['mensual','anual','por_usuario','a_llamado'][array_rand(['mensual','anual','por_usuario','a_llamado'])],
                    'id_client' => $client->id_client,
                    'status' => 'activo',
                ]);
            }

            // Specs de cada servicio
            foreach ($services as $service) {
                for ($k = 1; $k <= 2; $k++) {
                    Specs::create([
                        'name' => "Spec $k Servicio {$service->code}",
                        'description' => "Descripción de la spec $k",
                        'id_service' => $service->id_service,
                    ]);
                }
            }

            // Suscripciones del cliente a proveedores y servicios
            foreach ($services as $service) {
                foreach ($suppliers as $supplier) {
                    Suscription::create([
                        'id_client' => $client->id_client,
                        'id_service' => $service->id_service,
                        'id_supplier' => $supplier->id_supplier,
                        'start_date' => now(),
                        'cut_date' => now()->addMonth(),
                        'status' => 'pendiente',
                        'suscription_price' => rand(100, 1000),
                    ]);
                }
            }

            // Mantenimientos asociados a proveedores
            foreach ($suppliers as $supplier) {
                for ($m = 1; $m <= 2; $m++) {
                    Maintenance::create([
                        'start_date' => now()->addDays($m),
                        'end_date' => now()->addDays($m + 1),
                        'description' => "Mantenimiento $m proveedor {$supplier->supplier_name}",
                        'message' => "Mensaje de prueba $m",
                        'id_supplier' => $supplier->id_supplier,
                    ]);
                }
            }
        }
    }
}
