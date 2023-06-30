<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <div>
        <h2>Liste des championnats</h2>
        <hr>

        <form method="post" action="<?= BASE_URL ?>">
            <table class="data-table sober">
                <?php foreach ($championnats as $c) : ?>
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
                    <td class="row">

                        <a href="<?php echo BASE_URL .
                            "/rencontre/liste/?idChampionnat=$c->idChampionnat&nomPoule=$c->nomPoule"
                        ?>" class="button primarybuttonBlue col-lg text-center">Calendrier et résultats</a>

                        <a href="<?php echo BASE_URL .
                            "/classement/classementPoule/?idChampionnat=$c->idChampionnat" ;
                             if (isset($nomPoule)) {
                                echo "&nomPoule=$nomPoule";
                             } ?>" 
                            class="button primarybuttonWhite col-lg text-center">Classement</a>
                    </td>

                </tr>
                <?php endforeach; ?>
            </table>
        </form>
    </div>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>