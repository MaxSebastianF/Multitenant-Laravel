<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Client;

trait ClientScoped {

    protected static function bootClientScoped()
    {
        static::addGlobalScope('client_scope', function (Builder $builder) {

            if (!auth()->check()) {
                return;
            }

            $userId = auth()->id();

            // ¿Este usuario pertenece a un client?
            $client = Client::where('id_user', $userId)->first();

            // Si no tiene client asociado → usuario interno → full acceso
            if (!$client) {
                return;
            }

            $builder->where(
                $builder->getModel()->getTable() . '.id_client',
                $client->id_client
            );
        });
    }
}
