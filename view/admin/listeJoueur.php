<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<h2>Classement des joueurs</h2>
<hr>

    <a href="<?php echo BASE_URL . DS . "admin" . DS . "formJoueur" ?>"
       class="button primarybuttonBlue"><i class="fas fa-plus fa-sm"></i>&nbsp Nouveau joueur</a>

    <a href="<?php echo BASE_URL . DS . "admin" . DS . "formCsv" ?>"
       class="button primarybuttonBlue"><i class="fas fa-plus fa-sm"></i>&nbsp Import csv</a>
    <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeChampionnat" ?>">Retour au tableau de bord</a>


<table class="data-table">
    <thead>
    <tr>
        <th>Place</th>
        <th>Joueurs</th>
        <th>Score</th>
    </tr>
    </thead>
    <?php $place = 1;
    foreach ($joueurs as $j) : ?>
        <tr>
            <td><?= $place++ ?></td>
            <td><a href="<?= BASE_URL . '/joueur/detail/' . $j->idJoueur; ?>"
                   title="Cliquez pour modifier"><?= $j->nom . ' ' . $j->prenom ?></a></td>
            <td><?= $j->nbPoints ?></td>
        </tr>

    <?php endforeach; ?>
</table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>