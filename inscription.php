<?php
    include 'assets/compos/database.php';
    include 'assets/compos/header.php';

    // Vérification si le formulaire a été soumis
    if(isset($_POST['singIn'])) {
        // Récupération des valeurs du formulaire
        $nom = $_POST['nom_client'];
        $prenom = $_POST['prenom_client'];
        $num_telephone = $_POST['num_tele_client'];
        $email = $_POST['email_client'];
        $adresse = $_POST['adresse_client'];
        $mot_de_passe = $_POST['motdepasse_client'];
        $confirm_mot_de_passe = $_POST['confirm_motdepasse_client'];
        $message = "";

        // Vérification si les mots de passe correspondent
        if($mot_de_passe == $confirm_mot_de_passe) {
            // Vérification si l'email existe déjà dans la base de données
            $sql_check_email = "SELECT * FROM client WHERE email='$email'";
            $result_check_email = mysqli_query($conn, $sql_check_email);
            if(mysqli_num_rows($result_check_email) > 0) {
                $message =  "L'email est déjà utilisé.";
            } else {
                // Hashage du mot de passe
                $mot_de_passe_hash = md5($mot_de_passe);

                // Requête d'insertion
                $sql = "INSERT INTO client (nom_client, prenom_client, email, num_tel,  adresse, mot_de_passe) VALUES ('$nom', '$prenom', '$email', '$num_telephone', '$adresse', '$mot_de_passe_hash')";
                mysqli_query($conn, $sql);
                $message_e =  "Inscription réussie.";
            }
        } else {
            $message = "Les mots de passe ne correspondent pas.";
        }
    }
?>

    <div class="container">

        <div class="sing-in-form mt-3 mb-3">
        
            <!-- TITRE FORMULAIRE D'INSCRIPTION -->
            <h3 class="mb-3 text-center">Créer votre compte client</h3> 
            <?php if (!empty($message)) { ?>
                <div class="alert alert-danger mt-3">
                    <?php echo $message; ?> 
                </div>
            <?php } ?>
            <?php if (!empty($message_e)) { ?>
                <div class="alert alert-success mt-3">
                    <?php echo $message_e; ?> 
                </div>
            <?php } ?>
            <!-- FORMULAIRE D'INSCRIPTION -->
            <form class="bg-light p-3 border" method="POST">
                <div class="row">
    
                    <!-- nom du client -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nom_client">Nom *</label>
                            <input type="text" class="form-control" id="nom_client" name="nom_client" value="" placeholder="Saisir votre nom..." required>
                        </div>
                    </div>
        
                    <!-- prénom du client -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="prenom_client">Prénom *</label>
                            <input type="text" class="form-control" id="prenom_client" name="prenom_client" value="" placeholder="Saisir votre prénom..." required>
                        </div>
                    </div>
        
                    <!--Numero de telephone du client-->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="date_depart">Numero de telephone *</label>
                            <input type="text" class="form-control datepicker" id="num_tele_client" name="num_tele_client" value="" placeholder="Sélectionner le Numero de telephone" required>
                        </div>
                    </div>
        
                    <!-- email du client -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="email_client">Email *</label>
                            <input type="email" class="form-control" id="email_client" name="email_client" value="" placeholder="Saisir votre adresse email..." required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="email_client">Adresse *</label>
                            <input type="text" class="form-control" id="adresse_client" name="adresse_client" value="" placeholder="Saisir votre adresse ..." required>
                        </div>
                    </div>
        
        
                    <!-- mot de passe du client -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="motdepasse_client">Mot de passe *</label>
                            <input type="password" class="form-control" id="motdepasse_client" name="motdepasse_client" placeholder="Saisir votre mot de passe..." required>
                        </div>
                    </div>
        
                    <!-- confirmation du mot de passe du client -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="confirm_motdepasse_client">Confirmation mot de passe *</label>
                            <input type="password" class="form-control" id="confirm_motdepasse_client" name="confirm_motdepasse_client" placeholder="Confirmer votre mot de passe..." required>
                        </div>
                    </div>
        
                    <!--boutton du formulaire  -->
                    <div class="col-12 mt-3">
                        <input type="submit" class="btn btn-primary" value="Valider" name="singIn">
                    </div>
        
                    <!-- lien vers incription -->
                    <div class="col-12 mt-3">
                        <p>Vous disposez d'un compte ? <a href="connexion.php">Connectez-vous...</a></p>
                    </div>
                </div>
        
            </form>
        </div>
        </div>
        
   
</body>
</html>
