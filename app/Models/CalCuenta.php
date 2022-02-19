<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalCuenta extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'cal_cuentas';

    protected $fillable = ['nombre','tipocuentas','minimo','debaja'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function calTipocuenta()
    {
        return $this->hasOne('App\Models\CalTipocuenta', 'id', 'tipocuentas');
    }
    
}
