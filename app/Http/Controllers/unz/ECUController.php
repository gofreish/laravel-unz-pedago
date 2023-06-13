<?php

namespace App\Http\Controllers\unz;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ECU;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class ECUController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('unz_st.ecu.index');
    }

    public function createPDF( Request $request ){
        return PDF::loadHtml($request->html)
            ->download($request->pdfName.".pdf");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //dd( User::find(3)->getRoleNames() );
        return view('unz_st.ecu.create');
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
        $request->validate([
            'code' => ['required', 'string','max:255', 'unique:e_c_u_s'],
            'ecu' => ['required'],
            'coefficient' => ['required','integer','numeric'],
            'ue' => ['required'],
        ]);

        //Création de l ECU
        ECU::create([
            'code' => $request->code,
            'nom' => $request->ecu,
            'coefficient' => $request->coefficient,
            'u_e_id' => $request->ue
        ]);

        //Recherche de l id de ECU dans la BDD du BREAD
        $ecu_id = DB::table('form')->where('name', '=','ECU')->value('id');

        return redirect()->route('resource.index',
            ['table' => $ecu_id]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($ecu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($ecu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ecu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($ecu)
    {
        //
        ECU::destroy($ecu);
        return view('unz_st.ecu.index');
    }
}
