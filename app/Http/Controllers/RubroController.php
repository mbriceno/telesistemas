<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rubro;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubros = Rubro::orderBy('nombre')->paginate(10);

        return view('rubro.index', compact('rubros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rubro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, Rubro::$rules);

            $rubro_data = $request->all();
            $rubro = Rubro::create($rubro_data);

        } catch (Exception $e) {
            
        }

        return redirect()->route('admin.rubro.index')->with('message', '<div class="alert alert-success" style="margin-top:15px">Rubro creado con Éxito</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rubro = Rubro::find($id);
        return view('rubro.show', compact('rubro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rubro = Rubro::find($id);
        return view('rubro.edit', compact('rubro'));
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
        try {
            $rubro = Rubro::findOrFail($id);
            $data = $request->all();
            $this->validate($request, Rubro::$rules);

            $rubro->update($data);
        } catch (Exception $e) {
            
        }

        return redirect()->route('admin.rubro.index')->with('message', '<div class="alert alert-success" style="margin-top:15px">Rubro editado con Éxito</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Rubro::destroy($id);
        }catch (Exception $e) {
            
        }

        return redirect()->route('admin.rubro.index')->with('message', '<div class="alert alert-success" style="margin-top:15px">Rubro eliminado con Éxito</div>');
    }
}
