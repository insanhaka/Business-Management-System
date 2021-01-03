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
                    <h2 class="text-primary">Data Produk</h2>
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-success" href="/dapur/product/import" role="button">Import Excel</a>
                    {!! ButtonLib::addButton(Auth::user()->getRoleNames()) !!}
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped table-sm table-bordered display responsive nowrap" style="width:100%">
                <thead class="bg-primary" style="color: #ffff;">
                    <tr>
                        <th>Name</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Nama Usaha</th>
                        <th>Is Active?</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $data)
                    <tr>
                        <td>{!!$data->name!!}</td>
                        <td>{!!$data->stock!!}</td>
                        <td>{!!$data->price!!}</td>
                        <td>{!!$data->category->name!!}</td>
                        <td>{!!$data->business->name!!}</td>
                        @if ($data->is_active == 0)
                        <td>
                            <label class="custom-toggle">
                                <input id="{!!$data->id!!}" type="checkbox">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON" ></span>
                            </label>
                        </td>
                        @else
                        <td>
                            <label class="custom-toggle">
                                <input id="{!!$data->id!!}" type="checkbox" checked>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON" ></span>
                            </label>
                        </td>
                        @endif
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
        $("#product").addClass("active");
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

@foreach ($product as $cek)
<script>
    $(function() {
      $('#{!! $cek->id !!}').change(function(event) {
        var status = ($(this).prop('checked')) ? '1' : '0';
        var id = event.target.id;
        var is_active = status;
        console.log(id);
        // console.log(status);
        axios.post('/dapur/product/activation', {
            is_active: is_active,
            id: id
        })
        .then(function (response) {
            iziToast.success({
                title: 'Success',
                message: 'Proses Berhasil',
                position: 'topRight'
            });
        })
        .catch(function (error) {
            iziToast.warning({
                title: 'Upps !',
                message: 'Proses Gagal',
                position: 'topRight'
            });
        });
      })
    })
</script>
@endforeach

@endsection