<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    /**
     * Primary Key
     */
    protected $primaryKey = 'id_maintenance';

    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Fillables
     */
    protected $fillable = [
        'start_date',
        'end_date',
        'description',
        'message',
        'id_supplier',
    ];

    /**
     * Casts
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date'   => 'datetime',
        ];
    }

    /**
     * Relación con Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
}
