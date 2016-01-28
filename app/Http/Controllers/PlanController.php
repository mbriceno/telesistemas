<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Plan;
use App\Rubro;
use App\Period;

class PlanController extends Controller
{
    private $tiempo = array(
        'hours' => 'Hora(s)', 
        'days' => 'Día(s)', 
        'weeks' => 'Semana(s)', 
        'months' => 'Mes(es)', 
        'years' => 'Año(s)'
    );

    public function __construct()
    {
        $this->middleware('level:90');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planes = Plan::orderBy('nombre')->paginate(10);

        return view('plan.index', compact('planes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rubros = Rubro::lists('nombre', 'id');
        $periodos = Period::lists('nombre', 'id');

        return view('plan.create', compact('rubros','periodos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Plan::$rules);
        $plan = Plan::create($request->all());

        return redirect()->route('admin.plan.index')->with('message', '<div class="alert alert-success" style="margin-top:15px">Plan creado con Éxito</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = Plan::find($id);
        $tiempo = $this->tiempo;

        return view('plan.show', compact('plan', 'tiempo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Plan::find($id);
        $rubros = Rubro::lists('nombre', 'id');
        $periodos = Period::lists('nombre', 'id');

        return view('plan.edit', compact('plan', 'rubros', 'periodos'));
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
        $plan = Plan::findOrFail($id);
        $data = $request->all();
        $this->validate($request, Plan::$rules);

        $plan->update($data);
        
        return redirect()
                ->route('admin.plan.index')
                ->with('message', '<div class="alert alert-success" style="margin-top:15px">Plan editado con Éxito</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$plan = Plan::find($id);
		if(count($plan->enterprises)>0){
			return redirect()->route('admin.plan.index')->with('message', '<div class="alert alert-warning" style="margin-top:15px">Este plan está asociado a algunas empresas por ende no puede ser eliminado</div>');
		}else{
        	$plan->delete();
		}

        return redirect()->route('admin.plan.index')->with('message', '<div class="alert alert-success" style="margin-top:15px">Plan eliminado con Éxito</div>');
    }
}
