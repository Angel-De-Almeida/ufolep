<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_top.php"; ?>



    <div>
    <h1><?= $rencontre[0]->nomChampionnat . ' ' . $rencontre[0]->typeChampionnat ?></h1>
    <h2><?php
        foreach ($divisions as $d) {
            if ($d->idDivision == $rencontre[0]->idDivision) {
                echo $d->nomDivision;
            }
        }
        ?>
    - <?= ((isset($nomPoule)&&$nomPoule!="")?"Poule".$nomPoule:"Poule unique"); ?>&nbsp; </h2><h3> <br>Journée N° <?= $rencontre[0]->numJournee ?></h3>
</div>
    <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "rencontre/liste".DS."?idChampionnat=".$rencontre[0]->idChampionnat."&nomPoule=" ?>">Retour à la liste </a>
    <br>
<hr>


<div>
    <table border=1 class="data-table sober">
        <tr>
            <td>Date : <?= $rencontre[0]->date ?></td>
            <td>Heure : <?= $rencontre[0]->heure ?></td>
            <td>Lieu : <?= $rencontre[0]->lieu ?></td>
        </tr>
        <tr>
            <td colspan="3">Nom et adresse du Juge Arbitre : 
    <?php foreach ($joueurs as $j) {
        if ($j->idJoueur == $rencontre[0]->idArbitre) {
            echo $j->nom . ' ' . $j->prenom;
        }
    } ?></td>
        </tr>
    </table>
</div>
<br>
<div>
    <table border=1 class="data-table sober">
        <thead class="text-center">
            <tr>
                <th colspan=4>Equipe <?php
                    $format = "NJ" ;
                                    foreach ($equipes as $e) {
                                        if ($e->idEquipe == $rencontre[0]->idEquipeA) {
                                            echo $e->nomEquipe;
                                            if ($e->idEquipe == 9){
                                                $format = "D";
                                            }
                                        }
                                    }
                                    ?></th>
                <th colspan=4>Equipe <?php
                                    foreach ($equipes as $e) {
                                        if ($e->idEquipe == $rencontre[0]->idEquipeB) {
                                            echo $e->nomEquipe;
                                            if ($e->idEquipe == 9){

                                                $format = "W";
                                            }
                                        }
                                    }
                                    ?></th>
            </tr>
            <tr>
                <th></th>
                <th>NOM PRENOM</th>
                <th>Licence</th>
                <th>Classement</th>
                <th></th>
                <th>NOM PRENOM</th>
                <th>Licence</th>
                <th>Classement</th>
            </tr>
        </thead>
        <tr>
        <?php for ($cpt = 0; $cpt < 4; $cpt++) : ?>
            <td><?php if ($cpt == 0) {
                    echo 'A';
                } elseif ($cpt == 1) {
                    echo 'B';
                } elseif ($cpt == 2) {
                    echo 'C';
                }
                elseif ($cpt == 3 && $format == "D") {
                    echo 'D';
                }



                ?>


            </td>
            <?php foreach ($joueurs as $j) {
                if ($j->idJoueur == $matchs[$cpt]->idJR) {
                    if  ($cpt == 3 && ($format == "NJ" || $format == "W" )) {
                        break;
                    }

                    echo '<td>' . $j->nom . ' ' . $j->prenom . '</td>';
                    echo '<td>' . mb_strtoupper($j->licenceJoueur) . '</td>';
                    echo '<td>' . $j->nbPoints . '</td>';
                }
            } ?>
            <td><?php if ($cpt == 0) {
                    echo 'X';
                } elseif ($cpt == 1) {
                    echo 'Y';
                } elseif ($cpt == 2) {
                    echo 'Z';
                }
                elseif ($cpt == 3 && $format == "W" ) {
                    echo 'W';
                }



                ?>






            </td>
            <?php foreach ($joueurs as $j) {
                if  ($cpt == 3 && ($format == "NJ" || $format == "D" )) {
                    break;
                }
                if ($j->idJoueur == $matchs[$cpt]->idJV) {
                    echo '<td>' . $j->nom . ' ' . $j->prenom . '</td>';
                    echo '<td>' . mb_strtoupper($j->licenceJoueur) . '</td>';
                    echo '<td>' . $j->nbPoints . '</td>';
                }
            } ?>
        </tr>
            <?php endfor; ?>
    </table>
