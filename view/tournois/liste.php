<?php 
require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <div>
        <h2>Liste des Tournois</h2>
        <hr>
        <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "championnat/liste" ?>">Acceuil</a>

        <table class="data-table">
            <thead>

            <tr>
                <th>Noms des Tournois</th>
            </tr>

            </thead>
            <?php foreach ($Tournois as $t) : ?>
                <tr>
                    <td> <?= $t->nomTournois ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>
