<?php 
require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <div>
        <h2>Liste des Matchs Individuels</h2>
        <hr>
        <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "championnat/liste" ?>">Acceuil</a>

            <table border='1'class="data-table sober">
        <thead>
            <th>Joueurs A</th>
            <th>Joueurs B</th>
            <th>Manche 1</th>
            <th>Manche 2</th>
            <th>Manche 3</th>
            <th>Manche 4</th>
            <th>Manche 5</th>
            <th>Points A</th>
            <th>Points B</th>
            <th>Date</th>
            <th>Lieu</th>
        </thead>
        <?php foreach ($Matchs as $match) : ?>
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
                    <?php if (isset($match->PointsA)) {
                        echo $match->PointsA;
                    } else {
                        echo "N/A";
                    } ?>
                </td>
                <td>
                    <?php if (isset($match->PointsB)) {
                        echo $match->PointsB;
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
                <td>
                    <?php if (isset($match->lieu)) {
                        echo $match->lieu;
                    } else {
                        echo "N/A";
                    } ?>
                </td>
            </tr>
        <?php endforeach; ?>

        </table>
    </div>
    
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>
