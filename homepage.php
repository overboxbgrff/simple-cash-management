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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">Simple Cash Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            </div>
        </div>
    </nav>

    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 300px;">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none" >
            <i class="fa-solid fa-money-bill"></i> Cash Manager
        </a>
    </div>

</body>
</html>