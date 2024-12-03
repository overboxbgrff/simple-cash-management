<?php
    $root = realpath($_SERVER['DOCUMENT_ROOT']);
    require_once $root."/kas/connector.php";
    require_once $root."/kas/session.php";

    $query = mysqli_query($conn,"select * from kas_keluar");

    //pagination
    $data_pages = 10;
    $pages = (isset($_GET['pages'])) ? (int)$_GET['pages'] : 1;
    $start_pages = ($pages > 1) ? ($pages * $data_pages) - $data_pages : 0;
    $total = mysqli_num_rows($query);
    $hal = ceil($total/$data_pages)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Management - Kas Keluar</title>
</head>

<!-- BS Initialize-->
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
<!-- FA Initialize -->
    <script src="../lib/font-awesome/js/solid.min.js"></script>
    <script src="../lib/font-awesome/js/fontawesome.min.js"></script>
    <script src="../lib/font-awesome/js/brands.min.js"></script>

<body style="background-color: rgb(81, 50, 252);">
    <!--navbar-->
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a href="../homepage.php" class="navbar-brand"><i class="fa-solid fa-money-bill-transfer"> </i> Simple Cash Management (Trial)</a>
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
                            <li><a href="../page-kas-masuk/kas-masuk.php" class="dropdown-item"><i class="fa-solid fa-cash-register"> </i> Kas Pemasukan</a></li>
                            <li><a href="kas-keluar.php" class="dropdown-item"><i class="fa-solid fa-hand-holding-dollar"> </i> Kas Pengeluaran</a></li>                            
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="../rekap-kas.php" class="dropdown-item"><i class="fa-solid fa-box-archive"> </i> Rekap</a></li>
                            <li><a href="../print-lapor.php" class="dropdown-item"><i class="fa-solid fa-print"> </i> Cetak</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-file-pen"> </i> Edit
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="../page-kas-masuk/kas-masuk-m.php" class="dropdown-item <?php echo $kode_manager;?>">
                                    <i class="fa-solid fa-file-pen"> </i> Kode Kas Masuk <?php echo $status_kode;?>
                                </a>
                            </li>
                            <li>
                                <a href="kas-keluar-m.php" class="dropdown-item <?php echo $kode_manager;?>">
                                    <i class="fa-solid fa-file-pen"> </i> Kode Kas Keluar <?php echo $status_kode;?>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a href="../page-user/user-man.php" class="dropdown-item <?php echo $kode_manager;?>">
                                    <i class="fa-solid fa-user-pen"> </i> User <?php echo $status_kode;?>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

                <ul class="navbar-nav d-flex">
                    <li class="nav-item"><a href="" class="nav-link"><i class="fa-solid fa-circle-info"> </i> About</a></li>
                    <li class="nav-item"><a href="../logout.php" class="nav-link text-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                </ul>

            </div>
        </div>
    </nav>
    <br>

    <!--content-->
    <div class="container">
        <div class="card border-primary">
            <div class="card-body">
                <!--Header-->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1><i class="fa-solid fa-hand-holding-dollar"> </i> Manajemen Kas Pengeluaran</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12"><br></div>
                    </div>   
                    
                    <div class="row">
                        <div class="d-grid gap-2 col-md-2 mx-auto">
                            <!-- Button Trigger Modal -->
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambah-data">
                                    <i class="fa-solid fa-plus"> </i> Tambah Data
                                </button>
                                <br>

                            <!-- Modal Tambah Data -->
                                <div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="process.php?act=tambah-kas" method="POST">
                                            <div class="modal-content">
                                                <!-- Header -->
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="tanggal_kk" class="form-label">Tanggal Pengeluaran</label>
                                                        <input type="date" name="tanggal_kk" class="form-control" placeholder="dd-mm-yyyy">
                                                    </div>                        
                                                    <div class="mb-3">
                                                        <label for="kode_kk" class="form-label">Kode Kas Keluar</label>
                                                        <select name="kode_kk" class="form-select">
                                                            <option selected>--Pilih Kode--</option>
                                                            <?php
                                                                $q_kk = mysqli_query($conn,"SELECT * FROM jenis_kk");
                                                                while($tqkk = mysqli_fetch_array($q_kk)){
                                                                    ?>
                                                                        <option value="<?php echo $tqkk['kode_kk'];?>"><?php echo $tqkk['kode_kk']." - ".$tqkk['desk_kk'];?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="uraian_kk" class="form-label">Keterangan Kas Keluar</label>
                                                        <textarea name="uraian_kk" class="form-control" rows="2"></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jumlah_kk" class="form-label">Jumlah Kas Keluar(Rp.)</label>
                                                        <input type="number" class="form-control" name="jumlah_kk" placeholder="Jumlah Kas Masuk (Rp.)">
                                                    </div>                          
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"> </i> Batal</button>
                                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa-solid fa-plus"> </i> Tambah Data</button>
                                                </div>
                                            </div>
                                        </form> 
                                    </div>
                                </div>                                
                        </div>
                        <div class="d-grid gap-2 col-md-6 mx-auto"></div>
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
                <!--Tabel Data-->
                <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="table-dark">
                                            <th scope="col">Tanggal Kas Masuk</th>
                                            <th scope="col">Kode Kas Masuk</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col" colspan="2" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            // fungsi search
                                            if (isset($_GET['cari'])){
                                                $cari = $_GET['cari'];
                                                $pagination = mysqli_query($conn,"SELECT * FROM kas_keluar WHERE tanggal_kk LIKE '%$cari%' OR kode_kk LIKE '%$cari%' OR uraian_kk LIKE '%$cari%' 
                                                                            OR desk_kk LIKE '%$cari%' OR jumlah_kk LIKE '%$cari%'
                                                                            ORDER BY tanggal_kk DESC LIMIT $start_pages,$data_pages");
                                            } else {
                                                $pagination = mysqli_query($conn,"select * from kas_keluar ORDER BY tanggal_kk DESC LIMIT $start_pages,$data_pages");
                                            }
                                            while($td = mysqli_fetch_array($pagination)){ ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y', strtotime($td['tanggal_kk']));?></td>
                                            <td><?php echo $td['kode_kk'];?></td>
                                            <td><?php echo $td['uraian_kk'];?></td>
                                            <td><?php echo "Rp. ".number_format($td['jumlah_kk'], 2, ",", ".");?></td>

                                            <!-- Tombol Hapus -->
                                            <td>   
                                                <a href="#" class="btn btn-outline-danger text-center" data-bs-toggle="modal" data-bs-target="#hapus-kk<?php echo $td['id_kkk'];?>"><i class="fa-solid fa-trash"></i> Hapus</a>
                                                <div class="modal fade" id="hapus-kk<?php echo $td['id_kkk'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                                <!-- Header -->
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data?</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <!-- Modal Body -->
                                                                <div class="modal-body">
                                                                    <h2>Apakah anda ingin menghapus data ini?</h3>
                                                                    <h5><?php echo $td['tanggal_kk']." - ".$td['uraian_kk'];?></h5>
                                                                    <h5><?php echo "Rp. ".$td['jumlah_kk'];?></h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"> </i> Batal</button>
                                                                    <a href="process.php?act=hapus_kas&id=<?php echo $td['id_kkk'];?>" class="btn btn-danger text-center"><i class="fa-solid fa-trash"></i> Hapus</a>
                                                                </div>
                                                        </div>                                                            
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- tombol Edit -->
                                            <td>
                                                <a href="#" class="btn btn-outline-info text-center" data-bs-toggle="modal" data-bs-target="#edit-kk<?php echo $td['id_kkk'];?>"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                                    <div class="modal fade" id="edit-kk<?php echo $td['id_kkk'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="process.php?act=edit-kas&id=<?php echo $td['id_kkk'];?>" method="POST">
                                                                    <!-- Header -->
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kas Masuk</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <!-- Modal Body -->
                                                                    <div class="modal-body">
                                                                        
                                                                        <div class="mb-3">
                                                                            <label for="tanggal_kk" class="form-label">Tanggal Pemasukan</label>
                                                                            <input type="date" name="tanggal_kk" class="form-control" value="<?php echo $td['tanggal_kk'];?>">
                                                                        </div>                        
                                                                        <div class="mb-3">
                                                                            <label for="kode_kk" class="form-label">Kode Kas Masuk</label>
                                                                            <select name="kode_kk" class="form-select" selectedValue="<?php echo $td['kode_kk'];?>">
                                                                                <?php
                                                                                    $q_kk = mysqli_query($conn,"SELECT * FROM jenis_kk");
                                                                                    while($tqkk = mysqli_fetch_array($q_kk)){
                                                                                        ?>
                                                                                            <option value="<?php echo $tqkk['kode_kk'];?>"><?php echo $tqkk['kode_kk']." - ".$tqkk['desk_kk'];?></option>
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="uraian_kk" class="form-label">Keterangan Kas masuk</label>
                                                                            <textarea name="uraian_kk" class="form-control" rows="2"><?php echo $td['uraian_kk'];?></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="jumlah_kk" class="form-label">Jumlah Uang (Rp. )</label>
                                                                            <input type="number" class="form-control" name="jumlah_kk" value="<?php echo $td['jumlah_kk'];?>" placeholder="Jumlah Kas Masuk (Rp.)">
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"> </i> Batal</button>
                                                                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"> </i> Edit Data</button>
                                                                    </div>
                                                                </form>
                                                            </div>                                                            
                                                        </div>
                                                    </div>
                                            </td>
                                        </tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                    
            </div>
        </div>
    </div>
</body>
</html>