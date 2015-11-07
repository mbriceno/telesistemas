<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Enterprise;
use App\Plan;
use App\Representative;

class EnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enterprises = Enterprise::orderBy('razon_social')->paginate(10);

        return view('enterprise.index', compact('enterprises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $planes = Plan::lists('nombre', 'id');
        return view('enterprise.create', compact('planes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Enterprise::$rules);
        $this->validate($request, Representative::$rules_rl);
        $this->validate($request, Representative::$rules_ct);

        $empresa = Enterprise::create($request->all());
        $rep_legal = new Representative;
        $rep_legal->tipo = 'legal';
        $rep_legal->nombre = $request->input('nombre_rl');
        $rep_legal->apellido = $request->input('apellido_rl');
        $rep_legal->ci = $request->input('ci_rl');
        $rep_legal->rif = $request->input('rif_rl');
        $rep_legal->email = $request->input('email_rl');
        $rep_legal->telefono = $request->input('telefono_rl');
        $rep_legal->direccion = $request->input('direccion_rl');
        $rep_legal->save();
        $empresa->representatives()->attach($rep_legal->id);

        $rep_contact = new Representative;
        $rep_contact->tipo = 'contacto';
        $rep_contact->nombre = $request->input('nombre_ct');
        $rep_contact->apellido = $request->input('apellido_ct');
        $rep_contact->ci = $request->input('ci_ct');
        $rep_contact->rif = $request->input('rif_ct');
        $rep_contact->email = $request->input('email_ct');
        $rep_contact->telefono = $request->input('telefono_ct');
        $rep_contact->direccion = $request->input('direccion_ct');
        $rep_contact->save();
        $empresa->representatives()->attach($rep_contact->id);

        return redirect()->route('admin.empresa.index')->with('message', '<div class="alert alert-success" style="margin-top:15px">Empresa creada con Éxito</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Enterprise::find($id);
        $tipo = array('CO' => 'Cuenta Corriente', 
                        'AH' => 'Cuenta de Ahorro', 
                        'EL' => 'Cuenta Electrónica');

        return view('enterprise.show', compact('empresa', 'tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = Enterprise::find($id);
        $planes = Plan::lists('nombre', 'id');

        return view('enterprise.edit', compact('planes', 'empresa'));
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
        $empresa = Enterprise::findOrFail($id);
        $data = $request->all();
        $this->validate($request, Enterprise::$rules);

        $empresa->update($data);
        
        return redirect()
                ->route('admin.empresa.index')
                ->with('message', '<div class="alert alert-success" style="margin-top:15px">Empresa editada con Éxito</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Enterprise::destroy($id);

        return redirect()->route('admin.empresa.index')->with('message', '<div class="alert alert-success" style="margin-top:15px">Empresa eliminada con Éxito</div>');
    }
}
