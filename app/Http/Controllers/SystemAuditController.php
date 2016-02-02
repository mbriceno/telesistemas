<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \OwenIt\Auditing\Log;

class SystemAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $logs = Log::with(['user']);
        $filtros = array();

        if($request->input('tipo')){
            $logs = $logs->where('type', $request->input('tipo'));
            $filtros['tipo'] = $request->input('tipo');
        }

        if($request->input('fecha_inic') != '' && $request->input('fecha_fin') != ''){
            $inic_arr = explode('/', $request->input('fecha_inic'));
            $inic = $inic_arr[2]."-".$inic_arr[1]."-".$inic_arr[0]." 00:00:00";
            $fin_arr = explode('/', $request->input('fecha_fin'));
            $fin = $fin_arr[2]."-".$fin_arr[1]."-".$fin_arr[0]." 11:59:59";
            $logs = $logs->whereBetween('created_at', [$inic, $fin]);
            $filtros['fecha_inic'] = $request->input('fecha_inic');
            $filtros['fecha_fin'] = $request->input('fecha_fin');
        }elseif($request->input('fecha_inic') != '' && $request->input('fecha_fin') == ''){
            $inic_arr = explode('/', $request->input('fecha_inic'));
            $inic = $inic_arr[2]."-".$inic_arr[1]."-".$inic_arr[0]." 00:00:00";
            $logs = $logs->where('created_at', '>', $inic);
            $filtros['fecha_inic'] = $request->input('fecha_inic');
        }elseif($request->input('fecha_inic') == '' && $request->input('fecha_fin') != ''){
            $fin_arr = explode('/', $request->input('fecha_fin'));
            $fin = $fin_arr[2]."-".$fin_arr[1]."-".$fin_arr[0]." 11:59:59";
            $logs = $logs->where('created_at', '<', $fin);
            $filtros['fecha_fin'] = $request->input('fecha_fin');
        }

        $logs = $logs->paginate(25);

        return view('audit.index', compact('logs','filtros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
