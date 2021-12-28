@extends('layouts.main')
@section('content')
<body>
<form action="" class="px-4">
    <div class="container">
        @include('layouts.flash-message')   
        <h3>INBOUND TRANSACTION</h3>
        <br>     
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="my-2">
                            
                            <label for="noinbound" class="form-label">No Inbound</label>
                            <?php 
                            if(request()->input('noinbound') == null){ 
                            ?>
                            <select type="text" class="form-control mb-2 js-inbound" id="noinbound" name="noinbound">
                                <option></option>
                                @foreach($inbound as $itemInbound)
                                <option value='{{ $itemInbound->no }}'>{{ $itemInbound->no }}</option>
                                @endforeach
                            </select>
                            <?php }else{?>
                            <select type="text" class="form-control mb-2 js-inbound" id="noinbound" name="noinbound">
                                <option value='{{ $_GET['noinbound'] }}'>{{ $_GET['noinbound'] }}</option>
                                @foreach($inbound as $itemInbound)
                                <option value='{{ $itemInbound->no }}'>{{ $itemInbound->no }}</option>
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
                            <label for="pemilik" class="form-label">Owner / Pemilik</label>
                            <?php 
                            if(request()->input('pemilik') == null){ 
                            ?>
                                <input type="text" class="form-control mb-2" id="pemilik" aria-label="readonly input example" value="" name="pemilik" readonly>
                            <?php }else{?>
                                <input type="text" class="form-control mb-2" id="pemilik" aria-label="readonly input example" value="{{ $_GET['pemilik'] }}" name="pemilik" readonly>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="my-2">
                            <label for="note" class="form-label">Catatan / Notes</label>
                            <?php 
                            if(request()->input('note') == null){ 
                            ?>
                                <textarea type="text" class="form-control mb-2" id="note" value="" aria-label="readonly input example" value="" name="note" readonly></textarea>
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
                        {{-- <select class="contoh" name="state">
                            <option></option>
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                          </select> --}}
                    <label for="palletid" class="form-label">Pallet ID</label>
                    <div class="search-select-box">
                        <?php 
                            if(request()->input('pallet') == null){ 
                        ?>
                            <select class="form-control js-pallet" id='palletid' name="pallet">
                                <option></option>
                                @foreach($pallet as $itemPallet)
                                <option value="{{ $itemPallet->code }}">{{ $itemPallet->code }}</option>
                                @endforeach
                            </select>
                        <?php }else{?>
                            <select class="form-control js-pallet" id='palletid' name="pallet">
                                <option value="{{ $_GET['pallet'] }}">{{ $_GET['pallet'] }}</option>
                                @foreach($pallet as $itemPallet)
                                <option value="{{ $itemPallet->code }}">{{ $itemPallet->code }}</option>
                                @endforeach
                            </select>
                        <?php }?>
                    </div>
                    <label for="nopo" class="form-label">No PO</label>
                    <div class="search-select-box">
                        <select class="form-control js-nopo" id='nopo' name="nopo" >
                            <option></option>
                            @foreach($nopo as $itemNopo)
                            <option value="{{ $itemNopo->nopo }}">{{ $itemNopo->nopo }}</option>
                            @endforeach
                            {{-- <option value='0'>--Select No PO--</option> --}}
                        </select>
                    </div>
                        <label for="nama_sku" class="form-label mt-2">SKU</label>
                        <input type="text" class="form-control mb-2" id="nama_sku" name="nama_sku"  value="" aria-label="readonly input example" readonly>
                        <label for="desc" class="form-label">Description</label>
                        <input type="text" class="form-control mb-2" id="desc" name="desc"  value="" aria-label="readonly input example" readonly>
                        <label for="qtycount" class="form-label">Quantity Count</label>
                        <input type="text" class="form-control mb-2" id="qtycount" name="qtycount"  value="" aria-label="readonly input example" readonly>
                        <label for="qtycrtn" class="form-label">Total QTY Carton</label>
                        <input type="text" class="form-control mb-2" id="qtycrtn"   value="" aria-label="readonly input example" readonly>
                        <label for="crtnid" class="form-label">Carton ID</label>
                        <input type="text" class="form-control mb-2" id="crtnid" name="crtnid"  value="" aria-label="readonly input example">
                        <label for="sat" class="form-label">Satuan</label>
                        <input type="text" class="form-control mb-2" id="sat" value="" name="sat"  aria-label="readonly input example" readonly>
                        <div class="row">
                            <div class="col-sm-12 text-end mb-4">
                                <form action="">                                
                                    <button type="submit" class="btn btn-primary" id="ok" formaction="{{ route('insertQty') }}">Confirm QTY</button>
                                    <a type="button" class="btn btn-primary" id="finish">Finish</a>
                                </form>
                            </div>
                        </div>
                    </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- Bot Script --}}
<script type="text/javascript">
    //CSRF TOKEN
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $('.js-pallet').select2({
            placeholder : 'Select Pallet',
            allowClear : true
        });
        $('#palletid').on('select2:select',function (e) {
            var id = $(this).val();
            console.log("isi ID");
            console.log(id);
            $.ajax({
                url : '{{ route('getPalletId') }}',
                method : 'post',
                data : {'id' : id},
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                dataType : 'json',
                success : function (response) {
                    console.log("response Pallet");
                    console.log(response);
                    // for (i=0;i<response.length;i++) {
                    //     if (response[i].code==id){
                    //         kode = $('#nama_sku').val(response[i].code);
                    //         console.log("isi Kode");
                    //         console.log(kode);
                    //     }
                    // }
                },
            });
        });
        $('.contoh').select2({
            placeholder : 'Select Pallet',
            allowClear : true
        });
        // NO PO Method Baru
        $('.js-nopo').select2({
            placeholder : 'Select Nomor PO',
            allowClear : true
        });
        $('#nopo').on('select2:select',function (e) {
            var id = $(this).val();
            $.ajax({
                url : '{{ route('getPo') }}',
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
                    var noinbound = $('#noinbound').val();
                    var nopo = $('#nopo').val();
                    $.ajax({
                        url : '{{ route('getCQty') }}',
                        method : 'post',
                        data : {'noinbound': noinbound,
                                'nopo': nopo},
                        headers : {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                        dataType : 'json',
                        success : function (response){
                            console.log("noinbound");
                            console.log(noinbound);
                            console.log("response inbound");
                            console.log(response.length);
                            for (i=0; i < response.length; i++) {
                                $("#qtycount").val(response[i].jumlah);
                            }
                            console.log("res CountQty");
                            console.log(response);
                        },
                    });
                },
            });
        });
        $('.js-inbound').select2({
            placeholder : 'Select Nomor PO',
            allowClear : true,
            initSelection: function(element, callback) {},
        });
        $('#noinbound').on('select2:select',function (e) {
            var id = $(this).val();
            $.ajax({
                url : '{{ route('getInbound') }}',
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
                            tgl = response[i].tdate;
                            date = new Date(tgl).toLocaleDateString('en-GB');
                            $("#tglTrans").val(date);
                            $("#pemilik").val(response[i].name_mbp);
                            $("#note").val(response[i].note);
                        }
                    }
                    var noinbound = $('#noinbound').val();
                    var nopo = $('#nopo').val();
                    $.ajax({
                        url : '{{ route('getCQty') }}',
                        method : 'post',
                        data : {'noinbound': noinbound,
                                'nopo': nopo},
                        headers : {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                        dataType : 'json',
                        success : function (response){
                            console.log("noinbound");
                            console.log(noinbound);
                            console.log("response inbound");
                            console.log(response.length);
                            for (i=0; i < response.length; i++) {
                                $("#qtycount").val(response[i].jumlah);
                            }
                            console.log("res CountQty");
                            console.log(response);
                        },
                    });
                },
            });
        });
        // $('.js-nopo').select2({});
        // $('#nopo').on('select2:select',function (e) {
        //     var id = $(this).val();
        //     $.ajax({
        //         url : '{{ route('getPo') }}',
        //         method : 'post',
        //         data : {'id' : id},
        //         headers : {
        //             'CSRF_TOKEN' : $('meta[name="csrf-token"]').attr('content')},
        //         dataType : 'json',
        //         success : function (response){
        //             console.log("res nopo");
        //             console.log(response);
        //             for (i=0; i < response.length; i++) {
        //                 if (response[i].nopo==id){
        //                     $("#nama_sku").val(response[i].code_mitem);
        //                 }
        //             }
        //         },
        //     });
        // });
        // noInbound
        // $("#noinbound").change(function (e) {
        //     console.log($("#noinbound").prop("selectedIndex"));
        //     console.log(tempInbound);
        //     // $("#hdnnoinbound").val(tempInbound[this.value-1].text);
        //     tgl = tempInbound[this.value-1].tanggal;
        //     date = new Date(tgl).toLocaleDateString('en-GB');
        //     $("#tglTrans").val(date);
        //     $("#pemilik").val(tempInbound[this.value-1].pemilik);
        //     $("#note").val(tempInbound[this.value-1].note);
        // });
        // $("#nopo").change(function (e) {
        //     $.ajax({
        //         url : '{{ route('getCQty') }}',
        //         method : 'post',
        //         // data : {'id' : id},
        //         headers : {
        //             'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
        //         dataType : 'json',
        //         success : function (response){
        //             console.log("res CountQty");
        //             console.log(response);
        //         },
        //     });
        // });
        $("#palletid").change(function (e) {
            pallet = $(this).val();
            console.log("Isi Pallet");
            console.log(pallet);
            // $("#hdnpallet").val(tempPallet[this.value-1].text);
        });
    });
    // #finish = Reset all fields
    // function reset() {
    //     $('#noinbound').select2('val','');
    // }
    $(document).on("click","#finish",function(e) {
        e.preventDefault();
        // $("#noinbound").empty();
        $("#noinbound").val('').trigger('change')
        // $("#noinbound").append("<option value=""></option>");
        document.getElementById('tglTrans').value = "";
        document.getElementById('pemilik').value = "";
        document.getElementById('note').value = "";
        $("#palletid").val('').trigger('change')
        // $("#palletid").empty();
        // $("#palletid").append("<option value='0'>--Select Pallet ID--</option>");
        $("#nopo").val('').trigger('change')
        // $("#nopo").empty();
        // $("#nopo").append("<option value='0'>--Select No PO--</option>");
        document.getElementById('nama_sku').value = "";
        document.getElementById('desc').value = "";
        document.getElementById('qtycount').value = "";
        document.getElementById('qtycrtn').value = "";
        document.getElementById('crtnid').value = "";
        document.getElementById('sat').value = "";
    });

    // VALIDATE TRIGGER
    $("#qty").keyup(function(e){
        if (/\D/g.test(this.value)){
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });
    $(document).on("click","#ok",function(e){
        // Validate ifnull
        notrans = $("#noTrans").val();
        sku = $("#kode").val();
        qty = $("#qty").val();
        lokasi = $("#lokasi").val();
        pallet = $("#pallet").val();
        cartonid = $("#crtnid").val();
        if (notrans == ""){
            alert("Please select No Transaksi");
            return false;
        }else if (sku == ""){
            alert("Please select SKU");
            return false;
        }else if (qty == ""){
            alert("Please insert Value of Quantity");
            return false;
        }else if (lokasi == ""){
            alert("Please select Lokasi");
            return false;
        }else if (pallet == ""){
            alert("Please insert Value of Pallet");
            return false;
        }else if (cartonid == ""){
            alert("Please insert Value of Id Carton");
            return false;
        }
    });
    
</script>
@endsection
