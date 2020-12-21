@extends('Backend.Layout.app')

@section('css')
<style>
    .opsButtonBusiness-hide {
        display: none;
    }
    .opsButtonBusiness-show {
        display: flex;
    }
</style>
<style>
    .opsButtonOwner-hide {
        display: none;
    }
    .opsButtonOwner-show {
        display: flex;
    }
</style>
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
                    <table class="table table-striped table-sm table-bordered display responsive nowrap" style="width:100%" id="owner-tableserverside">
                        <thead class="bg-primary" style="color: #ffff;">
                            <tr>
                                {{-- <th style="text-align: center;"><input type="checkbox" aria-label="Checkbox for following text input"></th> --}}
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
                            {{-- DATA TABLES SERVERSIDE --}}
                        </tbody>
                    </table>
                    <div class="row opsButtonOwner-hide" style="margin-top: 3%;" id="opsButtonOwner">
                        <div class="col-md-12" style="padding-bottom: 1%;">
                            <input class="btn btn-danger" type="button" value="Hapus Yang Terpilih" id="delete-all">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table id="business-tableserverside" class="table table-striped table-sm table-bordered display responsive nowrap" style="width:100%">
                        <thead class="bg-primary" style="color: #ffff;">
                            <tr>
                                {{-- <th style="text-align: center;"><input type="checkbox" aria-label="Checkbox for following text input"></th> --}}
                                <th>Nama</th>
                                <th>Pemilik</th>
                                <th>Alamat</th>
                                <th>Paguyuban</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- DATA TABLES SERVERSIDE --}}
                        </tbody>
                    </table>
                    <div class="row opsButtonBusiness-hide" style="margin-top: 3%;" id="opsButtonBusiness">
                        <div class="col-md-12" style="padding-bottom: 1%;">
                            <input class="btn btn-success" type="button" value="Generate QRcode" id="generate">
                        </div>
                    </div>
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

<script type="text/javascript">
    $(document).ready(function() {
        var events = $('#events');
        var tableowner = $('#owner-tableserverside').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "paginate": {
                "previous": "&lt",
                "next": "&gt"
                }
            },
            ajax: "{!!url('/dapur')!!}" + "/business/owner/getdataowner-serverside",
            select: {
                style: 'multi'
            },
            order: [
                [0, 'asc']
            ],
            columns: [
                // {data: 'checkbox',name: 'checkbox', searchable: false, orderable: false},
                {data: 'name',name: 'name'},
                {data: 'nik',name: 'nik'},
                {data: 'ktp_addr',name: 'ktp_addr'},
                {data: 'dom_addr',name: 'dom_addr'},
                {data: 'prokes', name: 'prokes'},
                {data: 'details', name: 'details'},
                {data: 'action',name: 'action'},
            ]
        });

        var idSelected = [];
        var idDeselected = [];

        tableowner
        .on( 'select', function ( e, dt, type, indexes ) {
            var rowData = tableowner.rows( indexes ).data();
            idSelected.push(rowData[0].id);
            if (idSelected.length > 0) {
                $('#opsButtonOwner').removeClass("opsButtonOwner-hide");
                $('#opsButtonOwner').addClass("opsButtonOwner-show");
            }
        })
        .on( 'deselect', function ( e, dt, type, indexes ) {
            var rowData = tableowner.rows( indexes ).data();
            idDeselected.push(rowData[0].id);
            if (idSelected.length - idDeselected.length == 0) {
                $('#opsButtonOwner').removeClass("opsButtonOwner-show");
                $('#opsButtonOwner').addClass("opsButtonOwner-hide");
            }
        } );

        // Handle form submission event
        $('#delete-all').on('click', function(){
            var getdata = tableowner.rows( { selected: true } ).data().toArray();
            // var id = getdata[0].id;
            var dataID = [];
            for (let i = 0; i < getdata.length; i++) {
                const id = getdata[i].id;
                dataID.push(id);
            }
            window.location.href = '/dapur/business/owner/delete-all/'+dataID+'';
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var events = $('#events');
        var tablebusiness = $('#business-tableserverside').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "paginate": {
                "previous": "&lt",
                "next": "&gt"
                }
            },
            ajax: "{!!url('/dapur')!!}" + "/business/getdatabusiness-serverside",
            select: {
                style: 'multi'
            },
            order: [
                [1, 'asc']
            ],
            columns: [
                // {data: 'checkbox',name: 'checkbox', searchable: false, orderable: false},
                {data: 'name',name: 'name'},
                {data: 'owner',name: 'owner'},
                {data: 'loc_addr',name: 'loc_addr'},
                {data: 'community',name: 'community'},
                {data: 'status', name: 'status'},
                {data: 'details', name: 'details'},
                {data: 'action',name: 'action'},
            ]
        });

        var idSelected = [];
        var idDeselected = [];

        tablebusiness
        .on( 'select', function ( e, dt, type, indexes ) {
            var rowData = tablebusiness.rows( indexes ).data();
            idSelected.push(rowData[0].id);
            if (idSelected.length > 0) {
                $('#opsButtonBusiness').removeClass("opsButtonBusiness-hide");
                $('#opsButtonBusiness').addClass("opsButtonBusiness-show");
            }
        })
        .on( 'deselect', function ( e, dt, type, indexes ) {
            var rowData = tablebusiness.rows( indexes ).data();
            idDeselected.push(rowData[0].id);
            if (idSelected.length - idDeselected.length == 0) {
                $('#opsButtonBusiness').removeClass("opsButtonBusiness-show");
                $('#opsButtonBusiness').addClass("opsButtonBusiness-hide");
            }
        } );

        // Handle form submission event
        $('#generate').on('click', function(){
            var getdata = tablebusiness.rows( { selected: true } ).data().toArray();
            // var id = getdata[0].id;
            var dataID = [];
            for (let i = 0; i < getdata.length; i++) {
                const id = getdata[i].id;
                dataID.push(id);
            }

            if (dataID.length > 8) {
                bootbox.alert("Maaf Saat Ini Generate QRCode Hanya Bisa Memilih Maksimal 8 saja");
            }else {
                window.location.href = '/dapur/business/generate-qrcode/'+dataID+'';
            }

        });

    });
</script>

@endsection
