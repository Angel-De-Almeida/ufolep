<?php 
require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <div>
        <h2>Liste des équipes</h2>
        <hr>
        <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "championnat/liste" ?>">Acceuil</a>

        <table class="data-table">
            <thead>

            <tr>
                <th>Nom de l'équipe</th>
                <th>Club</th>
                <th>Division</th>
                <th>Info</th>
            </tr>

            </thead>
            <?php foreach ($equipes as $e) : ?>
                <tr>
                    <td> <?= $e->nomEquipe ?></td>
                    <td> <?= $e->nomClub ?></td>
                    <td> <?= $e->idDivision ?></td>
                    <td>
                       <a href="<?= BASE_URL ."/equipes/Equipe/?idEquipe=$e->idEquipe"?>">
                           <img src="https://e7.pngegg.com/pngimages/92/319/png-clipart-computer-icons-person-name-miscellaneous-computer-wallpaper.png" alt="Info" width="20" height="20"> 
                       </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>
