@extends('layouts.main')
@section('content')
<body>
<form action="" class="px-4">
    <div class="container">
        @include('layouts.flash-message')   
        <h3>LOKASI</h3>
        <br>     
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="my-2">
                            <label for="sku" class="form-label">SKU</label>
                            <?php 
                            if(request()->input('sku') == 0){ 
                            ?>
                            <select type="text" class="form-control mb-2 select-trans" id="sku" onchange="" name="sku">
                                <option value=''>--Select SKU--</option>
                            </select>
                            <?php }else{?>
                            <select type="text" class="form-control mb-2 select-trans" id="sku" onchange="" name="sku">
                                <option value='{{ $_GET['sku'] }}'>{{ $_GET['hdnsku'] }}</option>
                            </select>
                            <?php } ?>
                            {{-- Hidden SKU --}}
                            <?php 
                            if(request()->input('hdnsku') == null){ 
                            ?>
                                <input type="hidden" class="form-control mb-2" id="hdnsku" value="" name="hdnsku" aria-label="readonly input example" readonly>
                            <?php }else{?>
                                <input type="hidden" class="form-control mb-2" id="hdnsku" value="{{ $_GET['hdnsku'] }}" name="hdnsku" aria-label="readonly input example" readonly>
                            <?php } ?>
                            {{-- END Hidden SKU --}}
                        </div>
                    </div>
                    <div class="col-sm-6">
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
                            <label for="desc" class="form-label">Description</label>
                            <?php 
                            if(request()->input('desc') == null){ 
                            ?>
                                <input type="text" class="form-control mb-2" id="desc" aria-label="readonly input example" value="" name="desc" readonly>
                            <?php }else{?>
                                <input type="text" class="form-control mb-2" id="desc" aria-label="readonly input example" value="{{ $_GET['desc'] }}" name="desc" readonly>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
            <div class="col-sm-6"></div>
        </div>
    </div>
    <div class="container">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-6">
                    <div class="my-2">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="text" class="form-control mb-2" id="quantity" value="" name="quantity">
                    <label for="sat" class="form-label">Satuan</label>
                    <input type="text" class="form-control mb-2" id="sat" value="" aria-label="readonly input example" readonly>
                    <label for="noinbound" class="form-label">No Inbound / Transaction</label>
                    <?php 
                    if(request()->input('noinbound') == 0){ 
                    ?>
                    <select type="text" class="form-control mb-2 select-trans" id="noinbound" onchange="" name="noinbound">
                        <option value=''>--Select No Trans--</option>
                    </select>
                    <?php }else{?>
                    <select type="text" class="form-control mb-2 select-trans" id="noinbound" onchange="" name="noinbound">
                        <option value='{{ $_GET['noinbound'] }}'>{{ $_GET['hdnnoinbound'] }}</option>
                    </select>
                    <?php } ?>
                    {{-- Hidden noinbound --}}
                    <?php 
                    if(request()->input('hdnnoinbound') == null){ 
                    ?>
                        <input type="hidden" class="form-control mb-2" id="hdnnoinbound" value="" name="hdnnoinbound" aria-label="readonly input example" readonly>
                    <?php }else{?>
                        <input type="hidden" class="form-control mb-2" id="hdnnoinbound" value="{{ $_GET['hdnnoinbound'] }}" name="hdnnoinbound" aria-label="readonly input example" readonly>
                    <?php } ?>
                    {{-- END Hidden noinbound --}}
                    <label for="owner" class="form-label">Owner</label>
                    <input type="text" class="form-control mb-2" id="owner" name="owner" readonly>
                    <label for="pallet" class="form-label">Pallet</label>
                    <input type="text" class="form-control mb-2" id="pallet" value="" name="pallet">
                    <label for="lokasi" class="form-label mt-2">Lokasi</label>
                    <?php 
                    if(request()->input('lokasi') == null){ 
                    ?>
                    <select type="text" class="form-control mb-2 select-trans" id="lokasi" onchange="" name="lokasi">
                        <option value=''>--Select Lokasi--</option>
                    </select>
                    <?php }else{?>
                    <select type="text" class="form-control mb-2 select-trans" id="lokasi" onchange="" name="lokasi">
                        <option value='0'>{{ $_GET['hdnlok'] }}</option>
                    </select>
                    <?php } ?>
                    {{-- Hidden noinbound --}}
                    <?php 
                    if(request()->input('hdnlok') == null){ 
                    ?>
                        <input type="hidden" class="form-control mb-2" id="hdnlok" value="" name="hdnlok" aria-label="readonly input example" readonly>
                    <?php }else{?>
                        <input type="hidden" class="form-control mb-2" id="hdnlok" value="{{ $_GET['hdnlok'] }}" name="hdnlok" aria-label="readonly input example" readonly>
                    <?php } ?>
                    {{-- END Hidden noinbound --}}
                    <div class="row">
                        <div class="col-sm-12 text-end mb-4">
                            <form action="">      
                                <button type="submit" class="btn btn-primary my-3" id="update" formaction="{{ route('updlokasi') }}">Update</button>
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

    $(document).ready(function(){
        var tempSku= [];
        var tempIndbound= [];
        var tempLok = [];
        var selectedLok = null;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // #SKU
        $("#sku").select2({
            ajax: {
                url: "{{route('getsku')}}",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        searchsku : params.term, //search term
                    };
                },
                processResults: function (response) {
                    tempSku = response
                    console.log(tempSku);
                    return {
                        results: tempSku
                    };
                },
                cache: true
            }
        });
        $("#sku").change(function (e) {
            $("#hdnsku").val(tempSku[this.value-1].text);
            $("#desc").val(tempSku[this.value-1].nama);
            $("#sat").val(tempSku[this.value-1].sat);
        });
        $("#noinbound").select2({
            ajax: {
                url: "{{route('getinbound')}}",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        searchindbound : params.term, //search term
                    };
                },
                processResults: function (response) {
                    tempIndbound = response
                    console.log(tempIndbound);
                    return {
                        results: tempIndbound
                    };
                },
                cache: true
            }
        });
        $("#noinbound").change(function (e) {
            $("#hdnnoinbound").val(tempIndbound[this.value-1].text);
            $("#owner").val(tempIndbound[this.value-1].nama);
        });
        $("#lokasi").select2({
            ajax: {
                url: "{{route('getlokasi')}}",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        searchlok : params.term, //search term
                    };
                },
                processResults: function (response) {
                    tempLok = response
                    console.log(tempLok);
                    return {
                        results: tempLok
                    };
                },
                cache: true
            }
        });
        $("#lokasi").change(function (e) {
            selectedLok = tempLok[this.value-1].text;
            console.log(selectedLok);
            $("#hdnlok").val(selectedLok);
            // $("#hdnlok").val(tempLok[this.value-1].text);
        });
        // VALIDATE TRIGGER
        $("#quantity").keyup(function(e){
            if (/\D/g.test(this.value)){
                // Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, '');
            }
        });
    });
</script>
{{-- END Bot Script --}}
@endsection