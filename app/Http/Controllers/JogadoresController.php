<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create())
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
           $err =  $ex->getMessage());

}
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
            $dados = new \App\Model\Jogadores;
            $dados->nome = $request->input('nome');
            $dados->save();
        }catch ( \Exception $ex ) {
            $err =  $ex->getMessage());
}
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
