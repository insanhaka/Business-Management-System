    $(document).ready(function(){

        var d = new Date();
        var months = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        var bulan1 = months[d.getMonth()-5];
        var bulan2 = months[d.getMonth()-4];
        var bulan3 = months[d.getMonth()-3];
        var bulan4 = months[d.getMonth()-2];
        var bulan5 = months[d.getMonth()-1];
        var bulan6 = months[d.getMonth()];

        var cat_nilai = [1,2,3,4,5];
        var sangat_buruk = cat_nilai[0];
        var buruk = cat_nilai[1];
        var cukup_baik = cat_nilai[2];
        var baik = cat_nilai[3];
        var sangat_baik = cat_nilai[4];

        var report1_sangat_baik = {};
        var report2_sangat_baik = {};
        var report3_sangat_baik = {};
        var report4_sangat_baik = {};
        var report5_sangat_baik = {};
        var report6_sangat_baik = {};

        var report1_baik = {};
        var report2_baik = {};
        var report3_baik = {};
        var report4_baik = {};
        var report5_baik = {};
        var report6_baik = {};

        var report1_cukup_baik = {};
        var report2_cukup_baik = {};
        var report3_cukup_baik = {};
        var report4_cukup_baik = {};
        var report5_cukup_baik = {};
        var report6_cukup_baik = {};

        var report1_buruk = {};
        var report2_buruk = {};
        var report3_buruk = {};
        var report4_buruk = {};
        var report5_buruk = {};
        var report6_buruk = {};

        var report1_sangat_buruk = {};
        var report2_sangat_buruk = {};
        var report3_sangat_buruk = {};
        var report4_sangat_buruk = {};
        var report5_sangat_buruk = {};
        var report6_sangat_buruk = {};
        // Make a request
        axios.get('/api/data-report')
        .then(function (response) {
            var res = response.data['data'];

            for(var i = 0; i < res.length; i++){
                var rating = res[i].rating;

                if(rating == sangat_buruk){
                    var data_sangat_buruk = res[i].created_at;
                    var getdate = new Date(data_sangat_buruk);
                    var mon = months[getdate.getMonth()]
                    // console.log(mon);
                    if( mon == bulan1){
                        report1_sangat_buruk[mon] = report1_sangat_buruk[mon] ? report1_sangat_buruk[mon] + 1 : 1;
                    }else if(mon == bulan2){
                        report2_sangat_buruk[mon] = report2_sangat_buruk[mon] ? report2_sangat_buruk[mon] + 1 : 1;
                    }else if(mon == bulan3){
                        report3_sangat_buruk[mon] = report3_sangat_buruk[mon] ? report3_sangat_buruk[mon] + 1 : 1;
                    }else if(mon == bulan4){
                        report4_sangat_buruk[mon] = report4_sangat_buruk[mon] ? report4_sangat_buruk[mon] + 1 : 1;
                    }else if(mon == bulan5){
                        report5_sangat_buruk[mon] = report5_sangat_buruk[mon] ? report5_sangat_buruk[mon] + 1 : 1;
                    }else{
                        report6_sangat_buruk[mon] = report6_sangat_buruk[mon] ? report6_sangat_buruk[mon] + 1 : 1;
                    }
                }else if(rating == buruk){
                    var data_buruk = res[i].created_at;
                    var getdate = new Date(data_buruk);
                    var mon = months[getdate.getMonth()]
                    // console.log(mon);
                    if( mon == bulan1){
                        report1_buruk[mon] = report1_buruk[mon] ? report1_buruk[mon] + 1 : 1;
                    }else if(mon == bulan2){
                        report2_buruk[mon] = report2_buruk[mon] ? report2_buruk[mon] + 1 : 1;
                    }else if(mon == bulan3){
                        report3_buruk[mon] = report3_buruk[mon] ? report3_buruk[mon] + 1 : 1;
                    }else if(mon == bulan4){
                        report4_buruk[mon] = report4_buruk[mon] ? report4_buruk[mon] + 1 : 1;
                    }else if(mon == bulan5){
                        report5_buruk[mon] = report5_buruk[mon] ? report5_buruk[mon] + 1 : 1;
                    }else{
                        report6_buruk[mon] = report6_buruk[mon] ? report6_buruk[mon] + 1 : 1;
                    }
                }else if(rating == cukup_baik){
                    var data_cukup_baik = res[i].created_at;
                    var getdate = new Date(data_cukup_baik);
                    var mon = months[getdate.getMonth()]
                    // console.log(mon);
                    if( mon == bulan1){
                        report1_cukup_baik[mon] = report1_cukup_baik[mon] ? report1_cukup_baik[mon] + 1 : 1;
                    }else if(mon == bulan2){
                        report2_cukup_baik[mon] = report2_cukup_baik[mon] ? report2_cukup_baik[mon] + 1 : 1;
                    }else if(mon == bulan3){
                        report3_cukup_baik[mon] = report3_cukup_baik[mon] ? report3_cukup_baik[mon] + 1 : 1;
                    }else if(mon == bulan4){
                        report4_cukup_baik[mon] = report4_cukup_baik[mon] ? report4_cukup_baik[mon] + 1 : 1;
                    }else if(mon == bulan5){
                        report5_cukup_baik[mon] = report5_cukup_baik[mon] ? report5_cukup_baik[mon] + 1 : 1;
                    }else{
                        report6_cukup_baik[mon] = report6_cukup_baik[mon] ? report6_cukup_baik[mon] + 1 : 1;
                    }
                }else if(rating == baik){
                    var data_baik = res[i].created_at;
                    var getdate = new Date(data_baik);
                    var mon = months[getdate.getMonth()]
                    // console.log(mon);
                    if( mon == bulan1){
                        report1_baik[mon] = report1_baik[mon] ? report1_baik[mon] + 1 : 1;
                    }else if(mon == bulan2){
                        report2_baik[mon] = report2_baik[mon] ? report2_baik[mon] + 1 : 1;
                    }else if(mon == bulan3){
                        report3_baik[mon] = report3_baik[mon] ? report3_baik[mon] + 1 : 1;
                    }else if(mon == bulan4){
                        report4_baik[mon] = report4_baik[mon] ? report4_baik[mon] + 1 : 1;
                    }else if(mon == bulan5){
                        report5_baik[mon] = report5_baik[mon] ? report5_baik[mon] + 1 : 1;
                    }else{
                        report6_baik[mon] = report6_baik[mon] ? report6_baik[mon] + 1 : 1;
                    }
                }else {
                    var data_sangat_baik = res[i].created_at;
                    // console.log(data_sangat_baik);
                    var getdate = new Date(data_sangat_baik);
                    var mon = months[getdate.getMonth()]
                    // console.log(mon);
                    if( mon == bulan1){
                        report1_sangat_baik[mon] = report1_sangat_baik[mon] ? report1_sangat_baik[mon] + 1 : 1;
                    }else if(mon == bulan2){
                        report2_sangat_baik[mon] = report2_sangat_baik[mon] ? report2_sangat_baik[mon] + 1 : 1;
                    }else if(mon == bulan3){
                        report3_sangat_baik[mon] = report3_sangat_baik[mon] ? report3_sangat_baik[mon] + 1 : 1;
                    }else if(mon == bulan4){
                        report4_sangat_baik[mon] = report4_sangat_baik[mon] ? report4_sangat_baik[mon] + 1 : 1;
                    }else if(mon == bulan5){
                        report5_sangat_baik[mon] = report5_sangat_baik[mon] ? report5_sangat_baik[mon] + 1 : 1;
                    }else{
                        report6_sangat_baik[mon] = report6_sangat_baik[mon] ? report6_sangat_baik[mon] + 1 : 1;
                    }
                }

            }

            var databulan1_sangat_buruk = 0;
            for (var tambah of Object.values(report1_sangat_buruk)){
                databulan1_sangat_buruk += tambah;
            }
            var databulan2_sangat_buruk = 0;
            for (var tambah of Object.values(report2_sangat_buruk)){
                databulan2_sangat_buruk += tambah;
            }
            var databulan3_sangat_buruk = 0;
            for (var tambah of Object.values(report3_sangat_buruk)){
                databulan3_sangat_buruk += tambah;
            }
            var databulan4_sangat_buruk = 0;
            for (var tambah of Object.values(report4_sangat_buruk)){
                databulan4_sangat_buruk += tambah;
            }
            var databulan5_sangat_buruk = 0;
            for (var tambah of Object.values(report5_sangat_buruk)){
                databulan5_sangat_buruk += tambah;
            }
            var databulan6_sangat_buruk = 0;
            for (var tambah of Object.values(report6_sangat_buruk)){
                databulan6_sangat_buruk += tambah;
            }

            var databulan1_buruk = 0;
            for (var tambah of Object.values(report1_buruk)){
                databulan1_buruk += tambah;
            }
            var databulan2_buruk = 0;
            for (var tambah of Object.values(report2_buruk)){
                databulan2_buruk += tambah;
            }
            var databulan3_buruk = 0;
            for (var tambah of Object.values(report3_buruk)){
                databulan3_buruk += tambah;
            }
            var databulan4_buruk = 0;
            for (var tambah of Object.values(report4_buruk)){
                databulan4_buruk += tambah;
            }
            var databulan5_buruk = 0;
            for (var tambah of Object.values(report5_buruk)){
                databulan5_buruk += tambah;
            }
            var databulan6_buruk = 0;
            for (var tambah of Object.values(report6_buruk)){
                databulan6_buruk += tambah;
            }

            var databulan1_cukup_baik = 0;
            for (var tambah of Object.values(report1_cukup_baik)){
                databulan1_cukup_baik += tambah;
            }
            var databulan2_cukup_baik = 0;
            for (var tambah of Object.values(report2_cukup_baik)){
                databulan2_cukup_baik += tambah;
            }
            var databulan3_cukup_baik = 0;
            for (var tambah of Object.values(report3_cukup_baik)){
                databulan3_cukup_baik += tambah;
            }
            var databulan4_cukup_baik = 0;
            for (var tambah of Object.values(report4_cukup_baik)){
                databulan4_cukup_baik += tambah;
            }
            var databulan5_cukup_baik = 0;
            for (var tambah of Object.values(report5_cukup_baik)){
                databulan5_cukup_baik += tambah;
            }
            var databulan6_cukup_baik = 0;
            for (var tambah of Object.values(report6_cukup_baik)){
                databulan6_cukup_baik += tambah;
            }

            var databulan1_baik = 0;
            for (var tambah of Object.values(report1_baik)){
                databulan1_baik += tambah;
            }
            var databulan2_baik = 0;
            for (var tambah of Object.values(report2_baik)){
                databulan2_baik += tambah;
            }
            var databulan3_baik = 0;
            for (var tambah of Object.values(report3_baik)){
                databulan3_baik += tambah;
            }
            var databulan4_baik = 0;
            for (var tambah of Object.values(report4_baik)){
                databulan4_baik += tambah;
            }
            var databulan5_baik = 0;
            for (var tambah of Object.values(report5_baik)){
                databulan5_baik += tambah;
            }
            var databulan6_baik = 0;
            for (var tambah of Object.values(report6_baik)){
                databulan6_baik += tambah;
            }

            var databulan1_sangat_baik = 0;
            for (var tambah of Object.values(report1_sangat_baik)){
                databulan1_sangat_baik += tambah;
            }
            var databulan2_sangat_baik = 0;
            for (var tambah of Object.values(report2_sangat_baik)){
                databulan2_sangat_baik += tambah;
            }
            var databulan3_sangat_baik = 0;
            for (var tambah of Object.values(report3_sangat_baik)){
                databulan3_sangat_baik += tambah;
            }
            var databulan4_sangat_baik = 0;
            for (var tambah of Object.values(report4_sangat_baik)){
                databulan4_sangat_baik += tambah;
            }
            var databulan5_sangat_baik = 0;
            for (var tambah of Object.values(report5_sangat_baik)){
                databulan5_sangat_baik += tambah;
            }
            var databulan6_sangat_baik = 0;
            for (var tambah of Object.values(report6_sangat_baik)){
                databulan6_sangat_baik += tambah;
            }

            Highcharts.chart('hightchart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Grafik Laporan Masyarakat'
                },
                subtitle: {
                    text: 'Total laporan perbulan berdasarkan nilai '
                },
                xAxis: {
                    categories: [
                    bulan1,
                    bulan2,
                    bulan3,
                    bulan4,
                    bulan5,
                    bulan6
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Laporan'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.f} Laporan</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Sangat buruk',
                    data: [databulan1_sangat_buruk, databulan2_sangat_buruk, databulan3_sangat_buruk, databulan4_sangat_buruk, databulan5_sangat_buruk, databulan6_sangat_buruk],
                    color: '#ff7979',
                }, {
                    name: 'Buruk',
                    data: [databulan1_buruk, databulan2_buruk, databulan3_buruk, databulan4_buruk, databulan5_buruk, databulan6_buruk],
                    color: '#ffbe76',
                }, {
                    name: 'Cukup Baik',
                    data: [databulan1_cukup_baik, databulan2_cukup_baik, databulan3_cukup_baik, databulan4_cukup_baik, databulan5_cukup_baik, databulan6_cukup_baik],
                    color: '#badc58',
                }, {
                    name: 'Baik',
                    data: [databulan1_baik, databulan2_baik, databulan3_baik, databulan4_baik, databulan5_baik, databulan6_baik],
                    color: '#7ed6df',
                },{
                    name: 'Sangat Baik',
                    data: [databulan1_sangat_baik, databulan2_sangat_baik, databulan3_sangat_baik, databulan4_sangat_baik, databulan5_sangat_baik, databulan6_sangat_baik],
                    color: '#686de0',
                }]
            });

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });

    });