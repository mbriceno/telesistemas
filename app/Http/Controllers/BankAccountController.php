<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BankAccount;
use App\Bank;

class BankAccountController extends Controller
{
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
        $cuentas = BankAccount::paginate(10);

        return view('banks_accounts.index', compact('cuentas'));
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
        $this->validate($request, BankAccount::$rules);
        BankAccount::create($request->all());

        return redirect()->route('admin.empresa.show', $request->input('enterprise_id'))
                        ->with('message', '<div class="alert alert-success" style="margin-top:15px">Cuenta bancaria creada con Éxito</div>');
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
        $cuenta = BankAccount::where('enterprise_id', $id)->first();
        $bancos = Bank::lists('nombre', 'id');

        if($cuenta)
            return view('banks_accounts.edit', compact('cuenta','id','bancos'));
        else
            return view('banks_accounts.create', compact('id','bancos'));
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
        $cuenta = BankAccount::findOrFail($id);
        $data = $request->all();
        $this->validate($request, BankAccount::$rules);

        $cuenta->update($data);
        
        return redirect()
                ->route('admin.empresa.show', $request->input('enterprise_id'))
                ->with('message', '<div class="alert alert-success" style="margin-top:15px">Cuenta Bancaria editada con Éxito</div>');
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
