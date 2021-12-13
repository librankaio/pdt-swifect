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
            $kodes = DB::table('toutbound')->orderBy('code_mitem','asc')->where('no', '=' .$notrans)->limit(10)->get();
        }else{
            $kodes = DB::table('toutbound')->orderBy('code_mitem','asc')->where('no',  'like',  '%'.$notrans)->limit(10)->get();
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
            $kodes = DB::table('toutbound')->orderby('no','asc')->limit(10)->get();
        }else{
            $kodes = DB::table('toutbound')->orderby('no','asc')->where('no', 'like',  '%' .$searchLok. '%')->limit(10)->get();
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
        $notrans = $request->input('hdntrans');
        $sku = $request->input('skuhdn');
        $qty = $request->input('qty');
        // dd($request->all());
        DB::table('toutbound')->where('no','=',$notrans)->where('code_mitem','=',$sku)->update(['qtycheck'=> $qty]);
        
        return redirect('/dashboard');
    }
}
