@extends('layouts.main')
@section('content')
<body>
<form action="" class="px-4">
    <div class="container">      
        @include('layouts.flash-message') 
        <h3>OUTBOUND TRANSACTION</h3>
        <br>     
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="my-2">
                            <label for="noutbound" class="form-label">No Shipping Out</label>
                            <?php 
                            if(request()->input('noutbound') == 0){ 
                            ?>
                            <select type="text" class="form-control mb-2 js-outbound" id="noutbound" onchange="" name="noutbound">
                                <option></option>
                                @foreach($outbound as $itemOutbound)
                                <option value='{{ $itemOutbound->no }}'>{{ $itemOutbound->no }}</option>
                                @endforeach
                            </select>
                            <?php }else{?>
                                <select type="text" class="form-control mb-2 js-outbound" id="noutbound" name="noutbound">
                                    <option value='{{ $_GET['noutbound'] }}'>{{ $_GET['noutbound'] }}</option>
                                    @foreach($outbound as $itemOutbound)
                                    <option value='{{ $itemOutbound->no }}'>{{ $itemOutbound->no }}</option>
                                    @endforeach
                                </select>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="my-2">
                            <label for="tglTrans" class="form-label">Tanggal Trans</label>
                            <?php 
                            if(request()->input('tglTrans') == null){ 
                            ?>
                                <input type="text" class="form-control mb-2" id="tglTrans" value="" aria-label="readonly input example" onchange="notrans()" name="tglTrans" readonly>
                            <?php }else{?>
                                <input type="text" class="form-control mb-2" id="tglTrans" value="{{ $_GET['tglTrans'] }}" aria-label="readonly input example" onchange="notrans()" name="tglTrans" readonly>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6"></div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="my-2">
                            <label for="pemilik" class="form-label">Tujuan / Ship To</label>
                            <?php 
                            if(request()->input('pemilik') == null){ 
                            ?>
                                <input type="text" class="form-control mb-2" id="pemilik" aria-label="readonly input example" name="pemilik" readonly>
                            <?php }else{?>
                                <input type="text" class="form-control mb-2" id="pemilik" aria-label="readonly input example" value="{{ $_GET['pemilik'] }}" name="pemilik" readonly>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="my-2">
                            <label for="note" class="form-label">Catatan</label>
                            <?php 
                            if(request()->input('note') == null){ 
                            ?>
                                <textarea type="text" class="form-control mb-2" id="note" value=""aria-label="readonly input example" name="note" readonly></textarea>
                            <?php }else{?>
                                <textarea type="text" class="form-control mb-2" id="note" value="" aria-label="readonly input example" value="{{ $_GET['note'] }}" name="note" readonly></textarea>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6"></div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-6">
                    <div class="my-2">
                        <label for="nopo" class="form-label">No PO</label>
                        <div class="search-select-box">
                        <?php 
                            if(request()->input('nopo') == null){ 
                        ?>
                            <select class="form-control js-nopo" id='nopo' name="nopo" >
                                <option></option>
                                @foreach($nopo as $itemNopo)
                                <option value="{{ $itemNopo->nopo }}">{{ $itemNopo->nopo }}</option>
                                @endforeach
                                {{-- <option value='0'>--Select No PO--</option> --}}
                            </select>
                        <?php }else{?>
                            <select class="form-control js-nopo" id='nopo' name="nopo" >
                                <option value="{{ $_GET['nopo'] }}">{{ $_GET['nopo'] }}</option>
                                @foreach($nopo as $itemNopo)
                                <option value="{{ $itemNopo->nopo }}">{{ $itemNopo->nopo }}</option>
                                @endforeach
                                {{-- <option value='0'>--Select No PO--</option> --}}
                            </select>
                        <?php }?>
                        </div>
                    <label for="palletid" class="form-label">Pallet ID</label>
                    <div class="search-select-box">
                        <?php 
                            if(request()->input('pallet') == null){ 
                        ?>
                            <select class="form-control js-pallet" id='palletid' name="pallet" onchange="qtysumout()">
                                <option></option>
                                {{-- @foreach($pallet as $itemPallet)
                                <option value="{{ $itemPallet->code }}">{{ $itemPallet->code }}</option>
                                @endforeach --}}
                            </select>
                        <?php }else{?>
                            <select class="form-control js-pallet" id='palletid' name="pallet" onchange="qtysumout()">
                                <option value="{{ $_GET['pallet'] }}">{{ $_GET['pallet'] }}</option>
                                @foreach($pallet as $itemPallet)
                                <option value="{{ $itemPallet->code }}">{{ $itemPallet->code }}</option>
                                @endforeach
                            </select>
                        <?php }?>
                    </div>
                    </div>
                    {{-- <label for="palletcap" class="form-label">Pallet Cap.</label>
                    <input type="text" class="form-control mb-2" id="palletcap" name="palletcap" aria-label="readonly input example" onchange=""> --}}
                    <label for="nama_sku" class="form-label">SKU</label>
                    <?php 
                            if(request()->input('nama_sku') == null){ 
                    ?>
                        <input type="text" class="form-control mb-2" id="nama_sku" name="nama_sku" value="" aria-label="readonly input example" readonly>
                    <?php }else{?>
                        <input type="text" class="form-control mb-2" id="nama_sku" name="nama_sku" value="{{ $_GET['nama_sku'] }}" aria-label="readonly input example" readonly>
                    <?php }?>
                    <label for="desc" class="form-label">Description</label>
                    <?php 
                        if(request()->input('desc') == null){ 
                    ?>
                        <input type="text" class="form-control mb-2" id="desc" name="desc" value="" aria-label="readonly input example" readonly>
                    <?php }else{?>
                        <input type="text" class="form-control mb-2" id="desc" name="desc" value="{{ $_GET['desc'] }}" aria-label="readonly input example" readonly>
                    <?php }?>
                    <label for="qtycount" class="form-label">Quantity Count / Pallet</label>
                    @php 
                    if (isset($_GET['qtycount'])){
                        $qtycount = $_GET['qtycount']; 
                    }
                    @endphp
                    <?php 
                        if(request()->input('qtycount') == null){ 
                    ?>
                        <input type="text" class="form-control mb-2" id="qtycount" name="qtycount"  value="" aria-label="readonly input example" readonly>
                    <?php }else{?>
                        <input type="text" class="form-control mb-2" id="qtycount" name="qtycount"  value="{{ $qtycount-1 }}" aria-label="readonly input example" readonly>
                    <?php }?>
                    <label for="sumqtyout" class="form-label">Total Quantity Count Out</label>
                    @php 
                    if (isset($_GET['sumqtyout'])){
                        $sumqtyout = $_GET['sumqtyout']; 
                    }
                    @endphp
                    <?php 
                        if(request()->input('sumqtyout') == null){ 
                    ?>
                        <input type="text" class="form-control mb-2" id="sumqtyout" name="sumqtyout"  value="" aria-label="readonly input example" readonly>
                    <?php }else{?>
                        <input type="text" class="form-control mb-2" id="sumqtyout" name="sumqtyout"  value="{{ $sumqtyout-1 }}" aria-label="readonly input example" readonly>
                    <?php }?>
                    <label for="qtycrtn" class="form-label">Total QTY Carton</label>
                    <?php 
                        if(request()->input('qtycrtn') == null){ 
                    ?>
                        <input type="text" class="form-control mb-2" id="qtycrtn" name="qtycrtn" value="" aria-label="readonly input example" readonly>
                    <?php }else{?>
                        <input type="text" class="form-control mb-2" id="qtycrtn" name="qtycrtn" value="{{ $_GET['qtycrtn'] }}" aria-label="readonly input example" readonly>
                    <?php }?>
                    <label for="crtnid" class="form-label" >Carton ID</label>
                    <input type="text" class="form-control mb-2" id="crtnid" name="crtnid"  value="" aria-label="readonly input example" onchange="idcarton()">
                    <label for="sat" class="form-label">Satuan</label>
                    <?php 
                        if(request()->input('sat') == null){ 
                    ?>
                        <input type="text" class="form-control mb-2" id="sat" name="sat" value="" aria-label="readonly input example" readonly>
                    <?php }else{?>
                        <input type="text" class="form-control mb-2" id="sat" name="sat" value="{{ $_GET['sat'] }}" aria-label="readonly input example" readonly>
                    <?php }?>
                    <div class="row">
                        <div class="col-sm-12 text-end mb-4">
                            <form action="">                                
                                <button type="submit" class="btn btn-primary" id="ok" formaction="{{ 'insOutbound' }}">OK</button>
                                <a type="button" class="btn btn-primary" id="finish">Finish</a>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- Kodingan fix --}}
<script type="text/javascript">
    //CSRF TOKEN
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $('.js-outbound').select2({
            placeholder : 'Select Nomor Outbound',
            allowClear : true,
            initSelection: function(element, callback) {},
        });
        $('#noutbound').on('select2:select',function (e) {
            var id = $(this).val();
            $.ajax({
                url : '{{ route('getOutbound') }}',
                method : 'post',
                data : {'id' : id},
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                dataType : 'json',
                success : function (response){
                    console.log("res Inbound");
                    console.log(response);
                    for (i=0; i < response.length; i++) {
                        if (response[i].no==id){
                            tgl = response[i].tdt;
                            date = new Date(tgl).toLocaleDateString('en-GB');
                            $("#tglTrans").val(date);
                            $("#pemilik").val(response[i].name_mbp);
                            $("#note").val(response[i].note);
                        }
                    }
                    var pallet = $("#palletid").val();
                    var nooutbound = $('#noutbound').val();
                    var nopo = $('#nopo').val();
                    $.ajax({
                        url : '{{ route('getCQtyOut') }}',
                        method : 'post',
                        data : {'pallet': pallet,
                                'nopo': nopo},
                        headers : {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                        dataType : 'json',
                        success : function (response){
                            for (i=0; i < response.length; i++) {
                                jmlInput = response[i].jumlah;
                            }
                            if (jmlInput == null){
                                $("#qtycount").val(0);
                            }else{
                                $("#qtycount").val(jmlInput);
                            }
                            // console.log("noutbound");
                            // console.log(noutbound);
                            // console.log("response inbound");
                            // console.log(response.length);
                            // for (i=0; i < response.length; i++) {
                            //     $("#qtycount").val(response[i].jumlah);
                            // }
                            // console.log("res CountQty");
                            // console.log(response);
                        },
                    });
                },
            });
        });
        $('.js-pallet').select2({
            placeholder : 'Select Pallet',
            allowClear : true
        });
        var nopo = $("#nopo").val();
        console.log(nopo);
        $('#palletid').on('select2:select',function (e) {
            var pallet = $(this).val();
            console.log("isi Pallet");
            console.log(pallet);
            var pallet = $("#palletid").val();
            var nooutbound = $('#noutbound').val();
            var nopo = $('#nopo').val();
            $.ajax({
                url : '{{ route('getCQtyOut') }}',
                method : 'post',
                data : {'pallet': pallet,
                        'nopo': nopo},
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                dataType : 'json',
                success : function (response){
                    for (i=0; i < response.length; i++) {
                        jmlInput = response[i].jumlah;
                    }
                    if (jmlInput == null){
                        $("#qtycount").val(0);
                    }else{
                        $("#qtycount").val(jmlInput);
                    }
                },
            });
        });
        // NO PO Method Baru
        $('.js-nopo').select2({
            placeholder : 'Select Nomor PO',
            allowClear : true
        });
        $('#nopo').on('select2:select',function (e) {
            var id = $(this).val();
            $.ajax({
                url : '{{ route('getPoOutbound') }}',
                method : 'post',
                data : {'id' : id},
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                dataType : 'json',
                success : function (response){
                    console.log("res nopo");
                    console.log(response);
                    for (i=0; i < response.length; i++) {
                        if (response[i].nopo==id){
                            $("#nama_sku").val(response[i].code_mitem);
                            $("#desc").val(response[i].name_mitem);
                            $("#qtycrtn").val(parseInt(response[i].qty));
                            $("#sat").val(response[i].code_muom);
                        }
                    }
                    var nooutbound = $('#noutbound').val();
                    var nopo = $('#nopo').val();
                    $.ajax({
                        url : '{{ route('getCQtyOut') }}',
                        method : 'post',
                        data : {'nooutbound': nooutbound,
                                'nopo': nopo},
                        headers : {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                        dataType : 'json',
                        success : function (response){
                            for (i=0; i < response.length; i++) {
                                jmlInput = response[i].jumlah;
                            }
                            if (jmlInput == null){
                                $("#qtycount").val(0);
                            }else{
                                $("#qtycount").val(jmlInput);
                            }
                            palletid = $("#palletid").val();
                            $.ajax({
                                url : '{{ route('getPalletCapOut') }}',
                                method : 'post',
                                data : {'nooutbound': nooutbound,
                                        'nopo': nopo,
                                        'palletid': palletid},
                                headers : {
                                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                                dataType : 'json',
                                success : function (response){
                                    console.log("Pallet Cap");
                                    console.log(response);
                                    $.ajax({
                                        url : '{{ route('getPalletOut') }}',
                                        method : 'post',
                                        data : {'nopo' : nopo},
                                        headers : {
                                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                                        dataType : 'json',
                                        success : function (response) {
                                            console.log("Response Pallet");
                                            console.log(response);
                                            if ($("#nopo").val() != ""){
                                                // $("#nopo").val('').trigger('change');
                                                $("#palletid").empty();
                                                $("#palletid").append("<option></option>");
                                                for (i=0; i < response.length; i++) {
                                                    console.log("response Pallet")
                                                    console.log(response)
                                                    pallet = response[i].pallet;
                                                    $("#palletid").append("<option value='"+pallet+"'>"+pallet+"</option>");

                                                }
                                            }else if ($("#nopo").val() == 0){
                                                alert("Data nopo harus kosong!");
                                            }
                                            var pallet = $('#palletid').val();
                                            var nopo = $('#nopo').val();
                                            $.ajax({
                                                url : '{{ route('sumQtyOut') }}',
                                                method : 'post',
                                                data : {'pallet': pallet,
                                                        'nopo':nopo},
                                                headers : {
                                                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                                                dataType : 'json',
                                                success : function (response){
                                                    for (i=0; i < response.length; i++) {
                                                        $("#sumqtyout").val(response[i].jumlahqty);
                                                    }           
                                                },
                                            });
                                            console.log("response Pallet");
                                            console.log(response);
                                        },
                                    });
                                },
                            });
                        },
                    });
                },
            });
        });

    });
    // Trigger IDCarton
    function idcarton() {        
        // Validate Id Carton
        var idcarton = $("#crtnid").val();
        $.ajax({
            url : '{{ route('getIdCrtnOut') }}',
            method : 'post',
            data : {'idcarton': idcarton},
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
            dataType : 'json',
            success : function (response){
                console.log("carton id");
                console.log(response);
                for (i=0; i < response.length; i++) {
                    hasil = response[i].jcrtnid;
                    if (hasil >= 1){
                        alert('Data ID Sudah ada BOSS!')
                        $("#crtnid").val('');
                    }
                }                
            },
        });
    }
    function qtysumout(){
        var pallet = $('#palletid').val();
        var nopo = $('#nopo').val();
        $.ajax({
            url : '{{ route('sumQtyOut') }}',
            method : 'post',
            data : {'pallet': pallet,
                    'nopo':nopo},
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
            dataType : 'json',
            success : function (response){
                for (i=0; i < response.length; i++) {
                    $("#sumqtyout").val(response[i].jumlahqty);
                }           
            },
        });
    }
    // #finish = Reset all fields
    $(document).on("click","#finish",function(e) {
        e.preventDefault();
        //-----------No Outbound--------------
        $("#noutbound").val('').trigger('change')
        document.getElementById('tglTrans').value = "";
        document.getElementById('pemilik').value = "";
        document.getElementById('note').value = "";
        //-----------Pallet--------------
        $("#palletid").val('').trigger('change');
        //-----------NOPO--------------
        $("#nopo").val('').trigger('change');
        document.getElementById('nama_sku').value = "";
        document.getElementById('desc').value = "";
        document.getElementById('qtycount').value = "";
        document.getElementById('qtycrtn').value = "";
        document.getElementById('crtnid').value = "";
        document.getElementById('sat').value = "";
    });
    $(document).on("click","#ok",function(e){
        // Validate ifnull
        noutbound = $("#noutbound").val();
        pallet = $("#palletid").val();
        nopo = $("#nopo").val();
        crtnid = $("#crtnid").val();
        if (noutbound == ""){
            alert("Please select No Outbound");
            return false;
        }else if (pallet == ""){
            alert("Please select Pallet ID");
            return false;
        }else if (nopo == ""){
            alert("Please select Nomor PO");
            return false;
        }else if (crtnid == ""){
            alert("Please Insert Value Of Carton ID");
            return false;
        }
    });
</script>
@endsection
