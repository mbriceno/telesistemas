<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Plan;
use App\Enterprise;
use App\PaymentOrder;
use App\SaleOrder;
use Log;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$pdf = \App::make('dompdf.wrapper');
        //$pdf->loadHTML('<h1>Test</h1>');
        
        //return $pdf->stream();

        /*$title = "Hola mundo desde el controlador";
        $pdf = \PDF::loadView('report.invoice', compact('title'));

        return $pdf->download('invoice.pdf');*/

        /*\Excel::create('report', function($excel) {
            $excel->sheet('hoja_'.date('d-m-Y'), function($sheet) {
                $sheet->mergeCells('A1:E1');
                $sheet->row(1, array(
                    'test1', 'test2'
                ));
            });
        })->download('xls');*/

        // or
        //->export('xls');
    }

    public function planes(Request $request){
        $planes = Plan::orderBy('nombre')->get();
        $enterprises = new Enterprise;

        $order = $request->input('order') == 'asc' ? 'ASC':'DESC';
        
        if($request->input('sort') == 'razon_social'){
            $enterprises = Enterprise::orderBy('razon_social',$order);
        }
        elseif ($request->input('sort') == 'created_at') {
            $enterprises = Enterprise::orderBy('created_at',$order);
        }
        elseif ($request->input('sort') == 'plan') {
            $enterprises = Enterprise::select('enterprises.*','planes.created_at AS created_date','planes.id AS plan_id')
                            ->leftJoin('planes', 'planes.id', '=', 'enterprises.plan_id')
                            ->orderBy('planes.nombre', $order);
        }
		elseif ($request->input('sort') == 'totals') {
            $enterprises = Enterprise::select('enterprises.*','planes.created_at AS created_date',
												'planes.id AS plan_id',
                                                \DB::raw('(select SUM(so.total) from sale_orders as so where so.enterprise_id = enterprises.id) AS total_sales'))
                            ->leftJoin('planes', 'planes.id', '=', 'enterprises.plan_id')
                            ->orderBy('total_sales', $order);
        }

        //Filters
        $filtros = array();
        $monto_plan = $planObj = null;
        if($request->input('tipo_plan')){
            $enterprises = $enterprises->where('plan_id', $request->input('tipo_plan'));
            $filtros['tipo_plan'] = $request->input('tipo_plan');
            $planObj = Plan::find($request->input('tipo_plan'));
            $monto_plan = Enterprise::select(\DB::raw('SUM(payment_orders.monto) AS total_sales'))
                            ->where('plan_id', $request->input('tipo_plan'))
                            ->leftJoin('payment_orders', 'payment_orders.enterprise_id', '=', 'enterprises.id')
                            ->first();
        }
		if($request->input('fecha_inic') != '' && $request->input('fecha_fin') != ''){
			$inic_arr = explode('/', $request->input('fecha_inic'));
			$inic = $inic_arr[2]."-".$inic_arr[1]."-".$inic_arr[0]." 00:00:00";
			$fin_arr = explode('/', $request->input('fecha_fin'));
			$fin = $fin_arr[2]."-".$fin_arr[1]."-".$fin_arr[0]." 11:59:59";
			$enterprises = $enterprises->whereBetween('created_at', [$inic, $fin]);
			$filtros['fecha_inic'] = $request->input('fecha_inic');
			$filtros['fecha_fin'] = $request->input('fecha_fin');
		}elseif($request->input('fecha_inic') != '' && $request->input('fecha_fin') == ''){
			$inic_arr = explode('/', $request->input('fecha_inic'));
			$inic = $inic_arr[2]."-".$inic_arr[1]."-".$inic_arr[0]." 00:00:00";
			$enterprises = $enterprises->where('created_at', '>', $inic);
			$filtros['fecha_fin'] = $request->input('fecha_fin');
		}elseif($request->input('fecha_inic') == '' && $request->input('fecha_fin') != ''){
			$fin_arr = explode('/', $request->input('fecha_fin'));
			$fin = $fin_arr[2]."-".$fin_arr[1]."-".$fin_arr[0]." 11:59:59";
			$enterprises = $enterprises->where('created_at', '<', $fin);
			$filtros['fecha_inic'] = $request->input('fecha_inic');
		}

        $enterprises = $enterprises->paginate(10);
        //Log::info($lastQuery);

        $order_colunm = $order=='ASC' ? 'desc':'asc';

        $param_nombre = array_merge(['sort'=>'razon_social','order'=>$order_colunm], $filtros);
        $param_date = array_merge(['sort'=>'created_at','order'=>$order_colunm], $filtros);
        $param_plan = array_merge(['sort'=>'plan','order'=>$order_colunm], $filtros);
        $param_total = array_merge(['sort'=>'totals','order'=>$order_colunm], $filtros);

        return view('report.index', compact('enterprises','order_colunm',
                                            'planes','filtros',
                                            'param_nombre','param_date',
                                            'param_plan','param_total',
                                            'monto_plan','planObj'));
    }

    public function ventas(Request $request){
        $empresas = Enterprise::orderBy('razon_social')->withTrashed()->get();
        $ordenes = new SaleOrder;
        $order = $request->input('order') == 'asc' ? 'ASC':'DESC';
        $filtros = array();

        if($request->input('sort') == 'razon_social'){
            $ordenes = $ordenes->orderBy('razon_social',$order);
        }
        elseif ($request->input('sort') == 'created_at') {
            $ordenes = $ordenes->orderBy('created_at',$order);
        }
        elseif ($request->input('sort') == 'nro_orden') {
            $ordenes = $ordenes->orderBy('nro_orden',$order);
        }
        elseif ($request->input('sort') == 'total') {
            $ordenes = $ordenes->orderBy('total',$order);
        }

        $empresa = null;
        if($request->input('empresa_id')){
            $ordenes = $ordenes->where('enterprise_id', $request->input('empresa_id'));
            $empresa = Enterprise::withTrashed()->find($request->input('empresa_id'));
            $filtros['empresa_id'] = $request->input('empresa_id');
        }

        if($request->input('fecha_inic') != '' && $request->input('fecha_fin') != ''){
            $inic_arr = explode('/', $request->input('fecha_inic'));
            $inic = $inic_arr[2]."-".$inic_arr[1]."-".$inic_arr[0]." 00:00:00";
            $fin_arr = explode('/', $request->input('fecha_fin'));
            $fin = $fin_arr[2]."-".$fin_arr[1]."-".$fin_arr[0]." 11:59:59";
            $ordenes = $ordenes->whereBetween('created_at', [$inic, $fin]);
            $filtros['fecha_inic'] = $request->input('fecha_inic');
            $filtros['fecha_fin'] = $request->input('fecha_fin');
        }elseif($request->input('fecha_inic') != '' && $request->input('fecha_fin') == ''){
            $inic_arr = explode('/', $request->input('fecha_inic'));
            $inic = $inic_arr[2]."-".$inic_arr[1]."-".$inic_arr[0]." 00:00:00";
            $ordenes = $ordenes->where('created_at', '>', $inic);
            $filtros['fecha_fin'] = $request->input('fecha_fin');
        }elseif($request->input('fecha_inic') == '' && $request->input('fecha_fin') != ''){
            $fin_arr = explode('/', $request->input('fecha_fin'));
            $fin = $fin_arr[2]."-".$fin_arr[1]."-".$fin_arr[0]." 11:59:59";
            $ordenes = $ordenes->where('created_at', '<', $fin);
            $filtros['fecha_inic'] = $request->input('fecha_inic');
        }

        $ordenes = $ordenes->paginate(10);
        $order_colunm = $order=='ASC' ? 'desc':'asc';
        $param_nombre = array_merge(['sort'=>'razon_social','order'=>$order_colunm], $filtros);
        $param_date = array_merge(['sort'=>'created_at','order'=>$order_colunm], $filtros);
        $param_orden = array_merge(['sort'=>'nro_orden','order'=>$order_colunm], $filtros);
        $param_total = array_merge(['sort'=>'total','order'=>$order_colunm], $filtros);

        return view('report.ventas', compact('ordenes','order_colunm',
                                            'empresas','filtros',
                                            'param_nombre','param_date',
                                            'param_orden','param_total',
                                            'monto_plan','empresa'));
    }
    public function planes_a_excel(Request $request){
        $planObj = Plan::orderBy('nombre')->get();

        $enterprises = new Enterprise;

        $order = $request->input('order') == 'asc' ? 'ASC':'DESC';

        $enterprises = Enterprise::select('enterprises.*','planes.created_at AS created_date',
            'planes.id AS plan_id',
            \DB::raw('(select SUM(so.total) from sale_orders as so where so.enterprise_id = enterprises.id) AS total_sales'))
            ->leftJoin('planes', 'planes.id', '=', 'enterprises.plan_id')
            ->orderBy('total_sales', $order);



        if($request->input('sort') == 'razon_social'){
            $enterprises = Enterprise::orderBy('razon_social',$order);
        }
        elseif ($request->input('sort') == 'created_at') {
            $enterprises = Enterprise::orderBy('created_at',$order);
        }
        elseif ($request->input('sort') == 'plan') {
            $enterprises = Enterprise::select('enterprises.*','planes.created_at AS created_date','planes.id AS plan_id')
                ->leftJoin('planes', 'planes.id', '=', 'enterprises.plan_id')
                ->orderBy('planes.nombre', $order);
        }
        elseif ($request->input('sort') == 'totals') {
            $enterprises = Enterprise::select('enterprises.*','planes.created_at AS created_date',
                'planes.id AS plan_id',
                \DB::raw('(select SUM(so.total) from sale_orders as so where so.enterprise_id = enterprises.id) AS total_sales'))
                ->leftJoin('planes', 'planes.id', '=', 'enterprises.plan_id')
                ->orderBy('total_sales', $order);
        }

        //Filters
        $filtros = array();
        $monto_plan = $planObj = null;
        if($request->input('tipo_plan')){
            $enterprises = $enterprises->where('plan_id', $request->input('tipo_plan'));
            $filtros['tipo_plan'] = $request->input('tipo_plan');
            $planObj = Plan::find($request->input('tipo_plan'));
            $monto_plan = Enterprise::select(\DB::raw('SUM(payment_orders.monto) AS total_sales'))
                ->where('plan_id', $request->input('tipo_plan'))
                ->leftJoin('payment_orders', 'payment_orders.enterprise_id', '=', 'enterprises.id')
                ->first();
        }else{
            $planObj = Plan::find(2);
        }

        if($request->input('fecha_inic') != '' && $request->input('fecha_fin') != ''){
            $inic_arr = explode('/', $request->input('fecha_inic'));
            $inic = $inic_arr[2]."-".$inic_arr[1]."-".$inic_arr[0]." 00:00:00";
            $fin_arr = explode('/', $request->input('fecha_fin'));
            $fin = $fin_arr[2]."-".$fin_arr[1]."-".$fin_arr[0]." 11:59:59";
            $enterprises = $enterprises->whereBetween('created_at', [$inic, $fin]);
            $filtros['fecha_inic'] = $request->input('fecha_inic');
            $filtros['fecha_fin'] = $request->input('fecha_fin');
        }elseif($request->input('fecha_inic') != '' && $request->input('fecha_fin') == ''){
            $inic_arr = explode('/', $request->input('fecha_inic'));
            $inic = $inic_arr[2]."-".$inic_arr[1]."-".$inic_arr[0]." 00:00:00";
            $enterprises = $enterprises->where('created_at', '>', $inic);
            $filtros['fecha_fin'] = $request->input('fecha_fin');
        }elseif($request->input('fecha_inic') == '' && $request->input('fecha_fin') != ''){
            $fin_arr = explode('/', $request->input('fecha_fin'));
            $fin = $fin_arr[2]."-".$fin_arr[1]."-".$fin_arr[0]." 11:59:59";
            $enterprises = $enterprises->where('created_at', '<', $fin);
            $filtros['fecha_inic'] = $request->input('fecha_inic');
        }

        $enterprises = $enterprises->get();

        \Excel::create('report', function($excel) use ($planObj, $enterprises, $filtros) {
            $excel->sheet('hoja_'.date('d-m-Y'), function($sheet) use ($planObj, $enterprises, $filtros) {
                $inic_table_row = 3;
                $sheet->mergeCells('A1:B1');

                $sheet->row(1, array(
                    'Reporte de Planes'
                ));
//
//                $sheet->row(2, array(
//                    'Plan',$planes->nombre
//                ));

                if($planObj != null){
                    $inic_table_row++;
                    $sheet->row(2, array(
                        'Plan', $planObj->nombre
                    ));
                }

                $fechas = array();
                if(isset($filtros['fecha_inic'])){
                    $inic_table_row++;
                    $inic_table_row++;
                    $fechas[] = 'Fecha Inicial';
                    $fechas[] = $filtros['fecha_inic'];
                }

                if(isset($filtros['fecha_inic'])){
                    $fechas[] = 'Fecha Final';
                    $fechas[] = $filtros['fecha_fin'];
                }

                if(!empty($fechas)){
                    $sheet->row(3, $fechas);
                }

                $sheet->row($inic_table_row, array(
                    'Empresa',
                    'Activa desde',
                    'Plan',
                    'Ingreso Total'
                ));

                $sheet->row($inic_table_row, function($row){
                    $row->setBackground('#337ab7');
                });

                $sheet->setHeight($inic_table_row, 20);

                $sheet->cells('A'.$inic_table_row.':G'.$inic_table_row, function($cells) {
                    $cells->setFontSize(12);
                    $cells->setValignment('top');
                });

                $sheet->setBorder('A'.$inic_table_row.':G'.$inic_table_row, 'thin');
//                $acum = 0;
                foreach ($enterprises as $key => $auxEmpresa) {
//                    $acum+=$orden->total;
                    $sheet->row($key+1+$inic_table_row, array(
                        $auxEmpresa->razon_social,
                        date("d/m/Y A", strtotime($auxEmpresa->created_at)),
                        date("d/m/Y h:i:s A", strtotime($auxEmpresa->created_at)),
                        $auxEmpresa->total_sales));

                    $sheet->cells('E'.($key+1+$inic_table_row).':G'.($key+1+$inic_table_row), function($cells) {
                        $cells->setAlignment('right');
                    });
                }

//                $sheet->row($key+4+$inic_table_row, array(
//                    'Ventas Totales', number_format($acum, 2, ',', '.')
//                ));
//                $sheet->cells('B'.($key+4+$inic_table_row), function($cells) {
//                    $cells->setAlignment('right');
//                });
            });
        })->download('xls');
    }

    public function ventas_a_excel(Request $request){
        $empresas = Enterprise::orderBy('razon_social')->get();
        $ordenes = new SaleOrder;
        $order = $request->input('order') == 'asc' ? 'ASC':'DESC';
        $filtros = array();

        if($request->input('sort') == 'razon_social'){
            $ordenes = $ordenes->orderBy('razon_social',$order);
        }
        elseif ($request->input('sort') == 'created_at') {
            $ordenes = $ordenes->orderBy('created_at',$order);
        }
        elseif ($request->input('sort') == 'nro_orden') {
            $ordenes = $ordenes->orderBy('nro_orden',$order);
        }
        elseif ($request->input('sort') == 'total') {
            $ordenes = $ordenes->orderBy('total',$order);
        }

        $empresa = null;
        if($request->input('empresa_id')){
            $ordenes = $ordenes->where('enterprise_id', $request->input('empresa_id'));
            $empresa = Enterprise::find($request->input('empresa_id'));
            $filtros['empresa_id'] = $request->input('empresa_id');
        }

        if($request->input('fecha_inic') != '' && $request->input('fecha_fin') != ''){
            $inic_arr = explode('/', $request->input('fecha_inic'));
            $inic = $inic_arr[2]."-".$inic_arr[1]."-".$inic_arr[0]." 00:00:00";
            $fin_arr = explode('/', $request->input('fecha_fin'));
            $fin = $fin_arr[2]."-".$fin_arr[1]."-".$fin_arr[0]." 11:59:59";
            $ordenes = $ordenes->whereBetween('created_at', [$inic, $fin]);
            $filtros['fecha_inic'] = $request->input('fecha_inic');
            $filtros['fecha_fin'] = $request->input('fecha_fin');
        }elseif($request->input('fecha_inic') != '' && $request->input('fecha_fin') == ''){
            $inic_arr = explode('/', $request->input('fecha_inic'));
            $inic = $inic_arr[2]."-".$inic_arr[1]."-".$inic_arr[0]." 00:00:00";
            $ordenes = $ordenes->where('created_at', '>', $inic);
            $filtros['fecha_fin'] = $request->input('fecha_fin');
        }elseif($request->input('fecha_inic') == '' && $request->input('fecha_fin') != ''){
            $fin_arr = explode('/', $request->input('fecha_fin'));
            $fin = $fin_arr[2]."-".$fin_arr[1]."-".$fin_arr[0]." 11:59:59";
            $ordenes = $ordenes->where('created_at', '<', $fin);
            $filtros['fecha_inic'] = $request->input('fecha_inic');
        }

        $ordenes = $ordenes->get();

        \Excel::create('report', function($excel) use ($ordenes, $empresa, $filtros) {
            $excel->sheet('hoja_'.date('d-m-Y'), function($sheet) use ($ordenes, $empresa, $filtros) {
                $inic_table_row = 3;
                $sheet->mergeCells('A1:B1');

                $sheet->row(1, array(
                    'Reporte de Ventas'
                ));

                if($empresa != null){
                    $inic_table_row++;
                    $sheet->row(2, array(
                        'Empresa', $empresa->razon_social
                    ));
                }

                $fechas = array();
                if(isset($filtros['fecha_inic'])){
                    $inic_table_row++;
                    $inic_table_row++;
                    $fechas[] = 'Fecha Inicial'; 
                    $fechas[] = $filtros['fecha_inic'];
                }

                if(isset($filtros['fecha_inic'])){
                    $fechas[] = 'Fecha Final'; 
                    $fechas[] = $filtros['fecha_fin'];
                }

                if(!empty($fechas)){
                    $sheet->row(3, $fechas);
                }

                $sheet->row($inic_table_row, array(
                    'Cliente',
                    'Empresa',
                    'Fecha',
                    'Nro. de orden',
                    'Monto',
                    'IVA',
                    'Total'
                ));

                $sheet->row($inic_table_row, function($row){
                    $row->setBackground('#337ab7');
                });

                $sheet->setHeight($inic_table_row, 20);

                $sheet->cells('A'.$inic_table_row.':G'.$inic_table_row, function($cells) {
                    $cells->setFontSize(12);
                    $cells->setValignment('top');
                });

                $sheet->setBorder('A'.$inic_table_row.':G'.$inic_table_row, 'thin');
                $acum = 0;
                foreach ($ordenes as $key => $orden) {
                    $acum+=$orden->total;
                    $sheet->row($key+1+$inic_table_row, array(
                        $orden->razon_social,
                        $orden->enterprise->razon_social,
                        date("d/m/Y h:i:s A", strtotime($orden->created_at)),
                        $orden->nro_orden,
                        number_format($orden->monto, 2, ',', '.'),
                        number_format($orden->iva, 2, ',', '.'),
                        number_format($orden->total, 2, ',', '.')
                    ));

                    $sheet->cells('E'.($key+1+$inic_table_row).':G'.($key+1+$inic_table_row), function($cells) {
                        $cells->setAlignment('right');
                    });
                }

                $sheet->row($key+4+$inic_table_row, array(
                    'Ventas Totales', number_format($acum, 2, ',', '.')
                ));
                $sheet->cells('B'.($key+4+$inic_table_row), function($cells) {
                    $cells->setAlignment('right');
                });
            });
        })->download('xls');
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
