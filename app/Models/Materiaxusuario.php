<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiaxusuario extends Model
{
    //use HasFactory;
    public $timestamps = false;

    protected $table = 'materias_x_usuarios';    

     protected $fillable = [
        'materias_id',
        'users_id'
     ];

     public function materia(){
        return $this->hasMany(Materia::class, 'materias_id');
    }

    public function user(){
        return $this->hasMany(User::class, 'user_id');
    }

    public function calificaciones(){
        return $this->hasMany(Calificacion::class, 'materias_x_usuario_id');
    }
}
