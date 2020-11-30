@extends('Backend.Layout.app')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid" style="margin-top: 3%; margin-bottom: 6%;">

    <div class="card">
        <div class="card-header">
          <h2 class="text-primary">Add Business Data</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="/dapur/business/create" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="container" style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Business Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Business sector's name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Owner Name</label>
                                <input type="text" class="form-control" id="owner" name="owner" placeholder="Business owner name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="Exp : 0877xxxxxxxx">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Business Sector</label>
                                <select class="form-control" name="business_sectors_id">
                                    <option value="">-- Select Business Sector --</option>
                                    @foreach ($sectors as $sector)
                                    <option value="{!!$sector->id!!}">{!! $sector->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Address ( Province )</label>
                                <select class="form-control" id="province" name="loc_province">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Address ( Regency )</label>
                                <select class="form-control" id="regency" name="loc_regency">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Address ( District )</label>
                                <select class="form-control" id="district" name="loc_district">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Address ( Village )</label>
                                <select class="form-control" id="village" name="loc_village">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Details Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Details business address">
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

@endsection
