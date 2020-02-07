<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JogadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = \App\Model\Jogadores::get();

        return view('jogadores.index')
        ->with("jogadores", $dados);

    }

    public function ranking()
    {

        $data_i = $request->input('data_i', date('Y-m-d', strtotime('-1 months', strtotime(date('Y-m-d')))));
        $data_f = $request->input('data_f', date('Y-m-d'));

        $dados = \App\Model\Partidas::select('jogadores.id','jogadores.nome', DB::raw('sum(partidas.valor_aposta) as total'))
        ->join('jogadores', function($join){
            $join->on('jogadores.id','=','partidas.vencedor2_id');
            $join->orOn('jogadores.id','=','partidas.vencedor1_id');
        })
        ->groupBy('jogadores.id')
        ->whereBetween('partidas.data_partida', [$data_i, $data_f])
        ->get();

        return view('jogadores.ranking')
        ->with("jogadores", $dados);

    }

    public function historico(Request $request,$id)
    {

        $data_i = $request->input('data_i', date('Y-m-d', strtotime('-1 months', strtotime(date('Y-m-d')))));
        $data_f = $request->input('data_f', date('Y-m-d'));

         $dados = \App\Model\Partidas::whereBetween('data_partida', [$data_i, $data_f])
        ->with('Vencedor1')
        ->with('Vencedor2')
        ->with('Perdedor1')
        ->with('Perdedor2')

        // $dados = \App\Model\Partidas::select('jogadores.id','jogadores.nome')
        // //, DB::raw('sum(partidas.valor_aposta) as total'))
        // ->join('jogadores', function($join){
        //     $join->on('jogadores.id','=','partidas.vencedor2_id');
        //     $join->orOn('jogadores.id','=','partidas.vencedor1_id');
        // })
        // //->groupBy('jogadores.id')
        ->whereOr('partidas.vencedor2_id', '=', $id)
        ->whereOr('partidas.vencedor2_id', '=', $id)
        ->whereOr('partidas.perdedor1_id', '=', $id)
        ->whereOr('partidas.perdedor2_id', '=', $id)
        //->whereBetween('partidas.data_partida', [$data_i, $data_f])
        ->get();

        return view('jogadores.partidas')
        ->with('jogador',\App\Model\Jogadores::find($id))
        ->with("partidas", $dados);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $dados = new \App\Model\Jogadores;

        return view('jogadores.both')
        ->with("acao", "add")
        ->with("dados", $dados);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     $request->validate([
        'nome' => 'required|unique:jogadores|max:50|min:3'
    ]);

     try{
         $dados = new \App\Model\Jogadores;
         $dados->nome = $request->input('nome');
         $dados->save();
     }catch ( \Exception $ex ) {
         $err =  $ex->getMessage();

     }
     return redirect()->route('jogadores.index'); 
 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dados = \App\Model\Jogadores::find($id);
        return view('jogadores.both')
        ->with("acao", "add")
        ->with("dados", $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = \App\Model\Jogadores::find($id);

        $request->validate([
            'nome' => 'max:50|min:3|required|unique:jogadores,nome,'. $id,
        ]);

        try{
            $dados = \App\Model\Jogadores::find($id);
            $dados->nome = $request->input('nome');
            $dados->save();
        }catch ( \Exception $ex ) {
            $err =  $ex->getMessage();
        }
        return redirect()->route('jogadores.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $dados = \App\Model\Jogadores::find($id);
     $dados->delete();
     return redirect()->route('jogadores.index'); 

 }
}
