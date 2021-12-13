@extends('layouts.main')
@section('content')
<body>
<form action="" class="px-4">
    <div class="container">      
        <h3>OUTBOUND</h3>
        <br>     
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="my-2">
                            {{-- @if(isset($alltrecs))
                                @if(count($alltrecs) > 0)
                                @foreach($alltrecs as $trec) --}}
                            <label for="noTrans" class="form-label">No Trans</label>
                            {{-- <input type="text" class="form-control mb-2" id="noTrans" name="noTrans" value="" onchange=""> --}}
                            <select type="text" class="form-control mb-2" id="noTrans" onchange="">
                                <option value='0'>--Select Code--</option>
                            </select>
                            {{-- <label for="hdntrans" class="form-label">Hidden Trans</label> --}}
                            <input type="hidden" class="form-control mb-2" id="hdntrans" value="" name="hdntrans" aria-label="readonly input example" readonly>
                            {{-- @endforeach
                                @endif
                            @else --}}
                            {{-- <label for="noTrans" class="form-label">No Trans</label>
                            <input type="text" class="form-control mb-2" id="noTrans" name="noTrans" value=""> --}}
                            {{-- @endif --}}
                            {{-- <button type="submit" class="btn btn-primary" formaction="{{route('searchtrec')}}">Search</button> --}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="my-2">
                            {{-- @if(isset($alltrecs))
                                @if(count($alltrecs) > 0)
                                @foreach($alltrecs as $trec) --}}
                            <label for="tglTrans" class="form-label">Tanggal Trans</label>
                            <input type="text" class="form-control mb-2" id="tglTrans" value="" aria-label="readonly input example" onchange="notrans()" readonly>
                                {{-- @endforeach
                                @endif
                            @else --}}
                                {{-- <label for="tglTrans" class="form-label">Tanggal Trans</label>
                                <input type="text" class="form-control mb-2" id="tglTrans" value="{{ date('d-m-Y',strtotime($trec->tdt)) }}" aria-label="readonly input example" readonly> --}}
                            {{-- @endif --}}
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
                            <input type="text" class="form-control mb-2" id="pemilik" aria-label="readonly input example" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="my-2">
                            {{-- @if(isset($alltrecs))
                                @if(count($alltrecs) > 0)
                                @foreach($alltrecs as $trec)
                            <label for="note" class="form-label">Catatan</label>
                            <textarea type="text" class="form-control mb-2" id="note" value="{{ $trec->note }}" aria-label="readonly input example" readonly></textarea>
                                @endforeach
                                @endif
                            @else --}}
                            <label for="note" class="form-label">Catatan</label>
                            <textarea type="text" class="form-control mb-2" id="note" value="" aria-label="readonly input example" readonly></textarea>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- @endforeach
            @endif
        @endisset --}}
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
                                {{-- @foreach($item_r as $data)
                                <option value="{{$data->id}}">{{$data->code}}--{{$data->name}}</option>
                                @endforeach --}}
                        </select>
                    </div>
                    {{-- <label for="hdnsku" class="form-label">Hidden Deskripsi</label> --}}
                    <input type="hidden" class="form-control mb-2" id="hdnsku" name="skuhdn" value="" aria-label="readonly input example" readonly>
                    </div>
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
                                {{-- @foreach($item_r as $data)
                                <option value="{{$data->id}}">{{$data->code}}--{{$data->name}}</option>
                                @endforeach --}}
                        </select>
                    </div>
                    {{-- <input type="text" class="form-control mb-2" id="lokasi"> --}}
                    <label for="pallet" class="form-label">Pallet</label>
                    <input type="text" class="form-control mb-2" id="pallet">
                    <div class="row">
                        {{-- <div class="col-sm-6">
                        </div> --}}
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
{{-- Kodingan fix --}}
{{-- <script type="text/javascript">
    //CSRF TOKEN
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $("#kode").select2({
            ajax: {
                url: "{{route('getKode')}}",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        search : params.term //search term
                    };
                },
                processResults: function (response) {
                    console.log("response");
                    console.log(response);
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
</script> --}}
{{-- <script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $('.js-select2').select2({});
        var counter = 1;
        $('#sel_kode').on('select2:select', function(e)
        {
            var search = $(this).val();
            $.ajax({
                type: "post",
                url: "{{route('getKode')}}"
                data: {'search':search},
                dataType: 'json',
                
            });
        });
    });
</script> --}}
{{-- <script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            type: "get",
            url: "{{route('getData')}}",
            success: function(response){
                console.log(response);
                var dataarr = response.data;
                var datas = {};
                for (var i = 0; i < dataarr.length; i++){
                    datas[dataarr[i]].code = null;
                }
                console.log("datas");
                console.log(datas);
                $('.js-select2').select2({});
                $("#sel_kode").on('select2.select', function(e){
                    data:response;
                });
            }
        });
    });
