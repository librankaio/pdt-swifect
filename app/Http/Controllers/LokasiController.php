<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LokasiController extends Controller
{
    public function index(){
        return view('reports.lokasi');
    }

    public function getSKU(Request $request){
        $searchsku = $request->searchsku;
        if($searchsku == ''){
            $kodes = DB::table('mitem')->orderBy('code_mitem','asc')->limit(10)->get();
        }else{
            $kodes = DB::table('mitem')->orderBy('code_mitem','asc')->where('code_mitem', 'like',  '%' .$searchsku. '%')->limit(10)->get();
        }

        $response = array();
        foreach($kodes as $kode){
            $response[] = array(
                "id"=>$kode->id,
                "text"=>$kode->code_mitem,
                "nama"=>$kode->name_mitem,
                "sat"=>$kode->code_muom,
            );
        }
        return response()->json($response);
    }

    public function getInbound(Request $request){
        $searchindbound = $request->searchindbound;
        if($searchindbound == ''){
            $kodes = DB::table('tinbound')->orderBy('id','asc')->limit(10)->get();
        }else{
            $kodes = DB::table('tinbound')->orderBy('id','asc')->where('no', 'like',  '%' .$searchindbound. '%')->limit(10)->get();
        }

        $response = array();
        foreach($kodes as $kode){
            $response[] = array(
                "id"=>$kode->id,
                "text"=>$kode->no,
                "nama"=>$kode->name_mbp,
            );
        }
        return response()->json($response);
    }

    public function getLokasi(Request $request){
        $searchlok = $request->searchlok;
        if($searchlok == ''){
            $kodes = DB::table('mwhse')->orderBy('id','asc')->limit(10)->get();
        }else{
            $kodes = DB::table('mwhse')->orderBy('id','asc')->where('code_mwhse', 'like',  '%' .$searchlok. '%')->limit(10)->get();
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

    public function updLokasi(Request $request){
        // dd($request->all());
        $noinbound = $request->input('hdnnoinbound');
        $sku = $request->input('hdnsku');
        $pallet = $request->input('pallet');
        $lokasi = $request->input('hdnlokasi');
        $qty = $request->input('quantity');
        // dd($request->all());
        DB::table('tinboundd')->where('code_mitem','=',$sku)->where('no_tinbound','=',$noinbound)->update(['code_mwhse'=> $lokasi,'pallet'=>$pallet]);
        
        return redirect('/lokasi');

        // return view('reports.lokasi');
    }
}
