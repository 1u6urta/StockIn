<?php
    session_start();
    include '../assets/compos/database.php';
    if ( ! isset($_SESSION['admin'])) {
        header("Location: index.php");
        exit();
    }
?>
<?php 
    if(isset($_POST['SupprimerProduit'])) {
        $id_produit = $_POST['SupprimerProduit'];
        
        $sql_delete = "DELETE FROM `produit` WHERE `id_produit` = $id_produit";
        
        if(mysqli_query($conn, $sql_delete)) {}
}
    if(isset($_POST['SupprimerClient'])) {
        $id_client = $_POST['SupprimerClient'];
        
        $sql_delete = "DELETE FROM `client` WHERE `id_client` = $id_client";
        
        if(mysqli_query($conn, $sql_delete)) {}
    }
    if(isset($_POST['SupprimerFournisseur'])) {
        $id_fournisseur = $_POST['SupprimerFournisseur'];
        
        $sql_delete = "DELETE FROM `fournisseur` WHERE `id_fournisseur` = $id_fournisseur";
        
        if(mysqli_query($conn, $sql_delete)) {}
    }
    if(isset($_POST['Livraisioncommande'])) {
        $id_commande = $_POST['Livraisioncommande'];
        $sql = "SELECT * FROM `commande` WHERE `id_commande` = $id_commande";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $date = date("Y-m-d"); 
        $id_client = $row['id_client'];

        $sql_INSERT = "INSERT INTO livraison (date, id_client, id_commande) VALUES ('$date', '$id_client', '$id_commande')";
        
        if(mysqli_query($conn, $sql_INSERT)) {}

        
    }
    if (isset($_POST['ajouteProduit'])) {
        $nom_produit = $_POST["nom_produit"];
        $libelle = $_POST["Libelle"];
        $prix_unit = $_POST["prix_unit"];
        $prix_achat = $_POST["prix_achat"];
        $quantite = $_POST["quantite"];
        $id_fournisseur = $_POST["id_fournisseur"];
        $sql = "INSERT INTO produit (nom_produit, libelle, prix_unit, prix_achat, quantite, id_fournisseur) VALUES ('$nom_produit', '$libelle', '$prix_unit', '$prix_achat', '$quantite', '$id_fournisseur')";

        if (mysqli_query($conn, $sql)) {}
    }
    if (isset($_POST['ajoutefourinsseur'])) {
        $nom_fournisseur = $_POST["nom_fourinsseur"];
        $telephone = $_POST["telephone"];
        $adresse = $_POST["Adresse"];

        $sql = "INSERT INTO fournisseur (nom, num_tel, adresse) VALUES ('$nom_fournisseur', '$telephone', '$adresse')";

        if (mysqli_query($conn, $sql)) {}
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord</title>

    <link rel="stylesheet" href="styles/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



    <link rel="stylesheet" href="styles/fontawesome.css">

    <script defer src="scripts/dashboard.js"></script>
 
    
</head>

<body>
    
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar--top">
                <a href="../index.php" class="logo">
                    <h1 class="Logo" > Stock<span class="red">In</span></h1>
                </a>

                <button class="sidebar--collapse-btn">
                    <svg class="icon-24" viewBox="0 0 32 32">
                        <path d="M20 7L11 16M11 16L20 25" fill="none" fill-rule="evenodd" stroke=currentColor
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <svg class="icon-24" viewBox="0 0 32 32">
                        <path d="M0 0L32 0L32 32L0 32L0 0L0 0Z" fill="none" fill-rule="evenodd" stroke="none" />
                        <path d="M7 7.98016L25 8.01981" fill-rule="evenodd" stroke=currentColor stroke-width="2" stroke-linecap="round" />
                        <path d="M7 23.0198L25 23.0198" fill-rule="evenodd" stroke=currentColor stroke-width="2" stroke-linecap="round" />
                        <path d="M7 15.0198L25 15.0198" fill-rule="evenodd" stroke=currentColor stroke-width="2" stroke-linecap="round" />
                    </svg>

                    <svg class="icon-24" viewBox="0 0 32 32">
                        <path d="M0 0L32 0L32 32L0 32L0 0L0 0Z" fill="none" fill-rule="evenodd" stroke="none" />
                        <path d="M7.16116 7.16116L24.8388 24.8388" fill-rule="evenodd" stroke=currentColor stroke-width="2" stroke-linecap="round" />
                        <path d="M7.16116 24.8388L24.8388 7.16116" fill-rule="evenodd" stroke=currentColor stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>

            <div class="sidebar--tab-controls">
                <button class="sidebar--btn tab-control tab-control__selected">
                    <i class="fa-solid fa-chart-simple"></i>
                    <p>Tableau de bord</p>
                </button>
                <button class="sidebar--btn tab-control">
                    <i class="fa-solid fa-bottle-water"></i>
                    <p>Produits</p>
                </button>
                <button class="sidebar--btn tab-control">
                    <i class="fa-solid fa-user"></i>
                    <p>Nos Clients</p>
                </button>
                <button class="sidebar--btn tab-control">
                    <i class="fa-solid fa-users"></i>
                    <p>Nos Fournisseur</p>
                </button>
                <button class="sidebar--btn tab-control">
                    <i class="fa-solid fa-people-carry-box"></i>
                    <p>Nos Livraison</p>
                </button>
                <button class="sidebar--btn tab-control">
                    <i class="fa-solid fa-box"></i>    
                    <p>Les Commandes</p>
                </button>
                <button class="sidebar--btn tab-control">
                    <i class="fa-solid fa-box"></i>    
                    <p>Ajoute Produit</p>
                </button>
                <button class="sidebar--btn tab-control">
                    <i class="fa-solid fa-box"></i>    
                    <p>Ajoute Fournisseur</p>
                </button>
            </div>

            <div class="sidebar--bottom">
                <div class="sidebar--divider"></div>
                <a href="../assets/compos/deconnexion.php?logout=admin" class="sidebar--btn">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>   
                    <p>Log Out</p>
                </a>
            </div>
        </div>

        <div class="content-wrapper">
            <header class="navbar">
                <div class="tab--headers">
                    <div class="tab--header tab--header__selected">
                        <p class="tab--title">Statistique</p>
                    </div>
                    <div class="tab--header">
                        <p class="tab--title">Produits</p>
                    </div>
                    <div class="tab--header">
                        <p class="tab--title">Nos Clients</p>
                    </div>
                    
                    <div class="tab--header">
                        <p class="tab--title">Nos Fournisseurs</p>
                    </div>
                    <div class="tab--header">
                        <p class="tab--title">Nos Livraison</p>
                    </div>
                    <div class="tab--header">
                        <p class="tab--title">Les Commandes</p>
                    </div>
                    <div class="tab--header">
                        <p class="tab--title">Ajoute Produit</p>
                    </div>
                    <div class="tab--header">
                        <p class="tab--title">Ajoute Fournisseur</p>
                    </div>
                </div>
            </header>
            
            <main class="tabs">
                <div class="tab tab__grades tab__selected">
                    <div class="tab--container">
                        <div class="chart-card--wrapper">
                            <div class="card card__compare">
                                <header class="card--header">
                                    <p class="card--title">Produits Vendus</p>
                                    <div class="compare-chart--info-wrapper">
                                        <div class="chart--info">
                                            <div class="chart--info-circle"></div>
                                            <p>Vendu</p>
                                        </div>
                                        <div class="chart--info">
                                            <div class="chart--info-circle"></div>
                                            <p>Disponibilité</p>
                                        </div>
                                    </div>
                                </header>
                                <main class="compare-chart">
                                    <div class="bars">
                                        <div class="bar--wrapper">
                                            <div style="height: 60%" data-value="2500" class="bar bar__s1"></div>
                                            <div style="height:45%" data-value="1200" class="bar bar__s2"></div>
                                            <p class="bar--text">1</p>
                                        </div>
                                        <div class="bar--wrapper">
                                            <div style="height:50%" data-value="2000" class="bar bar__s1"></div>
                                            <div style="height:45%" data-value="1600" class="bar bar__s2"></div>
                                            <p class="bar--text">2</p>
                                        </div>
                                        <div class="bar--wrapper">
                                            <div style="height:70%" data-value="3000" class="bar bar__s1"></div>
                                            <div style="height:23%" data-value="400" class="bar bar__s2"></div>
                                            <p class="bar--text">4</p>
                                        </div>
                                        <div class="bar--wrapper">
                                            <div style="height:91%" data-value="9500" class="bar bar__s1"></div>
                                            <div style="height:50%" data-value="3800" class="bar bar__s2"></div>
                                            <p class="bar--text">6</p>
                                        </div>
                                        
                                        <div class="bar--wrapper">
                                            <div style="height:20%" data-value="900" class="bar bar__s1"></div>
                                            <div style="height:8%" data-value="750" class="bar bar__s2"></div>
                                            <p class="bar--text">8</p>
                                        </div>
                                        
                                    </div>

                                    <div class="axises">
                                        <div class="axis">
                                            <p class="namber">10000</p>
                                            <div class="line"></div>
                                        </div>
                                        <div class="axis">
                                            <p class="namber">5000</p>
                                            <div class="line"></div>
                                        </div>
                                        <div class="axis">
                                            <p class="namber">2000</p>
                                            <div class="line"></div>
                                        </div>
                                        <div class="axis">
                                            <p class="namber">500</p>
                                            <div class="line"></div>
                                        </div>
                                        <div class="axis">
                                            <p class="namber">0</p>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </main>
                                
                            
                            </div>

                            <div class="card card__gauge">
                                <header class="card--header">
                                    <p class="card--title">Pourcentage de Vente</p>
                                </header>
                                <main class="gauge-chart--wrapper">
                                    <div class="gauge-chart">
                                        <svg class="gauge-chart--circles" viewBox="0 0 250 250">
                                            <circle class="gauge-chart--back" style="fill:none;stroke-width:23.8095"
                                                cx="121.04727" cy="126.98376" r="107.14255" StrockWidth="24"
                                                Radius="120" InnerRadius="108" id="circle880" />
                                            <circle class="gauge-chart--cc"
                                                style="fill:none;stroke-width:31.7459;stroke-linecap:round;stroke-miterlimit:4;stroke-dasharray:648.263, 648.263;stroke-dashoffset:248.015"
                                                cx="-126.98376" cy="121.04727" r="107.14255" StrockWidth="32"
                                                Radius="120" InnerRadius="104" Circumference="653.451271947"
                                                Arc="653.451271947" DashArray="653.451271947,653.451271947"
                                                transform="rotate(-90)" help="251.327412287" id="circle882" />
                                            <circle class="gauge-chart--exam"
                                                style="fill:none;stroke-width:39.6824;stroke-linecap:round;stroke-miterlimit:4;stroke-dasharray:623.331, 623.331;stroke-dashoffset:373.998;stroke-opacity:1"
                                                cx="-126.98376" cy="121.04727" r="107.14255" StrockWidth="40"
                                                Radius="120" InnerRadius="100" Circumference="628.318530718"
                                                Arc="628.318530718" DashArray="628.318530718,628.318530718"
                                                transform="rotate(-90)" id="circle884" />
                                        </svg>

                                        <p class="score score__large">
                                            63.5<span class="score--total">%</span>
                                        </p>
                                    </div>
                                    <div class="gauge-chart--info-wrapper">
                                        <div class="chart--info">
                                            <div class="chart--info-circle"></div>
                                            <p>Vendu</p>
                                        </div>
                                        <div class="chart--info">
                                            <div class="chart--info-circle"></div>
                                            <p>Pas encore</p>
                                        </div>
                                    </div>

                                </main>
                            </div>
                        </div>
                       
                    </div>
                  
                    
                </div>
           
                <div class="tab tab__produit">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <?php 
                                    $sql = "SELECT * FROM `produit`";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        // Parcourir chaque ligne de résultats
                                        while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                
                                    <div class="card-produit">
                                        <div class="card-image">
                                        <img src="../img/produit/<?php echo $row["id_produit"]?>.png" class="card-img-top rounded-bottom-0 card-img" alt="image <?php echo $row["nom_produit"]?>">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title text-uppercase"   id="nom_<?php echo $row["id_produit"] ?>" ><?php echo $row["nom_produit"]?></h4>
                                            <h6 class="card-country text-capitalize" id="libelle_<?php echo $row["id_produit"] ?>"><b><?php echo $row["libelle"]?></b></h6>
                                            <h6 class="card-price" ><?php echo $row["prix_unit"]?>DZ</h6>
                                        </div>
                                        <form method="POST" class="card-action">
                                            <button class="btn btnop block card-btn text-capitalize" name="SupprimerProduit" value="<?php echo $row["id_produit"]?>" >Supprimer Produit</button>
                                        </form>
                                    </div>
                                
                                <?php
                                    }
                                                                    
                                }
                                else {
                                    echo '<p class="messagenontouve">Aucun produit trouvé.</p>';
                                }
                                ?>  
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="tab tab__clients">
                    <div class="container">
                        <div class="row">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID Client</th>
                                    <th>Nom Client</th>
                                    <th>Prenom Client</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Adresse</th>
                                    <th>Suppression</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM `client`";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        // Parcourir chaque ligne de résultats
                                        while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <th class="item"><?php echo $row["id_client"];?></th>
                                        <th class="item"><?php echo $row["nom_client"];?></th>
                                        <th class="item"><?php echo $row["prenom_client"];?></th>
                                        <th class="item"><?php echo $row["email"];?></th>
                                        <th class="item"><?php echo $row["num_tel"];?></th>
                                        <th class="item"><?php echo $row["adresse"];?></th>
                                        <th>
                                        <form method="POST" class="card-action">
                                            <button class="btn btnop block card-btn text-capitalize" name="SupprimerClient" value="<?php echo $row["id_client"];?>" >Supprimer Client</button>
                                        </form>
                                        </th>
                                    </tr>
                                <?php
                                    }
                                    
                                }
                                else {
                                    echo '<p class="messagenontouve">Aucun client trouvé.</p>';
                                }
                                ?>  
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>

                <div class="tab tab__fournisseur">
                    <div class="container">
                        <div class="row">

                        <table>
                            <thead>
                                <tr>
                                    <th>ID Fournisseur</th>
                                    <th>Nom Fournisseur</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                    <th>Suppression</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM `fournisseur`";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        // Parcourir chaque ligne de résultats
                                        while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <th class="item"><?php echo $row["id_fournisseur"];?></th>
                                        <th class="item"><?php echo $row["nom"];?></th>
                                        <th class="item"><?php echo $row["adresse"];?></th>
                                        <th class="item"><?php echo $row["num_tel"];?></th>
                                        <th>
                                        <form method="POST" class="card-action">
                                            <button class="btn btnop block card-btn text-capitalize" name="SupprimerFournisseur" value="<?php echo $row["id_fournisseur"];?>" >Supprimer Fournisseur</button>
                                        </form>
                                        </th>
                                    </tr>
                                <?php
                                    }
                                    
                                }
                                else {
                                    echo '<p class="messagenontouve">Aucun fournisseur trouvé.</p>';
                                }
                                ?>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab tab__livraison">
                    <div class="container">
                        <div class="row">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID Livraison</th>
                                    <th>Date Livraison</th>
                                    <th>ID Client</th>
                                    <th>ID Commande</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM `livraison`";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        // Parcourir chaque ligne de résultats
                                        while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <th class="item"><?php echo $row["id_livraison"];?></th>
                                        <th class="item"><?php echo $row["date"];?></th>
                                        <th class="item"><?php echo $row["id_client"];?></th>
                                        <th class="item"><?php echo $row["id_commande"];?></th>
                                    </tr>
                                <?php
                                    }
                                    
                                }
                                else {
                                    echo '<p class="messagenontouve">Aucun livraison trouvé.</p>';
                                }
                                ?>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab tab__commande">
                    <div class="container">
                        <div class="row">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID Commande</th>
                                    <th>Date Commande</th>
                                    <th>ID Client</th>
                                    <th>ID Produit</th>
                                    <th>Montant</th>
                                    <th>Livraision</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM `commande` c WHERE c.id_commande NOT IN (SELECT id_commande FROM `livraison`) ";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        // Parcourir chaque ligne de résultats
                                        while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <th class="item"><?php echo $row["id_commande"];?></th>
                                        <th class="item"><?php echo $row["date"];?></th>
                                        <th class="item"><?php echo $row["id_client"];?></th>
                                        <th class="item"><?php echo $row["id_produit"];?></th>
                                        <th class="item"><?php echo $row["montant"];?></th>
                                        <th>
                                        <form method="POST" class="card-action">
                                            <button class="btn btnop block card-btn text-capitalize" name="Livraisioncommande" value="<?php echo $row["id_commande"];?>" >Livraision Commande</button>
                                        </form>
                                        </th>
                                    </tr>
                                <?php
                                    }
                                    
                                }
                                else {
                                    echo '<p class="messagenontouve">Aucun commande trouvé.</p>';
                                }
                                
                                ?>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab tab_ajoute_produit" >
                <div class="container">
                <form class="border" method="POST">    
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nom_produit">Nom *</label>
                            <input type="text" class="form-control" id="nom_produit" name="nom_produit" value="" placeholder="Saisir le nom de produit..." required>
                        </div>
                    </div>
        
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Libelle">Libelle *</label>
                            <input type="text" class="form-control" id="Libelle" name="Libelle" value="" placeholder="Saisir Libelle..." required>
                        </div>
                    </div>
        
                    <div class="col-12">
                        <div class="form-group">
                            <label for="prix_unit">Prix Unit *</label>
                            <input type="text" class="form-control datepicker" id="prix_unit" name="prix_unit" value="" placeholder="Sélectionner le prix unit" required>
                        </div>
                    </div>
        
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label for="prix_achat">Prix Achat *</label>
                            <input type="text" class="form-control datepicker" id="prix_achat" name="prix_achat" value="" placeholder="Sélectionner le prix chat" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="quantite">Quantite *</label>
                            <input type="text" class="form-control" id="quantite" name="quantite" value="" placeholder="Sélectionner la quantite" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="id_fournisseur">ID Fournisseur *</label>
                            <input type="text" class="form-control" id="id_fournisseur" name="id_fournisseur" value="" placeholder="Saisir ID Fournisseur..." required>
                        </div>
                    </div>        
                    <div class="col-12 mt-3">
                        <input type="submit" class="btn btnop btn-primary" value="Ajoute Produit" name="ajouteProduit">
                    </div>
                </form>
                            </div>
            </div>

            <div class="tab tab_ajoute_fourinsseur" >
                <div class="container">
                <form class="border" method="POST">    
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nom_fourinsseur">Nom *</label>
                            <input type="text" class="form-control" id="nom_fourinsseur" name="nom_fourinsseur" value="" placeholder="Saisir le nom de fourinsseur..." required>
                        </div>
                    </div>
        
                    <div class="col-12">
                        <div class="form-group">
                            <label for="telephone">Telephone *</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" value="" placeholder="Saisir telephone..." required>
                        </div>
                    </div>
        
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Adresse">Adresse *</label>
                            <input type="text" class="form-control datepicker" id="Adresse" name="Adresse" value="" placeholder="Saisir Adresse" required>
                        </div>
                    </div>
                    
                    <div class="col-12 mt-3">
                        <input type="submit" class="btn btnop btn-primary" value="Ajoute Fourinsseur" name="ajoutefourinsseur">
                    </div>
                </form>

            </div>
        </div>
            </main>
        </div>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>