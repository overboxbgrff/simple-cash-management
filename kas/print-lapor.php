<?php
    $root = realpath($_SERVER['DOCUMENT_ROOT']);
    require_once $root."/kas/connector.php";
    require_once $root."/kas/session.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Management - Cetak Rekap Kas</title>
</head>
<!-- BS Initialize-->
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
<!-- FA Initialize -->
    <script src="lib/font-awesome/js/solid.min.js"></script>
    <script src="lib/font-awesome/js/fontawesome.min.js"></script>
    <script src="lib/font-awesome/js/brands.min.js"></script>

<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

<body style="background-color: rgb(81, 50, 252);">
    <!--navbar-->
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">

        <div class="container-fluid">
            <a href="homepage.php" class="navbar-brand"><i class="fa-solid fa-money-bill-transfer"> </i> Cash Management (Trial)</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-receipt"> </i> Kas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="page-kas-masuk/kas-masuk.php" class="dropdown-item"><i class="fa solid fa-cash-register"> </i> Kas Pemasukan</a></li>
                            <li><a href="page-kas-keluar/kas-keluar.php" class="dropdown-item"><i class="fa-solid fa-hand-holding-dollar"> </i> Kas Pengeluaran</a></li>                            
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="rekap-kas.php" class="dropdown-item"><i class="fa-solid fa-box-archive"> </i> Rekap</a></li>
                            <li><a href="print-lapor.php" class="dropdown-item"><i class="fa-solid fa-print"> </i> Cetak</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-file-pen"> </i> Edit
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="page-kas-masuk/kas-masuk-m.php" class="dropdown-item <?php echo $kode_manager;?>">
                                    <i class="fa-solid fa-file-pen"> </i> Kode Kas Masuk <?php echo $status_kode;?>
                                </a>
                            </li>
                            <li>
                                <a href="page-kas-keluar/kas-keluar-m.php" class="dropdown-item <?php echo $kode_manager;?>">
                                    <i class="fa-solid fa-file-pen"> </i> Kode Kas Keluar <?php echo $status_kode;?>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a href="page-user/user-man.php" class="dropdown-item <?php echo $kode_manager;?>">
                                    <i class="fa-solid fa-user-pen"> </i> User <?php echo $status_kode;?>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

                <ul class="navbar-nav d-flex">
                    <li class="nav-item"><a href="about.php" class="nav-link"><i class="fa-solid fa-circle-info"> </i> About</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link text-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                </ul>

            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <br>
    <div class="container">
        <div class="card border-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h1><i class="fa-solid fa-print"> </i> Cetak Rekap Kas</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><br></div>
                </div>
                <div class="row">
                    <div class="d-grid gap-2 col-md-4 mx-auto">
                    </div>
                    <div class="d-grid gap-2 col-md-8 mx-auto">
                        <form action="" method="get">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Mulai</span>
                                <input type="date" class="form-control" name="start" id="">
                                <span class="input-group-text" id="basic-addon1">Akhir</span>
                                <input type="date" class="form-control" name="end" id="">
                                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-search"> </i> Cari</button>
                            </div>
                        </form>   
                    </div>
                    <br> <br>
                </div>
                
                <!-- Print Region -->
                <div class="row">
                    <div class="col-md-12">    
                        <!-- Printable -->
                        <?php
                            if (isset($_GET['start']) && isset($_GET['end'])){
                                $start = $_GET['start'];
                                $end = $_GET['end'];
                                $print = mysqli_query($conn,"SELECT * FROM lapor UNION 
                                        SELECT `kas_masuk`.`id_kkm`,`kas_masuk`.`tanggal_km`,`kas_masuk`.`kode_km`,`kas_masuk`.`uraian_km`, `kas_masuk`.`jumlah_km`, '0' from `kas_masuk` 
                                        WHERE `tanggal_km` BETWEEN '$start' AND '$end' 
                                        UNION SELECT `kas_keluar`.`id_kkk`,`kas_keluar`.`tanggal_kk`,`kas_keluar`.`kode_kk`,`kas_keluar`.`uraian_kk`,'0',`kas_keluar`.`jumlah_kk` FROM `kas_keluar` 
                                        WHERE `tanggal_kk` BETWEEN '$start' AND '$end' ORDER BY `id_lapor` DESC, `tanggal_lapor` ASC");
                                $total=0;
                                $t_masuk = 0;
                                $t_keluar = 0;
                                $t_saldo = 0;
                        ?>
                        <div class="d-flex flex-row-reverse">
                            <button class="btn btn-outline-primary" onclick="printDiv('printableArea')"><i class="fa-solid fa-print"></i> Print</button>
                        </div>
                        <br>
                        <div id="printableArea">
                            <h1 class="text-uppercase text-center">Instansi Sekolah (Placeholder)</h1>
                            <h5 class="text-center">Alamat Kantor. No. Telp Kantor</h5>
                            <h5 class="text-center">Kontak Lainnya</h5>
                            <hr>
                            <h5 class="text-uppercase text-center">KAS UMUM</h5>
                            <p class="text-center"><?php echo strftime("%d %B %Y", strtotime($start)); ?> s/d <?php echo strftime("%d %B %Y", strtotime($end));; ?></p>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">Tanggal</th>
                                                <th scope="col" class="text-center">Kode</th>
                                                <th scope="col" class="text-center">Uraian</th>
                                                <th scope="col" class="text-center">Pemasukan</th>
                                                <th scope="col" class="text-center">Pengeluaran</th>
                                                <th scope="col" class="text-center">Saldo</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="text-center">1</th>
                                                <th scope="col" class="text-center">2</th>
                                                <th scope="col" class="text-center">3</th>
                                                <th scope="col" class="text-center">4</th>
                                                <th scope="col" class="text-center">5</th>
                                                <th scope="col" class="text-center">6</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($td = mysqli_fetch_array($print)){ 
                                                    $total = $total+($td['pemasukan']-$td['pengeluaran']);
                                                    $t_masuk = $t_masuk + $td['pemasukan'];
                                                    $t_keluar = $t_keluar + $td['pengeluaran'];
                                                    $t_saldo = $t_saldo + $total;
                                                    if($td['pemasukan']==0){
                                                        $masuk = "-";
                                                    } else {
                                                        $masuk ="Rp. ".number_format($td['pemasukan'],2,",",".");
                                                    }
                                                    if ($td['pengeluaran']==0) {
                                                        $keluar = "-";
                                                    } else {
                                                        $keluar ="Rp. ".number_format($td['pengeluaran'],2,",",".");
                                                    }    
                                            ?>
                                                <tr>
                                                    <td><?php echo date('d/m/Y', strtotime($td['tanggal_lapor']));?></td>
                                                    <td><?php echo $td['kode_lapor']."/".date('d/m/Y', strtotime($td['tanggal_lapor']));?></td>
                                                    <td><?php echo $td['uraian_lapor'];?></td>
                                                    <td><?php echo $masuk;?></td>
                                                    <td><?php echo $keluar;?></td>
                                                    <td><?php echo "Rp. ".number_format($total,2,",",".");?></td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                                    <tr>
                                                        <td colspan="3" class="text center"><b>Jumlah</b></td>
                                                        <td class="fw-bold"><?php echo "Rp. ".number_format($t_masuk,2,",",".");?></td>
                                                        <td class="fw-bold"><?php echo "Rp. ".number_format($t_keluar,2,",",".");?></td>
                                                        <td class="fw-bold"><?php echo "Rp. ".number_format($total,2,",",".");?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-between">
                                                <div class="col-md-4">
                                                    <p class="text-center fw-bold invisible" ><?php echo strftime("%A, %d %B %Y");?></p>
                                                    <p class="text-center fw-bold">(Contoh Jabatan)</p>
                                                    <br><br><br><br>
                                                    <p class="text-center fw-bold">(Contoh Nama)</p>
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="text-center fw-bold">(Kota), <?php echo strftime("%d %B %Y");?></p>
                                                    <p class="text-center fw-bold">(Contoh Jabatan)</p>
                                                    <br><br><br><br>
                                                    <p class="text-center fw-bold">(Contoh Nama)</p>
                                                    
                                                </div>
                                            </div>
                                            <?php
                                            } else {
                                                ?>
                                                <br><br>
                                                <h3 class="text-center fst-italic">Pilih tanggal awal dan akhir periode kas yang ingin dicetak.</h3>
                                                <br><br>
                                                <?php
                                            } 
                                        ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- End Printable Region -->
            </div>
        </div>
    </div>
    
</body>
</html>