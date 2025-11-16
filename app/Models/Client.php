<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_client';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'code',
        'id_user',
        'company_name',
        'nit_or_ci',
        'direction',
        'country',
        'city',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function services()
    {
        return $this->hasMany(Service::class, 'id_client');
    }
}
