<?php

namespace App\Models;

use App\Traits\ClientScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, ClientScoped;

    /**
     * Primary Key
     */
    protected $primaryKey = 'id_service';

    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Fillables
     */
    protected $fillable = [
        'code',
        'service_name',
        'type_plan',
        'id_client',
        'status',
    ];

    /**
     * Relación con Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
    public function specs()
    {
        return $this->hasMany(Specs::class, 'id_service');
    }
    public function suscriptions()
    {
        return $this->hasMany(Suscription::class, 'id_service');
    }
}
