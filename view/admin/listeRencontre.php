<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<div>
    <h2><?= $championnat -> nomChampionnat . ' ' . $championnat -> typeChampionnat . ' Division ' . $championnat -> idDivision . " " . (isset( $championnat -> nomPoule ) ? "Poule " . $championnat -> nomPoule : "Poule unique"); ?>
        : </h2>
</div>
<hr>
<h2>Liste des rencontres</h2>
<hr>
<table style='text-align:center' class="data-table sober">
    <?php
    $cpt = 0;
    foreach ( $rencontre as $r ) :
        ?>
        <tr>
            <td style='width:10%'>
                <?php
                foreach ( $equipes as $e ) {
                    if ( $e[ 0 ] -> idEquipe === $r -> idEquipeA ) {
                        echo $e[ 0 ] -> nomEquipe;
                        break;
                    }
                }
                ?>
            </td>
            <td style='width:5%'> <?= isset( $r -> scoreFinalA ) ? $r -> scoreFinalA : '?' ?> </td>
            <td style='width:5%'> -</td>
            <td style='width:5%'> <?= isset( $r -> scoreFinalB ) ? $r -> scoreFinalB : '?' ?> </td>
            <td style='width:10%'>
                <?php
                foreach ( $equipes as $e ) {
                    if ( $e[ 0 ] -> idEquipe === $r -> idEquipeB ) {
                        echo $e[ 0 ] -> nomEquipe;
                        break;
                    }
                }
                ?>
            </td>
            <?php
            $typeMatch = "";
            foreach ( $equipes as $e ) {
                if ( $e[ 0 ] -> idEquipe === $r -> idEquipeB or $e[ 0 ] -> idEquipe === $r -> idEquipeA ) {
                    if ( $e[ 0 ] -> idClub != 10 ) {
                       $typeMatch = "standard";
                    } else {
                        $typeMatch = "SMASH";
                        break;
                    }
                }
            }
                    ?>
                    <td style='width:20%'>
                        <a href="<?php
                        if ( $typeMatch == "standard") {
                            echo BASE_URL . "/admin/formRencontre/?idRencontre=" . $r -> idRencontre . "&championnat=" . $championnat -> idChampionnat;
                        } else {
                            echo BASE_URL .
                                "/admin/formRencontreSMASH/?idRencontre=" . $r -> idRencontre . "&championnat=" . $championnat -> idChampionnat;
                        }
                        ?>" class="button primarybuttonBlue col-lg text-center">Feuille de Match <?= $typeMatch
                          ?> </a>
                    </td>


                <?php
            ?>


            <td style='width:25%'>
                <a href="<?php echo BASE_URL .
                    "/admin/formRencontreDetail/?idRencontre=" . $r -> idRencontre . "&championnat=" . $championnat -> idChampionnat ?>"
                   class="button primarybuttonWhite col-lg text-center">Saisie détail des matchs</a>
            </td>

        </tr>
    <?php

    endforeach;
    echo '</table>';
    require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>
