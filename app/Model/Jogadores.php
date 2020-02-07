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


	public function partidasVencidas1()
	{
		return $this->hasMany(\App\Model\Partidas::class,  'id','vencedor1_id');
	}

	public function partidasPerdidas1() {
		return $this->hasMany(\App\Model\Partidas::class,'id','perdedor1_id');
	}

	public function partidasVencidas2()
	{
		return $this->hasMany(\App\Model\Partidas::class,  'id','vencedor2_id');
	}

	public function partidasPerdidas2() {
		return $this->hasMany(\App\Model\Partidas::class,'id','perdedor2_id');
	}


	// public function allVencidas() {
	// 	return $this->partidasVencidas1->merge($this->partidasVencidas2);
	// }

	// public function allPerdidas() {
	// 	return $this->partidasPerdidas1->merge($this->partidasPerdidas2);
	// }


	// public function allPartidas() {
	// 	return $this->allVencidas->merge($this->allPerdidas);
	// }

}
