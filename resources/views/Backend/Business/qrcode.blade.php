<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<style>
		#frame {
			position: relative;
			margin-top: -75%;
			margin-left: -50%;
		}

        #button-save {
            position: absolute;
            top: 0;
        }
	</style>

    <title>Generate QR Code</title>
  </head>
  <body>
    <div class="section" id="section" style="width: 100%; height: 100vh;">
    	<div class="container qrcode text-center">
				<div class="row justify-content-around">
					@foreach ($business as $d)
					<div class="col-md-3">
						<div id="qrcode{!!$d->id!!}"></div>
						<img src="{{asset('assets/img/QRframe-01.png')}}" height="300" width="220" alt="" id="frame">
					</div>
					@endforeach
				</div>
    	</div>
	</div>
	<div class="save" id="button-save">
		<button type="button" class="btn btn-primary" id="tosave">Download</button>
		<a class="btn btn-secondary" href="/dapur/business" role="button">Back</a>
	</div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	{!! Html::script('assets/vendor/qrcode/easy-qrcode.js') !!}
	<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>


	@foreach ($business as $i)

	<script>
	function showQr() {
	    new QRCode(document.getElementById("qrcode{!! $i->id !!}"), {
	        text : window.location.origin + "/qrcode/"+ {!! $i->id !!},
	        width: 130,
	        height: 130,
	        colorDark: "#000000",
	        colorLight: "#ffffff",

	        title: "{!! $i->owner !!}",
	        titleFont: "bold 14px Arial",
	        titleColor: "#004284",
	        titleBgColor: "#fff",
	        titleHeight: 67,

	        subTitle: "{!! $i->name !!}",
	        subTitleFont: "14px Arial",
	        subTitleColor: "#004284",

	        // logo:"logo-transparent.png", // LOGO
	        logo:"{{ asset('assets/img/logo-kabupaten-tegal.png') }}",
	        logoWidth:35, //
	        logoHeight:45,
	        logoBgColor:'#ffffff', // Logo backgroud color, Invalid when `logBgTransparent` is true; default is '#ffff

	        correctLevel: QRCode.CorrectLevel.H
	    });
	}
	showQr();
	</script>

	@endforeach

	<script>
		$('#tosave').click(function() {

			// var element = document.getElementById("qrcode{!!$i->id!!}");
			var element = document.getElementById("section");

			html2canvas(element).then(function(canvas) {

				var base64image = canvas.toDataURL("image/jpg");

				// var downloadLink = document.createElement("a");
				// downloadLink.href = base64image;
				// downloadLink.download = "{!!$i->name!!}.jpeg";
				// document.body.appendChild(downloadLink);
				// downloadLink.click();
				// document.body.removeChild(downloadLink);

				const doc = new jsPDF({
				orientation: "landscape"
				});

				doc.addImage(base64image, "JPEG", -22, -10, 370, 210);
				doc.save("cek.pdf");
			});


		});
	</script>
	

  </body>
</html>
