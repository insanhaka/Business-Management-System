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
                    <h2 class="text-primary">Data Business</h2>
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-primary" href="/dapur/business/add" role="button">Add Data</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
                <thead class="bg-primary" style="color: #ffff;">
                    <tr>
                        <th style="text-align: center;"><input type="checkbox" aria-label="Checkbox for following text input"></th>
                        <th>Name</th>
                        <th>Owner</th>
                        <th>Address</th>
                        <th>Active?</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($business as $data)
                    <tr>
                        <td style="text-align: center;"><input type="checkbox" aria-label="Checkbox for following text input"></td>
                        <td>{!!$data->name!!}</td>
                        <td>{!!$data->owner!!}</td>
                        <td>{!!Str::limit($data->address, 35)!!}</td>
                        @if ($data->is_active == 0 || $data->is_active == null)
                        <td><img src="{{asset('assets/img/lamp_off.png')}}" class="img-fluid" alt="Responsive image" width="40"></td>
                        @else
                        <td><img src="{{asset('assets/img/lamp_on.png')}}" class="img-fluid" alt="Responsive image" width="40"></td>
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
@endsection

@section('js')
<script>
    $(document).ready(function() {   
        $("#business").addClass("active");
    });
</script>

<script type="text/javascript">
    @if ($message = Session::get('created'))

    var sesi = '{!!Session::get('created')!!}';
    var result = String(sesi);

    axios.get('/api/data-business')
    .then(function (response) {
        // handle success
        var business = response.data['databusiness'];
        for (var n in business) {
            if (business[n].name == result){
                var id = business[n].id;
                bootbox.confirm({
                    message: '<p style="font-weight : bold;">Silahkan lengkapi data bisnis agar informasi lebih akurat</p>',
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
                            window.location.href = "/dapur/business/edit/"+id;
                        }
                    }
                });
            }
        }
    })
    .catch(function (error) {
        // handle error
        console.log(error);
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