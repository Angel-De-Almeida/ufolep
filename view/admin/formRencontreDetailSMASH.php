<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>
<script type="text/javascript">  
   function calculScore() {
	//alert("OK");
	var feuille = document.getElementById("feuilleDeMatch").rows;
	document.getElementById("calcul").style.color = "red";
	var nbSimples = feuille.length-3;
	//alert("recup = "+nbMatchs);
	console.log("nb lignes = "+nbSimples);
	var scoreA = 0;
	var scoreB = 0;
	var vainqueur=new Array();
	var ptsA=new Array();
    var ptsB=new Array();
    //selection du form pour injecter des input
    var formulaire = document.getElementById("saisie");
	for(var i=1;i<nbSimples;i++) {
		vainqueur[i]=0; 
		var colonnes = feuille[i].cells;//on récupère les cellules de la ligne
		//var largeur = colonnes.length;
		//console.log("nb colonnes = "+largeur);
		//for(var j=0; j<largeur; j++) {
		for(var j=2; j<7; j++) {
		 
			var recup = colonnes[j].firstElementChild.value;
			console.log("match["+i+","+(j-1)+"] = "+recup);
			if(recup<0) {
				vainqueur[i]--;
			}
			else 
				{
					vainqueur[i]++;
				}
		}	
		console.log("vainqueur du match["+i+","+(j-1)+"] = "+vainqueur[i]);
        ptsA[i] = document.createElement("input");
        ptsB[i] = document.createElement("input");
        ptsA[i].setAttribute("type","hidden");
        ptsA[i].setAttribute("name","ptsA[]");
        ptsB[i].setAttribute("type","hidden");
        ptsB[i].setAttribute("name","ptsB[]");
        ptsA[i].setAttribute("value",0);
        ptsB[i].setAttribute("value",0);
		if(vainqueur[i]<0) {
				colonnes[j++].innerHTML=0;	
				colonnes[j].innerHTML=1;
				scoreB++;
                ptsB[i].setAttribute("value",1);
			}
			else {
				colonnes[j++].innerHTML=1;	
				colonnes[j].innerHTML=0;
				scoreA++;
                ptsA[i].setAttribute("value",1);
			}
            formulaire.appendChild(ptsA[i]);
            formulaire.appendChild(ptsB[i]);
			console.log("score match["+i+","+j+"] = "+scoreA+" ----- "+scoreB);
	}
	var double = feuille[i].cells;//on récupère les cellules de la ligne
	vainqueur[i]=0;	
	for(var j=1; j<6; j++) {
		//var recup = colonnes[j].firstElementChild.value
		var recup = double[j].firstElementChild.value;
			console.log("double["+i+","+(j-1)+"] = "+recup);
			if(recup<0) {
				vainqueur[i]--;
			}
			else 
				 {
					vainqueur[i]++;
				}	
	}
	// trt double
	var pdbA = document.createElement("input");
	pdbA.setAttribute("type","hidden");
    pdbA.setAttribute("name","pdbA");

    var pdbB = document.createElement("input");
    pdbB.setAttribute("type","hidden");
    pdbB.setAttribute("name","pdbB");

	console.log("vainqueur du double["+i+","+(j-1)+"] = "+vainqueur[i]);
	if(vainqueur[i]<0) {
				scoreB++;
				double[j++].innerHTML=0;	
				double[j].innerHTML=1;
                pdbA.setAttribute("value",0);
                pdbB.setAttribute("value",1);
			}
			else {
				scoreA++;
				double[j++].innerHTML=1;
				double[j].innerHTML=0;
                pdbA.setAttribute("value",1);
                pdbB.setAttribute("value",0);
			} // à vérifier plus tard : utilité pointsA/B pour le double (cf classement) 27/10/2020
    formulaire.appendChild(pdbA);
    formulaire.appendChild(pdbB);
	//alert("sortie de boucle");
	console.log("score final = "+scoreA+" ----- "+scoreB);
	document.saisie.scoreAI.value=scoreA;
	document.saisie.scoreBI.value=scoreB;
	//Ajout d'une nouvelle balise pour le score global
    var inputScoreA = document.createElement("input");
    var inputScoreB = document.createElement("input");
    //on y affecte des attributs (ici, le type, le nom, et sa valeur)
    inputScoreA.setAttribute("type","hidden");
    inputScoreA.setAttribute("name","scoreA");
    inputScoreA.setAttribute("value",scoreA);
    formulaire.appendChild(inputScoreA);
    inputScoreB.setAttribute("type","hidden");
    inputScoreB.setAttribute("name","scoreB");
    inputScoreB.setAttribute("value",scoreB);
    formulaire.appendChild(inputScoreB);
    // modifierrencontre
    document.saisie.modifierrencontre.disabled=false;
   }
   function modifRencontre() {
       var validation = confirm("Voulez-vous modifier le classement ?");
       var verrouName = document.getElementsByName("verrou");
       var verrou = verrouName[0];
       //alert(verrou[0].value);
       if (validation){
           verrou.setAttribute("value","P")
           return true;
       }
       else {
           return false;
       }

   }

