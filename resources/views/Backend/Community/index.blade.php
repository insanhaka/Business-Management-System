@extends('Backend.Layout.app')

@section('css')
    
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid" style="margin-top: 3%; margin-bottom: 6%;">

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-primary">Data Kelompok / Paguyuban</h2>
                </div>
                <div class="col-md-6 text-right">
                    {!! ButtonLib::addButton(Auth::user()->getRoleNames()) !!}
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped table-sm table-bordered display responsive nowrap" style="width:100%">
                <thead class="bg-primary" style="color: #ffff;">
                    <tr>
                        <th>id</th>
                        <th>Nama Kelompok</th>
                        <th>Alamat</th>
                        <th>Ketua</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($community as $data)
                    <tr>
                        <td>{!! $data->id !!}</td>
                        <td>{!!$data->name!!}</td>
                        <td>{!!$data->office_address!!}</td>
                        <td>{!!$data->chairman_name!!}</td>
                        <td>
                            {!! ButtonLib::editButton(Auth::user()->getRoleNames(), $data) !!}
                            {!! ButtonLib::deleteButton(Auth::user()->getRoleNames(), $data)!!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</div>      
@endsection

@section('js')
<script>
    $(document).ready(function() {   
        $("#community").addClass("active");
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