<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jogadores extends Model
{

	protected $table = 'jogadores';
	public $timestamps = true;
	protected $dates = [
		'created_at',
		'updated_at'
	];

	protected $fillable = [
		'nome'
	];


		public function partidasVencidas()
	{
		return $this->hasMany(\App\Model\Partidas::class,  'id','vencedor1_id');
	}



public function partidasPerdidas() {
    return $this->hasMany(\App\Model\Partidas::class,'id','perdedor_id');
}

public function allUserRelations() {
    return $this->partidasVencidas->merge($this->partidasPerdidas);
}

}
