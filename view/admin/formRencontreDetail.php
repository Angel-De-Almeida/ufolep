<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>
    <script type="text/javascript">
        function calculScore() {
            //alert("OK");
            var feuille = document.getElementById("feuilleDeMatch").rows;
            document.getElementById("calcul").style.color = "red";
            var nbSimples = feuille.length - 3;
            //alert("recup = "+nbMatchs);
            console.log("nb lignes = " + nbSimples);
            var scoreA = 0;
            var scoreB = 0;
            var vainqueur = new Array();
            var ptsA = new Array();
            var ptsB = new Array();
            //selection du form pour injecter des input
            var formulaire = document.getElementById("saisie");
            for (var i = 1; i < nbSimples; i++) {
                vainqueur[i] = 0;
                var colonnes = feuille[i].cells;//on récupère les cellules de la ligne
                //var largeur = colonnes.length;
                //console.log("nb colonnes = "+largeur);
                //for(var j=0; j<largeur; j++) {
                for (var j = 3; j <= 7; j++) {

                    var recup = colonnes[j].firstElementChild.value;
                    console.log("match[" + i + "," + (j - 1) + "] = " + recup);
                    if (recup < 0) {
                        vainqueur[i]--;
                    } else {
                        vainqueur[i]++;
                    }
                }
                console.log("vainqueur du match[" + i + "," + (j - 1) + "] = " + vainqueur[i]);
                ptsA[i] = document.createElement("input");
                ptsB[i] = document.createElement("input");
                ptsA[i].setAttribute("type", "hidden");
                ptsA[i].setAttribute("name", "ptsA[]");
                ptsB[i].setAttribute("type", "hidden");
                ptsB[i].setAttribute("name", "ptsB[]");
                ptsA[i].setAttribute("value", 0);
                ptsB[i].setAttribute("value", 0);
                if (vainqueur[i] < 0) {
                    colonnes[j++].innerHTML = 0;
                    colonnes[j].innerHTML = 1;
                    scoreB++;
                    ptsB[i].setAttribute("value", 1);
                } else {
                    colonnes[j++].innerHTML = 1;
                    colonnes[j].innerHTML = 0;
                    scoreA++;
                    ptsA[i].setAttribute("value", 1);
                }
                formulaire.appendChild(ptsA[i]);
                formulaire.appendChild(ptsB[i]);
                console.log("score match[" + i + "," + j + "] = " + scoreA + " ----- " + scoreB);
            }
            var double = feuille[i].cells;//on récupère les cellules de la ligne
            vainqueur[i] = 0;
            for (var j = 1; j < 6; j++) {
                //var recup = colonnes[j].firstElementChild.value
                var recup = double[j].firstElementChild.value;
                console.log("double[" + i + "," + (j - 1) + "] = " + recup);
                if (recup < 0) {
                    vainqueur[i]--;
                } else {
                    vainqueur[i]++;
                }
            }
            // trt double
            var pdbA = document.createElement("input");
            pdbA.setAttribute("type", "hidden");
            pdbA.setAttribute("name", "pdbA");

            var pdbB = document.createElement("input");
            pdbB.setAttribute("type", "hidden");
            pdbB.setAttribute("name", "pdbB");

            console.log("vainqueur du double[" + i + "," + (j - 1) + "] = " + vainqueur[i]);
            if (vainqueur[i] < 0) {
                scoreB++;
                double[j++].innerHTML = 0;
                double[j].innerHTML = 1;
                pdbA.setAttribute("value", 0);
                pdbB.setAttribute("value", 1);
            } else {
                scoreA++;
                double[j++].innerHTML = 1;
                double[j].innerHTML = 0;
                pdbA.setAttribute("value", 1);
                pdbB.setAttribute("value", 0);
            } // à vérifier plus tard : utilité pointsA/B pour le double (cf classement) 27/10/2020
            formulaire.appendChild(pdbA);
            formulaire.appendChild(pdbB);
            //alert("sortie de boucle");
            console.log("score final = " + scoreA + " ----- " + scoreB);
            document.saisie.scoreAI.value = scoreA;
            document.saisie.scoreBI.value = scoreB;
            //Ajout d'une nouvelle balise pour le score global
            var inputScoreA = document.createElement("input");
            var inputScoreB = document.createElement("input");
            //on y affecte des attributs (ici, le type, le nom, et sa valeur)
            inputScoreA.setAttribute("type", "hidden");
            inputScoreA.setAttribute("name", "scoreA");
            inputScoreA.setAttribute("value", scoreA);
            formulaire.appendChild(inputScoreA);
            inputScoreB.setAttribute("type", "hidden");
            inputScoreB.setAttribute("name", "scoreB");
            inputScoreB.setAttribute("value", scoreB);
            formulaire.appendChild(inputScoreB);
            // modifierrencontre
            document.saisie.modifierrencontre.disabled = false;
        }

        function modifRencontre() {
            var validation = confirm("Voulez-vous modifier le classement ?");
            var verrouName = document.getElementsByName("verrou");
            var verrou = verrouName[0];
            //alert(verrou[0].value);
            if (validation) {
                verrou.setAttribute("value", "P")
                return true;
            } else {
                return false;
            }

        }
    </script>
    <h2><?= (isset( $rencontre )) ? "Saisie des matchs de la rencontre" : "Nouvelle rencontre" ?></h2>
    <hr>

    <form name="saisie" method="POST" action="" id="saisie">
        <table class="form-table">
            <tr>
                <td><label>Lieu</label></td>
                <td><input class="form-control" type="text" name="lieu"
                           value="<?= (isset( $rencontre )) ? $rencontre[ 0 ] -> lieu : "" ?>" size="20" required/>
                    <input type="hidden" name="verrou" value="<?= (isset( $rencontre )) ? $verrou : ""; ?>" size="20"
                           readonly/></td>
                <td><label>Journée</label></td>
                <td>
                    <input class="form-control" type="text" name="journee"
                           value="<?= (isset( $rencontre )) ? $journee[ 0 ] -> numJournee : ""; ?>" size="20" readonly/>
                </td>
            </tr>
            <tr>
                <td><label>Date</label></td>
                <td><input class="form-control" type="date" name="date"
                           value="<?= (isset( $rencontre )) ? $rencontre[ 0 ] -> date : "" ?>" size="20" readonly/></td>

                <td><label>Heure</label></td>
                <td><input class="form-control" type="time" name="heure"
                           value="<?= (isset( $rencontre )) ? $rencontre[ 0 ] -> heure : "" ?>" size="20" readonly/>
                </td>
            </tr>
            <tr>
                <td><label>Équipe A</label></td>
                <td>
                    <input class="form-control" type="text" name="equipea"
                           value="<?= (isset( $rencontre )) ? $equipeR[ 0 ] -> nomEquipe : ""; ?>" size="20" readonly/>
                    <input type="hidden" name="idEquipeR"
                           value="<?= (isset( $rencontre )) ? $equipeR[ 0 ] -> idEquipe : "" ?>"/>
                </td>
                <td><label>Équipe B</label></td>
                <td>
                    <input class="form-control" type="text" name="equipeb"
                           value="<?= (isset( $rencontre )) ? $equipeV[ 0 ] -> nomEquipe : "" ?> " size="20" readonly/>
                    <input type="hidden" name="idEquipeV"
                           value="<?= (isset( $rencontre )) ? $equipeV[ 0 ] -> idEquipe : "" ?>"/>
                </td>
            </tr>
            <tr>
                <td><label>Points équipe A</label></td>
                <td>  <?php
                    //  var_dump ($_GET["idRencontre"]);
                    // var_dump (isset($_GET["idRencontre"]));
                    //  var_dump ($journee);
                    if ( isset( $rencontre ) ) :
                        foreach ( $engagement as $equipe ) :
                            if ( $rencontre[ 0 ] -> idEquipeA == $equipe -> idEquipe ) { ?>
                                <input class="form-control" type="text" name="nbPointsA"
                                       value="<?= $equipe -> nbPoints ?>" size="20" readonly/>
                                <input class="form-control" type="hidden" name="matchesGagnesR"
                                       value="<?= $equipe -> matchesGagnes ?>" size="20" readonly/>
                                <input class="form-control" type="hidden" name="matchesPerdusR"
                                       value="<?= $equipe -> matchesPerdus ?>" size="20" readonly/>
                                <input class="form-control" type="hidden" name="engagementR"
                                       value="<?= $equipe -> idEngagement ?>" size="20" readonly/>
                            <?php }
                        endforeach;
                    endif; ?>
                </td>

                <td><label>Points équipe B</label></td>
                <td><?php
                    if ( isset( $rencontre ) ) :
                        foreach ( $engagement as $equipe ) :
                            if ( $rencontre[ 0 ] -> idEquipeB == $equipe -> idEquipe ) { ?>
                                <input class="form-control" type="text" name="nbPointsB"
                                       value="<?= $equipe -> nbPoints ?>" size="20" readonly/>
                                <input class="form-control" type="hidden" name="matchesGagnesV"
                                       value="<?= $equipe -> matchesGagnes ?>" size="20" readonly/>
                                <input class="form-control" type="hidden" name="matchesPerdusV"
                                       value="<?= $equipe -> matchesPerdus ?>" size="20" readonly/>
                                <input class="form-control" type="hidden" name="engagementV"
                                       value="<?= $equipe -> idEngagement ?>" size="20" readonly/>
                            <?php }
                        endforeach;
                    endif ?></td>

            </tr>
            <tr>
                <td><label>Arbitre</label></td>
                <?php foreach ($arbitres

                as $arbitre) :

                if ($arbitre -> idArbitre == $rencontre[ 0 ] -> idArbitre) :


                ?>

                <td colspan="2">
                    <input class="form-control" type="text" name="idArbitre"
                           value="<?= (isset( $rencontre )) ? $arbitre -> prenom . " " . $arbitre -> nom : ""; ?>"
                           size="20" readonly/>
                </td>
                <td><input type="hidden" name="championnat2" value="<?= (isset( $rencontre )) ? $championnat : ""; ?>"
                           size="20" readonly/></td>
            </tr>
            <?php endif;
            endforeach; ?>
        </table>
        <br/>
        <?php if ( isset( $rencontre ) ) : ?>
            <div>
                <table border=1 class="data-table sober">

                    <thead class="text-center">
                    <tr>
                        <th colspan=4>Equipe <?php
                            $format = "NJ";
                            foreach ( $engagement as $e ) {
                                if ( $e -> idEquipe == $rencontre[ 0 ] -> idEquipeA ) {
                                    echo $e -> idEquipe;
                                    if ( $e -> idEquipe == 9 ) {
                                        $format = "D";
                                    }


                                }
                            }
                            ?></th>
                        <th colspan=4>Equipe <?php
                            foreach ( $engagement as $e ) {
                                if ( $e -> idEquipe == $rencontre[ 0 ] -> idEquipeB ) {
                                    echo $e -> idEquipe;
                                    if ( $e -> idEquipe == 9 ) {

                                        $format = "W";
                                    }

                                }
                            }

                            ?>


                        </th>
                    </tr>
                    <?php if ($statut == "N") { ?>
                    <tr>
                        <th>clé</th>
                        <th>NOM PRENOM</th>
                        <th>Licence</th>
                        <th>Classement</th>
                        <th>clé</th>
                        <th>NOM PRENOM</th>
                        <th>Licence</th>
                        <th>Classement</th>
                    </tr>
                    </thead>
                    <tr>

                        <?php

                        $joueursABC = array();
                        $joueursXYZ = array();
                        //   var_dump ($matchs);
                        for ($cpt = 0;
                        $cpt < 4;
                        $cpt++) : ?>
                        <td><?php if ( $cpt == 0 ) {
                                echo 'A';
                            } elseif ( $cpt == 1 ) {
                                echo 'B';
                            } elseif ( $cpt == 2 ) {
                                echo 'C';
                            } elseif ( $cpt == 3 && $format == "D" ) {
                                echo 'D';

                            }


                            ?>

                        </td>
                        <?php // ajout 11/08/2020
                        if ( isset( $matchs[ $cpt ] ) ) {
                            foreach ( $joueurs as $j ) {


                                if ( $j -> idJoueur == $matchs[ $cpt ] -> idJR ) {
                                    if ( $cpt == 3 && ($format == "NJ" || $format == "W") ) {
                                        break;
                                    }

                                    $joueursABC[ $cpt ] = $j -> nom . '<br> ' . $j -> prenom;
                                    echo '<td>' . $j -> nom . '<br> ' . $j -> prenom . '</td>';
                                    echo '<td>' . mb_strtoupper ( $j -> licenceJoueur ) . '</td>';
                                    echo '<td>' . $j -> nbPoints . '</td>';


                                    if ( $cpt == 0 ) {
                                        echo '<input type="hidden" name="joueurA" value="' . $j -> idJoueur . '">';
                                    } elseif ( $cpt == 1 ) {
                                        echo '<input type="hidden" name="joueurB" value="' . $j -> idJoueur . '">';
                                    } elseif ( $cpt == 2 ) {
                                        echo '<input type="hidden" name="joueurC" value="' . $j -> idJoueur . '">';
                                    } elseif ( $cpt == 3 && $j -> idClub == 10 ) {

                                        echo '<input type="hidden" name="joueurDW" value="' . $j -> idJoueur . '">';
                                    }
                                }
                            }
                        } else {
                            echo '<td> --- </td>';
                            echo '<td> --- </td>';
                            echo '<td> --- </td>';
                            echo '<td> --- </td>';
                        }
                        // ajout 11/08/2020
                        ?>
                        <td><?php if ( $cpt == 0 ) {
                                echo 'X';
                            } elseif ( $cpt == 1 ) {
                                echo 'Y';
                            } elseif ( $cpt == 2 ) {
                                echo 'Z';
                            } elseif ( $cpt == 3 && $format == "W" ) {
                                echo 'W';

                            } ?>


                        </td>

                        <?php


                        if ( isset( $matchs[ $cpt ] ) ) {
                            foreach ( $joueurs as $j ) {
                                // ajout 11/08/2020

                                if ( $j -> idJoueur == $matchs[ $cpt ] -> idJV ) {
                                    if ( $cpt == 3 && ($format == "NA" || $format == "D") ) {
                                        break;
                                    }
                                    $joueursXYZ[ $cpt ] = $j -> nom . '<br> ' . $j -> prenom;
                                    echo '<td>' . $j -> nom . '<br>  ' . $j -> prenom . '</td>';
                                    echo '<td>' . mb_strtoupper ( $j -> licenceJoueur ) . '</td>';
                                    echo '<td>' . $j -> nbPoints . '</td>';

                                    if ( $cpt == 0 ) {
                                        echo '<input type="hidden" name="joueurX" value="' . $j -> idJoueur . '">';
                                    } elseif ( $cpt == 1 ) {
                                        echo '<input type="hidden" name="joueurY" value="' . $j -> idJoueur . '">';
                                    } elseif ( $cpt == 2 ) {
                                        echo '<input type="hidden" name="joueurZ" value="' . $j -> idJoueur . '">';
                                    } elseif ( $cpt == 3 && $j -> idClub == 10 ) {
                                        echo '<input type="hidden" name="joueurDW" value="' . $j -> idJoueur . '">';
                                    }

                                }
                            }
                        } // ajout 11/08/2020
                        else {
                            echo '<td> --- </td>';
                            echo '<td> --- </td>';
                            echo '<td> --- </td>';
                            echo '<td> --- </td>';
                        }
                        ?>
                    </tr>
                    <?php endfor;
                    // ajout 11/08/2020
                    // ajout 21/08/2021
                    }

                    ?>
                </table>
            </div>
            <br/>

            <table border='1' class="data-table sober" id="feuilleDeMatch">
                <thead>
                <th>&ensp;clés&ensp;</th>
                <th>Joueurs ABC</th>
                <th>Joueurs XYZ</th>
                <th>Manche1</th>
                <th>Manche2</th>
                <th>Manche3</th>
                <th>Manche4</th>
                <th>Manche5</th>
                <th>Points ABC</th>
                <th>Points XYZ</th>
                </thead>
                <?php
                if ( $statut == "N" ) {
                    $tabMatches = array();
                    $tabMatches[] = [$joueursABC[ 0 ], $joueursXYZ[ 0 ]];
                    $tabMatches[] = [$joueursABC[ 1 ], $joueursXYZ[ 1 ]];
                    $tabMatches[] = [$joueursABC[ 2 ], $joueursXYZ[ 2 ]];
                    $tabMatches[] = [$joueursABC[ 1 ], $joueursXYZ[ 0 ]];
                    $tabMatches[] = [$joueursABC[ 0 ], $joueursXYZ[ 2 ]];
                    $tabMatches[] = [$joueursABC[ 2 ], $joueursXYZ[ 1 ]];
                    $tabMatches[] = [$joueursABC[ 1 ], $joueursXYZ[ 2 ]];
                    $tabMatches[] = [$joueursABC[ 2 ], $joueursXYZ[ 0 ]];
                    $tabMatches[] = [$joueursABC[ 0 ], $joueursXYZ[ 1 ]];
                }

                $cpt = 0;
                // ajout 11/08/2020
                if ( isset( $matchs ) ) {
                    $i = 0;
                    foreach ( $matchs as $match ) : ?>

                        <tr>
                            <?php

                            // ajout du 05/11/2022
                            // tableau de lettres-clés
                            ?>
                            <td><?php echo $cles[ $format ][ $i ] ?></td>
                            <td><?php //$typeRencontre[$cpt];

                                $i++;

                                ?>
                                <!--// ajout 27/08/2020  -->
                                <input type="hidden" name="ligneMatch[]" value="<?= $match -> idMatch ?>"/>
                                <?php
                                if ( $statut == "S" ) {
                                    foreach ( $joueurs as $j ) {
                                        if ( $j -> idJoueur == $match -> idJR ) {
                                            echo $j -> nom . '<br>  ' . $j -> prenom;

                                        }
                                    }
                                } else {
                                    echo $tabMatches[ $cpt ][ 0 ];
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ( $statut == "S" ) {
                                    foreach ( $joueurs as $j ) {
                                        if ( $j -> idJoueur == $match -> idJV ) {
                                            echo $j -> nom . '<br> ' . $j -> prenom;
                                        }
                                    }
                                } else {
                                    echo $tabMatches[ $cpt ][ 1 ];
                                }

                                ?>
                            </td>
                            <!-- ajout 26/08/2020  -->

                            <td><input class="form-control" type="number" name="m1[]"
                                       value="<?= isset( $match -> M1 ) ? $match -> M1 : 0; ?>" size="3" required/></td>
                            <td><input class="form-control" type="number" name="m2[]"
                                       value="<?= isset( $match -> M2 ) ? $match -> M2 : 0; ?>" size="3" required/></td>
                            <td><input class="form-control" type="number" name="m3[]"
                                       value="<?= isset( $match -> M3 ) ? $match -> M3 : 0; ?>" size="3" required/></td>
                            <td><input class="form-control" type="number" name="m4[]"
                                       value="<?= isset( $match -> M4 ) ? $match -> M4 : 0; ?>" size="3" required/></td>
                            <td><input class="form-control" type="number" name="m5[]"
                                       value="<?= isset( $match -> M5 ) ? $match -> M5 : 0; ?>" size="3" required/></td>
                            <td><?= ($match -> pointsA == 1) ? $match -> pointsA : '<p name="pointsA">-</p>'; ?></td>
                            <td><?= ($match -> pointsB == 1) ? $match -> pointsB : '<p name="pointsB">-</p>' ?></td>
                        </tr>
                        <?php
                        $cpt++;
                    endforeach;
                    // ajout 11/08/2020
                }

                ?>
                <tr>
                    <!-- remplacer --- par 0 si erreur requête ?  -->
                    <td colspan="3">Double</td>
                    <td><input class="form-control" type="number" name="d1"
                               value="<?= isset( $rencontre[ 0 ] -> D1 ) ? $rencontre[ 0 ] -> D1 : 0; ?>" size="3"
                               required/></td>
                    <td><input class="form-control" type="number" name="d2"
                               value="<?= isset( $rencontre[ 0 ] -> D2 ) ? $rencontre[ 0 ] -> D2 : 0; ?>" size="3"
                               required/></td>
                    <td><input class="form-control" type="number" name="d3"
                               value="<?= isset( $rencontre[ 0 ] -> D3 ) ? $rencontre[ 0 ] -> D3 : 0; ?>" size="3"
                               required/></td>
                    <td><input class="form-control" type="number" name="d4"
                               value="<?= isset( $rencontre[ 0 ] -> D4 ) ? $rencontre[ 0 ] -> D4 : 0; ?>" size="3"
                               required/></td>
                    <td><input class="form-control" type="number" name="d5"
                               value="<?= isset( $rencontre[ 0 ] -> D5 ) ? $rencontre[ 0 ] -> D5 : 0; ?>" size="3"
                               required/></td>
                    <td><p id="doubleA" name="doubleA"><?= ($match -> pointsA == 1) ? $match -> pointsA : '-'; ?></p>
                    </td>
                    <td><p id="doubleB" name="doubleB"><?= ($match -> pointsB == 1) ? $match -> pointsB : '-'; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="8"><p id="calcul" onclick="calculScore();">Cliquez pour calculer le score
                            final&ensp;<input class="button primarybuttonBlue" type="button" value="calcul" id="calcul"
                                              onclick="calculScore();"></p></td>
                    <td><p><input type="text" id="scoreAI" name="scoreAI"
                                  value=" <?= isset( $rencontre[ 0 ] -> scoreFinalA ) ? $rencontre[ 0 ] -> scoreFinalA : '-'; ?>"
                                  size="8" disabled="true"></p></td>
                    <td><p><input type="text" id="scoreBI" name="scoreBI"
                                  value=" <?= isset( $rencontre[ 0 ] -> scoreFinalB ) ? $rencontre[ 0 ] -> scoreFinalB : '-'; ?>"
                                  size="8" disabled="true"></p></td>
                </tr>
                <tr>
                    <td colspan="9">
                        <input type="hidden" name="forfait" value="<?= $rencontre[ 0 ] -> WO ?>"/>
                        <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeChampionnat" ?>">Annuler</a>
                        <input class="primarybutton<?= ($verrou == "P") ? "Blue" : "Red" ?>" type="submit"
                               value="<?= ($verrou == "P") ? "Enregister" : "Modifier" ?>"
                               name="<?= (isset( $rencontre )) ? "modifierrencontre" : "creerrencontre" ?>"
                               onclick="return modifRencontre()" disabled/>
                    </td>
                </tr>
            </table>
        <?php endif; ?>
    </form>
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>