<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >

    <!-- star rating css styles -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />

    <style>
      .sangatjelek {
        background-color: #ff4757;
      }
      .jelek {
        background-color: #ff6348;
      }
      .cukup {
        background-color: #ffa502;
      }
      .baik {
        background-color: #2ed573;
      }
      .sangatbaik {
        background-color: #1e90ff;
      }
    </style>

    <title>Business Preview</title>
  </head>
  <body>
    {{-- <div class="jumbotron jumbotron-fluid" style="background-image: url('{{asset('assets/img/header-preview.jpg')}}'); background-repeat: no-repeat; height: auto; background-size: cover;">
      <div class="container">
        <h1 class="display-4">Fluid jumbotron</h1>
        <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
      </div>
    </div> --}}
    @if ($data->is_active == 1)
        @if ($data->photo == null)
        <img src="{{asset('business_photo/default-image.jpg')}}" style="width: 100%; height: auto;">
        @else
        <img src="{{asset('business_photo/'.$data->photo)}}" style="width: 100%; height: auto;">
        @endif
        <div class="container">
            <div class="row" style="padding-left: 3%; background-color: #f1f2f6; padding-top: 4%; padding-bottom: 4%;">
                <div class="col-3 text-center"><img src="{{asset('assets/img/protection.png')}}" style="width: 75px;"></div>
                <div class="col-8">Usaha ini telah menyetujui untuk melaksanakan protokol kesehatan <br> yang telah ditetapkan Pemerintah Kabupaten Tegal</div>
            </div>
            <br>
            <p class="text-center" style="font-size: 20px; font-weight: bold;">{!! $data->business_name !!}</p>
            <div class="row justify-content-center" style="margin-top: -3%;">
              <div class="form-group text-center">
                <input id="star" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" data-size="sm" style="margin-top: 50px;">
                <span class="badge badge-pill" id="nilai">3.5</span>
              </div>
            </div>
            <hr>
            <p style="margin-bottom: 5%">Nama pemilik :</p>
            <div class="row" style="margin-top: -3%;">
                <div class="col-1"><img src="{{asset('assets/img/user.png')}}" style="width: 20px;"></div>
                <div class="col-10"><b>{!! $data->name !!}</b></div>
            </div>
            <hr>
            <p style="margin-bottom: 5%">Lokasi jualan :</p>
            <div class="row" style="margin-top: -3%;">
                <div class="col-1"><img src="{{asset('assets/img/pin.png')}}" style="width: 20px;"></div>
                <div class="col-10"><b>{!! $data->loc_address !!}</b></div>
            </div>
            <hr>
            <p style="margin-bottom: 5%">Jam Operasional :</p>
            <div class="row" style="margin-top: -3%;">
                <div class="col-1"><img src="{{asset('assets/img/open.png')}}" style="width: 20px;"></div>
                <div class="col-10"><b>{!! $data->mulai_jual !!} - {!! $data->selesai_jual !!}</b></div>
            </div>
            <hr>
            <p style="margin-bottom: 5%">Pesan Disini :</p>
            <div class="row" style="margin-top: -3%;">
                <div class="col-1"><img src="{{asset('assets/img/phone.png')}}" style="width: 20px;"></div>
                <div class="col-10"><b>{!! $data->contact !!}</b></div>
            </div>
            <hr>
            {{-- <p>Penilaian masyarakat terhadap usaha ini  :</p>
            <div class="row justify-content-center" style="margin-top: -3%;">
              <div class="form-group text-center">
                <input id="star" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" data-size="sm" style="margin-top: 50px;">
                <span class="badge badge-pill" id="nilai">3.5</span>
              </div>
            </div>
            <hr> --}}

            <div class="lapor text-center">
                <a class="btn btn-block btn-lg" href="/laporan/{!!$data->id!!}" role="button" style="margin-top: 1%; margin-bottom: 10%; background-color: #5a61c1; color: #fff;">Beri Penilaian</a>
            </div>
        </div>
    @else
        <img src="{{asset('assets/img/404-01.jpg')}}" style="width: 100%; height: auto;">
    @endif

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" ></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js" type="text/javascript"></script>

    <script>
      $("#star").rating({
        displayOnly: true,
        showCaption : false,
        showClear : false,
        size : 'lg',
      });

      $('#star').rating('update', '{!! $rating !!}');
      $("#nilai").html('{!! $rating !!}');
    </script>
  </body>
</html>
