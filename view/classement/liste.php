<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>


    <h2><?= $championnat[0]->nomChampionnat . " " . $championnat[0]->typeChampionnat . " Division " . $championnat[0]->idDivision. " " . (isset($championnat[0]->nomPoule)?"Poule ".$championnat[0]->nomPoule:"Poule unique"); ?></h2>

    <h3>Classement des équipes</h3>
    <hr>

    <table class="data-table">
        <thead>
            <tr>
                <th>Place</th>
                <th>Équipes</th>
                <th>Score</th>
                <th>Goal average</th>
            </tr>
        </thead>
        <?php
            $place = 1;
            foreach ($classement as $c) : ?>
            <tr>
                <td><?= $place++ ?></td>
                <td><?= $c->nomEquipe ?></td>
                <td><?= $c->nbPoints ?></td>
                <td><?= $c->goalAverage ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>