@extends('Backend.Layout.app')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid" style="margin-top: 3%; margin-bottom: 6%;">

    <div class="card">
        <div class="card-header">
          <h2 class="text-primary">Tambah Data Kelompok / Paguyuban</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="/dapur/community/create">
                {{ csrf_field() }}
                <div class="container" style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Kelompok / Paguyuban</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Kelompok">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Ketua</label>
                                <input type="text" class="form-control" id="chairman_name" name="chairman_name" placeholder="Nama Ketua Kelompok">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NIK</label>
                                <input type="text" class="form-control" id="chairman_nik" name="chairman_nik" placeholder="NIK Ketua" maxlength="18">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="color: #546de5; font-weight: bold;">Alamat Kesekretariatan</p>
                            <hr style="margin-top: -1%; border-color: #546de5;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Provinsi</label>
                                <select class="form-control" id="ktp-province" name="office_loc_province">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Kabupaten / Kota</label>
                                <select class="form-control" id="ktp-regency" name="office_loc_regency">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Kecamatan</label>
                                <select class="form-control" id="ktp-district" name="office_loc_district">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Desa</label>
                                <select class="form-control" id="ktp-village" name="office_loc_village">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Details Alamat</label>
                                <input type="text" class="form-control" id="ktp-address" name="office_address" placeholder="Alamat kesekretariatan lengkap">
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
        $("#community").addClass("active");
    });
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

@endsection