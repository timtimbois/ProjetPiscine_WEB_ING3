<?php
session_start();
try {
	$bdd = new PDO('mysql:host=localhost;dbname=projetpiscineweb;charset=utf8', 'root', 'root');
}
catch (Exception $e){
	die('Erreur : ' . $e->getMessage());
}
if ($_POST['buttonlog2']) {
	$InputLogin = ($_POST['Login']);
	$InputMDP = ($_POST['MDP']);
	$InputType = ($_POST['type']);

	$Radio = ($_POST['radio']);

	
	if ($Radio=="Acheteur") {

		if (!empty($InputLogin) AND !empty($InputMDP)) {
			$reqconach = $bdd->prepare('SELECT * FROM acheteur where EmailAcheteur = ? AND MDPAcheteur = ?');
			$reqconach->execute(array($InputLogin, $InputMDP));

			$AcheteurExist = $reqconach->rowCount();

			if ($AcheteurExist == 1) {
				$AcheteurInfo = $reqconach->fetch();
				$_SESSION['PrenomAcheteur']= $AcheteurInfo['PrenomAcheteur'];
				$_SESSION['IDAcheteur'] = $AcheteurInfo['IDAcheteur'];
				$_SESSION['NomAcheteur'] = $AcheteurInfo['NomAcheteur'];
				$_SESSION['EmailAcheteur'] = $AcheteurInfo['EmailAcheteur'];
				$_SESSION['MDPAcheteur'] = $AcheteurInfo['MDPAcheteur'];
				$_SESSION['AdresseLigne1Acheteur'] = $AcheteurInfo['AdresseLigne1Acheteur'];
				$_SESSION['AdresseLigne2Acheteur'] = $AcheteurInfo['AdresseLigne2Acheteur'];
				$_SESSION['VilleAcheteur'] = $AcheteurInfo['VilleAcheteur'];
				$_SESSION['CodePostalAcheteur'] = $AcheteurInfo['CodePostalAcheteur'];
				$_SESSION['PaysAcheteur'] = $AcheteurInfo['PaysAcheteur'];
				$_SESSION['NumAcheteur'] = $AcheteurInfo['NumAcheteur'];
				$_SESSION['TypeCarteAcheteur'] = $AcheteurInfo['TypeCarteAcheteur'];
				$_SESSION['NumCarteAcheteur'] = $AcheteurInfo['NumCarteAcheteur'];
				$_SESSION['NomCarteAcheteur'] = $AcheteurInfo['NomCarteAcheteur'];
				$_SESSION['DatedExpAcheteur'] = $AcheteurInfo['DatedExpAcheteur'];
				$_SESSION['CodeSecuAcheteur'] = $AcheteurInfo['CodeSecuAcheteur'];

				header("Location: PageConnecté.php");
			} else {
				$Erreur = "mail ou mdp incorrect";
				
			}
		}else {
			$Erreur = "Tous les champs doivent être complétés !";
		}
	}else{


		if (!empty($InputLogin) AND !empty($InputMDP)) {
			$reqconvend = $bdd->prepare('SELECT * FROM vendeur where EmailVendeur = ? AND PseudoVendeur = ?');
			$reqconvend->execute(array($InputLogin, $InputMDP));

			$VendeurExist = $reqconvend->rowCount();

			if ($VendeurExist == 1) {
				$VendeurInfo = $reqconvend->fetch();
				$_SESSION['NomVendeur']= $VendeurInfo['NomVendeur'];
				$_SESSION['IDVendeur'] = $VendeurInfo['IDVendeur'];
				$_SESSION['PseudoVendeur'] = $VendeurInfo['PseudoVendeur'];
				$_SESSION['EmailVendeur'] = $VendeurInfo['EmailVendeur'];
				$_SESSION['PhotoVendeur'] = $VendeurInfo['PhotoVendeur'];
				$_SESSION['ImageVendeur'] = $VendeurInfo['ImageVendeur'];

				header("Location: PageConnecté1.php");
			} else {
				$Erreur = "mail ou mdp incorrect";
			}
		}else {
			$Erreur = "Tous les champs doivent être complétés !";
		}
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>EbayECE : Log in - Sign in</title>


	<!-- Bootstrap CSS CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<!-- MAKE A LINK WITH THE CSS TO CUSTOME IT -->
	<link href="index1.css" rel="stylesheet">

	<!-- SCROLLBAR CUSTOM CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

	<!-- Font Awesome JS = AUSSI POUR LES PETITS TRAIT A COTE DE SIDEBAR-->
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

	<!-- LIEN CSS POUR AVOIR LES ICONES TELECHARGÉES DEPUIS ICOMOON -->
	<link href="style.css" rel="stylesheet">


</head>

<body >

	<!-- SIDEBAR -->
	<div class="wrapper">

		<!-- Sidebar -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<h3>Ebay ECE</h3>
			</div>

			<ul class="list-unstyled components">
				<p>Sections</p>
				<li class="active">
					<!-- data toggle = collaps c'est pour drop down menu et la class pour ajouter le petit triangle a cote -->
					<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Catégories</a>
					<ul class="collapse list-unstyled" id="homeSubmenu">
						<li>
							<a href="#">Ferrailes ou Trésor</a>
						</li>
						<li>
							<a href="#">Bon pour le musée</a>
						</li>
						<li>
							<a href="#">Accesoire VIP</a>
						</li>

					</ul>
				</li>

				<li>
					<!-- aria expanded pour definir l'etat du menu deroullant false = ferme par exemple -->
					<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Achat</a>
					<ul class="collapse list-unstyled" id="pageSubmenu">
						<li>
							<a href="#">Enchéresr</a>
						</li>
						<li>
							<a href="#">Achetez le maintenant</a>
						</li>
						<li>
							<a href="#">Meilleure offre</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#">Vendre</a>
				</li>

				<li>
					<a href="#" class = "icon-user"> VotreCompte</a>
				</li>

				<li>
					<a href="#" class = "icon-cart"> Panier</a>
				</li>

				<li>
					<a href="AdminLogin.php" class = "icon-user"> Admin</a>
				</li>

			</ul>

			<ul class="list-unstyled CTAs">

				<li>
					<a href="PageAccueil.php" class="backhome">EbayECE : Home</a>
				</li>
			</ul>

			<ul>
				<p>CONTACT<br>
					37, quai de Grenelle, 75015 Paris, France <br>
					info@ebay.ece.fr <br>
					+33 01 02 03 04 05 <br>
					+33 01 03 02 05 04
				</p>
			</ul>

		</nav>




		<!-- Page Content -->
		<div id="content">
			<!-- LA BARRE BLANCHE DU HAUT -->
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">

					<button type="button" id="sidebarCollapse" class="btn btn-info">
						<i class="fas fa-align-left"></i>
						<span>BIENVENUE CHEZ EBAY ECE </span>
					</button>

					<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<i class="fas fa-align-justify"></i>
					</button>

				</div>
			</nav>


			<div class="container-fluid">

				<div class="rowA">
					<div class="col-lg-6">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Formulaire de connexion</h6>
							</div>
							<div class="card-body">
								<form action="PageLoginn.php" method="post">
									<table>
										<tr>
											<td>E-mail :</td>
											<td><input type="text" class="form-control" name="Login"></td>
										</tr>

										<tr>
											<td>Mot de passe :</td>
											<td><input type="password" class="form-control" name="MDP"></td>
										</tr>

										<tr>
											<td>Type d'utilisateur :</td>
											<td>
												<input type="radio" name="radio" value="Acheteur">Acheteur
												<input type="radio" name="radio" value="Vendeur">Vendeur
											</td>
										</tr>

										<tr>
											<td colspan="2" align="center">
												<input type="submit" class ="btn btn-primary"name="buttonlog2" value="Connexion">
											</td>

										</tr>
									</table>
									<?php
									if (isset($Erreur)) {
										echo '<font color="red">'.$Erreur.'</font>';
									}
									?>
								</form>



							</div>
						</div>
					</div>
				</div>


				<div class="rowA">
					<div class="col-lg-6">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Formulaire d'inscription</h6>
							</div>
							<div class="card-body">
								<p>Veuillez choisir entre vous inscrire ent tant qu'acheteur ou en tant que vendeur</p>
								<br>
								<br>
								<a href="InscriptionAcheteur.php"><button class="btn btn-primary">Acheteur</button></a>
								<br>
								<a href="InscriptionVendeur.php"><button class="btn btn-primary">Vendeur</button></a>


							</div>
						</div>
					</div>
				</div>


			</div>

			<!-- Footer -->
			<footer class="sticky-footer ">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>&copy; 2020 Copyright | Droit d'auteur: Tim et Dany</span>
						<a href="mailto:dany.tadrous.edu.ece.fr">dany.tadrous@edu.ece.fr</a>

					</div>
				</div>
			</footer>
			<!-- FIN DU Footer -->


		</div>

	</div>   






	<!-- jQuery CDN - Slim version (=without AJAX) -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<!-- jQuery Custom Scroller CDN = SLIDER -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function () {
			$("#sidebar").mCustomScrollbar({
				theme: "minimal"
			});

			$('#sidebarCollapse').on('click', function () {
				$('#sidebar, #content').toggleClass('active');
				$('.collapse.in').toggleClass('in');
				$('a[aria-expanded=true]').attr('aria-expanded', 'false');
			});
		});
	</script>

</body>
</html>
