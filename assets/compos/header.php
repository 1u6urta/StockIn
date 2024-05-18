<?php 
    session_start();
    $url = $_SERVER['REQUEST_URI'];
    $nom_de_page = basename($url);
?>
<!-- <i class="fa-solid fa-cart-shopping"></i> -->
<!-- <i class="fa-solid fa-user"></i> -->
<html lang="fr">

<head>
    <meta charset="UTF-16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- le titre -->
    <title></title>
    <!-- LES STYLES -->
    <?php 
        $admin = "";
        if ( $nom_de_page == "admin" || $url == "/StockIn/admin/index.php"  ) {
            $admin = "../";
        }
    ?>
    
    <link rel="stylesheet" href="<?php echo $admin;?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $admin;?>assets/css/datepicker.css">
    <link rel="stylesheet" href="<?php echo $admin;?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $admin;?>assets/css/all.min.css">
    <!-- FIN LES STYLES -->
</head>

<body>

    <!------------------------------- LE HEADER ------------------------------->
    <header class="header">

        <!--------------- LA NAVBAR --------------->
        <nav class="navbar navbar-administration navbar-expand-lg fixed-top shadow">
            <!-- logo de la navbar -->
            <a class="navbar-brand" href="<?php echo $admin;?>index.php"><h1 class="Logo" > Stock<span class="red">In</span></h1></a>
            <!-- logo de la navbar -->

            <!-- boutton toggler -->
            <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- lien de la navbar collapse -->
            <div class="collapse navbar-collapse " id="navbarCollapse">
                <ul class="navbar-nav  ml-auto flex-nowrap ">
                    <li class="nav-item mr-5">
                        <a class="nav-link  active" href="<?php echo $admin;?>index.php">Accueil</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="<?php echo $admin;?>produit.php">Produits</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="<?php echo $admin;?>index.php#A-propos">À propos</a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse " id="navbarCollapse">
                <ul class="navbar-nav  ml-auto flex-nowrap   <?php if ( isset($_SESSION['id'])) { echo 'd-none';}?> ">
                    <li class="nav-item">
                        <a class="nav-link btn btn-light btn-sm text-dark btn-sing-in-navbar <?php if ($nom_de_page == "inscription.php") { echo 'd-none'; } ?>" href="<?php echo $admin;?>inscription.php">
                            Sign up
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary btn-sm text-white btn-log-in-navbar <?php if ($nom_de_page == "connexion.php") { echo 'd-none'; } ?>" href="<?php echo $admin;?>connexion.php">
                            Login
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav  ml-auto flex-nowrap   <?php if ( ! isset($_SESSION['id'])) { echo 'd-none';}?> ">
                <div class="dropdown">
                    <button class="dropbtn"><i class="fa fa-user   sidebar--btn--icon icon-32"></i></button>
                    <div class="dropdown-content">
                        <a href="panier.php"><i class="fa-solid fa-cart-shopping"></i>Panier</a>
                        <a href="assets/compos/deconnexion.php?logout=user">Log out</a>
                    </div>
                </div>
                </ul>
            </div>
        </nav>

    </header>
