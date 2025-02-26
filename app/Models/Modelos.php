<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelos extends Model
{
    use HasFactory;
    protected $table = 'modelos';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'id',
        'nombre_modulo',
        'profesor',
        'created_at',
        'updated_at'
    ];
}
