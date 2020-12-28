@extends('Backend.Layout.app')

@section('css')

<style>
.list-group {
  display:block;
  max-height:200px;
  overflow-y:auto;
}
.list-group::-webkit-scrollbar {
    width: 5px;
}

.list-group::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1); 
    border-radius: 10px;
}

.list-group::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}

</style>
    
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid" style="margin-top: 3%">
    <div class="row justify-content-center" style="margin-top: 20px;">
        <div class="col-md-7">
            <div class="card" style="height: 28rem;">
                <div class="card-body">
                    <div id="hightchart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card" style="height: 28rem;">
                <div class="card-body">
                    <H4 class="text-center" style="margin-bottom: 5%">Data Laporan Terbaru</H4>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1" style="font-size: 12px">Urutkan Berdasarkan</label>
                        <select class="form-control" id="sort">
                            <option value="">-- Urutkan --</option>
                            <option value="bad">Laporan Sangat Buruk Terbanyak</option>
                            <option value="good">Laporan Sangat Baik Terbanyak</option>
                        </select>
                    </div>
                    {{-- <table class="table table-sm table-responsive"> --}}
                        {{-- Handle with JS --}}
                    {{-- </table> --}}
                    <div class="row text-center" style="font-size: 12px; margin-top: -3%; margin-bottom: 3%">
                        <div class="col-md-4">
                            Nama Usaha
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            Detail
                        </div>
                    </div>
                    <ul class="list-group" style="font-size: 13px;" id="mylist">
                        {{-- JS Handle --}}
                    </ul>
                    <a class="btn btn-primary btn-block btn-sm" href="/dapur/report" role="button" style="margin-top: 5%">Lihat Semua Data</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-bottom: 3%;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id='myPieOne'>
                        <!-- Plotly chart will be drawn inside this DIV -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id='myPieTwo'>
                        <!-- Plotly chart will be drawn inside this DIV -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>      
@endsection

@section('js')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<script>
    $(document).ready(function() {   
        $("#statistic").addClass("active");
    });
</script>

<script type="text/javascript">
    @if ($message = Session::get('created'))
            iziToast.success({
                        title: 'Success',
                        message: 'Data berhasil disimpan',
                        position: 'topRight'
                    });
    @endif
</script>
<script type="text/javascript">
    @if ($message = Session::get('updated'))
            iziToast.success({
                        title: 'Success',
                        message: 'Data berhasil diubah',
                        position: 'topRight'
                    });
    @endif
</script>
<script type="text/javascript">
    @if ($message = Session::get('deleted'))
            iziToast.success({
                        title: 'Success',
                        message: 'Data berhasil dihapus',
                        position: 'topRight'
                    });
    @endif
</script>
<script type="text/javascript">
    @if ($message = Session::get('warning'))
            iziToast.error({
                        title: 'Failed',
                        message: 'Data gagal diproses',
                        position: 'topRight'
                    });
    @endif
</script>

{{-- SCRIPT GRAFIK --}}
<script src="{{asset('assets/js/handmade/prokes-chart.js')}}"></script>
<script>
    $(document).ready(function() {

        axios.get('/api/data-prokes-agree-count')
        .then(function (response) {
            var result = response.data['data'];
            // console.log(result);
            var Colors = ['#546de5', '#e66767',];

            var data = [{
                values: result,
                labels: ['Sudah', 'Belum',],
                type: 'pie',
                marker: {
                            colors: Colors
                        },
                hoverlabel: {
                            font: {color: '#fff'}
                        },
                insidetextfont: {
                            color: '#fff'
                } 
            }];

            var layout = { 
                title: 'Data Pelaku Usaha Yang Menyetujui <br>Protokol Kesehatan',
                font: {size: 12}
            };

            var config = {responsive: true}

            Plotly.newPlot('myPieOne', data, layout, config);

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });

    });

</script>
<script>
    $(document).ready(function() {

        axios.get('/api/data-grade-report')
        .then(function (response) {
            var result = response.data['data'];
            // console.log(result);
            var Colors = ['#e66767', '#ffb142', '#27ae60', '#3498db', '#546de5'];

            var data = [{
                values: result,
                labels: ['Sangat Buruk', 'Buruk', 'Cukup Baik', 'Baik', 'Sangat Baik'],
                type: 'pie',
                marker: {
                            colors: Colors
                        },
                hoverlabel: {
                            font: {color: '#fff'}
                        },
                insidetextfont: {
                            color: '#fff'
                } 
            }];

            var layout = { 
                title: 'Total Jumlah Laporan Masuk <br>Berdasarkan Tingkat Penilaian',
                font: {size: 12}
            };

            var config = {responsive: true}

            Plotly.newPlot('myPieTwo', data, layout, config);

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });

    });

</script>

<script>
    //Mengambil data JSON Alamat untuk KTP
    $(document).ready(function() {

        let newlist = $('#mylist');
        // Make a request
        axios.get('/api/data-report-custome')
        .then(function (response) {
            var datareport = response.data['datareport'];
            // console.log(datareport);

            $.each(datareport, function (index, entry) {
                newlist.append($('<li class="list-group-item d-flex justify-content-between align-items-center">'+entry['Nama Usaha']+'<span class="badge badge-primary badge-pill" style="font-size: 13px">1</span><a class="btn btn-primary btn-sm" href="{!!url('/dapur')!!}/business/show/'+entry['id']+'" role="button">View</a></li>'));
            });

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });

        $('#sort').on('change', function () {
            var selected = this.value;
            
            if (selected === 'good') {
                // console.log("bisa");
                newlist.empty();
                // Make a request
                axios.get('/api/data-report-custome')
                .then(function (response) {
                    var dataterbaik = response.data['dataterbaik'];

                    let newlist = $('#mylist');

                    $.each(dataterbaik, function (index, entry) {
                        newlist.append($('<li class="list-group-item d-flex justify-content-between align-items-center">'+entry['Nama Usaha']+'<span class="badge badge-primary badge-pill" style="font-size: 13px">'+entry['Jumlah']+'</span><a class="btn btn-primary btn-sm" href="{!!url('/dapur')!!}/business/show/'+entry['id']+'" role="button">View</a></li>'));
                    });

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            }else if(selected === 'bad'){
                // console.log("bisa");
                newlist.empty();
                // Make a request
                axios.get('/api/data-report-custome')
                .then(function (response) {
                    var dataterburuk = response.data['dataterburuk'];

                    $.each(dataterburuk, function (index, entry) {
                        newlist.append($('<li class="list-group-item d-flex justify-content-between align-items-center">'+entry['Nama Usaha']+'<span class="badge badge-primary badge-pill" style="font-size: 13px">'+entry['Jumlah']+'</span><a class="btn btn-primary btn-sm" href="{!!url('/dapur')!!}/business/show/'+entry['id']+'" role="button">View</a></li>'));
                    });
                
                });

            }

        });

    });

</script>

@endsection