@extends('layouts.main')
@section('content')
<body>
<form action="" class="px-4">
    <div class="container">      
        <h3>INBOUND TRANSACTION</h3>
        <br>     
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="my-2">
                            
                            <label for="noTrans" class="form-label">No Trans</label>
                            <?php 
                            if(request()->input('noTrans') == 0){ 
                            ?>
                            <select type="text" class="form-control mb-2 select-trans" id="noTrans" onchange="" name="noTrans">
                                <option value=''>--Select No Trans--</option>
                            </select>
                            <?php }else{?>
                            <select type="text" class="form-control mb-2 select-trans" id="noTrans" onchange="" name="noTrans">
                                <option value='{{ $_GET['noTrans'] }}'>{{ $_GET['hdntrans'] }}</option>
                            </select>
                            <?php } ?>
                            {{-- Hidden Trans --}}
                            <?php 
                            if(request()->input('hdntrans') == null){ 
                            ?>
                                <input type="hidden" class="form-control mb-2" id="hdntrans" value="" name="hdntrans" aria-label="readonly input example" readonly>
                            <?php }else{?>
                                <input type="hidden" class="form-control mb-2" id="hdntrans" value="{{ $_GET['hdntrans'] }}" name="hdntrans" aria-label="readonly input example" readonly>
                            <?php } ?>
                            {{-- END Hidden Trans --}}
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
                            <label for="pemilik" class="form-label">Dari / Pemilik</label>
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
                            <label for="note" class="form-label">Catatan</label>
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
                    <label for="sku" class="form-label">SKU</label>
                    <div class="search-select-box">
                        <select class="form-control" id='kode'>
                            <option value='0'>--Select Code--</option>
                        </select>
                    </div>
                    {{-- Hidden SKU --}}
                    <?php 
                    if(request()->input('skuhdn') == null){ 
                    ?>
                        <input type="hidden" class="form-control mb-2" id="hdnsku" name="skuhdn" value="" aria-label="readonly input example" readonly>
                    <?php }else{?>
                        <input type="hidden" class="form-control mb-2" id="hdnsku" name="skuhdn" value="" aria-label="readonly input example" readonly>
                    <?php } ?>
                    </div>
                    {{-- END Hidden SKU --}}
                    <label for="nama" class="form-label">Nama / Deskripsi</label>
                    <input type="text" class="form-control mb-2" id="nama_sku" value="" aria-label="readonly input example" readonly>
                    <label for="qty" class="form-label">Quantity</label>
                    <input type="text" class="form-control mb-2" id="qty" name="qty">
                    <label for="sat" class="form-label">Satuan</label>
                    <input type="text" class="form-control mb-2" id="sat" value="" aria-label="readonly input example" readonly>
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <div class="search-select-box">
                        <select class="form-control" id='lokasi'>
                            <option value='0'>--Select Lokasi--</option>
                        </select>
                        {{-- Hidden Lokasi --}}
                        <input type="hidden" class="form-control mb-2" id="hdnlokasi" name="hdnlokasi" value="" aria-label="readonly input example" readonly>
                        {{-- END Hidden Lokasi --}}
                    </div>
                    <label for="pallet" class="form-label mt-2">Pallet</label>
                    <input type="text" class="form-control mb-2" id="pallet" name="pallet">
                    <div class="row">
                        <div class="col-sm-12 text-end mb-4">
                            <form action="">                                
                                <button type="submit" class="btn btn-primary" id="ok" formaction="{{ route('updSKU') }}">OK</button>
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
{{-- Bot Script --}}
<script type="text/javascript">
    var tempResponse = [];
    var tempSku= [];
    var tempLok = [];
    var selectedLok = null;
    var selectedTrans = null;
    //CSRF TOKEN
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        // #kode = SKU
        $("#kode").select2({
            ajax: {
                url: "{{route('getKode')}}",
                type: "post",
                dataType: "json",
                delay: 50,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        search :  params.term, //search term
                        notrans: selectedTrans
                    };
                },
                processResults: function (response) {
                    // console.log("response");
                    // console.log(JSON.stringify(response));
                    tempSku = response;
                    // console.log(tempSku);
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        $("#noTrans").select2({
            ajax: {
                url: "{{route('getNoTrans')}}",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    // console.log(JSON.stringify(params));
                    return {
                        _token: CSRF_TOKEN,
                        searchTrans : params.term //search term
                    };
                },
                processResults: function (response) {
                    // console.log("response");
                    // console.log(response);
                    // tempResponse = response;
                    // response.map(x => tempResponse.filter(a => a.text == x.text).length > 0 ? null : tempResponse.push(x));
                    tempResponse = response
                    // console.log("tempResponse");
                    // console.log(tempResponse)
                    return {
                        results: tempResponse
                    };
                },
                cache: true
            }
        });
        // noTrans = No Transaksi
        $("#noTrans").change(function (e) {
            selectedTrans = tempResponse[this.value-1].text;
            $("#hdntrans").val(tempResponse[this.value-1].text);
            // $("#tglTrans").val(tempResponse[this.value-1].tgl);
            tgl = tempResponse[this.value-1].tgl;
            // console.log(tgl);
            date = new Date(tgl).toLocaleDateString('en-GB');
            $("#tglTrans").val(date);
            $("#pemilik").val(tempResponse[this.value-1].nama);
            $("#note").val(tempResponse[this.value-1].note);
            document.getElementById('qty').focus();

            // Clear SKU form
            $("#kode").empty();
            $("#kode").append("<option value='0'>--Select Code--</option>");
            $("#nama_sku").val(null);
            $("#sat").val(null);
            // console.log(selectedTrans);
            // console.log($( "#noTrans" ).val());
        });

        $("#kode").change(function (e) {
            // console.log($("#kode").prop("selectedIndex"))
            // console.log(tempSku);
            $("#nama_sku").val(tempSku[$("#kode").prop("selectedIndex") - 1].nama);
            $("#sat").val(tempSku[$("#kode").prop("selectedIndex") - 1].sat);
            // $("#lokasi").val(tempSku[$("#kode").prop("selectedIndex") - 1].lokasi);
            $("#pallet").val(tempSku[$("#kode").prop("selectedIndex") - 1].pallet);
            $("#hdnsku").val(tempSku[$("#kode").prop("selectedIndex") - 1].text);
            // $("#hdnlokasi").val(tempSku[$("#kode").prop("selectedIndex") - 1].lokasi);
            console.log($("#hdnlokasi").val());
            document.getElementById('qty').focus();
        })

    });
    // #finish = Reset all fields
    $(document).on("click","#finish",function(e) {
        e.preventDefault();
        $("#kode").empty();
        $("#kode").append("<option value='0'>--Select Code--</option>");
        document.getElementById('nama_sku').value = "";
        document.getElementById('qty').value = "";
        document.getElementById('sat').value = "";
        // document.getElementById('lokasi').value = "";
        $("#lokasi").empty();
        $("#lokasi").append("<option value='0'>--Select Code--</option>");
        document.getElementById('pallet').value = "";
        $("#noTrans").empty();
        $("#noTrans").append("<option value='0'>--Select Code--</option>");
        document.getElementById('tglTrans').value = "";
        document.getElementById('note').value = "";
        document.getElementById('pemilik').value = "";
    });
    // #lokasi = lokasi
    $("#lokasi").select2({
            ajax: {
                url: "{{route('getLokasi')}}",
                type: "post",
                dataType: "json",
                delay: 50,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        searchLok :  params.term //search term
                        // searchLok: selectedLok
                    };
                },
                processResults: function (response) {
                    console.log("response");
                    console.log(JSON.stringify(response));
                    tempLok = response;
                    // response.map(x => tempResponse.filter(a => a.text == x.text).length > 0 ? null : tempResponse.push(x));
                    // console.log(tempResponse);
                    console.log(tempLok)
                    return {
                        results: tempLok
                    };
                },
                cache: true
            }
        });
    $("#lokasi").change(function (e) {
        $("#hdnlokasi").val(tempLok[$("#lokasi").prop("selectedIndex")].text);
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
