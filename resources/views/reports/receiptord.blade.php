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
                            if(request()->input('noinbound') == 0){ 
                            ?>
                            <select type="text" class="form-control mb-2 select-trans" id="noinbound" onchange="" name="noinbound">
                                <option value=''>--Select No Inbound--</option>
                            </select>
                            <?php }else{?>
                            <select type="text" class="form-control mb-2 select-trans" id="noinbound" onchange="" name="noinbound">
                                <option value='{{ $_GET['noinbound'] }}'>{{ $_GET['hdnnoinbound'] }}</option>
                            </select>
                            <?php } ?>
                            {{-- Hidden No Inbound --}}
                            <?php 
                            if(request()->input('hdnnoinbound') == null){ 
                            ?>
                                <input type="hidden" class="form-control mb-2" id="hdnnoinbound" value="" name="hdnnoinbound" aria-label="readonly input example" readonly>
                            <?php }else{?>
                                <input type="hidden" class="form-control mb-2" id="hdnnoinbound" value="{{ $_GET['hdnnoinbound'] }}" name="hdnnoinbound" aria-label="readonly input example" readonly>
                            <?php } ?>
                            {{-- END Hidden No Inbound --}}
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
                    <label for="palletid" class="form-label">Pallet ID</label>
                    <div class="search-select-box">
                        <select class="form-control" id='palletid'>
                            <option value='0'>--Select Pallet ID--</option>
                        </select>
                    </div>
                    {{-- Hidden PalletID --}}
                    <?php 
                    if(request()->input('hdnpallet') == null){ 
                    ?>
                        <input type="hidden" class="form-control mb-2" id="hdnpallet" name="hdnpallet" value="" aria-label="readonly input example" readonly>
                    <?php }else{?>
                        <input type="hidden" class="form-control mb-2" id="hdnpallet" name="hdnpallet" value="" aria-label="readonly input example" readonly>
                    <?php } ?>
                    </div>
                    {{-- END Hidden SKU --}}
                    <label for="nopo" class="form-label">No PO</label>
                    <div class="search-select-box">
                        <select class="form-control" id='nopo'>
                            <option value='0'>--Select No PO--</option>
                        </select>
                    </div>
                    {{-- Hidden SKU --}}
                    <?php 
                    if(request()->input('hdnpo') == null){ 
                    ?>
                        <input type="hidden" class="form-control mb-2" id="hdnpo" name="hdnpo" value="" aria-label="readonly input example" readonly>
                    <?php }else{?>
                        <input type="hidden" class="form-control mb-2" id="hdnpo" name="hdnpo" value="" aria-label="readonly input example" readonly>
                    <?php } ?>
                        <label for="nama_sku" class="form-label mt-2">SKU</label>
                        <input type="text" class="form-control mb-2" id="nama_sku" name="nama_sku"  value="" aria-label="readonly input example" readonly>
                        <label for="desc" class="form-label">Description</label>
                        <input type="text" class="form-control mb-2" id="desc"   value="" aria-label="readonly input example" readonly>
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
    var tempResponse = [];
    var tempInbound= [];
    var tempLok = [];
    var tempPallet = [];
    var selectedLok = null;
    var selectedTrans = null;
    // var selectedSKU = null;
    //CSRF TOKEN
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        // #kode = SKU
        var selInbound = $('#noinbound option:selected').text();
        $("#noinbound").select2({
            ajax: {
                url: "{{route('getInbound')}}",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        searchinbound :  params.term, //search term
                        // notrans: selectedTrans
                        // notrans: selInbound
                    };
                },
                processResults: function (response) {
                    // console.log(selectedTrans);
                    // console.log("response");
                    // console.log(JSON.stringify(response));
                    tempInbound = response;
                    console.log("tempInbound");
                    console.log(tempInbound);
                    // console.log(selTrans);
                    return {
                        results: tempInbound
                    };
                },
                cache: true
            }
        });
        // Pallet
        $("#palletid").select2({
            ajax: {
                url: "{{route('getPallet')}}",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        searchpallet :  params.term, //search term
                    };
                },
                processResults: function (response) {
                    // console.log(selectedTrans);
                    // console.log("response");
                    // console.log(JSON.stringify(response));
                    tempPallet = response;
                    console.log("tempPallet");
                    console.log(tempPallet);
                    // console.log(selTrans);
                    return {
                        results: tempPallet
                    };
                },
                cache: true
            }
        });
        // No PO
        $("#nopo").select2({
            ajax: {
                url: "{{route('getPo')}}",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        searchpo :  params.term, //search term
                    };
                },
                processResults: function (response) {
                    // console.log(selectedTrans);
                    // console.log("response");
                    // console.log(JSON.stringify(response));
                    tempPo = response;
                    console.log("tempPallet");
                    console.log(tempPallet);
                    // console.log(selTrans);
                    return {
                        results: tempPo
                    };
                },
                cache: true
            }
        });
        // noInbound
        $("#noinbound").change(function (e) {
            console.log($("#noinbound").prop("selectedIndex"));
            console.log(tempInbound);
            $("#hdnnoinbound").val(tempInbound[this.value-1].text);
            tgl = tempInbound[this.value-1].tanggal;
            date = new Date(tgl).toLocaleDateString('en-GB');
            $("#tglTrans").val(date);
            $("#pemilik").val(tempInbound[this.value-1].pemilik);
            $("#note").val(tempInbound[this.value-1].note);
        });
        $("#palletid").change(function (e) {
            $("#hdnpallet").val(tempPallet[this.value-1].text);
        });
        $("#nopo").change(function (e) {
            $("#hdnpo").val(tempPo[this.value-1].text);
            $("#nama_sku").val(tempPo[this.value-1].sku);
            $("#desc").val(tempPo[this.value-1].desc);
            $("#qtycrtn").val(tempPo[this.value-1].qty);
            $("#sat").val(tempPo[this.value-1].sat);
        });

    });
    // #finish = Reset all fields
    $(document).on("click","#finish",function(e) {
        e.preventDefault();
        $("#noinbound").empty();
        $("#noinbound").append("<option value='0'>--Select No Inbound--</option>");
        document.getElementById('tglTrans').value = "";
        document.getElementById('pemilik').value = "";
        document.getElementById('note').value = "";
        $("#palletid").empty();
        $("#palletid").append("<option value='0'>--Select Pallet ID--</option>");
        $("#nopo").empty();
        $("#nopo").append("<option value='0'>--Select No PO--</option>");
        document.getElementById('nama_sku').value = "";
        document.getElementById('desc').value = "";
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
        }
    });
</script>
@endsection
