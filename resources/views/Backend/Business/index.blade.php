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
                    <h2 class="text-primary">Data Usaha</h2>
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-primary" href="/dapur/business/owner/add" role="button">Tambah Data</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h4 style="margin-bottom: 2%">View by :</h4>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pemilik</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Usaha</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent" style="padding-top: 3%">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table id="datatable-owner" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
                        <thead class="bg-primary" style="color: #ffff;">
                            <tr>
                                <th style="text-align: center;"><input type="checkbox" aria-label="Checkbox for following text input"></th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Alamat KTP</th>
                                <th>Alamat Domisili</th>
                                <th>Prokes</th>
                                <th>Detail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($owner as $data)
                            <tr>
                                <td style="text-align: center;"><input type="checkbox" aria-label="Checkbox for following text input"></td>
                                <td>{!!$data->name!!}</td>
                                <td>{!!$data->nik!!}</td>
                                <td>{!!Str::limit($data->ktp_address, 35)!!}</td>
                                <td>{!!Str::limit($data->domisili_address, 35)!!}</td>
                                @if ($data->attachment == null)
                                <td><i class="fa fa-times-circle text-danger" style="font-size: 21px;"></i></td>
                                @else
                                <td>
                                    <a href="{{url('/agreement_file').'/'.$data->attachment}}" target="_blank"><i class="fa fa-check-circle text-success" style="font-size: 21px;"></i></a>
                                </td>
                                @endif
                                <td><a class="btn btn-success btn-sm" href="{{url()->current().'/owner/show/'.$data->id}}" role="button">View</a></td>
                                <td>
                                    <a style="margin-right: 20px;" href="{{url()->current().'/owner/edit/'.$data->id}}"><i class="fa fa-edit text-primary" style="font-size: 21px;"></i></a>
                                    <a style="margin-right: 10px;" href="{{url()->current().'/owner/delete/'.$data->id}}"><i class="fa fa-trash text-primary" style="font-size: 21px;"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table id="datatable-business" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
                        <thead class="bg-primary" style="color: #ffff;">
                            <tr>
                                <th style="text-align: center;"><input type="checkbox" aria-label="Checkbox for following text input"></th>
                                <th>Nama</th>
                                <th>Pemilik</th>
                                <th>Alamat</th>
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
                                <td>{!!$data->owner!!}</td>
                                <td>{!!Str::limit($data->loc_address, 35)!!}</td>
                                @if ($data->status === 'Verify')
                                <td>{!!$data->status!!} &nbsp; <img src="{{asset('assets/img/icons/checked.png')}}" class="img-fluid" alt="Responsive image" width="20"></td>
                                @else
                                <td>{!!$data->status!!} &nbsp; <img src="{{asset('assets/img/icons/minus.png')}}" class="img-fluid" alt="Responsive image" width="20"></td>
                                @endif
                                <td><a class="btn btn-success btn-sm" href="{{url()->current().'/show/'.$data->id}}" role="button">View</a></td>
                                <td>
                                    <a style="margin-right: 20px;" href="{{url()->current().'/edit/'.$data->id}}"><i class="fa fa-edit text-primary" style="font-size: 21px;"></i></a>
                                    <a style="margin-right: 10px;" href="{{url()->current().'/delete/'.$data->id}}"><i class="fa fa-trash text-primary" style="font-size: 21px;"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    @if ($message = Session::get('owner_created'))
        bootbox.confirm({
            message: '<p style="font-weight : bold;">Data berhasil disimpan, Selanjutnya silahkan input data usahanya</p>',
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-secondary'
                }
            },
            callback: function (result) {
                if (result == true) {
                    window.location.href = "/dapur/business/add";
                }
            }
        });
    @endif
</script>

<script type="text/javascript">
    @if ($message = Session::get('empty'))
        bootbox.confirm({
            message: '<p style="font-weight : bold;">Data usaha masih kosong, Mau menambahkan data usaha ?</p>',
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-secondary'
                }
            },
            callback: function (result) {
                if (result == true) {
                    window.location.href = "/dapur/business/add";
                }
            }
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
