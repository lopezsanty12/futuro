<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalTipocuenta extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'cal_tipocuentas';

    protected $fillable = ['nombre','descripcion','debaja'];
	
}
