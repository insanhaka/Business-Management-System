@extends('Backend.Layout.app')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid" style="margin-top: 3%; margin-bottom: 6%;">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-primary" style="font-weight: bold;">Data Pelaku Usaha</h2>
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-warning" href="/dapur/business/owner/edit/{!!$owner->id!!}" role="button">Perbarui Data</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="col-md-4">
                    @if (empty($owner->photo))
                    <img src="{{asset('assets/img/no-image.jpg')}}" class="img-fluid" alt="Responsive image">
                    @else
                    <img src="{{asset('owner_photo/'.$owner->photo.'')}}" class="img-fluid" alt="Responsive image">
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                            <tr>
                                <td style="font-weight: bold">Nama</td>
                                <td>:</td>
                                <td>{!!$owner->name!!}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">NIK</td>
                                <td>:</td>
                                <td>{!!$owner->nik!!}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Alamat Sesuai KTP</td>
                                <td>:</td>
                                <td>{!!wordwrap($owner->ktp_address,30,"<br>\n")!!}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Alamat Domisili</td>
                                <td>:</td>
                                <td>{!!wordwrap($owner->domisili_address,30,"<br>\n")!!}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-primary" style="font-weight: bold;">Data Usaha</h2>
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-primary" href="/dapur/business/add" role="button">Tambah Data</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable-business" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
                <thead class="bg-primary" style="color: #ffff;">
                    <tr>
                        <th style="text-align: center;"><input type="checkbox" aria-label="Checkbox for following text input"></th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Paguyuban</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($business as $data)
                    <tr>
                        <td style="text-align: center;"><input type="checkbox" aria-label="Checkbox for following text input"></td>
                        <td>{!!$data->name!!}</td>
                        <td>{!!Str::limit($data->loc_address, 35)!!}</td>
                        @if ($data->community_id == null)
                        <td>-----</td>
                        @else
                        <td>{!!$data->community->name!!}</td>
                        @endif
                        @if ($data->status === 'Verify')
                        <td>{!!$data->status!!} &nbsp; <img src="{{asset('assets/img/icons/checked.png')}}" class="img-fluid" alt="Responsive image" width="20"></td>
                        @else
                        <td>{!!$data->status!!} &nbsp; <img src="{{asset('assets/img/icons/minus.png')}}" class="img-fluid" alt="Responsive image" width="20"></td>
                        @endif
                        <td><a class="btn btn-success btn-sm" href="{{url('/dapur/business').'/show/'.$data->id}}" role="button">View</a></td>
                        <td>
                            <a style="margin-right: 20px;" href="{{url('/dapur/business').'/edit/'.$data->id}}"><i class="fa fa-edit text-primary" style="font-size: 21px;"></i></a>
                            <a style="margin-right: 10px;" href="{{url('/dapur/business').'/delete/'.$data->id}}"><i class="fa fa-trash text-primary" style="font-size: 21px;"></i></a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>

<script>
    $(document).ready(function() {
        $("#business").addClass("active");
    });
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
    @if ($message = Session::get('warning'))
            iziToast.error({
                        title: 'Failed',
                        message: 'Data gagal diproses',
                        position: 'topRight'
                    });
    @endif
</script>

{{-- <script>
    $(function() {
      $('#{!! $business->id !!}').change(function(event) {
        var status = ($(this).prop('checked')) ? '1' : '0';
        var id = event.target.id;
        var is_active = status;
        // console.log(id);
        // console.log(status);
        axios.post('/dapur/business/activation', {
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
</script> --}}



@endsection
