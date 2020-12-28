@extends('Backend.Layout.app')

@section('css')
    <style>
        .tab-pane {
            height: 23rem;
        }
        .tab-pane p {
            font-size: 14px;
        } 
    </style>
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid" style="margin-top: 3%; margin-bottom: 6%;">

    <div class="card">
        <div class="card-body">
            <h3 style="margin-bottom: 3%;">Berikut adalah cara untuk melakukan import data menggunakan file excel :</h3>
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="langkah1-tab" data-toggle="tab" href="#langkah1" role="tab" aria-controls="langkah1" aria-selected="true">Langkah 1</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="langkah2-tab" data-toggle="tab" href="#langkah2" role="tab" aria-controls="langkah2" aria-selected="false">Langkah 2</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="langkah3-tab" data-toggle="tab" href="#langkah3" role="tab" aria-controls="langkah3" aria-selected="false">Langkah 3</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="langkah4-tab" data-toggle="tab" href="#langkah4" role="tab" aria-controls="langkah4" aria-selected="false">Langkah 4</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent" style="margin-top: 3%;">
                <div class="tab-pane fade show active" id="langkah1" role="tabpanel" aria-labelledby="langkah1-tab">
                    <div class="container">
                        <ul class="list-unstyled">
                            <li><p>Siapkan dua data yaitu <b>Data Pemilik Usaha</b> dan <b>Data Usahanya</b></p></li>
                            <li><p>Data yang akan di import dalam bentuk file excel harus menyesuaikan format yang telah ditentukan pada sistem.</p></li>
                            <li>
                                <p>Unduh format file excel Dibawah ini</p>
                                <a class="btn btn-primary btn-sm" href="{{url('/example_import/format-data-pelaku-usaha.xlsx')}}" role="button"><i class="fa fa-download" aria-hidden="true"></i> Format data pemilik usaha</a>
                                <a class="btn btn-primary btn-sm" href="{{url('/example_import/format-data-usaha.xlsx')}}" role="button"><i class="fa fa-download" aria-hidden="true"></i> Format data usaha</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade" id="langkah2" role="tabpanel" aria-labelledby="langkah2-tab">
                    <div class="container">
                        <ul class="list-unstyled">
                            <li><p>Setelah selesai mengunduh format file excel, silahkan isi data seperti contoh berikut</p></li>
                            <li>Contoh pengisian untuk data pelaku usaha </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade" id="langkah3" role="tabpanel" aria-labelledby="langkah3-tab">
                    <div class="container">
                        <form method="post" action="/dapur/business/owner/file-import" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label for="exampleFormControlFile1">Import terlebih dahulu data pelaku usahanya</label>
                              <input type="file" class="form-control-file" id="file-import1" name="file">
                            </div>
                            <input class="btn btn-primary" type="submit" value="Import">
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="langkah4" role="tabpanel" aria-labelledby="langkah4-tab">
                    <div class="container">
                        <form method="post" action="/dapur/business/owner/file-import" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label for="exampleFormControlFile1">Import data usahanya</label>
                              <input type="file" class="form-control-file" id="file-import2" name="file">
                            </div>
                            <input class="btn btn-primary" type="submit" value="Import">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>      
@endsection

@section('js')
<script>
    $(document).ready(function() {   
        $("#business").addClass("active");
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

@endsection