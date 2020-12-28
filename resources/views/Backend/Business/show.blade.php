@extends('Backend.Layout.app')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid" style="margin-top: 3%; margin-bottom: 6%;">

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-primary" style="font-weight: bold;">Data Usaha</h2>
                </div>
                <div class="col-md-6 text-right">
                    <a style="margin-right: 20px;" href="/dapur/business/edit/{!!$business->id!!}"><i class="fa fa-edit text-warning" style="font-size: 21px;"></i></a>
                    <a style="margin-right: 10px;" href="/dapur/business/delete/{!!$business->id!!}"><i class="fa fa-trash text-danger" style="font-size: 21px;"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="col-md-4">
                    @if (empty($business->photo))
                    <img src="{{asset('assets/img/no-image.jpg')}}" class="img-fluid" alt="Responsive image">
                    @else
                    <img src="{{asset('business_photo/'.$business->photo.'')}}" class="img-fluid" alt="Responsive image">
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                            <tr>
                                <td style="font-weight: bold">Nama Usaha</td>
                                <td>:</td>
                                <td>{!!$business->name!!}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Pemilik</td>
                                <td>:</td>
                                <td>{!!$business->owner!!}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Alamat</td>
                                <td>:</td>
                                <td>{!!wordwrap($business->loc_address,30,"<br>\n")!!}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Kontak</td>
                                <td>:</td>
                                <td>{!!$business->contact!!}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Jenis Usaha</td>
                                <td>:</td>
                                <td>{!!$business->sector->name!!}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Kelompok / Paguyuban</td>
                                <td>:</td>
                                @if ($business->community_id == null)
                                <td>-----------</td>
                                @else
                                <td>{!!wordwrap($business->community->name,30,"<br>\n")!!}</td>
                                @endif
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Status</td>
                                <td>:</td>
                                @if ($business->status === 'Verify')
                                <td>{!!$business->status!!} &nbsp; <img src="{{asset('assets/img/icons/checked.png')}}" class="img-fluid" alt="Responsive image" width="30"></td>
                                @else
                                <td>{!!$business->status!!} &nbsp; <img src="{{asset('assets/img/icons/minus.png')}}" class="img-fluid" alt="Responsive image" width="30"></td>
                                @endif
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Is active?</td>
                                <td>:</td>
                                @if ($business->is_active == 0 || $business->is_active == null)
                                <td>
                                    <label class="custom-toggle">
                                        <input id="{!!$business->id!!}" type="checkbox">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON" ></span>
                                    </label>
                                </td>
                                @else
                                <td>
                                    <label class="custom-toggle">
                                        <input id="{!!$business->id!!}" type="checkbox" checked>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON" ></span>
                                    </label>
                                </td>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="text-center" style="font-weight: bold; margin-top: 3%">Waktu Operasional</h5>
                    <div class="table-responsive" style="margin-top: -1%">
                        <table class="table table-sm" style="margin-top: 2%">
                            <tbody>
                                <tr>
                                    <td style="font-weight: bold">Hari</td>
                                    @foreach ($operation as $item)
                                    <td>{!!$item->days!!}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Jam Buka</td>
                                    @foreach ($operation as $item)
                                    <td>{!!Str::beforeLast($item->open, ':')!!}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Jam Tutup</td>
                                    @foreach ($operation as $item)
                                    <td>{!!Str::beforeLast($item->close, ':')!!}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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

<script>
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
</script>



@endsection
