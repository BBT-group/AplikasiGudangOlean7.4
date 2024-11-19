            <!-- Main Content -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Jumlah Barang</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_barang ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-layer-group fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Jumlah Alat</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_alat ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-wrench fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Data Peminjaman</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <form method="get" action="">
                                    <label for="year">Pilih Tahun:</label>
                                    <select name="year" id="year" onchange="this.form.submit()">
                                        <?php foreach ($years as $year): ?>
                                            <option value="<?= $year ?>" <?= $year == $selectedYear ? 'selected' : '' ?>>
                                                <?= $year ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </form>
                                <div class="chart-area">
                                    <canvas id="AreaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Status Peminjaman</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="PieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-primary"></i> Belum Dikembalikan
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-success"></i> Dikembalikan
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Team IT PT. Olean</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Bootstrap core JavaScript-->
            <script src="/jquery/jquery.js"></script>
            <script src="/bootstrap/js/bootstrap.bundle.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="/jquery-easing/jquery.easing.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="/js/sb-admin-2.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <!-- Page level plugins -->
            <script src="/chart.js/Chart.js"></script>

            <!-- Page level custom scripts -->
            <script src="/js/demo/chart-area-demo.js"></script>
            <!-- <script src="/js/demo/chart-pie-demo.js"></script> -->

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                <?php if (session()->getFlashdata('login_suceess') && session()->role == 'admin') : ?>
                    <?php if ($jumlah_satuan == 0 || $jumlah_kategori == 0) : ?>
                        Swal.fire({
                            title: "Perhatian!",
                            text: "<?= session()->getFlashdata('login_suceess') ?>",
                        });
                    <?php endif; ?>
                <?php endif; ?>
            </script>
            <script>
                var chartData = <?php echo json_encode($chart_data); ?>;
                console.log(chartData); // Debug: periksa data

                // Siapkan array untuk label dan data
                var labels = [];
                var data = [];
                var backgroundColors = [];
                var hoverBackgroundColors = [];

                // Loop melalui data yang diambil dari database
                chartData.forEach(function(item) {
                    labels.push(item.status == 0 ? "Dikembalikan" : "Belum Dikembalikan");
                    data.push(item.count);

                    // Tentukan warna berdasarkan status
                    if (item.status == 0) {
                        backgroundColors.push('#1cc88a'); // Hijau jika sudah dikembalikan
                        hoverBackgroundColors.push('#17a673'); // Hover hijau jika sudah dikembalikan
                    } else {
                        backgroundColors.push('#4e73df'); // Biru jika belum dikembalikan
                        hoverBackgroundColors.push('#2e59d9'); // Hover biru jika belum dikembalikan
                    }
                });

                // Periksa apakah semua barang sudah dikembalikan
                var allReturned = chartData.every(function(item) {
                    return item.status == 0;
                });

                // Jika semua barang sudah dikembalikan, set warna hijau untuk seluruh chart
                if (allReturned) {
                    backgroundColors = ['#1cc88a']; // Semua hijau jika sudah dikembalikan
                    hoverBackgroundColors = ['#17a673']; // Hover hijau jika sudah dikembalikan
                }

                // Set default font dan warna seperti di Bootstrap
                Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                Chart.defaults.global.defaultFontColor = '#858796';

                // Inisialisasi Pie Chart
                var ctx = document.getElementById("PieChart").getContext('2d');
                var PieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: backgroundColors,
                            hoverBackgroundColor: hoverBackgroundColors,
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 80,
                    },
                });
            </script>
            <script>
                var barangMasuk = <?= json_encode($msbarang_masuk) ?>;
                var barangKeluar = <?= json_encode($msbarang_keluar) ?>;
                var allMonths = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

                var ctx = document.getElementById("AreaChart").getContext('2d');
                var inventoryChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: allMonths,
                        datasets: [{
                                label: "Barang Masuk",
                                lineTension: 0.3,
                                backgroundColor: "rgba(28, 200, 138, 0.05)",
                                borderColor: "rgba(28, 200, 138, 1)",
                                pointRadius: 3,
                                pointBackgroundColor: "rgba(28, 200, 138, 1)",
                                pointBorderColor: "rgba(28, 200, 138, 1)",
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: "rgba(28, 200, 138, 1)",
                                pointHoverBorderColor: "rgba(28, 200, 138, 1)",
                                pointHitRadius: 10,
                                pointBorderWidth: 2,
                                data: barangMasuk,
                            },
                            {
                                label: "Barang Keluar",
                                lineTension: 0.3,
                                backgroundColor: "rgba(231, 74, 59, 0.05)",
                                borderColor: "rgba(231, 74, 59, 1)",
                                pointRadius: 3,
                                pointBackgroundColor: "rgba(231, 74, 59, 1)",
                                pointBorderColor: "rgba(231, 74, 59, 1)",
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: "rgba(231, 74, 59, 1)",
                                pointHoverBorderColor: "rgba(231, 74, 59, 1)",
                                pointHitRadius: 10,
                                pointBorderWidth: 2,
                                data: barangKeluar,
                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 0,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 12
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    maxTicksLimit: 10,
                                    padding: 10,
                                    callback: function(value) {
                                        return value.toLocaleString();
                                    }
                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        legend: {
                            display: true
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': ' + tooltipItem.yLabel.toLocaleString();
                                }
                            }
                        }
                    }
                });
            </script>

            </body>

            </html>