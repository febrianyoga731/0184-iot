<!DOCTYPE HTML>
<html>
    <head>
        
    </head>

    <body>

        <br><br><br>
        <!-- menampilkan grafik dengan id chartContainer -->
        <!-- ukuran grafik: tinggi 550 pixel, dan maksimal lebar 920 pixel-->
        <div id="chartContainer" style="height: 250px; max-width: 520px; margin: 0px auto; "></div>

        <h2 style="text-align: center">Monitoring Suhu Real Time</h2>

        <!-- import library canvasjs dan jquery dengan cdn -->
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

        <script>
            window.onload = function () {

                //inisialisasi data array dps kepanjangan dari data points
                var dps = [];
                var dataLength = 20; // panjang data yang ditampilkan horizontal, ditampilkan di bagian bawah
                var updateInterval = 1000; // setiap 1 detik data di refresh
                var xVal = 0;
                var yVal = 0;

                //inisialisasi chart js
                var chart = new CanvasJS.Chart("chartContainer", {
                    title: {
                        text: "Grafik Suhu Realtime" // memberi judul grafik
                    },
                    data: [{
                        type: "line", //tipe grafik yang digunakan, lihat di situsnya untuk lihat gaya yang lain
                        dataPoints: dps //dps adalah data yang digunakan
                    }]
                });

                var updateChart = function (count) {
                    //data json diambil dari alamat /getdata
                    $.getJSON("http://localhost/iot/suhu/getdata.php", function (data) {

                var suhu = data.suhu //mengambil data spesifik rate float
                //alert(suhu):
                        console.log(suhu) // menampilkan data dengan console.log hanya terlihat saat mode inspection
                        yVal = suhu //mengisi variabel yVal dengan data usd

                        count = count || l;

                        //melakukan perulangan data dengan for agar data dapat dijalankan
                        for (var j = 0; j < count; j++) {
                            dps.push({
                                x: xVal,
                                y: yVal
                            });
                            xVal++;
                        }

                        //jika datapoints telah melewati datalength
                        if (dps.length > dataLength) {
                            dps.shift(); // maka hapus data awal dengan fungsi shift()
                        }

                    })
                    chart.render();
                }; 
                
                //jalankan fungsi updateChart diatas
                updateChart(dataLength);

                //fungsi agar data dapat diupdate setiap 1000 detik sekali
                setInterval(function () {
                    updateChart()
                }, updateInterval);
            }
        </script>
    </body>
</html>