</div>
<br>
<div>
    <table border='1'class="data-table sober">
        <thead>
            <th></th>
            <th>Joueurs ABC</th>
            <th>Joueurs XYZ</th>
            <th>Manche 1</th>
            <th>Manche 2</th>
            <th>Manche 3</th>
            <th>Manche 4</th>
            <th>Manche 5</th>
            <th>Points ABC</th>
            <th>Points XYZ</th>
        </thead>
        <?php $cpt = 0;
        foreach ($matchs as $match) : ?>
            <tr>
                <td><?= $typeRencontre[$cpt];
                    $cpt++ ?></td>
                <td>
                    <?php foreach ($joueurs as $j) {
                        if ($j->idJoueur == $match->idJR) {
                            echo $j->nom;
                        }
                    } ?>
                </td>
                <td>
                    <?php foreach ($joueurs as $j) {
                        if ($j->idJoueur == $match->idJV) {
                            echo $j->nom;
                        }
                    } ?>
                </td>
                <td><?= $match->M1  ?></td>
                <td><?= $match->M2  ?></td>
                <td><?= $match->M3  ?></td>
                <td><?= ($match->M4 != 0) ? $match->M4 : '-'; ?></td>
                <td><?= ($match->M5 != 0) ? $match->M5 : '-'; ?></td>
                <td><?= ($match->pointsA != 0) ? $match->pointsA : '-'; ?></td>
                <td><?= ($match->pointsB != 0) ? $match->pointsB : '-'; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
                <td>Double</td>
                <td colspan="2"></td>
                <td><?= $rencontre[0]->D1 ?></td>
                <td><?= $rencontre[0]->D2 ?></td>
                <td><?= $rencontre[0]->D3 ?></td>
                <td><?= ($rencontre[0]->D4 != 0) ? $rencontre[0]->D4 : '-'; ?></td>
                <td><?= ($rencontre[0]->D5 != 0) ? $rencontre[0]->D5 : '-'; ?></td>
                <td><?= ($rencontre[0]->ptsDbA != 0) ? $rencontre[0]->ptsDbA :'-'; ?></td>
                <td><?= ($rencontre[0]->ptsDbB != 0) ? $rencontre[0]->ptsDbB :'-'; ?></td>
        </tr>
        <tr>
            <td colspan="8">Score de le rencontre</td>
            <td><?= $rencontre[0]->scoreFinalA ?></td>
            <td><?= $rencontre[0]->scoreFinalB ?></td>
        </tr>
    </table>
</div>
<br>
<div>
    <table border=1 class="data-table sober">
        <thead  class="text-center">
            <th colspan=3>Résultats</th>
        </thead>
    <?php ($rencontre[0]->scoreFinalA < $rencontre[0]->scoreFinalB) ?
            $idEquipe = $rencontre[0]->idEquipeB : $idEquipe = $rencontre[0]->idEquipeA; ?>
    <tbody>
        <tr>
            <?php  if($rencontre[0]->scoreFinalA == $rencontre[0]->scoreFinalB) {
            echo "<td>Match Nul</td>";
            } else {?>
                <td>Victoire de l'équipe : </td>
                <td>
                    <?php
                    foreach ($equipes as $e) {
                        if ($e->idEquipe == $idEquipe) {
                            echo $e->nomEquipe;
                        }
                    }
                    ?>
                </td>
            <?php } ?>
        </tr>
        <tr>
            <td>Score : </td>
            <td><?php if ($rencontre[0]->scoreFinalA > $rencontre[0]->scoreFinalB) 
            {echo $rencontre[0]->scoreFinalA . ' / ' . $rencontre[0]->scoreFinalB;}
            else {echo $rencontre[0]->scoreFinalB . ' / ' . $rencontre[0]->scoreFinalA;} ?></td>
        </tr>
        
    </tbody>
    </table>
</div>
<br>
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "guest" . DS . "_guest_bottom.php"; ?>