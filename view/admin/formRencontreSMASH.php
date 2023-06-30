<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2><?= (isset( $rencontre )) ? "Modification de la rencontre (SMASH)" : "Nouvelle rencontre (SMASH)" ?></h2>
    <hr>
    <script>
        function choixJoueur() {
            var BoutonValide = document.getElementsByName("modifierrencontre").item(0)
            var T1 = [];
            var J1 = document.getElementsByName("joueurA").item(0).value;
            var J2 = document.getElementsByName("joueurB").item(0).value;
            var J3 = document.getElementsByName("joueurC").item(0).value;
            var J4 = document.getElementsByName("joueurX").item(0).value;
            var J5 = document.getElementsByName("joueurY").item(0).value;
            var J6 = document.getElementsByName("joueurZ").item(0).value;
            var J7 = document.getElementsByName("joueurDW").item(0).value;
            var JOpt1 = document.getElementsByName("joueurA").item(0).options
            var JOpt2 = document.getElementsByName("joueurB").item(0).options
            var JOpt3 = document.getElementsByName("joueurC").item(0).options
            var JOpt4 = document.getElementsByName("joueurY").item(0).options
            var JOpt5 = document.getElementsByName("joueurX").item(0).options
            var JOpt6 = document.getElementsByName("joueurZ").item(0).options
            var JOpt7 = document.getElementsByName("joueurDW").item(0).options
            var LBLM = document.getElementById('LabelBLM')
            var BLM = document.getElementsByName('BLM').item(0)
            var verif = true;
            var T2 = [J1, J2, J3]
            var T3 = [J4, J5, J6]
            var TO2 = [JOpt1, JOpt2, JOpt3]
            var TO3 = [JOpt4, JOpt5, JOpt6]
            var TN2 = []
            var TN3 = []
            var lettre7 = document.getElementById("joueurSept").innerText
            var TEqV = document.getElementsByName("joueurV[]")
            var TEqR = document.getElementsByName("joueurR[]")

            //console.log(TEqV.item(0))
            // console.log(TEqR.item(0))
            // console.log(lettre7.innerText)
            if (lettre7 === "Joueur D") {
                T2.push(J7)
                TO2.push(JOpt7)
            } else {
                T3.push(J7)
                TO3.push(JOpt7)
            }
            var VD = verifDoublon(T2, T3)
           // alert(VD);
            //console.log(TO2)
            for (let i = 0; i < TO2.length; i++) {
                for (let j = 0; j < TO2[i].length; j++) {
                    if (T2[i] === TO2[i].item(j).value)
                        TN2.push(TO2[i].item(j).innerText)
                }

            }
            for (let i = 0; i < TO3.length; i++) {
                for (let j = 0; j < TO3[i].length; j++) {
                    if (T3[i] === TO3[i].item(j).value)
                        TN3.push(TO3[i].item(j).innerText)
                }

            }
            // console.log(TN2)
            // console.log(T2)
            //  console.log(T3)


            T1.push(J1, J2, J3, J4, J5, J6, J7);
           // console.log(TEqV)
            for (let i = 0; i < T1.length; i++) {
                // alert(T1[i]+"("+(i+1)+")")
                if (T1[i] === '88') {
                    verif = false;
                    break;
                }
            }
            if (verif && VD) {
                alert("Vous pouvez désormais selectionner les matchs !")
                var lmt = document.getElementById("lmtitre")
                for (let i = 1; i <= 9; i++) {
                    var listeM = document.getElementById("listematchs" + i);
                    listeM.hidden = false;
                }
                for (let i = 0; i < T2.length; i++) {
                    for (let j = 0; j < TEqR.length; j++) {
                        let opt = document.createElement("option")
                        opt.setAttribute("id", T2[i])
                        opt.innerText = TN2[i]
                        //   console.log(opt)
                        TEqR.item(j).appendChild(opt)
                    }
                }
                for (let i = 0; i < T3.length; i++) {
                    for (let j = 0; j < TEqV.length; j++) {
                        let opt = document.createElement("option")
                        opt.setAttribute("id", T3[i])
                        opt.innerText = TN3[i]

                        TEqV.item(j).appendChild(opt)
                    }
                }
                //console.log(TEqV.item(0))
                BoutonValide.disabled = false;
                LBLM.hidden = true
                BLM.hidden = true

            } else {
                alert('Vous avez oubliez de selectionner un joueur ou vous avez des joueurs en double !');
            }


        }
        function verifMatch() {

            var JR = document.getElementsByName("joueurR[]");
            var JV = document.getElementsByName("joueurV[]");
          //  alert(JR[0].value )
            for (let i = 0; i < 9; i++) {
                if (JR[i].value === JV[i].value ){
                  alert("Vous avez un match en double ou non insere")  ;

                    return false;

                }


            }
            return true
        }
        function verifDoublon(l1, l2) {
            var l1bis = l1.filter((item, index) => l1.indexOf(item) === index);
            var l2bis = l2.filter((item, index) => l2.indexOf(item) === index);
          /*  alert (typeof l1)
            alert(typeof l2)
            alert(l1bis)
            alert(l2bis)
            alert(l1.length )
            alert(l2.length )
            alert(l1bis.length )
            alert(l2bis.length )
            alert(l1.length == l1bis.length)
            alert(l2.length == l2bis.length)*/

            return (l1.length == l1bis.length && l2.length == l2bis.length);
        }
    </script>
    <form method="POST" action="" onsubmit="return verifMatch()" >
        <table class="form-table">
            <tr>
                <td><label>Lieu</label></td>
                <td><input class="form-control" type="text" name="lieu"
                           value="<?= (isset( $rencontre )) ? $rencontre[ 0 ] -> lieu : "" ?>" size="20" required/>
                    <input type="hidden" name="verrou" value="<?= (isset( $rencontre )) ? $verrou : ""; ?>" size="20"
                           readonly/></td>
                <td><label>Journée</label></td>
                <td>
                    <input class="form-control" type="text" name="journee" value="<?= $journee[ 0 ] -> numJournee; ?>"
                           size="20" readonly/>
                </td>
            </tr>
            <tr>
                <td><label>Date</label></td>
                <td><input class="form-control" type="date" name="date"
                           value="<?= (isset( $rencontre )) ? $rencontre[ 0 ] -> date : "" ?>" size="20" required/></td>
                <td><label>Heure</label></td>
                <td><input class="form-control" type="time" name="heure"
                           value="<?= (isset( $rencontre )) ? $rencontre[ 0 ] -> heure : "" ?>" size="20" required/>
                </td>
            </tr>
            <tr>
                <td><label>Club visité</label></td>
                <td>
                    <input class="form-control" type="text" name="equipea" value="<?= $equipeR[ 0 ] -> nomEquipe ?>"
                           size="20" readonly/>
                </td>
                <td><label>Club visiteur</label></td>
                <td>
                    <input class="form-control" type="text" name="equipeb" value="<?= $equipeV[ 0 ] -> nomEquipe ?>"
                           size="20" readonly/>
                </td>
                <td><label><!-- detailRenc --></label></td>
            </tr>
            <tr>
                <td><label> forfait ?</label></td>
                <fieldset>
                    <td><input type="radio" name="forfait" value="A">Forfait club visité</td>
                    <td><input type="radio" name="forfait" value="J" checked>Match joué</td>
                    <td><input type="radio" name="forfait" value="B">Forfait club visiteur</td>
                </fieldset>
            </tr>
            <tr>
                <td><label>Points club visité</label></td>
                <td>  <?php
                    foreach ($engagement

                    as $equipe) :
                    if ($rencontre[ 0 ] -> idEquipeA == $equipe -> idEquipe) { ?>
                    <input class="form-control" type="text" name="nbPointsA" value="<?= $equipe -> nbPoints ?>"
                           size="20" readonly/>
                    <input class="form-control" type="hidden" name="engagementR" value="<?= $equipe -> idEngagement ?>"
                           size="20" readonly/>
                    <input class="form-control" type="hidden" name="idEquipeR" value="<?= $equipe -> idEquipe ?>"
                           size="20" readonly/>
                </td>
                <?php }
                endforeach; ?>
                </td>

                <td><label>Points club visiteur</label></td>
                <td><?php
                    foreach ($engagement

                    as $equipe) :
                    if ($rencontre[ 0 ] -> idEquipeB == $equipe -> idEquipe) { ?>
                    <input class="form-control" type="text" name="nbPointsB" value="<?= $equipe -> nbPoints ?>"
                           size="20" readonly/>
                    <input class="form-control" type="hidden" name="engagementV" value="<?= $equipe -> idEngagement ?>"
                           size="20" readonly/></td>
            <input class="form-control" type="hidden" name="idEquipeV" value="<?= $equipe -> idEquipe ?>"
                   size="20" readonly/>
            <?php }
            endforeach; ?>
                </td>

            </tr>
            <tr>
                <td><label>Arbitre</label></td>
                <td colspan="2">
                    <select class="form-control" name="arbitre" required>
                        <option value="88">Choisissez un arbitre</option>

                        <?php
                        foreach ( $joueurs as $joueur ) :
                            foreach ( $arbitres as $arbitre ) :
                                if ( $joueur -> idClub == $arbitre -> idArbitre ) {
                                    echo '<option value="' . $joueur -> idJoueur . '">';
                                    echo $joueur -> nom . '&nbsp' . $joueur -> prenom;
                                    echo '</option>';
                                }
                            endforeach;
                        endforeach;


                        ?></td>
                <td>
                <td><input type="hidden" name="championnat" value="<?= $championnat; ?>" size="20" readonly/></td>
                </td>
            </tr>
            <tr>
                <td><label>Joueur A</label></td>
                <td>
                    <select class="form-control" name="joueurA" required>
                        <option value="88">Choisissez un joueur</option>

                        <?php
                        foreach ( $joueurs as $joueur ) :
                            if ( $joueur -> idClub == $idClubR ) {
                                echo '<option value="' . $joueur -> idJoueur . '">';
                                echo $joueur -> nom . '&nbsp' . $joueur -> prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                    </select>
                </td>
                <td><label>Joueur X</label></td>
                <td>
                    <select class="form-control" name="joueurX" required>
                        <option value="88">Choisissez un joueur</option>

                        <?php
                        foreach ( $joueurs as $joueur ) :
                            if ( $joueur -> idClub == $equipeV[ 0 ] -> idClub ) {
                                echo '<option value="' . $joueur -> idJoueur . '">';
                                echo $joueur -> nom . '&nbsp' . $joueur -> prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                    </select>
                </td>
                <td>&ensp;</td>
            </tr>
            <tr>
                <td><label>Joueur B</label></td>
                <td>
                    <select class="form-control" name="joueurB" required>
                        <option value="88">Choisissez un joueur</option>
                        <?php
                        foreach ( $joueurs as $joueur ) :
                            if ( $joueur -> idClub == $idClubR ) {
                                echo '<option value="' . $joueur -> idJoueur . '">';
                                echo $joueur -> nom . '&nbsp' . $joueur -> prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                </td>
                <td><label>Joueur Y</label></td>
                <td>
                    <select class="form-control" name="joueurY" required>
                        <option value="88">Choisissez un joueur</option>
                        <?php
                        foreach ( $joueurs as $joueur ) :
                            if ( $joueur -> idClub == $equipeV[ 0 ] -> idClub ) {
                                echo '<option value="' . $joueur -> idJoueur . '">';
                                echo $joueur -> nom . '&nbsp' . $joueur -> prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                    </select>
                </td>
                <td>&ensp;</td>
            </tr>
            <tr>
                <td><label>Joueur C</label></td>
                <td>
                    <select class="form-control" name="joueurC" required>
                        <option value="88">Choisissez un joueur</option>
                        <?php
                        foreach ( $joueurs as $joueur ) :
                            if ( $joueur -> idClub == $idClubR ) {
                                echo '<option value="' . $joueur -> idJoueur . '">';
                                echo $joueur -> nom . '&nbsp' . $joueur -> prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                    </select>
                </td>
                <td><label>Joueur Z</label></td>
                <td>
                    <select class="form-control" name="joueurZ" required>
                        <option value="88">Choisissez un joueur</option>

                        <?php
                        foreach ( $joueurs as $joueur ) :
                            if ( $joueur -> idClub == $equipeV[ 0 ] -> idClub ) {
                                echo '<option value="' . $joueur -> idJoueur . '">';
                                echo $joueur -> nom . '&nbsp' . $joueur -> prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                    </select>
                </td>
                <td>&ensp;</td>
            </tr>
            <tr>
                <td>
                    <?php
                    $format = "";
                    if ($equipeV[ 0 ] -> idClub == 10) {
                        $format = "W";
                    }
                    else {
                        $format = "D";
                    }
                    ?>

                </td>
                <td><label id="joueurSept">Joueur <?= ($equipeV[ 0 ] -> idClub == 10) ? "W" : "D" ?></label></td>
                <td>
                    <select class="form-control" name="joueurDW" required>
                        <option value="88">Choisissez un joueur</option>

                        <?php
                        foreach ( $joueurs as $joueur ) :
                            if ( $joueur -> idClub == 10 ) {
                                echo '<option value="' . $joueur -> idJoueur . '">';
                                echo $joueur -> nom . '&nbsp' . $joueur -> prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                    </select>
                </td>
                <td>&ensp;</td>
            </tr>
            <tr>

                <td><label id="LabelBLM">Confirmer le choix des joueurs </label></td>
                <td>
                    <br>
                    <input class="primarybuttonRed" type="button" value="Liste des matchs" name="BLM"
                           onclick="choixJoueur()"/>
                </td>
            </tr>
            <tr>
                <td colspan="2" id="lmtitre" hidden="hidden"><label>Joueurs club visité</label></td>
                <td colspan="2"><label>Joueurs club visiteur</label></td>
                <td colspan="3"></td>
            </tr>

            <?php
//var_dump ($cles);
            for ( $i = 0; $i < 9; $i++ ) {
                ?>

                <tr id="listematchs<?php echo ($i + 1); ?>" hidden="hidden">
                    <td><label>match <?php echo ($i + 1)." ".$cles[$format][$i]; ?></label></td>
                    <td>
                        <select class="form-control" name="joueurR[]" required>
                            <option value="88">Choisissez un joueur</option>

                            <?php /*
                    foreach ($joueurs as $joueur) :
                        if($joueur->idClub==$idClubR) {
                            echo '<option value="'.$joueur->idJoueur.'">';
                            echo $joueur->nom.'&nbsp'.$joueur->prenom;
                            echo '</option>';
                        }
                    endforeach; */ ?>
                        </select>
                    </td>
                    <td><label>contre</label></td>
                    <td>
                        <select class="form-control" name="joueurV[]" required>
                            <option value="88">Choisissez un joueur</option>

                            <?php /*
                    foreach ($joueurs as $joueur) :
                        if($joueur->idClub==$equipeV[0]->idClub) {
                            echo '<option value="'.$joueur->idJoueur.'">';
                            echo $joueur->nom.'&nbsp'.$joueur->prenom;
                            echo '</option>';
                        }
                    endforeach;  */ ?>
                        </select>
                    </td>
                </tr>
                <?php
            }
            ?>

            <tr>
                <td colspan="2"><label>Cliquer sur enregistrer pour sauvegarder les donnees
                        <br/>et saisir les matchs
                        <br/><br/>
                        Cliquer sur annuler pour abandonner les saisies
                    </label>
                </td>
                <td>
                    <input class="primarybuttonBlue" type="submit" value="Enregistrer"
                           name="<?= (isset( $rencontre )) ? "modifierrencontre" : "creerrencontre" ?>"  disabled/>
                </td>
                <td>
                    <a class="button primarybuttonWhite"
                       href="<?= BASE_URL . DS . "admin/listeChampionnat" ?>">Annuler</a>
                </td>

            </tr>

        </table>
        <br/>


        <br/>


    </form>
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>