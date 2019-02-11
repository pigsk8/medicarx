<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EstudioRequest;
use App\Estudio;

class EstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudios = Estudio::all();
        return view('estudio.index')
        ->with('estudios',$estudios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstudioRequest $request)
    {
        $estudio = new Estudio();
        $estudio->descripcion = $request->nuevo;
        $estudio->save();

        return redirect()->back()->with('success','Tipo de estudio creado');
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
        $estudio = Estudio::find($id);
        $estudio->descripcion = $request->descripcion;
        $estudio->save();

        return redirect()->back()->with('success', 'Estudio modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
            $estudio = Estudio::findOrFail($id);
            $estudio->delete();
            return redirect()->back()->with('success','Tipo de estudio eliminado'); 
        }catch (\Illuminate\Database\QueryException $e){
            return redirect()->back()->with('warning','Tipo de estudio no se puede eliminar, se encuentra asociado a consultas'); 
        }
        
    }
}
