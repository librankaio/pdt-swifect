<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutboundController extends Controller
{
    public function index(){
        return view('reports.outbound');
    }

    public function getKode(Request $request){
        $search = $request->search;
        $notrans = $request->notrans;
        if($notrans == null){
            $kodes = DB::table('toutboundd')->orderBy('code_mitem','asc')->where('no_toutbound', '=' .$notrans)->limit(10)->get();
        }else{
            $kodes = DB::table('toutboundd')->orderBy('code_mitem','asc')->where('no_toutbound',  'like',  '%'.$notrans)->limit(10)->get();
        }

        $response = array();
        foreach($kodes as $kode){
            $response[] = array(
                "id"=>$kode->id,
                "text"=>$kode->code_mitem,
                "nama"=>$kode->name_mitem,
                "sat"=>$kode->code_muom,
                "lokasi"=>$kode->code_mwhse,
                "pallet"=>$kode->pallet,
            );
        }
        return response()->json($response);
    }

    public function getNoTrans(Request $request){
        $searchTrans = $request->searchTrans;
        if($searchTrans == ''){
            $kodes = DB::table('toutbound')->orderby('no','asc')->limit(10)->get();
        }else{
            $kodes = DB::table('toutbound')->orderby('no','asc')->where('no', 'like',  '%' .$searchTrans. '%')->limit(10)->get();
        }

        $response = array();
        foreach($kodes as $kode){
            $response[] = array(
                "id"=>$kode->id,
                "text"=>$kode->no,
                "tgl"=>$kode->tdate,
                "nama"=>$kode->name_mbp,
                "note"=>$kode->note
            );
        }
        return response()->json($response);
    }

    public function getLokasi(Request $request){
        $searchLok = $request->searchLok;
        if($searchLok == ''){
            $kodes = DB::table('mwhse')->orderby('id','asc')->limit(10)->get();
        }else{
            $kodes = DB::table('mwhse')->orderby('id','asc')->where('code_mwhse', 'like',  '%' .$searchLok. '%')->limit(10)->get();
        }

        $response = array();
        foreach($kodes as $kode){
            $response[] = array(
                "id"=>$kode->id,
                "text"=>$kode->code_mwhse,
            );
        }
        return response()->json($response);
    }

    public function updSKU(Request $request){
        // dd($request->all());
        $notrans = $request->input('hdntrans');
        $sku = $request->input('skuhdn');
        $pallet = $request->input('pallet');
        $lokasi = $request->input('hdnlokasi');
        $qty = $request->input('qty');
        // dd($request->all());
        DB::table('toutboundd')->where('no_toutbound','=',$notrans)->where('code_mitem','=',$sku)->update(['qtycheck'=> $qty,'pallet'=>$pallet,'code_mwhse'=>$lokasi]);
        
        // return redirect('/dashboard');
        return view('reports.outbound');
    }
}
