<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    //

    public function apply(Builder $builder, Model $model): void
    {
        $user = auth()->user();
        if ($user) {
            if($user->can('view_services'))
            {
                return ;
            }
        }
        if(tenant())
        {
            $builder->where('tenant_id',tenant()->id);
        }
    }
}
