<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

<h2><?= mb_strtoupper($joueur->nom) .' '. $joueur->prenom ?></h2>    <h3> <?= $joueur->nomEquipe ?></h3>
<br>
<h3> Changer le classement</h3>
<hr>

<form method="post"

<div>
    <b>Modification du classement :</b>
    <label for="score"> <input type="number" value="<?= $joueur->nbPoints ?>" name="score"> </label>
</div>
<?php  // var_dump ($joueur->nbPoints); ?>
<hr>
<a class="button primarybuttonBlue" href="<?= BASE_URL . DS . "joueur" . DS . "detail". DS . $joueur->idJoueur ?>">Retour</a>
<input type="submit" value="Enregistrer" class="primarybuttonRed" name="saisie">

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>
