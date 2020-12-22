@extends('Backend.Layout.app')

@section('css')

<style>
body {
  --table-width: 100%; /* Or any value, this will change dinamically */
}
tbody {
  display:block;
  max-height:173px;
  overflow-y:auto;
}
tbody::-webkit-scrollbar {
    width: 5px;
}

tbody::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1); 
    border-radius: 10px;
}

tbody::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}
thead, tbody tr {
  display:table;
  width: var(--table-width);
  table-layout:fixed;
}
td {
    font-size: 5px;
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
                    <table class="table table-sm table-responsive">
                        {{-- Handle with JS --}}
                    </table>
                    <a class="btn btn-primary btn-block btn-sm" href="/dapur/report" role="button" style="margin-top: 5%">Lihat Semua Data</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-bottom: 3%;">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>Pie Usaha Menyetujui Prokes</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>Pie Rekapitulasi Nilai Semua Laporan</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>Pie Usaha Menyetujui Prokes</h4>
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

<script src="{{asset('assets/js/handmade/prokes-chart.js')}}"></script>

<script>
    $(document).ready(function() {
        
        // Make a request
        axios.get('/api/data-report-custome')
        .then(function (response) {
            var datareport = response.data['datareport'];

            // console.log(datareport);

            // var tbodyreport = document.querySelector("table");
            // tbodyreport.innerHTML = '';
            let table = document.querySelector("table");
            let data = Object.keys(datareport[0]);

            function generateTableHead(table, data) {
            let thead = table.createTHead();
            let row = thead.insertRow();
                for (let key of data) {
                    let th = document.createElement("th");
                    let text = document.createTextNode(key);
                    th.appendChild(text);
                    row.appendChild(th);
                }
            }

            function generateTable(table, data) {
                for (let element of data) {
                    let row = table.insertRow();
                    for (key in element) {
                    let cell = row.insertCell();
                    let text = document.createTextNode(element[key]);
                    cell.appendChild(text);
                    }
                }
            }

            generateTableHead(table, data);
            generateTable(table, datareport);

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('#sort').on('change', function () {
            var selected = this.value;
            
            if (selected === 'good') {
                // console.log("bisa");

                // Make a request
                axios.get('/api/data-report-custome')
                .then(function (response) {
                    var dataterbaik = response.data['dataterbaik'];

                    // console.log(dataterburuk);

                    var tbodygood = document.querySelector("table");
                    tbodygood.innerHTML = '';

                    let table = document.querySelector("table");
                    let data = Object.keys(dataterbaik[0]);

                    function generateTableHead(table, data) {
                    let thead = table.createTHead();
                    let row = thead.insertRow();
                        for (let key of data) {
                            let th = document.createElement("th");
                            let text = document.createTextNode(key);
                            th.appendChild(text);
                            row.appendChild(th);
                        }
                    }

                    function generateTable(table, data) {
                        for (let element of data) {
                            let row = table.insertRow();
                            for (key in element) {
                            let cell = row.insertCell();
                            let text = document.createTextNode(element[key]);
                            cell.appendChild(text);
                            }
                        }
                    }

                    generateTableHead(table, data);
                    generateTable(table, dataterbaik);

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            }else if(selected === 'bad'){
                // console.log("bisa");

                // Make a request
                axios.get('/api/data-report-custome')
                .then(function (response) {
                    var dataterburuk = response.data['dataterburuk'];

                    // console.log(dataterburuk);

                    var tbodybad = document.querySelector("table");
                    tbodybad.innerHTML = '';

                    let table = document.querySelector("table");
                    let data = Object.keys(dataterburuk[0]);

                    function generateTableHead(table, data) {
                    let thead = table.createTHead();
                    let row = thead.insertRow();
                        for (let key of data) {
                            let th = document.createElement("th");
                            let text = document.createTextNode(key);
                            th.appendChild(text);
                            row.appendChild(th);
                        }
                    }

                    function generateTable(table, data) {
                        for (let element of data) {
                            let row = table.insertRow();
                            for (key in element) {
                            let cell = row.insertCell();
                            let text = document.createTextNode(element[key]);
                            cell.appendChild(text);
                            }
                        }
                    }

                    generateTableHead(table, data);
                    generateTable(table, dataterburuk);

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            }

        });
    });
</script>

@endsection