</script>
<h2><?= (isset($rencontre)) ? "Saisie des matchs de la rencontre" : "Nouvelle rencontre" ?></h2>
<hr>

<form name="saisie" method="POST" action="" id="saisie">
    <table class="form-table">    
        <tr>
            <td><label>Heure</label></td>
            <td><input class="form-control" type="time" name="heure" value="<?= (isset($rencontre)) ? $rencontre[0]->heure : "" ?>" size="20" readonly/></td>
            <td><label>Date</label></td>
            <td><input class="form-control" type="date" name="date" value="<?= (isset($rencontre)) ? $rencontre[0]->date : "" ?>" size="20" readonly/></td>
            <td><label>Lieu</label></td>
            <td><input class="form-control" type="text" name="lieu" value="<?= (isset($rencontre)) ? $rencontre[0]->lieu : "" ?>" size="20" readonly/></td>
        </tr>  
        <tr>
            <td><label>Équipe A</label></td>
            <td>
                <input class="form-control" type="text" name="equipea" value="<?= $equipeR[0]->nomEquipe ?>" size="20" readonly/>
            </td>
            <td><label>Équipe B</label></td>
            <td>
                <input class="form-control" type="text" name="equipea" value="<?= $equipeV[0]->nomEquipe ?>" size="20" readonly/>
            </td>
        </tr>
      
        <tr>
            <td><label>Points A</label></td>
            <td>  <?php 
            foreach ($equipes as $equipe) :
                if ($rencontre[0]->idEquipeA == $equipe->idEquipe) { ?>                
                    <input class="form-control" type="text" name="nbPointsA" value="<?= $equipe->nbPoints ?>" size="20" readonly/>
                <?php   }  
            endforeach; ?> 
            </td>
               
            <td><label>Points B</label></td>
            <td><?php  
            foreach ($equipes as $equipe) :
                if ($rencontre[0]->idEquipeB == $equipe->idEquipe) { ?> 
                    <input class="form-control" type="text" name="nbPointsB" value="<?= $equipe->nbPoints ?>" size="20" readonly/>
                <?php   }  
            endforeach; ?></td>
                
        </tr>
        <tr>
            <td><label>Journée</label></td>
            <td>
                <input class="form-control" type="text" name="journee" value="<?= $journee[0]->numJournee;?>" size="20" readonly/>
            </td>
            <td><label>Arbitre</label></td>
            <td>
           		<input class="form-control" type="text" name="arbitre" value="<?= (isset($rencontre)) ? $arbitre[0]->nom. ' ' .$arbitre[0]->prenom : "" ?>" size="20" readonly/>
            </td>
        </tr>
		
    </table><br/>
    <div>
    <table border=1 class="data-table sober">
        <thead class="text-center">
            <tr>
                <th colspan=4>Equipe <?php
                                    foreach ($equipes as $e) {
                                        if ($e->idEquipe == $rencontre[0]->idEquipeA) {
                                            echo $e->nomEquipe;
                                        }
                                    }
                                    ?></th>
                <th colspan=4>Equipe <?php
                                    foreach ($equipes as $e) {
                                        if ($e->idEquipe == $rencontre[0]->idEquipeB) {
                                            echo $e->nomEquipe;
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
        <?php         
       
            for ($cpt = 0; $cpt < 3; $cpt++) : ?>
            <td><?php if ($cpt == 0) {
                    echo 'A';
                } elseif ($cpt == 1) {
                    echo 'B';
                } else {
                    echo 'C';
                } ?></td>
            <?php   // ajout 11/08/2020
             if(isset($matchs[$cpt])) {
                foreach ($joueurs as $j) {
               
                  if ($j->idJoueur == $matchs[$cpt]->idJR) {
                    echo '<td>' . $j->nom . ' ' . $j->prenom . '</td>';
                    echo '<td>' . mb_strtoupper($j->licenceJoueur) . '</td>';
                    echo '<td>' . $j->nbPoints . '</td>';
                  }
                }
            }
             else
                {
                    echo '<td> --- </td>';
                    echo '<td> --- </td>';
                    echo '<td> --- </td>';
                }
              // ajout 11/08/2020
            ?>
            <td><?php if ($cpt == 0) {
                    echo 'X';
                } elseif ($cpt == 1) {
                    echo 'Y';
                } else {
                    echo 'Z';
                } ?></td>
            <?php
               if(isset($matchs[$cpt])) {
                foreach ($joueurs as $j) {
              // ajout 11/08/2020
            
                if ($j->idJoueur == $matchs[$cpt]->idJV) {
                    echo '<td>' . $j->nom . ' ' . $j->prenom . '</td>';
                    echo '<td>' . mb_strtoupper($j->licenceJoueur) . '</td>';
                    echo '<td>' . $j->nbPoints . '</td>';
                }
               }
              } // ajout 11/08/2020
               else
                {
                    echo '<td> --- </td>';
                    echo '<td> --- </td>';
                    echo '<td> --- </td>';
                }
             ?>
        </tr>
            <?php endfor; 
            // ajout 11/08/2020
        
        ?>
    </table>
</div>
<br/>

    <table border='1'class="data-table sober"  id="feuilleDeMatch">
        <thead>          
            <th>    Joueurs ABC    </th>
            <th>    Joueurs XYZ    </th>
            <th>Manche1</th>
            <th>Manche2</th>
            <th>Manche3</th>
            <th>Manche4</th>
            <th>Manche5</th>
            <th>Points ABC</th>
            <th>Points XYZ</th>
        </thead>
        <?php $cpt = 0;
        // ajout 11/08/2020
        if(isset($matchs)) {
        foreach ($matchs as $match) : ?> 
            <tr>
                <td><?= $typeRencontre[$cpt]; $cpt++; ?>
						<!--// ajout 27/08/2020  -->
						<input type="hidden" name="ligneMatch[]" value="<?= $match->idMatch ?>" />
					    <?php foreach ($joueurs as $j) {
                        if ($j->idJoueur == $match->idJR) {
                            echo $j->nom. ' ' . $j->prenom;
                        }	
                    } 
					?>
                </td>
                <td>
                    <?php foreach ($joueurs as $j) {
                        if ($j->idJoueur == $match->idJV) {
                            echo $j->nom. ' ' . $j->prenom;
                        }
                    } ?>
                </td>
				<!-- ajout 26/08/2020  -->

				<td><input class="form-control" type="number" name="m1[]" value="<?=  isset($match->M1) ? $match->M1 : 0; ?>" size="3" required/></td>
                <td><input class="form-control" type="number" name="m2[]" value="<?=  isset($match->M2) ? $match->M2 : 0; ?>" size="3" required/></td>
			    <td><input class="form-control" type="number" name="m3[]" value="<?=  isset($match->M3) ? $match->M3 : 0; ?>" size="3" required/></td>
			    <td><input class="form-control" type="number" name="m4[]" value="<?=  isset($match->M4) ? $match->M4 : 0; ?>" size="3" required/></td>
			    <td><input class="form-control" type="number" name="m5[]" value="<?=  isset($match->M5) ? $match->M5 : 0; ?>" size="3" required/></td>
                <td><?= ($match->pointsA == 1) ? $match->pointsA : '<p name="pointsA">-</p>'; ?></td>
                <td><?= ($match->pointsB == 1) ? $match->pointsB : '<p name="pointsB">-</p>' ?></td>
			</tr>
        <?php endforeach; 
           // ajout 11/08/2020
            }
        ?>
        <tr>      
				<!-- remplacer --- par 0 si erreur requête ?  -->		
				<td colspan="2">Double</td>
                <td><input class="form-control" type="number" name="d1" value="<?=  isset($rencontre[0]->D1) ? $rencontre[0]->D1 : 0; ?>" size="3" required/> </td>
                <td><input class="form-control" type="number" name="d2" value="<?=  isset($rencontre[0]->D2) ? $rencontre[0]->D2 : 0; ?>" size="3" required/> </td>
                <td><input class="form-control" type="number" name="d3" value="<?=  isset($rencontre[0]->D3) ? $rencontre[0]->D3 : 0; ?>" size="3" required/> </td>
                <td><input class="form-control" type="number" name="d4" value="<?=  isset($rencontre[0]->D4) ? $rencontre[0]->D4 : 0; ?>" size="3" required/> </td>
                <td><input class="form-control" type="number" name="d5" value="<?=  isset($rencontre[0]->D5) ? $rencontre[0]->D5 : 0; ?>" size="3" required/> </td>
                <td><p id="doubleA" name="doubleA"><?= ($match->pointsA == 1) ? $match->pointsA : '-'; ?></p></td>
                <td><p id="doubleB" name="doubleB"><?= ($match->pointsB == 1) ? $match->pointsB : '-'; ?></p></td>
        </tr>
        <tr> 
            <td colspan="7"><p id="calcul" onclick="calculScore();">Cliquez pour calculer le score final&ensp;<input class="button primarybuttonBlue" type="button" value="calcul" id="calcul" onclick="calculScore();"></p></td>
            <td> <p> <input type="text" id="scoreAI" name="scoreAI" value=" <?= isset($rencontre[0]->scoreFinalA) ? $rencontre[0]->scoreFinalA : '-'; ?>" size="8" disabled></p></td>
            <td> <p> <input type="text" id="scoreBI" name="scoreBI" value=" <?= isset($rencontre[0]->scoreFinalB) ? $rencontre[0]->scoreFinalB : '-'; ?>" size="8" disabled></p></td>
        </tr>
		<tr>
			<td colspan="9">
                <input type="hidden" name="forfait" value="<?= $rencontre[0]->WO ?>"/>
                <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeChampionnat"?>">Annuler</a>
                <input class="primarybutton<?= ($verrou=="P") ? "Blue" : "Red" ?>" type="submit" value="<?= ($verrou=="P") ? "Enregister" : "Modifier" ?>" name="<?= (isset($rencontre)) ? "modifierrencontre" : "creerrencontre" ?>" onclick="return modifRencontre()"  disabled/>
            </td>
		</tr>
    </table>
 </form>
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>