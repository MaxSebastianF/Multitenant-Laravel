<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ClientScoped {

    protected static function bootClientScoped()
    {
        static::addGlobalScope('client_scope', function (Builder $builder) {

            // Verificamos que haya un usuario autenticado
            if (!auth()->check()) return;

            $user = auth()->user();

            // Cargamos client si existe
            $user->loadMissing('client');
            $client = $user->client;

            // Si el usuario no tiene client, no filtramos (admin global)
            if (!$client) return;

            $clientId = $client->id_client;

            // Solo aplicamos si el modelo tiene columna id_client
            if (\Schema::hasColumn($builder->getModel()->getTable(), 'id_client')) {
                $builder->where($builder->getModel()->getTable() . '.id_client', $clientId);
            }
        });
    }
}
