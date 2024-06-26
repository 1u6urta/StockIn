<?php
    include 'assets/compos/database.php';
    include 'assets/compos/header.php';
?>
    <section class="home">
        <div class="cercle cercle1"></div>
        <div class="cercle cercle2"></div>
        
        <div class="text">
            <h1>Découvrez<span class="Logo" > Stock<span class="red">In</span></span>: </h1>
            <h2>Présentez Vos Produits en Toute Simplicité</h2>
            <p class="phome">
                <b>StockIn</b> est votre allié digital pour mettre en avant les produits de votre supérette. Parcourez notre sélection variée, explorez les offres spéciales et nouveautés, et offrez à vos clients une expérience d'achat en ligne pratique et séduisante.
            </p>
            
        </div>
        <div class="homeimg">
            <img src="img/home.jpg" alt="">
        </div>
        <div class="cercle cercle3"></div>
        <div class="cercle cercle4"></div>
    </section>
    <div class="container" id="Produit">
        <div class="row">
            <div class="col-12">
                <div class="presentation-title text-center">
                    <h3>Nos idées pour <span class="title-voyager">Produit</span></h3>
                </div>
            </div>

            <?php 
                $sql = "SELECT * FROM `produit` LIMIT 4 OFFSET 4";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    // Parcourir chaque ligne de résultats
                    while($row = mysqli_fetch_assoc($result  ) )  {
            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="card rounded-lg sejour-card mt-4">
                    <div class="card-price">
                        <span class="card-montant ml-1" id="prix_<?php echo $row["id_produit"] ?>"><?php echo $row["prix_unit"]?></span><span class="text-uppercase ml-1">DZ</span>
                    </div>
                    <img src="img/produit/<?php echo $row["id_produit"]?>.png" class="card-img-top rounded-bottom-0 card-img" alt="image séjour">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase"   id="nom_<?php echo $row["id_produit"] ?>" ><?php echo $row["nom_produit"]?></h5>
                        <h6 class="card-country text-capitalize" id="libelle_<?php echo $row["id_produit"] ?>"><b><?php echo $row["libelle"]?></b></h6>
                        <div class="card-action">
                            <a  <?php if ( isset($_SESSION['id'])) { echo 'href="#Produit" onclick="ajouterAuPanier(',$row["id_produit"],')"';}  else {echo 'href="connexion.php"';} ?> class="btn btnop block card-btn text-capitalize">Ajoute au Panier</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
            <!-- afficher tout les séjours -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="text-center mt-5 mb-5">
                    <a href="produit.php" class="btn btnop text-uppercase btn-afficher">afficher tout les produit<i class="fas fa-angle-right ml-2"></i></a>
                </div>
            </div>

        </div>
    </div>

    <section class="about-section" id="A-propos">
        <div class="container-about">
            <h2><b>À Propos de Nous</b></h2>
            <p><b class="title"> Stock<span class="red">In</span></b> est une plateforme dédiée à simplifier la gestion des stocks pour les supérettes. Notre objectif est d'offrir aux propriétaires de supérettes une solution conviviale et efficace pour suivre et gérer leurs inventaires en ligne.</p>
            <p>Nous croyons fermement en l'importance de la numérisation des processus commerciaux pour aider les petites entreprises à prospérer. Avec StockIn, nous voulons aider les supérettes à maximiser leur efficacité opérationnelle et leur rentabilité.</p>
            <p>Nos équipes travaillent sans relâche pour fournir des outils de gestion des stocks simples, intuitifs et puissants. Nous sommes passionnés par l'innovation et l'amélioration continue, et nous nous engageons à soutenir nos clients à chaque étape de leur parcours.</p>
        </div>
    </section>

<?php
    include 'assets/compos/footer.php';
?>

<script>
    function ajouterAuPanier(idProduit) {
        var prix = document.getElementById('prix_' + idProduit).innerText;
        var nomProduit = document.getElementById('nom_' + idProduit).innerText;
        var libelle = document.getElementById('libelle_' + idProduit).innerText;

        var produit = {
            id: idProduit,
            nom: nomProduit,
            prix: parseFloat(prix),
            libelle: libelle
        };

        // Récupérer le panier depuis le localStorage
        var panier = JSON.parse(localStorage.getItem('panier')) || [];

        // Assurez-vous que panier est un tableau
        if (!Array.isArray(panier)) {
            panier = [];
        }

        // Ajouter le produit au panier
        panier.push(produit);

        // Enregistrer le panier mis à jour dans le localStorage
        localStorage.setItem('panier', JSON.stringify(panier));

    }
</script>