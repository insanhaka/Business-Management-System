@extends('Backend.Layout.app')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet">
<style>
    .select-formhide {
        display: none;
    }
    .select-formshow {
        display: flex;
    }
</style>
<style>
    /*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 90%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 7px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9;
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important;
  color: #ffffff;
}
</style>
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid" style="margin-top: 3%; margin-bottom: 6%;">

    <div class="card">
        <div class="card-header">
          <h2 class="text-primary">Tambah Data Usaha</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="/dapur/business/create" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="container" style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NIK Pemilik</label>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="Owner NIK">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Pemilik</label>
                                <input type="text" class="form-control" id="owner" name="owner" placeholder="Business owner name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Usaha</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Business name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Status Verifikasi</label>
                                <select class="form-control" name="status">
                                    <option value="">-- Select Status --</option>
                                    <option value="verif">Verify</option>
                                    <option value="notverif">Not Verify</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Ikut Dalam Kelompok/Paguyuban ?</label>
                                <select class="form-control" name="community" id="menu-type" onchange="statuskelompok()">
                                    <option value="">-- Select --</option>
                                    <option value="kelompok">Ya</option>
                                    <option value="individu">Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row select-formhide" id="select_parent">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Kelompok/Paguyuban</label>
                                <select class="form-control" name="community_id">
                                    <option value="">-- Select --</option>
                                    @foreach ($community as $item)
                                    <option value="{!! $item->id !!}">{!! $item->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Jenis Usaha</label>
                                <select class="form-control" name="business_sectors_id">
                                    <option value="">-- Select Business Sector --</option>
                                    @foreach ($sector as $data)
                                    <option value="{!!$data->id!!}">{!! $data->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Kategori Usaha</label>
                                <select class="form-control" name="business_category_id">
                                    <option value="">-- Select Business Category --</option>
                                    @foreach ($category as $data)
                                    <option value="{!!$data->id!!}">{!! $data->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">No. Telfon</label>
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="Exp : 0877xxxxxxxx">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat Usaha ( Provinsi )</label>
                                <select class="form-control" id="province" name="loc_province">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat Usaha ( Kabupaten/Kota )</label>
                                <select class="form-control" id="regency" name="loc_regency">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat Usaha ( Kecamatan )</label>
                                <select class="form-control" id="district" name="loc_district">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat Usaha ( Desa )</label>
                                <select class="form-control" id="village" name="loc_village">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Details alamat Usaha</label>
                                <input type="text" class="form-control" id="address" name="loc_address" placeholder="Details business address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInput">Upload Gambar Usaha</label>
                                <div class="tower-file">
                                    <input type="file" name="photo" id="demoInput5" />
                                    <label for="demoInput5" class="btn btn-primary">
                                        <span class="mdi mdi-upload"></span>Select Files
                                    </label>
                                    <button type="button" class="tower-file-clear btn btn-secondary align-top">
                                        Clear
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Usaha ini Aktiv?</label>
                                <select class="form-control" name="is_active">
                                    <option value="">-- Select --</option>
                                    <option value="1">Ya</option>
                                    <option value="0">Belum</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="float: right; margin-top: 20px;">
                                <input class="btn btn-primary" type="submit" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
    $('#demoInput5').fileInput({
        iconClass: 'mdi mdi-fw mdi-upload'
    });
</script>

<script>
    //Script Hide or Show Select Menu Community
    function statuskelompok() {
        var i = document.getElementById("menu-type").value;
        // console.log(i);
        if(i === "kelompok"){
            $('#select_parent').removeClass("select-formhide");
            $('#select_parent').addClass("select-formshow");
        }else {
            $('#select_parent').removeClass("select-formshow");
            $('#select_parent').addClass("select-formhide");
        }
    }
</script>

<script>
    $(document).ready(function() {

        const url = '/provinsi-kota-kecamatan-kelurahan.json';

        let prov = $('#province');
            prov.empty();
            prov.append('<option disabled>-- Select Province --</option>');
            prov.prop('selectedIndex', 0);
        let reg = $('#regency');
            reg.empty();
            reg.append('<option disabled>-- Select Regency --</option>');
            reg.prop('selectedIndex', 0);
        let dist = $('#district');
            dist.empty();
            dist.append('<option disabled>-- Select District --</option>');
            dist.prop('selectedIndex', 0);
        let vill = $('#village');
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

        // Populate dropdown with list of provinces
        $.getJSON(url, function (data) {
            $.each(data, function (province, entry) {
                prov.append($('<option></option>').attr('value', province).text(province));
            })
        });

        //select province collect regency
        $('#province').on('change', function() {
            var provselected = this.value;
            localStorage.setItem('provselected', this.value);
            //refresh regency
            reg.empty();
            reg.append('<option disabled>-- Select Regency --</option>');
            reg.prop('selectedIndex', 0);
            //refresh District
            dist.empty();
            dist.append('<option disabled>-- Select District --</option>');
            dist.prop('selectedIndex', 0);
            //refresh Village
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

            $.getJSON(url, function (data) {
                $.each(data[provselected], function (regency, entry) {
                    reg.append($('<option></option>').attr('value', regency).text(regency));
                })
            });
        });

        //select regency collect district
        $('#regency').on('change', function() {
            var regselected = this.value;
            localStorage.setItem('regselected', this.value);
            var provselected = localStorage.getItem('provselected');
            //refresh District
            dist.empty();
            dist.append('<option disabled>-- Select District --</option>');
            dist.prop('selectedIndex', 0);
            //refresh Village
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

            $.getJSON(url, function (data) {
                $.each(data[provselected][regselected], function (district, entry) {
                    dist.append($('<option></option>').attr('value', district).text(district));
                })
            });
        });

        //select district collect village
        $('#district').on('change', function() {
            var distselected = this.value;
            localStorage.setItem('distselected', this.value);
            var provselected = localStorage.getItem('provselected');
            var regselected = localStorage.getItem('regselected');
            //refresh Village
            vill.empty();
            vill.append('<option disabled>-- Select Village --</option>');
            vill.prop('selectedIndex', 0);

            $.getJSON(url, function (data) {
                $.each(data[provselected][regselected][distselected], function (village, entry) {
                    vill.append($('<option></option>').attr('value', entry).text(entry));
                })
            });
        });

    });
</script>

<script>
    function autocomplete(inp, arr) {
      /*the autocomplete function takes two arguments,
      the text field element and an array of possible autocompleted values:*/
      var currentFocus;
      /*execute a function when someone writes in the text field:*/
      inp.addEventListener("input", function(e) {
          var a, b, i, val = this.value;
          /*close any already open lists of autocompleted values*/
          closeAllLists();
          if (!val) { return false;}
          currentFocus = -1;
          /*create a DIV element that will contain the items (values):*/
          a = document.createElement("DIV");
          a.setAttribute("id", this.id + "autocomplete-list");
          a.setAttribute("class", "autocomplete-items");
          /*append the DIV element as a child of the autocomplete container:*/
          this.parentNode.appendChild(a);
          /*for each item in the array...*/
          for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
              /*create a DIV element for each matching element:*/
              b = document.createElement("DIV");
              /*make the matching letters bold:*/
              b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
              b.innerHTML += arr[i].substr(val.length);
              /*insert a input field that will hold the current array item's value:*/
              b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
              /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
                  /*insert the value for the autocomplete text field:*/
                  inp.value = this.getElementsByTagName("input")[0].value;
                  /*close the list of autocompleted values,
                  (or any other open lists of autocompleted values:*/
                  closeAllLists();
              });
              a.appendChild(b);
            }
          }
      });
      /*execute a function presses a key on the keyboard:*/
      inp.addEventListener("keydown", function(e) {
          var x = document.getElementById(this.id + "autocomplete-list");
          if (x) x = x.getElementsByTagName("div");
          if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
          } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
          } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
              /*and simulate a click on the "active" item:*/
              if (x) x[currentFocus].click();
            }
          }
      });
      function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
      }
      function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
          x[i].classList.remove("autocomplete-active");
        }
      }
      function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
          if (elmnt != x[i] && elmnt != inp) {
            x[i].parentNode.removeChild(x[i]);
          }
        }
      }
      /*execute a function when someone clicks in the document:*/
      document.addEventListener("click", function (e) {
          closeAllLists(e.target);
      });
    }

    // GET data owner by API
    axios.get('/api/data-owner')
    .then(function (response) {
        // handle success
        var owner = response.data.data;
        var nik = owner.map((item) => String(item.nik));
        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("nik"), nik);
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });

</script>

<script>
    $( "#owner" ).click(function() {
        var getnik = document.getElementById("nik").value;
        // GET data owner by API
        axios.get('/api/data-owner')
        .then(function (response) {
            // handle success
            var dataowner = response.data.data;
            for (let i = 0; i < dataowner.length; i++) {

                if (dataowner[i].nik == getnik) {
                    document.getElementById("owner").value = dataowner[i].name;
                }

            }
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
    });
</script>

@endsection
