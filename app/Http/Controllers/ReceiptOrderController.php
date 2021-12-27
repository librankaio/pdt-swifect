<?php

namespace App\Http\Controllers;

use App\Models\mitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;
use JavaScript;

class ReceiptOrderController extends Controller
{
    public function index(Request $request){
        $noinbound = $request->noinbound;
        $nopo = $request->nopo;
        $kodes = DB::table('tinboundid')->select(DB::raw('count(*) as id'))->where('nopo','=',$nopo)->where('no_tinbound','=',$noinbound)->get();

        $pallet = DB::table('mpallet')->get();
        
        $nopo = DB::table('tinboundd')->get();

        $inbound = DB::table('tinbound')->get();

        $item_r = DB::table('tinboundd')->get();

        
        return view('reports.receiptord',[
            'kodes'=>$kodes,
            'item_r'=>$item_r,
            'pallet'=>$pallet,
            'nopo'=>$nopo,
            'inbound'=>$inbound]);
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

    public function getInbound(){
        $inbound = DB::table('tinbound')->get();
        // $searchinbound = $request->searchinbound;
        // if($searchinbound == ''){
        //     $kodes = DB::table('tinbound')->orderBy('id','asc')->where('stat','=','1')->limit(10)->get();
        // }else{
        //     $kodes = DB::table('tinbound')->orderBy('id','asc')->where('stat','=','1')->where('no', 'like',  '%' .$searchinbound. '%')->limit(10)->get();
        // }

        // $response = array();
        // foreach($kodes as $kode){
        //     $response[] = array(
        //         "id"=>$kode->id,
        //         "text"=>$kode->no,
        //         "tanggal"=>$kode->tdate,
        //         "pemilik"=>$kode->name_mbp,
        //         "note"=>$kode->note,
        //     );
        // }
        // return response()->json($response);
        return json_encode($inbound);
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

    public function getPalletR(Request $request){
        $id = $request->input('id');
        $item = $request->get('nopo');
        $nopo_r = DB::table('mpallet')->orderby('id','asc')->where('stat','=','1')->where('id','=',$id)->get();
        return $nopo_r;
    }

    public function getPalletId(Request $request){
        $id = $request->input('id');
        $item_r = DB::table('mpallet')->get();
        return json_encode($item_r);
    }
    // public function getPo(Request $request){
    //     $searchpo = $request->searchpallet;
    //     if($searchpo == ''){
    //         $kodes = DB::table('tinboundd')->orderby('id','asc')->where('stat','=','1')->limit(10)->get();
    //     }else{
    //         $kodes = DB::table('tinboundd')->orderby('id','asc')->where('stat','=','1')->where('no_tinbound', 'like',  '%' .$searchpo. '%')->limit(10)->get();
    //     }

    //     $response = array();
    //     foreach($kodes as $kode){
    //         $response[] = array(
    //             "id"=>$kode->id,
    //             "text"=>$kode->nopo,
    //             "sku"=>$kode->code_mitem,
    //             "desc"=>$kode->name_mitem,
    //             "qty"=>$kode->qty,
    //             "sat"=>$kode->code_muom,
    //         );
    //     }
    //     return response()->json($response);
    // }
    public function getPoRead(Request $request){
        $id = $request->input('id');
        $item = $request->get('nopo');
        $nopo_r = DB::table('tinboundd')->orderby('id','asc')->where('stat','=','1')->where('id','=',$id)->get();
        return $nopo_r;
    }
    public function getPo(Request $request){
        $id = $request->input('id');
        $item_r = DB::table('tinboundd')->get();
        return json_encode($item_r);
    }

    public function getCQty(Request $request){
        $noinbound = $request->noinbound;
        $nopo = $request->input('nopo');
        $kodes = DB::table('tinboundid')->select(DB::raw('count(id) as id'))->where('nopo','=',$nopo)->where('no_tinbound','=',$noinbound)->get();
        // if($searchpallet == ''){
            
        // }else{
        //     $kodes = DB::table('tinboundid')->orderby('id','asc')->where('stat','=','1')->where('code', 'like',  '%' .$searchpallet. '%')->limit(10)->get();
        // }
        
        return json_encode($kodes);
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
