<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bank;

class BankController extends Controller
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
        $bancos = Bank::orderBy('nombre')->paginate(10);

        return view('bank.index', compact('bancos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Bank::$rules);
        Bank::create($request->all());

        return redirect()->route('admin.bancos.index')->with('message', '<div class="alert alert-success" style="margin-top:15px">Banco creado con Éxito</div>');
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
        $banco = Bank::find($id);

        return view('bank.edit', compact('banco'));
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
        $banco = Bank::findOrFail($id);
        $data = $request->all();
        $this->validate($request, Bank::$rules);

        $banco->update($data);
        
        return redirect()
                ->route('admin.bancos.index')
                ->with('message', '<div class="alert alert-success" style="margin-top:15px">Banco editado con Éxito</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bank::destroy($id);

        return redirect()->route('admin.bancos.index')->with('message', '<div class="alert alert-success" style="margin-top:15px">Banco eliminado con Éxito</div>');
    }
}
