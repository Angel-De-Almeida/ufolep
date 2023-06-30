<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <div>
        <h2>Liste des anciens championnats</h2>
        <hr>

        <form method="post" action="<?= BASE_URL ?>">
            <table class="data-table sober">
                <?php foreach ($ancienChampionnats as $ac) : ?>
                    <tr>
                        <td class="text-left">
                            <?= $ac->nomChampionnat  ?>
                            &nbsp;
                            <?= $ac->typeChampionnat  ?>
                            &ensp;
                            Division&nbsp;<?= $ac->idDivision  ?>
                            &ensp;
                            <b><?= (isset($ac->nomPoule)? "[Poule " . $ac->nomPoule . "]":"[Poule unique]"); ?></b>
                        </td>
                        <td class="row">

                            <a href="<?php echo BASE_URL .
                                "/rencontre/liste/?idChampionnat=$ac->idChampionnat&nomPoule=$ac->nomPoule"
                            ?>" class="button primarybuttonBlue col-lg text-center">Calendrier et résultats</a>

                            <a href="<?php echo BASE_URL .
                                "/classement/classementPoule/?idChampionnat=$ac->idChampionnat" ;
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