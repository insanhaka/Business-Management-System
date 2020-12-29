@extends('Backend.Layout.app')

@section('css')
<link href="{{asset('assets/css/slimselect.min.css')}}" rel="stylesheet">
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
          <h2 class="text-primary">Tambah Data Usaha</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="/dapur/business/create" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="container" style="margin-top: -10px;">
                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NIK Pemilik</label>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="Owner NIK">
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NIK Pemilik</label>
                                <select class="form-control" name="nik" id="nik-owner">
                                    <option value="">-- Select NIK --</option>
                                    @foreach ($owner as $data)
                                    <option value="{!!$data->nik!!}">{!! $data->nik !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Pemilik</label>
                                <input type="text" class="form-control" id="owner" name="owner" placeholder="Business owner name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Usaha</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Business name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Status Verifikasi</label>
                                <select class="form-control" name="status">
                                    <option value="">-- Select Status --</option>
                                    <option value="Verify">Verify</option>
                                    <option value="Not Verif">Not Verify</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Ikut Dalam Kelompok/Paguyuban ?</label>
                                <select class="form-control" name="community" id="menu-type" onchange="statuskelompok()">
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
                                <select class="form-control" name="community_id">
                                    <option value="">-- Select --</option>
                                    @foreach ($community as $item)
                                    <option value="{!! $item->id !!}">{!! $item->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Jenis Usaha</label>
                                <select class="form-control" name="business_sectors_id">
                                    <option value="">-- Select Business Sector --</option>
                                    @foreach ($sector as $data)
                                    <option value="{!!$data->id!!}">{!! $data->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Kategori Usaha</label>
                                <select class="form-control" name="business_category_id">
                                    <option value="">-- Select Business Category --</option>
                                    @foreach ($category as $data)
                                    <option value="{!!$data->id!!}">{!! $data->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">No. Telfon</label>
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="Exp : 0877xxxxxxxx">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat Usaha ( Provinsi )</label>
                                <select class="form-control" id="province" name="loc_province">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat Usaha ( Kabupaten/Kota )</label>
                                <select class="form-control" id="regency" name="loc_regency">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat Usaha ( Kecamatan )</label>
                                <select class="form-control" id="district" name="loc_district">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat Usaha ( Desa )</label>
                                <select class="form-control" id="village" name="loc_village">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Details alamat Usaha</label>
                                <input type="text" class="form-control" id="address" name="loc_address" placeholder="Details business address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInput">Upload Gambar Usaha</label>
                                <div class="tower-file">
                                    <input type="file" name="photo" id="demoInput5" />
                                    <label for="demoInput5" class="btn btn-primary">
                                        <span class="mdi mdi-upload"></span>Select Files
                                    </label>
                                    <button type="button" class="tower-file-clear btn btn-secondary align-top">
                                        Clear
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Usaha ini Aktiv?</label>
                                <select class="form-control" name="is_active">
                                    <option value="">-- Select --</option>
                                    <option value="1">Ya</option>
                                    <option value="0">Belum</option>
                                </select>
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
        new SlimSelect({
            select: '#nik-owner',
            height: 100
        })
    });
</script>

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
    //Script Hide or Show Select Menu Community
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
    $(document).ready(function() {

        const url = '/provinsi-kota-kecamatan-kelurahan.json';

        let prov = $('#province');
            prov.empty();
            prov.append('<option disabled>-- Select Province --</option>');
            prov.prop('selectedIndex', 0);
        let reg = $('#regency');
            reg.empty();
            reg.append('<option disabled>-- Select Regency --</option>');
            reg.prop('selectedIndex', 0);
        let dist = $('#district');
            dist.empty();
            dist.append('<option disabled>-- Select District --</option>');
            dist.prop('selectedIndex', 0);
        let vill = $('#village');
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
        $('#province').on('change', function() {
            var provselected = this.value;
            localStorage.setItem('provselected', this.value);
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
                $.each(data[provselected], function (regency, entry) {
                    reg.append($('<option></option>').attr('value', regency).text(regency));
                })
            });
        });

        //select regency collect district
        $('#regency').on('change', function() {
            var regselected = this.value;
            localStorage.setItem('regselected', this.value);
            var provselected = localStorage.getItem('provselected');
            //refresh District
            dist.empty();
            dist.append('<option disabled>-- Select District --</option>');
            dist.prop('selectedIndex', 0);
            //refresh Village
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

            $.getJSON(url, function (data) {
                $.each(data[provselected][regselected], function (district, entry) {
                    dist.append($('<option></option>').attr('value', district).text(district));
                })
            });
        });

        //select district collect village
        $('#district').on('change', function() {
            var distselected = this.value;
            localStorage.setItem('distselected', this.value);
            var provselected = localStorage.getItem('provselected');
            var regselected = localStorage.getItem('regselected');
            //refresh Village
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

            $.getJSON(url, function (data) {
                $.each(data[provselected][regselected][distselected], function (village, entry) {
                    vill.append($('<option></option>').attr('value', entry).text(entry));
                })
            });
        });

    });
</script>

<script>

    $('#nik-owner').on('change', function() {
        var getnik = this.value;
        // console.log(getnik);
        // GET data owner by API
        axios.get('/api/data-owner')
        .then(function (response) {
            // handle success
            var dataowner = response.data.data;
            for (let i = 0; i < dataowner.length; i++) {

                if (dataowner[i].nik == getnik) {
                    document.getElementById("owner").value = dataowner[i].name;
                }

            }
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
    });
</script>

@endsection
