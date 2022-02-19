<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'gen_personas';

    protected $fillable = ['dpi','nit','nombres','apellidos','debaja'];
	
}
