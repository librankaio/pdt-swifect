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

    public function getKode(Request $request){
        $search = $request->search;
        $notrans = $request->notrans;
        if($notrans == null){
            $kodes = DB::table('tinboundd')->orderBy('code_mitem','asc')->where('no_tinbound', '=' .$notrans)->limit(10)->get();
        }else{
            $kodes = DB::table('tinboundd')->orderBy('code_mitem','asc')->where('no_tinbound',  'like',  '%'.$notrans)->limit(10)->get();
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
            $kodes = DB::table('tinbound')->orderby('no','asc')->limit(10)->get();
        }else{
            $kodes = DB::table('tinbound')->orderby('no','asc')->where('no', 'like',  '%' .$searchTrans. '%')->limit(10)->get();
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
        $notransfld = $request->input('noTrans');
        $notrans = $request->input('hdntrans');
        $sku = $request->input('skuhdn');
        $pallet = $request->input('pallet');
        $lokasi = $request->input('hdnlokasi');
        $qty = $request->input('qty');
        // dd($request->all());
        DB::table('tinboundd')->where('no_tinbound','=',$notrans)->where('code_mitem','=',$sku)->update(['qtycheck'=> $qty,'pallet'=>$pallet,'code_mwhse'=>$lokasi]);
        
        // return redirect('/dashboard');

        return view('reports.receiptord');
    }

    
}
