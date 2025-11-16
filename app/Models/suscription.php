<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscription extends Model
{
    use HasFactory;

    /**
     * Primary Key
     */
    protected $primaryKey = 'id_suscrption';

    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Fillables
     */
    protected $fillable = [
        'id_client',
        'id_service',
        'id_supplier',
        'start_date',
        'cut_date',
        'status',
        'suscription_price',
    ];

    /**
     * Casts
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'cut_date'   => 'date',
            'suscription_price' => 'decimal:2',
        ];
    }

    /**
     * Relación con Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    /**
     * Relación con Service
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }

    /**
     * Relación con Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
}
