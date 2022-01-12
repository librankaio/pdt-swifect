<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LokasiController extends Controller
{
    public function index(){
        $pallet = DB::table('mpallet')->get();

        $nopo = DB::table('tinboundd')->where('linestat','=','O')->get();

        $lokasi = DB::table('mwhse')->get();

        return view('reports.lokasi',[
            'pallet'=>$pallet,
            'nopo'=>$nopo,
            'lokasi'=>$lokasi]);
    }

    public function getQtycCrtn(Request $request){
        $pallet = $request->pallet;
        $nopo = $request->nopo;

        $qtyctn = DB::table('tinboundd')->select('qty')->where('nopo','=',$nopo)->where('pallet','=',$pallet)->get();

        return json_encode($qtyctn);
    }

    public function getPalletLok(Request $request){
        $nopo = $request->nopo;

        $qtyctn = DB::table('tinboundd')->select('pallet')->where('nopo','=',$nopo)->get();

        return json_encode($qtyctn);
    }

    public function getSKU(Request $request){
        $searchsku = $request->searchsku;
        if($searchsku == ''){
            $kodes = DB::table('mitem')->orderBy('code_mitem','asc')->where('stat','=','1')->limit(10)->get();
        }else{
            $kodes = DB::table('mitem')->orderBy('code_mitem','asc')->where('stat','=','1')->where('code_mitem', 'like',  '%' .$searchsku. '%')->limit(10)->get();
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
            $kodes = DB::table('tinbound')->orderBy('id','asc')->where('stat','=','1')->limit(10)->get();
        }else{
            $kodes = DB::table('tinbound')->orderBy('id','asc')->where('stat','=','1')->where('no', 'like',  '%' .$searchindbound. '%')->limit(10)->get();
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
            $kodes = DB::table('mwhse')->orderBy('id','asc')->where('stat','=','1')->limit(10)->get();
        }else{
            $kodes = DB::table('mwhse')->orderBy('id','asc')->where('stat','=','1')->where('code_mwhse', 'like',  '%' .$searchlok. '%')->limit(10)->get();
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
        $nopo = $request->input('nopo');
        $pallet = $request->input('pallet');
        $lokasi = $request->input('lokasi');
        // dd($request->all());
        DB::table('tinboundd')->where('nopo','=',$nopo)->where('pallet','=',$pallet)->where('linestat','=','O')->update(['lokasi'=> $lokasi]);
        
        // return redirect('/lokasi');

        $pallet = DB::table('mpallet')->get();

        $nopo = DB::table('tinboundd')->where('linestat','=','O')->get();

        $lokasi = DB::table('mwhse')->get();
        return view('reports.lokasi',[
            'message_success'=>'Data Berhasil Di inputkan',
            'pallet'=>$pallet,
            'nopo'=>$nopo,
            'lokasi'=>$lokasi]);
    }
}
