@extends('Backend.Layout.app')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid" style="margin-top: 3%; margin-bottom: 6%;">

    <div class="card">
        <div class="card-header">
          <h2 class="text-primary">Business Data</h2>
        </div>
        <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="col-md-4">
                    @if (empty($business->photo->title))
                    <img src="{{asset('assets/img/no-image.jpg')}}" class="img-fluid" alt="Responsive image">
                    @else
                    <img src="{{asset('business_pictures/'.$business->photo->title.'')}}" class="img-fluid" alt="Responsive image">
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                            <tr>
                                <td style="font-weight: bold">Business Name</td>
                                <td>:</td>
                                <td>{!!$business->name!!}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Owner</td>
                                <td>:</td>
                                <td>{!!$business->owner!!}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Address</td>
                                <td>:</td>
                                <td>{!!wordwrap($business->address,30,"<br>\n")!!}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Contact</td>
                                <td>:</td>
                                <td>{!!$business->contact!!}</td>
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
                    <div class="table-responsive" style="width: 60%">
                        <table class="table table-sm" style="margin-top: 2%">
                            <tbody>
                            <tr>
                                <td></td>
                                <td style="font-weight: bold">Operation Time</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Days</td>
                                <td style="font-weight: bold">Open</td>
                                <td style="font-weight: bold">Close</td>
                            </tr>
                            @foreach ($operation as $item)
                            <tr>
                                <td>{!!$item->days!!}</td>
                                <td>{!!Str::beforeLast($item->open, ':')!!}</td>
                                <td>{!!Str::beforeLast($item->close, ':')!!}</td>
                            </tr>
                            @endforeach
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