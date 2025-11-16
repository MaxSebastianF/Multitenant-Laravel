<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;


    protected $primaryKey = 'id_supplier';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'ip_direction',
        'url',
        'supplier_name',
        'description',
        'linked_email',
        'cut_date',
        'estimated_cost',
        'pay_type',
        'status',
    ];


    protected function casts(): array
    {
        return [
            'cut_date' => 'date',
            'estimated_cost' => 'decimal:2',
        ];
    }
}
