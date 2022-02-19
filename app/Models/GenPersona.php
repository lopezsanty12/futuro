<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenPersona extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'gen_personas';

    protected $fillable = ['dpi','nit','nombres','apellidos','id_cuenta','debaja'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function calCuenta()
    {
        return $this->hasOne('App\Models\CalCuenta', 'id', 'id_cuenta');
    }
    
}
