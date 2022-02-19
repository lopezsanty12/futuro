<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'ban_bancos';

    protected $fillable = ['nombre','debaja'];
	
}
