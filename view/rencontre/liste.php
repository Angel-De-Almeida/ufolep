<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>

    <div>
        <h2><?= $championnat->nomChampionnat . ' ' . $championnat->typeChampionnat . ' Division ' . $championnat->idDivision. " " . (isset($championnat->nomPoule)?"Poule ".$championnat->nomPoule:"Poule unique"); ?></h2>
    </div>
    <hr>

<?php
$cpt = 1;
$idJournee = $rencontres[0]['idJournee'];
?>

    <div>
        <h3><a href="<?= BASE_URL ?>/classement/classementPoule/?idChampionnat=<?= $championnat->idChampionnat ?>
    <?php if (isset($nomPoule)) {
                echo "&nomPoule=$nomPoule";
            } ?>"
            ><?php if (isset($nomPoule)) {
                echo 'Poule ' . $nomPoule;
            } ?></h3><h6>Classement des équipes</h6></a>


    </div>
    <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "championnat/liste" ?>">Retour aux championnats</a>
    <br>
    <div>
        <div class="col-lg-12">
            <table style="width:100%" class="data-table">
                <thead class="text-center">
                <th colspan="5">J<?= $cpt++ . '<br>' . $rencontres[0][0]['rencontre']->datePrev ?></th>
                </thead>
                <tbody>
                <?php
                foreach ($rencontres as $r):
                if ($r[0]['rencontre']->idJournee == $idJournee) {
                    ?>
                    <tr>
                        <td style='width:40%'><a
                                    href="<?php echo BASE_URL . '/joueur/liste/?idEquipe=' . $r[0]['rencontre']->idEquipeA ?>">
                                <?php
                                foreach ($equipes as $e) {
                                    if ($e->idEquipe == $r[0]['rencontre']->idEquipeA) {
                                        echo $e->nomEquipe;
                                        $_POST["idEquipe"]=$r[0]['rencontre']->idEquipeA;
                                    }
                                }
                                ?></a></td>
                        <td style='width:5%'> <?= isset($r[0]['rencontre']->scoreFinalA) ? $r[0]['rencontre']->scoreFinalA : '?' ?> </td>
                        <td style='width:5%'><a
                                    href="<?php echo BASE_URL . '/rencontre/detail/?idRencontre=' . $r[0]['rencontre']->idRencontre;
                                    if (isset($nomPoule)) {
                                        echo '&nomPoule=' . $nomPoule;
                                    } ?>"><i class="far fa-list-alt"></i></a></td>
                        <td style='width:5%'> <?= isset($r[0]['rencontre']->scoreFinalB) ? $r[0]['rencontre']->scoreFinalB : '?' ?> </td>
                        <td style='width:40%'><a
                                    href="<?php echo BASE_URL . '/joueur/liste/?idEquipe=' . $r[0]['rencontre']->idEquipeB ?>">
                                <?php
                                foreach ($equipes as $e) {
                                    if ($e->idEquipe == $r[0]['rencontre']->idEquipeB) {
                                        echo $e->nomEquipe;
                                        $_POST["idEquipe"]=$r[0]['rencontre']->idEquipeB;
                                    }
                                }
                                ?></a></td>
                    </tr>
                    <?php
                } else { ?>
                </tbody>
            </table>
            <hr>
        </div>
        <div class="col-lg-12">
            <table style="width:100%" class="data-table">
                <thead class="text-center">
                <th colspan="5">J<?= $cpt++ . '<br>' . $r[0]['rencontre']->datePrev ?></th>
                </thead>
                <tbody>
                <tr>
                    <td style='width:40%'><a
                                href="<?php echo BASE_URL . '/joueur/liste/?idEquipe=' . $r[0]['rencontre']->idRencontre ?>">
                            <?php
                            foreach ($equipes as $e) {
                                if ($e->idEquipe == $r[0]['rencontre']->idEquipeA) {
                                    echo $e->nomEquipe;
                                    $_POST["idEquipe"]=$r[0]['rencontre']->idEquipeA;
                                }
                            }
                            ?></a></td>
                    <td style='width:5%'> <?= isset($r[0]['rencontre']->scoreFinalA) ? $r[0]['rencontre']->scoreFinalA : '?' ?> </td>
                    <td style='width:5%'><a
                                href="<?php echo BASE_URL . '/rencontre/detail/?idRencontre=' . $r[0]['rencontre']->idRencontre;
                                (isset($nomPoule)) ? '&nomPoule=' . $nomPoule : "" ?>"><i
                                    class="far fa-list-alt"></i></a></td>
                    <td style='width:5%'> <?= isset($r[0]['rencontre']->scoreFinalB) ? $r[0]['rencontre']->scoreFinalB : '?' ?> </td>
                    <td style='width:40%'><a
                                href="<?php echo BASE_URL . '/joueur/liste/?idEquipe=' . $r[0]['rencontre']->idEquipeB ?>">
                        <?php
                        foreach ($equipes as $e) {
                            if ($e->idEquipe == $r[0]['rencontre']->idEquipeB) {
                                echo $e->nomEquipe;
                                $_POST["idEquipe"]=$r[0]['rencontre']->idEquipeB;
                            }
                        }
                        ?> </td>
                </tr>
                <?php $idJournee = $r[0]['rencontre']->idJournee;
                }
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>