@extends('Backend.Layout.app')

@section('css')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/picktim.css') }}"> --}}
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid" style="margin-top: 3%; margin-bottom: 6%;">

    <div class="card">
        <div class="card-header">
          <h2 class="text-primary">Edit Business Data</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="/dapur/business/update/{!! $data->id!!}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="container" style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NIK Pemilik</label>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="Owner NIK" value="{!!$owner->nik!!}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Pemilik</label>
                                <input type="text" class="form-control" id="owner" name="owner" placeholder="Business owner name" value="{!!$data->owner!!}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Usaha</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Business name" value="{!!$data->name!!}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Status Verifikasi</label>
                                <select class="form-control" name="status">
                                    <option value="">-- Select Status --</option>
                                    <option value="verif">Verify</option>
                                    <option value="notverif">Not Verify</option>
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
                                <input type="text" class="form-control" id="address" name="loc_address" placeholder="Details business address" value="{!!$data->loc_address!!}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInput">Upload Business Pictures</label>
                                <div class="tower-file">
                                    <input type="file" name="gambar[]" id="demoInput5" multiple />
                                    <label for="demoInput5" class="btn btn-primary">
                                        <span class="mdi mdi-upload"></span>Select Files
                                    </label>
                                    <button type="button" class="tower-file-clear btn btn-secondary align-top">
                                        Clear
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <table class="table table-sm">
                                <thead>
                                  <tr>
                                    <th scope="col"></th>
                                    <th scope="col"><h5>Operation Time</h5></th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td style="font-weight: bold;">Days</td>
                                    <td style="font-weight: bold;">Open Time</td>
                                    <td style="font-weight: bold;">Close Time</td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="senin" name="days[]">
                                            <label class="form-check-label" for="gridCheck1">
                                              Senin
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="time" id="senopen" name="senopen"></div></td>
                                    <td><input type="time" id="senclose" name="senclose"></div></td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="selasa" name="days[]">
                                            <label class="form-check-label" for="gridCheck1">
                                              Selasa
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="time" id="selopen" name="selopen"></div></td>
                                    <td><input type="time" id="selclose" name="selclose"></div></td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="rabu" name="days[]">
                                            <label class="form-check-label" for="gridCheck1">
                                              Rabu
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="time" id="rabopen" name="rabopen"></div></td>
                                    <td><input type="time" id="rabclose" name="rabclose"></div></td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="kamis" name="days[]">
                                            <label class="form-check-label" for="gridCheck1">
                                              Kamis
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="time" id="kamopen" name="kamopen"></div></td>
                                    <td><input type="time" id="kamclose" name="kamclose"></div></td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="jumat" name="days[]">
                                            <label class="form-check-label" for="gridCheck1">
                                              Jum'at
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="time" id="jumopen" name="jumopen"></div></td>
                                    <td><input type="time" id="jumclose" name="jumclose"></div></td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="sabtu" name="days[]">
                                            <label class="form-check-label" for="gridCheck1">
                                              Sabtu
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="time" id="sabopen" name="sabopen"></div></td>
                                    <td><input type="time" id="sabclose" name="sabclose"></div></td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="minggu" name="days[]">
                                            <label class="form-check-label" for="gridCheck1">
                                              Minggu
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="time" id="mingopen" name="mingopen"></div></td>
                                    <td><input type="time" id="mingclose" name="mingclose"></div></td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
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
    $(document).ready(function() {

        const url = '/provinsi-kota-kecamatan-kelurahan.json';

        let prov = $('#province');
            prov.empty();
            prov.append($('<option></option>').attr('value', '{!! $data->loc_province !!}').text('{!! $data->loc_province !!}'));
            prov.prop('selectedIndex', 0);
        let reg = $('#regency');
            reg.empty();
            reg.append($('<option></option>').attr('value', '{!! $data->loc_regency !!}').text('{!! $data->loc_regency !!}'));
            reg.prop('selectedIndex', 0);
        let dist = $('#district');
            dist.empty();
            dist.append($('<option></option>').attr('value', '{!! $data->loc_district !!}').text('{!! $data->loc_district !!}'));
            dist.prop('selectedIndex', 0);
        let vill = $('#village');
            vill.empty();
            vill.append($('<option></option>').attr('value', '{!! $data->loc_village !!}').text('{!! $data->loc_village !!}'));
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

{{-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="{{ asset('assets/js/picktim.js') }}"></script>

<script>
    $(".timepicker").picktim({mode: 'h12'});
</script> --}}

@endsection
