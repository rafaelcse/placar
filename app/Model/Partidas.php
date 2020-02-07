<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Partidas extends Model
{

	protected $table = 'partidas';
	public $timestamps = true;
	protected $dates = [
		'created_at',
		'updated_at',
		'data_partida'
	];

	// protected $fillable = [
	// 	''
	// ];


	public function Vencedor1()
	{
		return $this->BelongsTo(\App\Model\Jogadores::class, 'vencedor1_id', 'id');
	}

	public function Vencedor2()
	{
		return $this->BelongsTo(\App\Model\Jogadores::class, 'vencedor2_id', 'id');
	}

	public function Perdedor1() {
		return $this->BelongsTo(\App\Model\Jogadores::class,'perdedor1_id','id');
	}

	public function Perdedor2() {
		return $this->BelongsTo(\App\Model\Jogadores::class,'perdedor2_id','id');
	}
	
}
