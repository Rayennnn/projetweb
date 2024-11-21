<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/clubC.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Créer une instance du contrôleur
    $clubC = new ClubC();

    // Créer une instance de votre classe Club (modifiez selon votre modèle)
    $club = new Club(
        null, // L'ID du club est souvent généré automatiquement par la base de données
        $_POST['nom_club'] ?? '', // Récupérer le nom du club
        $_POST['description'] ?? '', // Description
        $_POST['date_creation'] ?? 'now', // Date de création, 'now' par défaut
        $_POST['categorie'] ?? '', // Catégorie
        $_POST['lieu'] ?? '', // Lieu
        $_FILES['logo']['name'] ?? '', // Nom du fichier logo, récupéré via $_FILES
        $_POST['lien'] ?? '' // Lien du club
    );

    // Charger et enregistrer le fichier logo si fourni
    if (!empty($_FILES['logo']['tmp_name'])) {
        $targetDirectory = '../../uploads/logos/'; // Dossier où enregistrer les logos
        $targetFile = $targetDirectory . basename($_FILES['logo']['name']);
        move_uploaded_file($_FILES['logo']['tmp_name'], $targetFile);
    }

    
        // Appeler la méthode pour ajouter un club
        $clubC->addClub($club);
        
        // Redirection vers listClubs.php après succès
        header("Location: listClubs.php");
        exit();
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

                        <div class="col-lg-8">
							<section class="card">
								<header class="card-header">
									<h2 class="card-title">Ajouter un Club</h2>
								</header>
								<div class="card-body">
									<form class="form-horizontal form-bordered" method="POST" action="" enctype="multipart/form-data">
										<!-- Nom du Club -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Nom du Club</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="nom_club" required>
												<span class="error-message" id="nomError" style="color:red;"></span>
											</div>
										</div>

										<!-- Description -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Description</label>
											<div class="col-lg-9">
												<textarea class="form-control" rows="3" name="description" required></textarea>
												<span class="error-message" id="descriptionError" style="color:red;"></span>
											</div>
										</div>

										<!-- Date de Création -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Date de Création</label>
											<div class="col-lg-9">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<input type="date" class="form-control" name="date_creation" required>
												</div>
											</div>
										</div>

										<!-- Catégorie -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Catégorie</label>
											<div class="col-lg-9">
												<select class="form-control" name="categorie" required>
													<option value="Culture">Culture</option>
													<option value="Sport">Sport</option>
													<option value="Technologie">Technologie</option>
													<option value="Art">Art</option>
													<option value="Social">Social</option>
													<option value="Scientifique">Scientifique</option>
													<option value="Environnement">Environnement</option>
												</select>
											</div>
										</div>

										<!-- Lieu -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Lieu</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="lieu" required>
											</div>
										</div>

										<!-- Logo -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Logo</label>
											<div class="col-lg-9">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="input-append">
														<div class="uneditable-input">
															<i class="fa fa-file fileupload-exists"></i>
															<span class="fileupload-preview"></span>
														</div>
														<span class="btn btn-default btn-file">
															<span class="fileupload-exists">Changer</span>
															<span class="fileupload-new">Sélectionner</span>
															<input type="file" name="logo" required>
														</span>
														<span class="error-message" id="logoError" style="color:red;"></span>
													</div>
												</div>
											</div>
										</div>

										<!-- Lien -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Lien</label>
											<div class="col-lg-9">
												<input type="url" class="form-control" name="lien" required>
											</div>
										</div>

										<!-- Boutons -->
										<div class="form-group row">
											<div class="col-lg-9 offset-lg-3">
												<button type="submit" class="btn btn-primary">Ajouter Club</button>
												<button type="reset" class="btn btn-default">Réinitialiser</button>
											</div>
										</div>
									</form>
								</div>
							</section>
						</div>
                        <script src="assets/js/formulaire.js"></script>


</body>
</html>