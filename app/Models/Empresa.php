<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'gen_empresas';

    protected $fillable = ['nombre','persona','debaja'];
	
}
