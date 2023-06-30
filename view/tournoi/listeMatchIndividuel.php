<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

<div>
    <h2><?php echo $tournoi->libelle; ?></h2>
    <p>Date : <?php echo $tournoi->dateTournoi; ?></p>
    <p>Lieu : <?php echo $tournoi->lieu; ?></p>
    <p>Catégorie : <?php echo $tournoi->categorie; ?></p>
        <hr>
        <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "championnat/liste" ?>">Acceuil</a>
        <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "tournoi/listeTournoi" ?>">Retour</a>
            <table border='1'class="data-table sober">
        <thead>
            <th>Joueurs A</th>
            <th>Joueurs B</th>
            <th>Manche 1</th>
            <th>Manche 2</th>
            <th>Manche 3</th>
            <th>Manche 4</th>
            <th>Manche 5</th>
            <th>Forfait</th>
            <th>Tour</th>
            <th>Date</th>
        </thead>
        <?php foreach ($matches as $match): ?>
            <tr>
                <td>
                    <?php if (isset($match->JR)) {
                        echo $match->JR;
                    } else {
                        echo "N/A";
                    } ?>
                </td>
                <td>
                    <?php if (isset($match->JV)) {
                        echo $match->JV;
                    } else {
                        echo "N/A";
                    } ?>
                </td>
                <td>
                    <?php if (isset($match->M1)) {
                        echo $match->M1;
                    } else {
                        echo "N/A";
                    } ?>
                </td>
                <td>
                    <?php if (isset($match->M2)) {
                        echo $match->M2;
                    } else {
                        echo "N/A";
                    } ?>
                </td>
                <td>
                    <?php if (isset($match->M3)) {
                        echo $match->M3;
                    } else {
                        echo "N/A";
                    } ?>
                </td>
                <td>
                    <?php if (isset($match->M4)) {
                        echo $match->M4;
                    } else {
                        echo "N/A";
                    } ?>
                </td>
                <td>
                    <?php if (isset($match->M5)) {
                        echo $match->M5;
                    } else {
                        echo "N/A";
                    } ?>
                </td>
                <td>
                    <?php if (isset($match->forfait)) {
                        echo $match->forfait;
                    } else {
                        echo "J";
                    } ?>
                </td>
                <td>
                    <?php if (isset($match->tour)) {
                        echo $match->tour;
                    } else {
                        echo "N/A";
                    } ?>
                </td>
                <td>
                    <?php if (isset($match->date)) {
                        echo $match->date;
                    } else {
                        echo "N/A";
                    } ?>
                </td>
            </tr>
        <?php endforeach; ?>

        </table>
    </div>
    
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>
