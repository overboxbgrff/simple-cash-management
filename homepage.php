<?php
    require_once "connector.php";
    require_once "session.php"

    //pagination section

    
?>

<!--HTML SECTION-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Management - Home</title>
</head>

    <!-- BS Initialize-->
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <!-- FA Initialize -->
    <script src="lib/font-awesome/js/solid.min.js"></script>
    <script src="lib/font-awesome/js/fontawesome.min.js"></script>
    <script src="lib/font-awesome/js/brands.min.js"></script>

<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">

        <div class="container-fluid">
            <a href="#" class="navbar-brand"><i class="fa-solid fa-money-bill-transfer"> </i> Simple Cash Management (Trial)</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manajemen
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="dropdown-item"><i class="fa solid fa-cash-register"> </i> Kas Pemasukan</a></li>
                            <li><a href="#" class="dropdown-item"><i class="fa-solid fa-hand-holding-dollar"> </i> Kas Pengeluaran</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="#" class="dropdown-item"><i class="fa-solid fa-file-pen"> </i> Manajemen Kode Kas</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="#" class="dropdown-item"><i class="fa-solid fa-box-archive"> </i> Rekap</a></li>
                            <li><a href="#" class="dropdown-item"><i class="fa-solid fa-print"> </i> Cetak</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav d-flex">
                    <li class="nav-item"><a href="" class="nav-link"><i class="fa-solid fa-circle-info"> </i> About</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link text-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                </ul>

            </div>
        </div>
    </nav>

    <br>

    <!--content-->
    <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="fst-italic">Halo, <?php echo $user_name;?>!</h1>
        </div>
    </div>
    <div class="row">
            <div class="col-sm-12" style="padding:4px;">
                <div class="card text-bg-warning">
                    <div class="card-header"><h5>Testing</h5></div>
                    <div class="card-body">
                        <p class="card-text">Sebagian fitur masih belum tersedia dan masih berupa placeholder.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-6" style="padding:4px;">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-success"><i class="fa-solid fa-cash-register"> </i> Pemasukan</h3>
                        <h3 class="text-success">Rp. 9.xxx.xxx</h3>
                        <a href="#" class="text-decoration-none fst-italic text-success">Atur Pemasukan <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6" style="padding:4px;">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-danger"><i class="fa-solid fa-hand-holding-dollar"></i> Pengeluaran</h3>
                        <h3 class="text-danger">Rp. 9.xxx.xxx</h3>
                        <a href="#" class="text-decoration-none fst-italic text-danger">Atur Pengeluaran <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>