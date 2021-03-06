<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

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
        background-color: #ffa502
      }
      .baik {
        background-color: #2ed573;
      }
      .sangatbaik {
        background-color: #1e90ff;
      }
    </style>

    <title>Form Pengaduan</title>
  </head>
  <body>
    {{-- <div class="jumbotron jumbotron-fluid" style="background-image: url('{{asset('assets/img/header-preview.jpg')}}'); background-repeat: no-repeat; height: auto; background-size: cover;">
      <div class="container">
        <h1 class="display-4">Fluid jumbotron</h1>
        <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
      </div>
    </div> --}}
    <img src="{{asset('assets/img/header-lapor-01.jpg')}}" style="width: 100%; height: auto;">
    <div class="container" style="margin-top: 5%;">
      <p style="font-weight: 700">Bagaimana menurut anda tentang penerapan protokol kesehatan pada usaha ini?</p>
    	<form action="/sent-report" method="POST">
        {{ csrf_field() }}
              <input type="text" class="form-control" name="id" value="{!! $data->id !!}" style="visibility: hidden; margin-top: -5%;">
              <input type="text" class="form-control" name="ip" id="ip" style="visibility: hidden; margin-top: -10%;">
              <div class="form-group text-center">
                <input id="star" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="1">
                <span class="badge badge-pill" id="nilai">Nilai Anda</span>
              </div>
              <div class="form-group" style="visibility: hidden; margin-top: -5%;">
                <input type="text" class="form-control" name="about" id="setvalue">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Keterangan</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
              </div>
			<button class="btn btn-block" type="submit" style="margin-top: 5%; margin-bottom: 10%; background-color: #5a61c1; color: #fff; height: 50px; font-size: 18px;">Kirim</button>
		</form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js" type="text/javascript"></script>

    <script>
      $("#star").rating({
        showCaption : false,
        showClear : false,
        size : 'lg',
      });

      $('#star').on('rating:change', function(event, value) {
        //   console.log(value);
          if(value == 1){
            document.getElementById("setvalue").value = "SANGAT BURUK" ;
            $("#nilai").html("SANGAT BURUK");
            $("#nilai").addClass("sangatjelek");
            $("#nilai").removeClass("jelek");
            $("#nilai").removeClass("cukup");
            $("#nilai").removeClass("baik");
            $("#nilai").removeClass("sangatbaik");
          }else if(value == 2){
            document.getElementById("setvalue").value = "BURUK" ;
            $("#nilai").html("BURUK");
            $("#nilai").addClass("jelek");
            $("#nilai").removeClass("sangatjelek");
            $("#nilai").removeClass("cukup");
            $("#nilai").removeClass("baik");
            $("#nilai").removeClass("sangatbaik");
          }else if(value == 3){
            document.getElementById("setvalue").value = "CUKUP BAIK" ;
            $("#nilai").html("CUKUP BAIK");
            $("#nilai").addClass("cukup");
            $("#nilai").removeClass("sangatjelek");
            $("#nilai").removeClass("jelek");
            $("#nilai").removeClass("baik");
            $("#nilai").removeClass("sangatbaik");
          }else if(value == 4){
            document.getElementById("setvalue").value = "BAIK" ;
            $("#nilai").html("BAIK");
            $("#nilai").addClass("baik");
            $("#nilai").removeClass("sangatjelek");
            $("#nilai").removeClass("jelek");
            $("#nilai").removeClass("cukup");
            $("#nilai").removeClass("sangatbaik");
          }else{
            document.getElementById("setvalue").value = "SANGAT BAIK" ;
            $("#nilai").html("SANGAT BAIK");
            $("#nilai").addClass("sangatbaik");
            $("#nilai").removeClass("sangatjelek");
            $("#nilai").removeClass("jelek");
            $("#nilai").removeClass("cukup");
            $("#nilai").removeClass("baik");
          }
      });
    </script>

    <script>
        function getIP(json) {
            // console.log("My public IP address is: ", json.ip);
            document.getElementById("ip").value = json.ip;
        }
    </script>

    <script src="https://api.ipify.org?format=jsonp&callback=getIP"></script>

  </body>
</html>
