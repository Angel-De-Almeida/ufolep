<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>
<script>
    function verifDoublon() {
     var T1 = [];
     var J1 = document.getElementsByName("joueurA").item(0).value;
        var J2 = document.getElementsByName("joueurB").item(0).value;
        var J3 = document.getElementsByName("joueurC").item(0).value;
        var J4 = document.getElementsByName("joueurX").item(0).value;
        var J5 = document.getElementsByName("joueurY").item(0).value;
        var J6 = document.getElementsByName("joueurZ").item(0).value;

     T1.push(J1,J2,J3,J4,J5,J6);
     var T2 = T1.filter((item,index) => T1.indexOf(item) === index) ;

        if (T1.length != T2.length){
                alert("Une des équipes contient un joueur en doublon");

            return false;
        }

    }
</script>
<h2><?= (isset($rencontre)) ? "Modification de la rencontre" : "Nouvelle rencontre" ?></h2>
<hr>

<form method="POST" action="" onsubmit="return verifDoublon()" >
    <table class="form-table">
        <tr>
            <td><label>Lieu</label></td>
            <td>
                <input class="form-control" type="text" name="lieu" value="<?= (isset($rencontre)) ? $rencontre[0]->lieu : "" ?>" size="20" required/>
                <input type="hidden" name="verrou" value="<?= (isset($rencontre)) ? $verrou: ""; ?>" size="20" readonly/>
            </td>
            <td><label>Journée</label></td>
            <td><input class="form-control" type="text" name="journee" value="<?= $journee[0]->numJournee;?>" size="20" readonly/>
            </td>
            <td><input type="hidden" name="championnat" value="<?= $championnat; ?>" size="20" readonly/></td>
        </tr>
        <tr>
            <td><label>Date</label></td>
            <td><input class="form-control" type="date" name="date" value="<?= (isset($rencontre)) ? $rencontre[0]->date : "" ?>" size="20" required/></td>
            <td><label>Heure</label></td>
            <td><input class="form-control" type="time" name="heure" value="<?= (isset($rencontre)) ? $rencontre[0]->heure : "" ?>" size="20" required/></td>
        </tr>
        <tr>
            <td><label>Club visité</label></td>
            <td>
                <input class="form-control" type="text" name="equipea" value="<?= $equipeR[0]->nomEquipe ?>" size="20" readonly/>
                <input type="hidden" name="idEquipeR" value="<?= $equipeR[0]->idEquipe ?>"  />
            </td>
            <td><label>Club visiteur</label></td>
            <td>
                <input class="form-control" type="text" name="equipeb" value="<?= $equipeV[0]->nomEquipe ?>" size="20" readonly/>
                <input type="hidden" name="idEquipeV" value="<?= $equipeV[0]->idEquipe ?>"  />
            </td>
            <td><label><!-- detailRenc --></label></td>
        </tr>
        <tr>
            <td ><label> forfait ?</label></td>
            <fieldset>
                <td><input type="radio" name="forfait" value="A">Forfait club visité</td>
                <td><input type="radio" name="forfait" value="J" checked>Match joué</td>
                <td><input type="radio" name="forfait" value="B">Forfait club visiteur</td>
            </fieldset>
        </tr>
        <tr>

            <td><label>Arbitre</label></td>
             <td colspan="2">
                 <select class="form-control" name="arbitre" required>
                     <option value="88">Choisissez un arbitre</option>

                     <?php
                     foreach ($joueurs as $joueur) :

                         foreach ($arbitres as $arbitre) :

                         if($joueur->idClub==$arbitre->idArbitre ) {

                             echo '<option value="'.$joueur->idJoueur.'">';
                             echo $joueur->nom.'&nbsp'.$joueur->prenom;
                             echo '</option>';
                         }
                         endforeach;

                     endforeach;



                     ?>  </td>
            <td></td>
        </tr>
        <tr>
            <td><label>Points club visité</label></td>
            <td>  <?php
               // var_dump ($rencontre[0]);
               // var_dump ($joueurs[12]->idEquipe);
              //  var_dump ($joueurs[12]->idJoueur);
                //var_dump ($joueurs);
               // var_dump ($joueurs[13]->idEquipe==$rencontre[0]->idEquipeA);
                foreach ($engagement as $equipe) :
                if ($rencontre[0]->idEquipeA == $equipe->idEquipe) { ?>
                <input class="form-control" type="text" name="nbPointsA" value="<?= $equipe->nbPoints ?>" size="20" readonly/>
                <input class="form-control" type="hidden" name="engagementR" value="<?= $equipe->idEngagement ?>" size="20" readonly/>
            </td>
            <?php   }
            endforeach; ?>
            </td>

            <td><label>Points club visiteur</label></td>
            <td><?php
                foreach ($engagement as $equipe) :
                if ($rencontre[0]->idEquipeB == $equipe->idEquipe) { ?>
                <input class="form-control" type="text" name="nbPointsB" value="<?= $equipe->nbPoints ?>" size="20" readonly/>
                <input class="form-control" type="hidden" name="engagementV" value="<?= $equipe->idEngagement ?>" size="20" readonly/>
            </td>
        <?php   }
        endforeach; ?>
            </td>

        </tr>
		<tr>
		 <td ><label>Joueur A</label></td>
            <td >
			<select class="form-control" name="joueurA" required>
            <option value="88">Choisissez un joueur</option>

                <?php
                foreach ($joueurs as $joueur) :
                    if($joueur->idClub==$idClubR) {
                        echo '<option value="'.$joueur->idJoueur.'">';
                        echo $joueur->nom.'&nbsp'.$joueur->prenom;
                        echo '</option>';
                    }
                endforeach; ?>
                </select>
            </td>
			 <td><label>Joueur X</label></td>
            <td >
            <select class="form-control" name="joueurX" required>
                    <option value="88">Choisissez un joueur</option>
                   
                    <?php
                    foreach ($joueurs as $joueur) :
                        if($joueur->idClub==$equipeV[0]->idClub) {
                            echo '<option value="'.$joueur->idJoueur.'">';
                            echo $joueur->nom.'&nbsp'.$joueur->prenom;
                            echo '</option>';
                        }
                    endforeach; ?>
                </select>
            </td>
			<td>&ensp;</td>
		</tr>
		<tr>
		 <td ><label>Joueur B</label></td>
            <td  >
            <select class="form-control" name="joueurB" required>
                    <option value="88">Choisissez un joueur</option>
                <?php
                foreach ($joueurs as $joueur) :
                    if($joueur->idClub==$idClubR) {
                        echo '<option value="'.$joueur->idJoueur.'">';
                        echo $joueur->nom.'&nbsp'.$joueur->prenom;
                        echo '</option>';
                    }
                endforeach; ?>
            </td>
			 <td><label>Joueur Y</label></td>
            <td >
            <select class="form-control" name="joueurY" required>
                    <option value="88">Choisissez un joueur</option>
                <?php
                foreach ($joueurs as $joueur) :
                if($joueur->idClub==$equipeV[0]->idClub) {
                echo '<option value="'.$joueur->idJoueur.'">';
                    echo $joueur->nom.'&nbsp'.$joueur->prenom;
                    echo '</option>';
                }
                endforeach; ?>
                </select>
            </td>
			<td>&ensp;</td>
		</tr>
        <tr>
		 <td  ><label>Joueur C</label></td>
            <td >
            <select class="form-control" name="joueurC" required>
                    <option value="88">Choisissez un joueur</option>
                <?php
                foreach ($joueurs as $joueur) :
                    if($joueur->idClub==$idClubR) {
                        echo '<option value="'.$joueur->idJoueur.'">';
                        echo $joueur->nom.'&nbsp'.$joueur->prenom;
                        echo '</option>';
                    }
                endforeach; ?>
                </select>
            </td>
			 <td><label>Joueur Z</label></td>
            <td >
            <select class="form-control" name="joueurZ" required>
                    <option value="88">Choisissez un joueur</option>

                <?php
                foreach ($joueurs as $joueur) :
                    if($joueur->idClub==$equipeV[0]->idClub) {
                        echo '<option value="'.$joueur->idJoueur.'">';
                        echo $joueur->nom.'&nbsp'.$joueur->prenom;
                        echo '</option>';
                    }
                endforeach; ?>
                </select>
            </td>
			<td>&ensp;</td>
		</tr>


        <tr>
            <td colspan ="2"> <label>Cliquer sur enregistrer pour sauvegarder les donnees
                    <br/>et saisir les matchs
                    <br/><br/>
                    Cliquer sur annuler  pour abandonner les saisies
                </label>
            </td>
            <td>
                <input class="primarybuttonBlue" type="submit" value="Enregistrer" name="<?= (isset($rencontre)) ? "modifierrencontre" : "creerrencontre" ?>" />
            </td>
            <td>
                <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeChampionnat"?>">Annuler</a>
            </td>

        </tr>
    </table><br/>
    
</div>
<br/>

   
 </form>
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>