</script> --}}
{{-- kodingan mayan --}}
{{-- <script type="text/javascript">
    //CSRF TOKEN
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $("#kode").select2({
            ajax: {
                url: "{{route('getKode')}}",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        search : params.term //search term
                    };
                },
                processResults: function (response) {
                    console.log("response");
                    console.log(response);
                    return {
                        results: response
                    };
                },
                success: function (response) {
                    console.log("sucess");
                    console.log(response);
                    for (var i = 0; i <response.length; i++) {
                        if(response[i].id= 1 ){
                            $("#nama").val(response[i].name);
                            $("#sat").val(response[i].code_muom);
                        }
                    }
                },
                cache: true
            }
        });
    });
</script> --}}
{{-- <script type="text/javascript">
    //CSRF TOKEN
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $("#kode").select2({
            ajax:{
                type:"get",
                url: "{{route('getKode')}}",
                success: function (response) {
                    // console.log(response);
                },
                data: function(response) {
                    var dataarr = response;
                    var dataitem = {};
                    for (var i = 0; i <dataarr.length; i++) {
                        dataitem[dataarr[i].code] = null;
                    }
                }
            }
        });
    });
</script> --}}
<script type="text/javascript">
    var tempResponse = [];
    var tempSku= [];
    var selectedTrans = null;
    //CSRF TOKEN
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $("#kode").select2({
            ajax: {
                url: "{{route('getKodeOut')}}",
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
                    console.log("response");
                    console.log(JSON.stringify(response));
                    tempSku = response;
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        $("#noTrans").select2({
            ajax: {
                url: "{{route('getNoTransOut')}}",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    console.log(JSON.stringify(params));
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

        $("#noTrans").change(function (e) {
            selectedTrans = tempResponse[this.value-1].text;
            $("#hdntrans").val(tempResponse[this.value-1].text);
            // $("#tglTrans").val(tempResponse[this.value-1].tgl);
            tgl = tempResponse[this.value-1].tgl;
            console.log(tgl);
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
            console.log(selectedTrans);
            console.log($( "#noTrans" ).val());
        });

        $("#kode").change(function (e) {
            console.log($("#kode").prop("selectedIndex"))
            console.log(tempSku);
            $("#nama_sku").val(tempSku[$("#kode").prop("selectedIndex") - 1].nama);
            $("#sat").val(tempSku[$("#kode").prop("selectedIndex") - 1].sat);
            // $("#lokasi").val(tempSku[$("#kode").prop("selectedIndex") - 1].lokasi);
            $("#pallet").val(tempSku[$("#kode").prop("selectedIndex") - 1].pallet);
            $("#hdnsku").val(tempSku[$("#kode").prop("selectedIndex") - 1].text);
            document.getElementById('qty').focus();
        })

    });
    // $(document).on("click","#ok",function(e) {
    //     e.preventDefault();
    //     $("#kode").empty();
    //     $("#kode").append("<option value='0'>--Select Code--</option>");
    //     document.getElementById('nama_sku').value = "";
    //     document.getElementById('qty').value = "";
    //     document.getElementById('sat').value = "";
    //     document.getElementById('lokasi').value = "";
    //     document.getElementById('pallet').value = "";
    // });
    $(document).on("click","#finish",function(e) {
        e.preventDefault();
        $("#kode").empty();
        $("#kode").append("<option value='0'>--Select Code--</option>");
        document.getElementById('nama_sku').value = "";
        document.getElementById('qty').value = "";
        document.getElementById('sat').value = "";
        document.getElementById('lokasi').value = "";
        document.getElementById('pallet').value = "";
        $("#noTrans").empty();
        $("#noTrans").append("<option value='0'>--Select Code--</option>");
        document.getElementById('tglTrans').value = "";
        document.getElementById('note').value = "";
        document.getElementById('pemilik').value = "";
    });

    $("#lokasi").select2({
            ajax: {
                url: "{{route('getLokasiOut')}}",
                type: "post",
                dataType: "json",
                delay: 50,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        search :  params.term, //search term
                        // notrans: selectedTrans
                    };
                },
                processResults: function (response) {
                    console.log("response");
                    console.log(JSON.stringify(response));
                    // tempSku = response;
                    // response.map(x => tempResponse.filter(a => a.text == x.text).length > 0 ? null : tempResponse.push(x));
                    // console.log(tempResponse);
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
</script>
@endsection
