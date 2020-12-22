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
                    <h2 class="text-primary">Data Laporan Masyarakat</h2>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped table-sm table-bordered display responsive nowrap" style="width:100%">
                <thead class="bg-primary" style="color: #ffff;">
                    <tr>
                        <th>Nilai</th>
                        <th>Nama Usaha</th>
                        <th>Pemilik</th>
                        <th>Alamat</th>
                        <th>Kontak</th>
                        <th>Waktu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($report as $data)
                    <tr>
                        <td>{!!$data->grade!!}</td>
                        <td>{!!$data->business->name!!}</td>
                        <td>{!!$data->business->owner!!}</td>
                        <td>{!!wordwrap($data->business->loc_address,30,"<br>\n")!!}</td>
                        <td>{!!$data->business->contact!!}</td>
                        <td>{!!$data->created_at!!}</td>
                        <td>
                            <a style="margin-right: 20px;" href="#" data-toggle="modal" data-target="#view{!!$data->id!!}"><i class="fa fa-eye text-primary" style="font-size: 21px;"></i></a>
                            <a style="margin-right: 10px;" href="{{url()->current().'/delete/'.$data->id}}"><i class="fa fa-trash text-primary" style="font-size: 21px;"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</div> 

<!-- Modal -->
@foreach ($report as $item)
<div class="modal fade" id="view{!!$item->id!!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Laporan Masyarakat</h5>
            </button>
        </div>
        <div class="modal-body">
            <p>" {!!$item->description!!} "</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>    
@endforeach


@endsection

@section('js')
<script>
    $(document).ready(function() {   
        $("#report").addClass("active");
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