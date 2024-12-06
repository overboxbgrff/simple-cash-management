<?php
    $root = realpath($_SERVER['DOCUMENT_ROOT']);
    require_once $root."/kas/connector.php";
    require_once $root."/kas/session.php";

    //blokir page jika bukan admin
    if ($priv != "Administrator"){
        header("location: ../login.php");
    }
    $query = mysqli_query($conn,"select * from jenis_km");

    //pagination
    $data_pages = 5;
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
    <title>Cash Management - Kode Kas Masuk</title>
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
                                    <li><a href="kas-masuk.php" class="dropdown-item"><i class="fa-solid fa-cash-register"> </i> Kas Pemasukan</a></li>
                                    <li><a href="../page-kas-keluar/kas-keluar.php" class="dropdown-item"><i class="fa-solid fa-hand-holding-dollar"> </i> Kas Pengeluaran</a></li>                            
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
                                        <a href="kas-masuk-m.php" class="dropdown-item <?php echo $kode_manager;?>">
                                            <i class="fa-solid fa-file-pen"> </i> Kode Kas Masuk <?php echo $status_kode;?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../page-kas-keluar/kas-keluar-m.php" class="dropdown-item <?php echo $kode_manager;?>">
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
                            <li class="nav-item"><a href="../about.php" class="nav-link"><i class="fa-solid fa-circle-info"> </i> About</a></li>
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
                            <h1><i class="fa-solid fa-cash-register"> </i> Manajemen Kode Kas Masuk</h1>
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
                            <!-- Modal -->
                                <div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="process.php?act=tambah-km" method="POST">
                                            <div class="modal-content">
                                                <!-- Header -->
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <!-- Modal Body -->
                                                <div class="modal-body">                        
                                                    <div class="mb-3">
                                                        <label for="kode_km" class="form-label">Kode Kas Masuk</label>
                                                        <input type="text" class="form-control" name="kode_km" placeholder="Kode Kas Masuk...">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="desk_km" class="form-label">Keterangan Kode Kas masuk</label>
                                                        <textarea name="desk_km" class="form-control" rows="2"></textarea>
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
                                            <th scope="col">Kode Kas Masuk</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col" colspan="2" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if (isset($_GET['cari'])){
                                                $cari = $_GET['cari'];
                                                $pagination = mysqli_query($conn,"SELECT * FROM jenis_km WHERE kode_km LIKE '%$cari%' OR desk_km LIKE '%$cari%' 
                                                                            ORDER BY id_km ASC LIMIT $start_pages,$data_pages");
                                            } else {
                                                $pagination = mysqli_query($conn,"select * from jenis_km ORDER BY id_km ASC LIMIT $start_pages,$data_pages");
                                            }
                                            while($td = mysqli_fetch_array($pagination)){ ?>
                                        <tr>
                                            <td><?php echo $td['kode_km'];?></td>
                                            <td><?php echo $td['desk_km'];?></td>
                                            <!-- Tombol Hapus -->
                                            <td>   
                                                <a href="#" class="btn btn-outline-danger text-center" data-bs-toggle="modal" data-bs-target="#hapus-km<?php echo $td['id_km'];?>"><i class="fa-solid fa-trash"></i> Hapus</a>
                                                <div class="modal fade" id="hapus-km<?php echo $td['id_km'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                                <!-- Header -->
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data? (<?php echo $td['kode_km']."-".$td['desk_km']; ?>)</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <!-- Modal Body -->
                                                                <div class="modal-body">
                                                                    <h3>Apakah anda ingin menghapus Kode ini?</h3>
                                                                    <h5><?php echo $td['kode_km']."-".$td['desk_km']; ?></h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"> </i> Batal</button>
                                                                    <a href="process.php?act=hapus_km&id=<?php echo $td['id_km'];?>" class="btn btn-danger text-center"><i class="fa-solid fa-trash"></i> Hapus</a>
                                                                </div>
                                                        </div>                                                            
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- tombol Edit -->
                                            <td>
                                                <a href="#" class="btn btn-outline-info text-center" data-bs-toggle="modal" data-bs-target="#edit-km<?php echo $td['id_km'];?>"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                                    <div class="modal fade" id="edit-km<?php echo $td['id_km'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="process.php?act=edit-km&id=<?php echo $td['id_km'];?>" method="POST">
                                                                    <!-- Header -->
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kas Masuk (<?php echo $td['kode_km']."-".$td['desk_km']; ?>)</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <!-- Modal Body -->
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="e_id_km" class="form-control" value="<?php echo $td['id_km'];?>">
                                                                        <div class="mb-3">
                                                                            <label for="e_kode_km" class="form-label">Kode Kas Masuk</label>
                                                                            <input type="text" class="form-control" name="e_kode_km" placeholder="Kode Kas Masuk..." value="<?php echo $td['kode_km'];?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="e_desk_km" class="form-label">Keterangan Kode Kas Masuk</label>
                                                                            <textarea name="e_desk_km" class="form-control" rows="2"><?php echo $td['desk_km'];?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"> </i> Batal</button>
                                                                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa-solid fa-plus"> </i> Tambah Data</button>
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

                <!-- Pagination -->
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
                </div>
        </div>
    </div>
</body>
</html>