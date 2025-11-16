<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specs extends Model
{
    use HasFactory;

    /**
     * Primary Key
     */
    protected $primaryKey = 'id_specs';

    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Fillables
     */
    protected $fillable = [
        'name',
        'description',
        'id_service'
    ];

    /**
     * Relación con Service
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }
}
