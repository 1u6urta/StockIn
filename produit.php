
<?php
    include 'assets/compos/database.php';
    include 'assets/compos/header.php';
?>
    <div class="cercle cercle1"></div>
        
    <div class="cercle cercle2"></div>
    <div class="cercle cercle3"></div>
    <div class="cercle cercle4"></div>    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="presentation-title text-center">
                    <h3>Nos <span class="title-voyager">Produit</span></h3>
                </div>
            </div>

            <?php 
                $sql = "SELECT * FROM `produit`p WHERE p.quantite > 0 ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    // Parcourir chaque ligne de résultats
                    while($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="card rounded-lg sejour-card mt-4">
                    <div class="card-price">
                        <span class="card-montant ml-1" id="prix_<?php echo $row["id_produit"] ?>"><?php echo $row["prix_unit"]?></span><span class="text-uppercase ml-1">DZ</span>
                    </div>
                    <img src="img/produit/<?php echo $row["id_produit"]?>.png" class="card-img-top rounded-bottom-0 card-img" alt="image <?php echo $row["nom_produit"]?>">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase"   id="nom_<?php echo $row["id_produit"] ?>" ><?php echo $row["nom_produit"]?></h5>
                        <h6 class="card-country text-capitalize" id="libelle_<?php echo $row["id_produit"] ?>"><b><?php echo $row["libelle"]?></b></h6>
                        <div class="card-action">
                            <a  <?php if ( isset($_SESSION['id'])) { echo 'href="#" onclick="ajouterAuPanier(',$row["id_produit"],')"';}  else {echo 'href="connexion.php"';} ?> class="btn btnop block card-btn text-capitalize">Ajoute au Panier</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>  
        </div>
        </div>
    </div>
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