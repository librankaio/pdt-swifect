<?php

namespace App\Http\Controllers;

use App\Models\mitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class ReceiptOrderController extends Controller
{
    public function index(){
        return view('reports.receiptord');
    }

    public function show(Request $request){
        
        
        if(isset($request->noTrans)){
            // dd($request->all());
            if($request->input('sku')== ''){
                $notrans = $request->input('noTrans');
                $alltrecs = DB::table('trec')->where('no','=',$notrans)->get();
                $sku = DB::table('mitem')->select('code')->get();
                $skuall = DB::table('mitem')->get();
                return view('reports.receiptord',[
                    'alltrecs'=>$alltrecs,
                    'sku'=>$sku,
                    'skuall'=>$skuall]);
            }else{
                $notrans = $request->input('noTrans');
                $code = $request->input('code');
                $alltrecs = DB::table('trec')->where('no','=',$notrans)->get();
                $valisku = DB::table('mitem')->where('code','=',$code)->get();
                $sku = DB::table('mitem')->select('code')->get();
                return view('reports.receiptord',[
                    'alltrecs'=>$alltrecs,
                    'valisku'=>$valisku,
                    'sku'=>$sku]);
            }
            
        }
    }

    public function getInbound(Request $request){
        $searchinbound = $request->searchinbound;
        if($searchinbound == ''){
            $kodes = DB::table('tinbound')->orderBy('id','asc')->where('stat','=','1')->limit(10)->get();
        }else{
            $kodes = DB::table('tinbound')->orderBy('id','asc')->where('stat','=','1')->where('no', 'like',  '%' .$searchinbound. '%')->limit(10)->get();
        }

        $response = array();
        foreach($kodes as $kode){
            $response[] = array(
                "id"=>$kode->id,
                "text"=>$kode->no,
                "tanggal"=>$kode->tdate,
                "pemilik"=>$kode->name_mbp,
                "note"=>$kode->note,
            );
        }
        return response()->json($response);
    }

    public function getPallet(Request $request){
        $searchpallet = $request->searchpallet;
        if($searchpallet == ''){
            $kodes = DB::table('mpallet')->orderby('id','asc')->where('stat','=','1')->limit(10)->get();
        }else{
            $kodes = DB::table('mpallet')->orderby('id','asc')->where('stat','=','1')->where('code', 'like',  '%' .$searchpallet. '%')->limit(10)->get();
        }

        $response = array();
        foreach($kodes as $kode){
            $response[] = array(
                "id"=>$kode->id,
                "text"=>$kode->code,
            );
        }
        return response()->json($response);
    }

    public function getPo(Request $request){
        $searchpallet = $request->searchpallet;
        if($searchpallet == ''){
            $kodes = DB::table('tinboundd')->orderby('id','asc')->where('stat','=','1')->limit(10)->get();
        }else{
            $kodes = DB::table('tinboundd')->orderby('id','asc')->where('stat','=','1')->where('code', 'like',  '%' .$searchpallet. '%')->limit(10)->get();
        }

        $response = array();
        foreach($kodes as $kode){
            $response[] = array(
                "id"=>$kode->id,
                "text"=>$kode->nopo,
                "sku"=>$kode->code_mitem,
                "desc"=>$kode->name_mitem,
                "qty"=>$kode->qty,
                "sat"=>$kode->code_muom,
            );
        }
        return response()->json($response);
    }

    public function insertQty(Request $request){
        // dd($request->all());
        $noinbound = $request->input('hdnnoinbound');
        $sku = $request->input('nama_sku');
        $nopo = $request->input('hdnpo');
        $pallet = $request->input('hdnpallet');
        $cartonid = $request->input('crtnid');
        $sat = $request->input('sat');
        // dd($request->all());
        DB::table('tinboundid')->insert(['no_tinbound'=> $noinbound,'pallet'=>$pallet,'code_mitem'=>$sku,"cartonid"=>$cartonid,'code_muom'=>$sat,'nopo'=>$nopo,'usin'=>'1']);
        
        // return redirect('/dashboard');

        return view('reports.receiptord');
    }

    
}
