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


        // $pltcapcount = DB::table('tinboundd')->select('pltcap')->where('no_tinbound','=','PKID2-21-7193')->where('nopo','=','AAAA')->where('pallet','=','PL003')->get();
        // dd($pltcapcount);
        // $cartoncount = DB::table('tinboundid')->select(DB::raw('count(id) as jcrtnid'))->where('cartonid','=','928401238490823908230')->get();

        // foreach($cartoncount as $itemcrtn){
        //     $hasil = $itemcrtn->jcrtnid; 
        // }

        // dd($hasil);

        return view('reports.receiptord',[
            'kodes'=>$kodes,
            'item_r'=>$item_r,
            'pallet'=>$pallet,
            'nopo'=>$nopo,
            'inbound'=>$inbound]);
    }

    // public function show(Request $request){
        
        
    //     if(isset($request->noTrans)){
    //         // dd($request->all());
    //         if($request->input('sku')== ''){
    //             $notrans = $request->input('noTrans');
    //             $alltrecs = DB::table('trec')->where('no','=',$notrans)->get();
    //             $sku = DB::table('mitem')->select('code')->get();
    //             $skuall = DB::table('mitem')->get();
    //             return view('reports.receiptord',[
    //                 'alltrecs'=>$alltrecs,
    //                 'sku'=>$sku,
    //                 'skuall'=>$skuall]);
    //         }else{
    //             $notrans = $request->input('noTrans');
    //             $code = $request->input('code');
    //             $alltrecs = DB::table('trec')->where('no','=',$notrans)->get();
    //             $valisku = DB::table('mitem')->where('code','=',$code)->get();
    //             $sku = DB::table('mitem')->select('code')->get();
    //             return view('reports.receiptord',[
    //                 'alltrecs'=>$alltrecs,
    //                 'valisku'=>$valisku,
    //                 'sku'=>$sku]);
    //         }
            
    //     }
    // }

    public function getInbound(){
        $inbound = DB::table('tinbound')->get();
        return json_encode($inbound);
    }

    // public function getPallet(Request $request){
    //     $searchpallet = $request->searchpallet;
    //     if($searchpallet == ''){
    //         $kodes = DB::table('mpallet')->orderby('id','asc')->where('stat','=','1')->limit(10)->get();
    //     }else{
    //         $kodes = DB::table('mpallet')->orderby('id','asc')->where('stat','=','1')->where('code', 'like',  '%' .$searchpallet. '%')->limit(10)->get();
    //     }

    //     $response = array();
    //     foreach($kodes as $kode){
    //         $response[] = array(
    //             "id"=>$kode->id,
    //             "text"=>$kode->code,
    //         );
    //     }
    //     return response()->json($response);
    // }

    // public function getPalletR(Request $request){
    //     $id = $request->input('id');
    //     $item = $request->get('nopo');
    //     $nopo_r = DB::table('mpallet')->orderby('id','asc')->where('stat','=','1')->where('id','=',$id)->get();
    //     return $nopo_r;
    // }

    public function getPalletId(Request $request){
        $id = $request->input('id');
        $item_r = DB::table('mpallet')->get();
        return json_encode($item_r);
    }

    public function getPoRead(Request $request){
        $id = $request->input('id');
        $item = $request->get('nopo');
        $nopo_r = DB::table('tinboundd')->orderby('id','asc')->where('stat','=','1')->where('id','=',$id)->get();
        return $nopo_r;
    }
    public function getWhrPO(Request $request){
        $noinbound = $request->noinbound;
        $item_r = DB::table('tinboundd')->where('no_tinbound','=',$noinbound)->get();
        return json_encode($item_r);
    }

    public function getPo(Request $request){
        $id = $request->input('id');
        $item_r = DB::table('tinboundd')->get();
        return json_encode($item_r);
    }

    public function getCQty(Request $request){
        $noinbound = $request->noinbound;
        $nopo = $request->nopo;
        $kodes = DB::table('tinboundid')->select(DB::raw('count(id) as jumlah'))->where('nopo','=',$nopo)->where('no_tinbound','=',$noinbound)->get();
        
        return json_encode($kodes);
    }

    public function sumQty(Request $request){
        $noinbound = $request->noinbound;
        $nopo = $request->nopo;
        $kodes = DB::table('tinboundid')->select(DB::raw('count(id) as jumlahqty'))->where('nopo','=',$nopo)->where('no_tinbound','=',$noinbound)->get();
        
        return json_encode($kodes);
    }

    public function getIdCrtn(Request $request){
        $idcarton = $request->idcarton;
        $cartoncount = DB::table('tinboundid')->select(DB::raw('count(id) as jcrtnid'))->where('cartonid','=',$idcarton)->get();

        return json_encode($cartoncount);
    }

    public function getPalletCap(Request $request){
        $noinbound = $request->noinbound;
        $nopo = $request->nopo;
        $palletid = $request->palletid;


        $pltcapcount = DB::table('tinboundd')->select('pltcap')->where('no_tinbound','=',$noinbound)->where('pallet','=',$palletid)->where('nopo','=',$nopo)->get();

        return json_encode($pltcapcount);
    }

    public function insertQty(Request $request){
        // dd($request->all());
        $noinbound = $request->input('noinbound');
        $sku = $request->input('nama_sku');
        $nopo = $request->input('nopo');
        $pallet = $request->input('pallet');
        $cartonid = $request->input('crtnid');
        $sat = $request->input('sat');
        $desc = $request->input('desc');
        $palletcap = $request->input('palletcap');
        
        //validate id carton
        $cartoncount = DB::table('tinboundid')->select(DB::raw('count(id) as jcrtnid'))->where('cartonid','=',$cartonid)->get();
        
        foreach($cartoncount as $itemcrtn){
            $hasil = $itemcrtn->jcrtnid; 
        }

        // dd($hasil);
        if ($hasil >= 1){
            $pallet = DB::table('mpallet')->get();
            $nopo = DB::table('tinboundd')->get();
            $inbound = DB::table('tinbound')->get();
            $item_r = DB::table('tinboundd')->get();
            // return redirect('/dashboard');

            return view('reports.receiptord',[
                'pallet'=>$pallet,
                'nopo'=>$nopo,
                'inbound'=>$inbound,
                'item_r'=>$item_r,
                'message_error'=> 'Data carton ID Sudah ada!']);
        }else{
            DB::table('tinboundid')->insert(['no_tinbound'=> $noinbound,'pallet'=>$pallet,'code_mitem'=>$sku,"cartonid"=>$cartonid,'code_muom'=>$sat,'nopo'=>$nopo,'name_mitem'=>$desc,'usin'=>'1']);
            
            DB::table('tinboundd')->where('no_tinbound','=',$noinbound)->where('pallet','=',$pallet)->where('nopo','=',$nopo)->update(['pltcap'=> $palletcap]);

            $pallet = DB::table('mpallet')->get();
            $nopo = DB::table('tinboundd')->get();
            $inbound = DB::table('tinbound')->get();
            $item_r = DB::table('tinboundd')->get();
            // return redirect('/dashboard');

            return view('reports.receiptord',[
                'pallet'=>$pallet,
                'nopo'=>$nopo,
                'inbound'=>$inbound,
                'item_r'=>$item_r,
                'message_success'=>'Data Berhasil Di inputkan']);
        }
    }

    
}
