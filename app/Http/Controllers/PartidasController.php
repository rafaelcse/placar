<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data_i = $request->input('data_i', date('Y-m-d', strtotime('-1 months', strtotime(date('Y-m-d')))));
        $data_f = $request->input('data_f', date('Y-m-d'));

        $dados = \App\Model\Partidas::whereBetween('data_partida', [$data_i, $data_f])
        ->with('Vencedor1')
        ->with('Vencedor2')
        ->with('Perdedor1')
        ->with('Perdedor2')
        ->get();

        return view('partidas.index')
        ->with("partidas", $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $dados = new \App\Model\Partidas;

       return view('partidas.both')
       ->with('acao','add')
       ->with('jogadores',\App\Model\Jogadores::get())
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
       'vencedor1_id' => 'required',
       'perdedor1_id' => 'required',
       'valor_aposta' => 'required',
       'data_partida' => 'required'
   ]);

   try{
       $dados = new \App\Model\Partidas;
       $dados->vencedor1_id = $request->input('vencedor1_id');
       $dados->vencedor2_id = $request->input('vencedor2_id');
       $dados->perdedor1_id = $request->input('perdedor1_id');
       $dados->perdedor2_id = $request->input('perdedor2_id');
       $dados->valor_aposta = str_replace(",", ".", $request->input('valor_aposta'));
       $dados->data_partida = $request->input('data_partida');
       $dados->save();
   }catch ( \Exception $ex ) {
       $err =  $ex->getMessage();

   }
   return redirect()->route('partidas.index'); 
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
         $dados = \App\Model\Partidas::find($id);

         return view('partidas.both')
         ->with('acao','edit')
         ->with('jogadores',\App\Model\Jogadores::get())
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
       $request->validate([
           'vencedor1_id' => 'required',
           'perdedor1_id' => 'required',
           'valor_aposta' => 'required',
           'data_partida' => 'required'

       ]);

       try{
        $dados = \App\Model\Partidas::find($id);
        $dados->vencedor1_id = $request->input('vencedor1_id');
        $dados->vencedor2_id = $request->input('vencedor2_id');
        $dados->perdedor1_id = $request->input('perdedor1_id');
        $dados->perdedor2_id = $request->input('perdedor2_id');
        $dados->valor_aposta = $request->input('valor_aposta');
        $dados->data_partida = $request->input('data_partida');
        $dados->update();
    }catch ( \Exception $ex ) {
       $err =  $ex->getMessage();
   }
   return redirect()->route('partidas.index'); 
}

         /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
         public function destroy($id)
         {
             $dados = \App\Model\Partidas::find($id);
             $dados->delete();
             return redirect()->route('partidas.index'); 
         }
     }
