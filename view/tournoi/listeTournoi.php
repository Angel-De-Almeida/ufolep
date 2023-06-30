<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

<h2>Tournois</h2>
<hr>
<a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "championnat/liste" ?>">Acceuil</a>
<br>
<br>

<table class="data-table sober">
    <thead>
        <tr>
            <th>Nom du tournoi</th>
            <th>Lieu</th>
            <th>Catégorie</th>
            <th>Date du tournoi</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Tournois as $tournoi) { ?>
            <tr>
                <td><?= $tournoi['libelle'] ?></td>
                <td><?= $tournoi['lieu'] ?></td>
                <td><?= $tournoi['categorie'] ?></td>
                <td><?= $tournoi['dateTournoi'] ?></td>
                <td>
                    <a href="<?= BASE_URL . DS . "tournoi" . DS . "listeMatchIndividuel/" . $tournoi['idTournoi'] ?>" class="button primarybuttonBlue"> Voir les matchs </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>
