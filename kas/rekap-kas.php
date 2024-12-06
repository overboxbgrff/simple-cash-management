<?php
    $root = realpath($_SERVER['DOCUMENT_ROOT']);
    require_once $root."/kas/connector.php";
    require_once $root."/kas/session.php";

    $query = mysqli_query($conn,"SELECT * FROM lapor union 
    SELECT `kas_masuk`.`id_kkm`,`kas_masuk`.`tanggal_km`,`kas_masuk`.`kode_km`,`kas_masuk`.`uraian_km`, `kas_masuk`.`jumlah_km`, '0' from `kas_masuk` 
    UNION SELECT `kas_keluar`.`id_kkk`,`kas_keluar`.`tanggal_kk`,`kas_keluar`.`kode_kk`,`kas_keluar`.`uraian_kk`,'0',`kas_keluar`.`jumlah_kk` FROM `kas_keluar` ORDER BY `tanggal_lapor` ASC");

    //pagination
    $data_pages = 10;
    $pages = (isset($_GET['pages'])) ? (int)$_GET['pages'] : 1;
    $start_pages = ($pages > 1) ? ($pages * $data_pages) - $data_pages : 0;
    $total = mysqli_num_rows($query);
    $hal = ceil($total/$data_pages);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Management - Rekap Kas</title>
</head>
<!-- BS Initialize-->
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
<!-- FA Initialize -->
    <script src="lib/font-awesome/js/solid.min.js"></script>
    <script src="lib/font-awesome/js/fontawesome.min.js"></script>
    <script src="lib/font-awesome/js/brands.min.js"></script>
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
                        <h1><i class="fa-solid fa-box-archive"> </i> Rekap Kas</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><br></div>
                </div>
                <div class="row">
                    <div class="d-grid gap-2 col-md-8 mx-auto"></div>
                    <div class="d-grid gap-2 col-md-4 mx-auto">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" id="" placeholder="Cari Data...">
                                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-search"> </i> Cari</button>
                            </div>
                        </form>   
                    </div>
                    <br> <br>
                </div>

                <!-- Data Table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                    <thead>
                                        <tr class="table-dark">
                                            <th scope="col" class="text-center">Tanggal</th>
                                            <th scope="col" class="text-center">Kode</th>
                                            <th scope="col" class="text-center">Uraian</th>
                                            <th scope="col" class="text-center">Pemasukan</th>
                                            <th scope="col" class="text-center">Pengeluaran</th>
                                            <th scope="col" class="text-center">Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            // fungsi search
                                            if (isset($_GET['cari'])){
                                                $cari = $_GET['cari'];
                                                $pagination = mysqli_query($conn,"SELECT * FROM lapor 
                                                                        UNION SELECT `kas_masuk`.`id_kkm`,`kas_masuk`.`tanggal_km`,`kas_masuk`.`kode_km`,`kas_masuk`.`uraian_km`, `kas_masuk`.`jumlah_km`, '0' from `kas_masuk` 
                                                                        WHERE `tanggal_km` like '%$cari%' OR `kode_km` LIKE '%$cari%' OR `uraian_km` LIKE '%$cari%' OR `jumlah_km` LIKE '%$cari%'
                                                                        UNION SELECT `kas_keluar`.`id_kkk`,`kas_keluar`.`tanggal_kk`,`kas_keluar`.`kode_kk`,`kas_keluar`.`uraian_kk`,'0',`kas_keluar`.`jumlah_kk` FROM `kas_keluar` 
                                                                        WHERE `tanggal_kk` like '%$cari%'  OR `kode_kk` LIKE '%$cari%' OR `uraian_kk` LIKE '%$cari%' OR `jumlah_kk` LIKE '%$cari%'
                                                                        ORDER BY `id_lapor` DESC, `tanggal_lapor` ASC LIMIT $start_pages,$data_pages");
                                            } else {
                                                $pagination = mysqli_query($conn,"SELECT * FROM lapor union 
                                                                                    SELECT `kas_masuk`.`id_kkm`,`kas_masuk`.`tanggal_km`,`kas_masuk`.`kode_km`,`kas_masuk`.`uraian_km`, `kas_masuk`.`jumlah_km`, '0' from `kas_masuk` 
                                                                                    UNION SELECT `kas_keluar`.`id_kkk`,`kas_keluar`.`tanggal_kk`,`kas_keluar`.`kode_kk`,`kas_keluar`.`uraian_kk`,'0',`kas_keluar`.`jumlah_kk` FROM `kas_keluar` 
                                                                                    ORDER BY `tanggal_lapor` ASC LIMIT $start_pages,$data_pages");
                                            }
                                            $total=0;
                                            $t_masuk = 0;
                                            $t_keluar = 0;
                                            $t_saldo = 0;
                                            while($td = mysqli_fetch_array($pagination)){ 
                                                $total = $total+($td['pemasukan']-$td['pengeluaran']);
                                                $t_masuk = $t_masuk + $td['pemasukan'];
                                                $t_keluar = $t_keluar + $td['pengeluaran'];
                                                $t_saldo = $t_saldo + $total;
                                                if($td['pemasukan']==0){
                                                    $masuk = "-";
                                                    $c_masuk = "text-center";
                                                } else {
                                                    $c_masuk = "text-success";
                                                    $masuk ="Rp. ".number_format($td['pemasukan'],2,",",".");
                                                }
                                                if ($td['pengeluaran']==0) {
                                                    $c_keluar = "text-center";
                                                    $keluar = "-";
                                                } else {
                                                    $c_keluar = "text-danger";
                                                    $keluar ="Rp. ".number_format($td['pengeluaran'],2,",",".");
                                                }    
                                        ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y', strtotime($td['tanggal_lapor']));?></td>
                                            <td><?php echo $td['kode_lapor']."/".date('d/m/Y', strtotime($td['tanggal_lapor']));?></td>
                                            <td><?php echo $td['uraian_lapor'];?></td>
                                            <td class="<?php echo $c_masuk;?>"><?php echo $masuk;?></td>
                                            <td class="<?php echo $c_keluar;?>"><?php echo $keluar;?></td>
                                            <td><?php echo "Rp. ".number_format($total,2,",",".");?></td>

                                        </tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                <!-- End Data Table -->

                <!-- pagination -->
                <div class="row">   
                        <div class="col-lg-12">
                            <nav class="text-center">
                                <div class="d-flex justify-content-center">
                                    <ul class="pagination">
                                        <?php
                                            if ($pages == 1){
                                        ?>
                                            <li class="page-item disabled"><a class="page-link" href="?pages=1"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></a></li>
                                            <li class="page-item disabled"><a class="page-link" href="?pages=<?php $pagel = $pages - 1; echo $pagel;?>"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></a></li>
                                        <?php
                                            } else {
                                        ?>
                                            <li class="page-item"><a class="page-link" href="?pages=1"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></a></li>
                                            <li class="page-item"><a class="page-link" href="?pages=<?php $pagep = $pages - 1; echo $pagep;?>"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></a></li>
                                        <?php
                                            }
                                            for($i=1; $i<=$hal; $i++){
                                                if($i==$pages){
                                        ?>
                                            <li class="page-item active"><a href="?pages=<?php echo $i;?>" class="page-link"><?php echo $i;?></a></li>
                                        <?php
                                                } else {
                                        ?>
                                            <li class="page-item"><a href="?pages=<?php echo $i;?>" class="page-link"><?php echo $i;?></a></li>
                                        <?php
                                                }

                                            }

                                            if ($hal == 1 || $hal == 0) {
                                        ?>
                                                <li class="page-item disabled"><a class="page-link" href="?pages=<?php $pagen = $pages + 1; echo $pagen;?>"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                                                <li class="page-item disabled"><a class="page-link" href="?pages=<?php echo $hal; ?>"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                                        <?php
                                            } elseif ($pages < $hal) {
                                        ?>
                                                <li class="page-item"><a class="page-link" href="?pages=<?php $pagen = $pages + 1; echo $pagen;?>"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                                                <li class="page-item"><a class="page-link" href="?pages=<?php echo $hal; ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                                        <?php
                                            } else {
                                        ?>
                                                <li class="page-item disabled"><a class="page-link" href="?pages=<?php $pagen = $pages + 1; echo $pagen;?>"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                                                <li class="page-item disabled"><a class="page-link" href="?pages=<?php echo $hal; ?>"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                                        <?php
                                            }
                                        ?>
                                        
                                    </ul>
                                </div>
                            </nav>
                </div>
                <!-- End Pagination -->
            </div>
        </div>
    </div>
</body>
</html>