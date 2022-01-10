<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutboundController extends Controller
{
    public function index(Request $request){
        $noutbound = $request->noutbound;
        $nopo = $request->nopo;
        $kodes = DB::table('toutboundid')->select(DB::raw('count(*) as id'))->where('nopo','=',$nopo)->where('no_toutbound','=',$noutbound)->get();

        $pallet = DB::table('mpallet')->get();
        
        $nopo = DB::table('tinboundd')->get();

        $outbound = DB::table('toutbound')->get();

        $item_r = DB::table('toutboundd')->get();
        // dd($nopo);
        return view('reports.outbound',[
            'kodes'=>$kodes,
            'item_r'=>$item_r,
            'pallet'=>$pallet,
            'nopo'=>$nopo,
            'outbound'=>$outbound]);
    }

    public function getOutbound(){
        $outbound = DB::table('toutbound')->get();
        return json_encode($outbound);
    }

    public function getPalletId(Request $request){
        $id = $request->input('id');
        $item_r = DB::table('mpallet')->get();
        return json_encode($item_r);
    }

    public function getPoOutbound(Request $request){
        // $id = $request->input('id');
        $item_r = DB::table('tinboundd')->get();
        return json_encode($item_r);
    }

    public function getCQtyOut(Request $request){
        $pallet = $request->pallet;
        $nopo = $request->nopo;
        $kodes = DB::table('tinboundid')->select(DB::raw('count(id) as jumlah'))->where('nopo','=',$nopo)->where('pallet','=',$pallet)->get();
        
        return json_encode($kodes);
    }

    public function getIdCrtnOut(Request $request){
        $idcarton = $request->idcarton;
        $cartoncount = DB::table('toutboundid')->select(DB::raw('count(id) as jcrtnid'))->where('cartonid','=',$idcarton)->get();
        
        return json_encode($cartoncount);
    }

    public function getPalletCapOut(Request $request){
        $nooutbound = $request->nooutbound;
        $nopo = $request->nopo;
        $palletid = $request->palletid;


        $pltcapcount = DB::table('toutboundd')->select('pltcap')->where('no_toutbound','=',$nooutbound)->where('pallet','=',$palletid)->where('nopo','=',$nopo)->get();

        return json_encode($pltcapcount);
    }

    public function sumQtyOut(Request $request){
        $pallet = $request->pallet;
        $nopo = $request->nopo;
        $kodes = DB::table('tinboundid')->select(DB::raw('count(id) as jumlahqty'))->where('nopo','=',$nopo)->where('pallet','=',$pallet)->get();
        
        return json_encode($kodes);
    }

    public function getPalletOut(Request $request){
        $nopo = $request->nopo;
        $palletout = DB::table('tinboundid')->select('pallet')->where('nopo','=',$nopo)->groupBy('pallet')->get();

        return json_encode($palletout);
    }

    public function insOutbound(Request $request){
        // dd($request->all());

        $noutbound = $request->input('noutbound');
        $sku = $request->input('nama_sku');
        $nopo = $request->input('nopo');
        $pallet = $request->input('pallet');
        $cartonid = $request->input('crtnid');
        $sat = $request->input('sat');
        $desc = $request->input('desc');

        $cartoncount = DB::table('toutboundid')->select(DB::raw('count(id) as jcrtnid'))->where('cartonid','=',$cartonid)->get();
        
        foreach($cartoncount as $itemcrtn){
            $hasil = $itemcrtn->jcrtnid; 
        }

        // dd($hasil);
        if ($hasil >= 1){
            $pallet = DB::table('mpallet')->get();
            $nopo = DB::table('toutboundd')->get();
            $outbound = DB::table('toutbound')->get();
            $item_r = DB::table('toutboundd')->get();
            // return redirect('/dashboard');

            return view('reports.outbound',[
                'pallet'=>$pallet,
                'nopo'=>$nopo,
                'outbound'=>$outbound,
                'item_r'=>$item_r,
                'message_error'=> 'Data carton ID Sudah ada!']);
        }else{
            DB::table('toutboundid')->insert(['no_toutbound'=> $noutbound,'pallet'=>$pallet,'code_mitem'=>$sku,"cartonid"=>$cartonid,'code_muom'=>$sat,'nopo'=>$nopo,'name_mitem'=>$desc,'usin'=>'1']);
            
            $pallet = DB::table('mpallet')->get();
            $nopo = DB::table('toutboundd')->get();
            $outbound = DB::table('toutbound')->get();
            $item_r = DB::table('toutboundd')->get();
            // return redirect('/dashboard');

            return view('reports.outbound',[
                'pallet'=>$pallet,
                'nopo'=>$nopo,
                'outbound'=>$outbound,
                'item_r'=>$item_r,
                'message_success'=>'Data Berhasil Di inputkan']);
        }
    }
}
