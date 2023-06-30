<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2>Liste des championnats</h2>
    <hr>

    <a href="<?php echo BASE_URL . DS . "admin" . DS . "formChampionnat" ?>"
       class="button primarybuttonBlue">
        <i class="fas fa-plus fa-sm"></i>&nbsp Nouveau championnat</a>

    <table class="data-table sober">
        <?php  
        foreach ($championnats as $c) : ?>
           <tr>
                <td class="text-left">
                        <?= $c->nomChampionnat  ?>
                        &nbsp;
                        <?= $c->typeChampionnat  ?>
                        &ensp;
                        Division&nbsp;<?= $c->idDivision  ?>
                        &ensp;
                        <b><?= (isset($c->nomPoule)? "[Poule " . $c->nomPoule . "]":"[Poule unique]"); ?></b>
                </td>
                <td>
                    <a href="<?= BASE_URL . DS . "admin" . DS . "listeJournee/?idchampionnat=" . $c->idChampionnat
                    ?>" class="button primarybuttonBlue">Gérer</a>
                </td>
               <td>
                   <a href="<?= BASE_URL . DS . "admin" . DS . "modifChampionnat/?idchampionnat=" . $c->idChampionnat
                   ?>" class="button primarybuttonRed">Modifier</a>
               </td>
           </tr>
        <?php endforeach; ?>
    </table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>