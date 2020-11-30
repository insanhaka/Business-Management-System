@extends('Backend.Layout.app')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet">
<style>
    .select-formhide {
        display: none;
    }
    .select-formshow {
        display: flex;
    }
</style>
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid" style="margin-top: 3%; margin-bottom: 6%;">

    <div class="card">
        <div class="card-header">
          <h2 class="text-primary">Add Business Owner Data</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="/dapur/business/owner/create" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="container" style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Business owner name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Status Verifikasi</label>
                                <select class="form-control" name="business_sectors_id">
                                    <option value="">-- Select Status --</option>
                                    <option value="yes">Verify</option>
                                    <option value="no">Not Verify</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Ikut Dalam Kelompok/Paguyuban ?</label>
                                <select class="form-control" name="type" id="menu-type" onchange="statuskelompok()">
                                    <option value="">-- Select --</option>
                                    <option value="kelompok">Ya</option>
                                    <option value="individu">Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row select-formhide" id="select_parent">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Kelompok/Paguyuban</label>
                                <select class="form-control" name="parent_id">
                                    <option value="">-- Select --</option>
                                    @foreach ($data as $item)
                                    <option value="{!! $item->id !!}">{!! $item->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="color: #546de5; font-weight: bold;">Alamat Sesuai KTP</p>
                            <hr style="margin-top: -1%; border-color: #546de5;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat ( Province )</label>
                                <select class="form-control" id="ktp-province" name="ktp_loc_province">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat ( Regency )</label>
                                <select class="form-control" id="ktp-regency" name="ktp_loc_regency">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat ( District )</label>
                                <select class="form-control" id="ktp-district" name="ktp_loc_district">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat ( Village )</label>
                                <select class="form-control" id="ktp-village" name="ktp_loc_village">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Details Alamat</label>
                                <input type="text" class="form-control" id="ktp-address" name="ktp_address" placeholder="Details business address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="color: #546de5; font-weight: bold;">Alamat Domisili</p>
                            <hr style="margin-top: -1%; border-color: #546de5;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat ( Province )</label>
                                <select class="form-control" id="domisili-province" name="domisili_loc_province">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat ( Regency )</label>
                                <select class="form-control" id="domisili-regency" name="domisili_loc_regency">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat ( District )</label>
                                <select class="form-control" id="domisili-district" name="domisili_loc_district">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat ( Village )</label>
                                <select class="form-control" id="domisili-village" name="domisili_loc_village">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Details Alamat</label>
                                <input type="text" class="form-control" id="domisili-address" name="domisili_address" placeholder="Details business address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="float: right; margin-top: 20px;">
                                <input class="btn btn-primary" type="submit" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>

<script>
    $(document).ready(function() {
        $("#business").addClass("active");
    });
</script>

<script type="text/javascript">
    $('#demoInput5').fileInput({
        iconClass: 'mdi mdi-fw mdi-upload'
    });
</script>

<script>
    function statuskelompok() {
        var i = document.getElementById("menu-type").value;
        // console.log(i);
        if(i === "kelompok"){
            $('#select_parent').removeClass("select-formhide");
            $('#select_parent').addClass("select-formshow");
        }else {
            $('#select_parent').removeClass("select-formshow");
            $('#select_parent').addClass("select-formhide");
        }
    }
</script>

<script>

    //Mengambil data JSON Alamat untuk KTP
    $(document).ready(function() {

        const url = '/provinsi-kota-kecamatan-kelurahan.json';

        let prov = $('#ktp-province');
            prov.empty();
            prov.append('<option disabled>-- Select Province --</option>');
            prov.prop('selectedIndex', 0);
        let reg = $('#ktp-regency');
            reg.empty();
            reg.append('<option disabled>-- Select Regency --</option>');
            reg.prop('selectedIndex', 0);
        let dist = $('#ktp-district');
            dist.empty();
            dist.append('<option disabled>-- Select District --</option>');
            dist.prop('selectedIndex', 0);
        let vill = $('#ktp-village');
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

        // Populate dropdown with list of provinces
        $.getJSON(url, function (data) {
            $.each(data, function (province, entry) {
                prov.append($('<option></option>').attr('value', province).text(province));
            })
        });

        //select province collect regency
        $('#ktp-province').on('change', function() {
            var ktpprovselected = this.value;
            localStorage.setItem('ktpprovselected', this.value);
            //refresh regency
            reg.empty();
            reg.append('<option disabled>-- Select Regency --</option>');
            reg.prop('selectedIndex', 0);
            //refresh District
            dist.empty();
            dist.append('<option disabled>-- Select District --</option>');
            dist.prop('selectedIndex', 0);
            //refresh Village
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

            $.getJSON(url, function (data) {
                $.each(data[ktpprovselected], function (regency, entry) {
                    reg.append($('<option></option>').attr('value', regency).text(regency));
                })
            });
        });

        //select regency collect district
        $('#ktp-regency').on('change', function() {
            var ktpregselected = this.value;
            localStorage.setItem('ktpregselected', this.value);
            var ktpprovselected = localStorage.getItem('ktpprovselected');
            //refresh District
            dist.empty();
            dist.append('<option disabled>-- Select District --</option>');
            dist.prop('selectedIndex', 0);
            //refresh Village
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

            $.getJSON(url, function (data) {
                $.each(data[ktpprovselected][ktpregselected], function (district, entry) {
                    dist.append($('<option></option>').attr('value', district).text(district));
                })
            });
        });

        //select district collect village
        $('#ktp-district').on('change', function() {
            var ktpdistselected = this.value;
            localStorage.setItem('ktpdistselected', this.value);
            var ktpprovselected = localStorage.getItem('ktpprovselected');
            var ktpregselected = localStorage.getItem('ktpregselected');
            //refresh Village
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

            $.getJSON(url, function (data) {
                $.each(data[ktpprovselected][ktpregselected][ktpdistselected], function (village, entry) {
                    vill.append($('<option></option>').attr('value', entry).text(entry));
                })
            });
        });

    });
</script>

<script>

    //Mengambil data JSON Alamat untuk domisili
    $(document).ready(function() {

        const url = '/provinsi-kota-kecamatan-kelurahan.json';

        let prov = $('#domisili-province');
            prov.empty();
            prov.append('<option disabled>-- Select Province --</option>');
            prov.prop('selectedIndex', 0);
        let reg = $('#domisili-regency');
            reg.empty();
            reg.append('<option disabled>-- Select Regency --</option>');
            reg.prop('selectedIndex', 0);
        let dist = $('#domisili-district');
            dist.empty();
            dist.append('<option disabled>-- Select District --</option>');
            dist.prop('selectedIndex', 0);
        let vill = $('#domisili-village');
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

        // Populate dropdown with list of provinces
        $.getJSON(url, function (data) {
            $.each(data, function (province, entry) {
                prov.append($('<option></option>').attr('value', province).text(province));
            })
        });

        //select province collect regency
        $('#domisili-province').on('change', function() {
            var domisiliprovselected = this.value;
            localStorage.setItem('domisiliprovselected', this.value);
            //refresh regency
            reg.empty();
            reg.append('<option disabled>-- Select Regency --</option>');
            reg.prop('selectedIndex', 0);
            //refresh District
            dist.empty();
            dist.append('<option disabled>-- Select District --</option>');
            dist.prop('selectedIndex', 0);
            //refresh Village
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

            $.getJSON(url, function (data) {
                $.each(data[domisiliprovselected], function (regency, entry) {
                    reg.append($('<option></option>').attr('value', regency).text(regency));
                })
            });
        });

        //select regency collect district
        $('#domisili-regency').on('change', function() {
            var domisiliregselected = this.value;
            localStorage.setItem('domisiliregselected', this.value);
            var domisiliprovselected = localStorage.getItem('domisiliprovselected');
            //refresh District
            dist.empty();
            dist.append('<option disabled>-- Select District --</option>');
            dist.prop('selectedIndex', 0);
            //refresh Village
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

            $.getJSON(url, function (data) {
                $.each(data[domisiliprovselected][domisiliregselected], function (district, entry) {
                    dist.append($('<option></option>').attr('value', district).text(district));
                })
            });
        });

        //select district collect village
        $('#domisili-district').on('change', function() {
            var domisilidistselected = this.value;
            localStorage.setItem('domisilidistselected', this.value);
            var domisiliprovselected = localStorage.getItem('domisiliprovselected');
            var domisiliregselected = localStorage.getItem('domisiliregselected');
            //refresh Village
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

            $.getJSON(url, function (data) {
                $.each(data[domisiliprovselected][domisiliregselected][domisilidistselected], function (village, entry) {
                    vill.append($('<option></option>').attr('value', entry).text(entry));
                })
            });
        });

    });
</script>

@endsection
