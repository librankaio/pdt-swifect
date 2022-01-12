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
                            <label for="nopo" class="form-label">No PO</label>
                            <?php 
                            if(request()->input('nopo') == 0){ 
                            ?>
                            <select type="text" class="form-control mb-2 select-trans js-nopo" id="nopo" onchange="" name="nopo">
                                <option></option>
                                @foreach($nopo as $itemnopo)
                                <option value="{{ $itemnopo->nopo }}">{{ $itemnopo->nopo }}</option>
                                @endforeach
                            </select>
                            <?php }else{?>
                            <select type="text" class="form-control mb-2 select-trans js-nopo" id="nopo" onchange="" name="nopo">
                                <option value='{{ $_GET['nopo'] }}'>{{ $_GET['nopo'] }}</option>
                                @foreach($nopo as $itemnopo)
                                <option value="{{ $itemnopo->nopo }}">{{ $itemnopo->nopo }}</option>
                                @endforeach
                            </select>
                            <?php } ?>
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
                            <label for="pallet" class="form-label">No Pallet</label>
                            <?php 
                            if(request()->input('pallet') == 0){ 
                            ?>
                                <select type="text" class="form-control mb-2 select-trans js-pallet" id="palletid" onchange="" name="pallet">
                                    <option></option>
                                    @foreach($pallet as $itempallet)
                                    <option value="{{ $itempallet->code }}">{{ $itempallet->code }}</option>
                                    @endforeach
                                </select>
                            <?php }else{?>
                                <select type="text" class="form-control mb-2 select-trans js-pallet" id="pallet" onchange="" name="pallet">
                                    <option value='{{ $_GET['pallet'] }}'>{{ $_GET['pallet'] }}</option>
                                    @foreach($pallet as $itempallet)
                                    <option value="{{ $itempallet->code }}">{{ $itempallet->code }}</option>
                                    @endforeach
                                </select>
                            <?php } ?>
                            <label for="qtycrtn" class="form-label mt-2">Quantity Carton</label>
                            <?php 
                            if(request()->input('qtycrtn') == null){ 
                            ?>
                                <input type="text" class="form-control mb-2" id="qtycrtn" aria-label="readonly input example" value="" name="qtycrtn" readonly>
                            <?php }else{?>
                                <input type="text" class="form-control mb-2" id="qtycrtn" aria-label="readonly input example" value="{{ $_GET['qtycrtn'] }}" name="qtycrtn" readonly>
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
                    <label for="lokasi" class="form-label mt-2">Lokasi</label>
                    <?php 
                    if(request()->input('lokasi') == null){ 
                    ?>
                    <select type="text" class="form-control mb-2 select-trans js-lokasi" id="lokasi" onchange="" name="lokasi">
                        <option></option>
                        @foreach($lokasi as $itemlokasi)
                        <option value="{{ $itemlokasi->code_mwhse }}">{{ $itemlokasi->code_mwhse }}</option>
                        @endforeach
                    </select>
                    <?php }else{?>
                    <select type="text" class="form-control mb-2 select-trans js-lokasi" id="lokasi" onchange="" name="lokasi">
                        <option value={{ $_GET['lokasi'] }}>{{ $_GET['lokasi'] }}</option>
                        @foreach($lokasi as $itemlokasi)
                        <option value="{{ $itemlokasi->code_mwhse }}">{{ $itemlokasi->code_mwhse }}</option>
                        @endforeach
                    </select>
                    <?php } ?>
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
    //CSRF TOKEN
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $('.js-pallet').select2({
            placeholder : 'Select Pallet',
            allowClear : true
        });
        var nopo = $('#nopo').val();
        $('#palletid').on('select2:select',function (e) {
            pallet = $(this).val();
            $.ajax({
                url : '{{ route('getQtycCrtn') }}',
                method : 'post',
                data : {'pallet' : pallet,
                        'nopo' : nopo},
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                dataType : 'json',
                success : function (response) {
                    console.log("response");
                    console.log(response);
                    for (i=0; i < response.length; i++) {
                        $("#qtycrtn").val(parseInt(response[i].qty));
                    }
                }
            });
        });

        $('.js-nopo').select2({
            placeholder : 'Select No PO',
            allowClear : true
        });
        pallet = $('#palletid').val();
        $('#nopo').on('select2:select',function (e) {
            nopo = $(this).val()
            $.ajax({
                url : '{{ route('getPalletLok') }}',
                method : 'post',
                data : {'nopo' : nopo},
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                dataType : 'json',
                success : function (response) {
                    console.log("response");
                    console.log(response);
                    if ($("#nopo").val() != ""){
                        // $("#nopo").val('').trigger('change');
                        $("#palletid").empty();
                        $("#palletid").append("<option></option>");
                        $("#qtycrtn").val(0);
                        for (i=0; i < response.length; i++) {
                            console.log("response Pallet")
                            console.log(response)
                            pallet = response[i].pallet;
                            $("#palletid").append("<option value='"+pallet+"'>"+pallet+"</option>");

                        }
                    }else if ($("#nopo").val() == 0){
                        alert("Data nopo harus kosong!");
                    }
                    $.ajax({
                    url : '{{ route('getQtycCrtn') }}',
                    method : 'post',
                    data : {'pallet' : pallet,
                            'nopo' : nopo},
                    headers : {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                    dataType : 'json',
                    success : function (response) {
                        // console.log("response");
                        // console.log(response);
                        // for (i=0; i < response.length; i++) {
                        //     $("#qtycrtn").val(parseInt(response[i].qty));
                        // }
                    }
                });
                }
            });
        });

        $('.js-lokasi').select2({
            placeholder : 'Select Lokasi',
            allowClear : true
        });

        $('#lokasi').on('select2:select',function (e) {
            
        });
        // var tempSku= [];
        // var tempIndbound= [];
        // var tempLok = [];
        // var selectedLok = null;
        // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // // #SKU
        // $("#sku").select2({
        //     ajax: {
        //         url: "{{route('getsku')}}",
        //         type: "post",
        //         dataType: "json",
        //         delay: 250,
        //         data: function (params) {
        //             return {
        //                 _token: CSRF_TOKEN,
        //                 searchsku : params.term, //search term
        //             };
        //         },
        //         processResults: function (response) {
        //             tempSku = response
        //             console.log(tempSku);
        //             return {
        //                 results: tempSku
        //             };
        //         },
        //         cache: true
        //     }
        // });
        // $("#sku").change(function (e) {
        //     $("#hdnsku").val(tempSku[this.value-1].text);
        //     $("#desc").val(tempSku[this.value-1].nama);
        //     $("#sat").val(tempSku[this.value-1].sat);
        // });
        // $("#noinbound").select2({
        //     ajax: {
        //         url: "{{route('getinbound')}}",
        //         type: "post",
        //         dataType: "json",
        //         delay: 250,
        //         data: function (params) {
        //             return {
        //                 _token: CSRF_TOKEN,
        //                 searchindbound : params.term, //search term
        //             };
        //         },
        //         processResults: function (response) {
        //             tempIndbound = response
        //             console.log(tempIndbound);
        //             return {
        //                 results: tempIndbound
        //             };
        //         },
        //         cache: true
        //     }
        // });
        // $("#noinbound").change(function (e) {
        //     $("#hdnnoinbound").val(tempIndbound[this.value-1].text);
        //     $("#owner").val(tempIndbound[this.value-1].nama);
        // });
        // $("#lokasi").select2({
        //     ajax: {
        //         url: "{{route('getlokasi')}}",
        //         type: "post",
        //         dataType: "json",
        //         delay: 250,
        //         data: function (params) {
        //             return {
        //                 _token: CSRF_TOKEN,
        //                 searchlok : params.term, //search term
        //             };
        //         },
        //         processResults: function (response) {
        //             tempLok = response
        //             console.log(tempLok);
        //             return {
        //                 results: tempLok
        //             };
        //         },
        //         cache: true
        //     }
        // });
        // $("#lokasi").change(function (e) {
        //     selectedLok = tempLok[this.value-1].text;
        //     console.log(selectedLok);
        //     $("#hdnlok").val(selectedLok);
        //     // $("#hdnlok").val(tempLok[this.value-1].text);
        // });
    });
</script>
{{-- END Bot Script --}}
@endsection