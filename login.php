<?php
    require_once "loginprocess.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Manager - Login</title>
</head>

<!-- BS Initialize-->
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
<!-- FA Initialize -->
<script src="lib/font-awesome/js/solid.min.js"></script>
<script src="lib/font-awesome/js/fontawesome.min.js"></script>
<script src="lib/font-awesome/js/brands.min.js"></script>

<body style="background-color: rgb(81, 50, 252);">
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"><br></div>
            <div class="col-sm-4"></div>
        </div>

        <!--LOGIN TITLE CARD-->
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 card border-primary text-primary d-grid gap-2 col-11 mx-auto">
                <div class="card-body">
                    <h3><center><i class="fa-solid fa-money-bill-transfer"></i> Cash Management</center></h3>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
        <br>

        <!--LOGIN FORM CARD-->
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 card border-primary d-grid gap-2 col-11 mx-auto">
                <form action="" method="post">
                    <br>
                    <div class="form-group">
                        <input type="text" class="form-control" name="uname" maxlength="32" placeholder="Username...">
                    </div>

                    <br>
                    <div class="form-group">
                        <input type="password" class="form-control" name="passwd" placeholder="Password...">
                    </div>

                    <div class="form-group">
                        <p></p>
                        <label class="bmd-label-static text-danger"><?php echo $error_msg; ?></label>
                        <p></p>
                    </div>

                    <div class="form-group ">
                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button type="submit" class="btn btn-outline-primary btn-block" name="login"><i class="fa fa-sign-in" aria-hidden="true"> </i><b>  Login</b></button>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 card bg-danger text-white d-grid gap-2 col-11 mx-auto">
                <div class="card-body">
                    <p><center><b>2024 - Kelompok 1 Capstone Project</b></center></p>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>

    </div>
</body>
</html>