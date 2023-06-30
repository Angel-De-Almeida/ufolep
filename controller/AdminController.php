<?php

class AdminController extends Controller
{
    private $auth_levels = [
        "GUEST" => 0,
        "ARBITRE" => 1,
        "GÉRANT" => 2
    ];

    // Méthode de filtrage
    private function filterAndGetUser($minAuthLevel = 1)
    {
        $compteModele = $this->loadModel("Compte");
        $redirectURL = "/auth/login";

        if (isset($_SESSION["identifiant"], $_SESSION["hash"], $_SESSION["type"], $_SESSION["ippref"])) {
            $ip = IP::getUserIP();
            $accountType = $_SESSION["type"];
            $validUser = $compteModele->userExists(Security::hardEscape($_SESSION["identifiant"]));
            $validIP = IP::startsWithPrefix($ip, Security::hardEscape($_SESSION["ippref"]));

            if (isset($this->auth_levels["$accountType"])) {
                $validAuthorization = $this->auth_levels["$accountType"] >= $minAuthLevel;
            } else {
                $validAuthorization = false;
            }

            if (!($validUser && $validIP && $validAuthorization)) {
                Session::destruct();
                $this->redirect($redirectURL);
            }
        } else {
            Session::destruct();
            $this->redirect($redirectURL);
        }

        $d["c_user"] = $compteModele->getByLogin($_SESSION["identifiant"], $_SESSION["hash"], true);
        $this->set($d);

        return $d["c_user"];
    }

    function formCsv()
    {

        $this->filterAndGetUser(1);
        //$this->render("formCsv");
        $persoModele = $this->loadModel("Personne");
        $joueurModele = $this->loadModel("Joueur");
        $d["avant"] = "avant submit";
        if (isset($_POST["submitcsv"])) {
            $d["leFichier"]=$_POST["file"];
            $d["apres"] = "submit OK";
            $d["leTest"]=$_POST["test"];

            if(isset($_FILES['file']))
            {
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    $data = fgetcsv($handle, 1000, ","); //élimine la première ligne si elle contient des en-têtes
                    $d["leContenu"]="lecture du fichier csv --> ";
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        //$d["nb"] = count($data);
                        /*
                    $att0 = $data[0]."000";
                    $att1 = $data[1]."111";
                    $att2 = $data[2]."222";
                    $att3 = $data[3]."333";
                    $att4 = $data[4]."444";
                    $att5 = $data[5]."555";

                    $d["leContenu"] .= $att0.$att1.$att2.$att3.$att4.$att5."<-->";
                    */
                        // à revoir mars/avril 2022 
                        /*$idPersonne = $persoModele->insertAI(
                            ["nom", "prenom", "age", "sexe", "mail", "adresse"],
                            [$data[0], $data[1],$data[2],$data[3],$data[4],$data[5]]
                        );*/
                        $idPersonne = $persoModele->insertAI(
                            ["nom", "prenom", "age", "sexe", "mail", "adresse"],
                            [$data[0], $data[1],$data[2],$data[3],null,null]
                        );
                        $d["insert"] = $idPersonne;
                        $joueurModele->insert(
                            ["idJoueur", "licenceJoueur", "visible", "idEquipe", "nbPoints"],
                            [$idPersonne, $data[3], 1, 0, $data[4]]
                        );

                    }
                    $cheminDeFichierTemporaire=$_FILES['file']['tmp_name'];
                    $d["leChemin"] = $cheminDeFichierTemporaire."***";
                    $nomFichier=$_FILES['file']['name'];
                    $d["leFichierSub"] = $nomFichier;
                    //$d["resultat"] = $persoModele->insertCsv($cheminDeFichierTemporaire,$nomFichier,["nom", "prenom", "age", "sexe", "mail", "adresse"]);
                    //$d["rbis"]=var_dump($d["resultat"]);
                }
            }

        }
        $this->set($d);
        $this->render("formCsv");
    }

    function listeChampionnat()
    {
        $this->filterAndGetUser(1);

        $this->modChamp = $this->loadModel("Championnat");
        $this->modPoule = $this->loadModel("Poule");

        $groupby = "championnat.idChampionnat";
        $orderpby = 'nomChampionnat desc, championnat.idDivision';
        $where = "championnat.nomChampionnat LIKE '%".date ("Y")."'";


        $d["championnats"] = $this->modChamp->find([
            "groupby" => $groupby,
            "orderby" => $orderpby,
            "conditions" => $where
        ]);

        if (empty($d['championnats'])) {
            $this->e404('Page introuvable');
        }

        $d["poules"] = $this->modPoule->find([
            "groupby" => "idChampionnat, nomPoule",
            "orderby" => "nomPoule"
        ]);

        $this->set($d);
        $this->render("listeChampionnat");
    }

    function listeJoueur()
    {
        $this->filterAndGetUser(1);

        $this->modJoueur = $this->loadModel('Joueur');
        $projection = 'personne.nom, personne.prenom, joueur.idJoueur, joueur.nbPoints';
        $orderby = 'joueur.nbPoints desc';
        $params = array('conditions' => 1, 'projection' => $projection, 'orderby' => $orderby);
        $d['joueurs'] = $this->modJoueur->find($params);

        if (empty($d['joueurs'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function formChampionnat()
    {
        $this->filterAndGetUser(2);

        if (isset($_POST["creerChampionnat"])) {
            $championnatModele = $this->loadModel("Championnat");

            $nomChampionnat = $_POST["nomChampionnat"];
            $typeChampionnat = $_POST["typeChampionnat"];
            $nombreJournees = $_POST["nombreJournee"];
            $idDivision = $_POST["idDivision"];

            $valid1 = filter_var_array(
                [
                    "nomChampionnat" => $nomChampionnat,
                    "typeChampionnat" => $typeChampionnat,
                    "nombreJournees" => $nombreJournees,
                    "idDivision" => $idDivision
                ],
                [
                    "nomChampionnat" => FILTER_SANITIZE_STRING,
                    "typeChampionnat" => FILTER_SANITIZE_STRING,
                    "nombreJournees" => FILTER_VALIDATE_INT,
                    "idDivision" => FILTER_VALIDATE_INT
                ]
            );

            $nomChampionnat = Security::shorten($nomChampionnat, 64);

            $typesChampionnat = Parser::getEnumValuesFromRaw(
                $championnatModele->getColumnFromTable("championnat", "typeChampionnat")["Type"]
            );

            $valid2 = in_array($typeChampionnat, $typesChampionnat);

            if ($valid1 && $valid2) {
                $championnatModele->insertAI(
                    ["nomChampionnat", "typeChampionnat", "idDivision"],
                    [$nomChampionnat, $typeChampionnat, $idDivision]
                );
                $this->redirect("/admin/listeChampionnat");
            } else {
                $this->redirect("/admin/formChampionnat");
            }
        } else {
            $championnatModele = $this->loadModel("Championnat");
            $divisionModele = $this->loadModel("division");

            $d["divisions"] = $divisionModele->find();
            $d["typesChampionnat"] = Parser::getEnumValuesFromRaw(
                $championnatModele->getColumnFromTable("championnat", "typeChampionnat")["Type"]
            );

            $this->set($d);
            $this->render("formChampionnat");
        }
    }

    function listeEquipe()
    {
        $this->filterAndGetUser(1);

        $this->modEquipe = $this->loadModel('Equipe');
        $groupby = "equipe.idEquipe";
        $orderby = "idDivision, equipe.nomEquipe ";
        $params = array();
        $params = array('groupby' => $groupby, 'orderby'=>$orderby);
        $d['equipes'] = $this->modEquipe->find($params);
       // var_dump ($d['equipes']);

        if (empty($d['equipes'])) {
            $this->e404('Page introuvable');
        }

        $this->set($d);
        $this->render("listeEquipe");
    }

    function formEquipe()
    {
        $this->filterAndGetUser(1);

        if (isset($_POST["creerEquipe"])) {
            $equipeModele = $this->loadModel("Equipe");
            $nomEquipe = $_POST["nomEquipe"];
            $idClub = $_POST["idClub"];
            $idDivision = $_POST["idDivision"];

            $equipeModele->insertAI(
                ["nomEquipe", "idClub", "idDivision"],
                [$nomEquipe, $idClub, $idDivision]
            );
            $this->redirect("/admin/listeEquipe");
        } else {
            $clubModele = $this->loadModel("Club");
            $divisionModele = $this->loadModel("Division");

            $d["clubs"] = $clubModele->find();
            $d["divisions"] = $divisionModele->find();



            $this->set($d);
            $this->render("formEquipe");
        }
    }

    function formJoueur()
    {
        $this->filterAndGetUser(1);

        if (isset($_POST["creerJoueur"])) {
            $joueurModele = $this->loadModel("Joueur");
            $joueurModele->table = "joueur";
            $personneModele = $this->loadModel("Personne");
            $nom = $_POST["nom"];
            $prenom = $_POST['prenom'];
            $sexe = $_POST['sexe'];
            $licence = $_POST['licence'];
            $nbPoints = $_POST['classement'];
            $idEquipe = $_POST["idEquipe"];

            $idPersonne = $personneModele->insertAI(
                ["nom", "prenom", "sexe"],
                [$nom, $prenom, $sexe]
            );

            $joueurModele->insertAI(
                ["idJoueur", "licenceJoueur", "visible", "idEquipe", "nbPoints"],
                [$idPersonne, $licence, 1, $idEquipe, $nbPoints]
            );
            $this->redirect("/admin/listeJoueur");
        } else {
            $equipeModele = $this->loadModel("Equipe");
            $orderby = "nomEquipe";
            $d["equipes"] = $equipeModele->find(["orderby" => $orderby]);

            $this->set($d);
            $this->render("formJoueur");
        }
    }

    function formJournee()
    {
        $this->filterAndGetUser(1);
    }

    function formRencontre()
    {
        $this->filterAndGetUser(1);


		// création d'une rencontre (facultatif, cf import csv en début de saison)
        if (isset($_POST["creerrencontre"])) {
		
            $EquipeRencontreModele = $this->loadModel("EquipeRencontre");

            $EquipeA = $_POST["equipea"];
            $EquipeB = $_POST["equipeb"];
            //$ScoreA = $_POST["scorea"];
			$ScoreA = 0;
            //$ScoreB = $_POST["scoreb"];
			$ScoreB = 0;
            $Heure = $_POST["heure"];
            $Date = $_POST["date"];
            $Lieu = $_POST["lieu"];
            $Arbitre = $_POST["arbitre"];
            $Journee = $_POST["journee"];

            $EquipeRencontreModele->insertAI(
                ["heure", "date", "lieu", "scoreFinalA", "scoreFinalB", "idJournee", "idArbitre", "idEquipeA", "idEquipeB"],
                [$Heure, $Date, $Lieu, $ScoreA, $ScoreB, $Journee, $Arbitre, $EquipeA, $EquipeB]
            );
            $this->redirect("/admin/listeChampionnat");
        } 
		elseif (isset($_POST["modifierrencontre"])) {
			// modification d'une rencontre (généralités)
           // var_dump($_POST['modifierrencontre']);
        //  var_dump ($_GET["idRencontre"]);
            // ajout 11/08/2020

            $RencontreModele = $this->loadModel("Rencontre");
            $RencontreModele->table = "rencontre";

            $idRencontre = $_GET['idRencontre'];
            $idChampionnat= $_POST['championnat'];
            //$d["championnat"]=$idChampionnat;
            $equipeA = $_POST["equipea"];
            $equipeB = $_POST["equipeb"];
            $idEquipeR=$_POST["idEquipeR"];
            $idEquipeV=$_POST["idEquipeV"];
            
            $Heure = $_POST["heure"];
            $Date = $_POST["date"];
            $Lieu = $_POST["lieu"];
            //modif du 27/10/2020 gérer arbitre (id joueur ou texte brut
            $Arbitre = $_POST["arbitre"];
            $Journee = $_POST["journee"];
            $pointsA = $_POST["nbPointsA"];
            $pointsB = $_POST["nbPointsB"];
            if(isset($_POST["forfait"])) {$forfait = $_POST["forfait"]; }
            //ajout du 19/11/2021
            $verrou = $_POST["verrou"];
           // var_dump($verrou);
			//ajout du 16/08/2020
			$joueurA = $_POST["joueurA"];
			$joueurX = $_POST["joueurX"];
			$joueurB = $_POST["joueurB"];
			$joueurY = $_POST["joueurY"];
			$joueurC = $_POST["joueurC"];
			$joueurZ = $_POST["joueurZ"];
             //ajout du 21/08/2021
            //$statut = "S";
            $engagementR=$_POST["engagementR"];
            $engagementV=$_POST["engagementV"];

            $EquipeModele = $this->loadModel("Equipe");
            $EquipeModele->table = "equipe";
            $EngagementModele = $this->loadModel("Engagement");
            // modifier 1/0 dans table rencontre
            //modif du 19/11/2021
            if($forfait!="J" && $verrou == "O"){
                $donnees = array("heure" => $Heure, "date" => $Date, "lieu" => $Lieu, "idArbitre" => $Arbitre, "WO" => $forfait, "verrou" => 'F');
                $conditions = array('idRencontre' => $idRencontre);
                $params = array('donnees' => $donnees, 'conditions' => $conditions);
                $RencontreModele->update($params);
                if($forfait=="A" ) {
                    $pointsB+=3;
                    $donneesB = array("nbPoints" => $pointsB);
                    //$conditionsB = array('idEquipe' => $idEquipeV);
                    //$paramsB = array('donnees' => $donneesB, 'conditions' => $conditionsB);
                    //$EquipeModele->update($paramsB);
                    $conditionsB = array('idEngagement' => $engagementV );
                    $paramsB = array('donnees' => $donneesB, 'conditions' => $conditionsB);
                    $EngagementModele->update($paramsB);
                }
                else {
                    $pointsA+=3;
                    $donneesA = array("nbPoints" => $pointsA);
                    //$conditionsA = array('idEquipe' => $idEquipeR);
                    //$paramsA = array('donnees' => $donneesA, 'conditions' => $conditionsA);
                    //$EquipeModele->update($paramsA);
                    $conditionsA = array('idEngagement' => $engagementR);
                    $paramsA = array('donnees' => $donneesA, 'conditions' => $conditionsA);
                    $EngagementModele->update($paramsA);

                }
                $this->redirect("/admin/listeChampionnat");
            }


//            if($forfait=="B"   {
//                $pointsA+=3;
//                $donneesA = array("nbPoints" => $pointsA);
//                $conditionsA = array('idEquipe' => $idEquipeR);
//                $paramsA = array('donnees' => $donneesA, 'conditions' => $conditionsA);
//                $EquipeModele->update($paramsA);
//                $this->redirect("/admin/listeChampionnat");
//            }
			//ajout test du 17/08/2020
            //modif du 19/11/2021
			if($forfait == "J" && ( $verrou == "O" || $verrou == "P")) {
                //modif du 19/11/2021
                $donnees = array("heure" => $Heure, "date" => $Date, "lieu" => $Lieu, "idArbitre" => $Arbitre, "verrou" => 'P');
                $conditions = array('idRencontre' => $idRencontre);
                $params = array('donnees' => $donnees, 'conditions' => $conditions);
                $RencontreModele->update($params);
				//ajout du 16/08/2020
				$DetailMatchModele = $this->loadModel('DetailMatch');
				$DetailMatchModele->insertAI(
					["idJR", "idJV", "idRencontre"],
					[$joueurA, $joueurX, $idRencontre]
				);
				$DetailMatchModele->insertAI(
					["idJR", "idJV", "idRencontre"],
					[$joueurB, $joueurY, $idRencontre]
				);
				$DetailMatchModele->insertAI(
					["idJR", "idJV", "idRencontre"],
					[$joueurC, $joueurZ, $idRencontre]
				);
                $DetailMatchModele->insertAI(
                    ["idJR", "idJV", "idRencontre"],
                    [$joueurB, $joueurX, $idRencontre]
                );
                $DetailMatchModele->insertAI(
                    ["idJR", "idJV", "idRencontre"],
                    [$joueurA, $joueurZ, $idRencontre]
                );
                $DetailMatchModele->insertAI(
                    ["idJR", "idJV", "idRencontre"],
                    [$joueurC, $joueurY, $idRencontre]
                );
				$DetailMatchModele->insertAI(
					["idJR", "idJV", "idRencontre"],
					[$joueurB, $joueurZ, $idRencontre]
				);
				$DetailMatchModele->insertAI(
					["idJR", "idJV", "idRencontre"],
					[$joueurC, $joueurX, $idRencontre]
				);
                $DetailMatchModele->insertAI(
                    ["idJR", "idJV", "idRencontre"],
                    [$joueurA, $joueurY, $idRencontre]
                );
				// modif 17/08/2020
				//$this->redirect("/admin/formRencontreDetail/?idRencontre=".$idRencontre."&championnat=".$idChampionnat);
            }
			else
            {
                $this->redirect("/admin/listeChampionnat");
            }
			// modif 17/08/2020
            //$this->redirect("/admin/listeChampionnat");

            $this->redirect("/admin/formRencontreDetail/?idRencontre=".$idRencontre."&championnat=".$idChampionnat);
        } 
		
		elseif (isset($_GET['idRencontre'])) {
           // var_dump ($_GET['idRencontre']);
            $idRencontre = $_GET['idRencontre'];
            $idChampionnat= $_GET['championnat'];
            $d["championnat"]=$idChampionnat;
            $this->modRenc = $this->loadModel('Rencontre');
            $conditions = array('idRencontre' => $idRencontre);
            $params = array('conditions' => $conditions);
            $rencontre = $this->modRenc->find($params);
            $d['rencontre'] = $rencontre;
            //ajout du 19/11/2021
            $d["statut"] = $rencontre[0]->statut;
            $d["verrou"] = $rencontre[0]->verrou;

            $EquipeModele = $this->loadModel("Equipe");
            $JoueurModele = $this->loadModel("Joueur");
            $JourneeModele = $this->loadModel("Journee");
            $ArbitreModele = $this->loadModel("Arbitre");
            $EngagementModele = $this->loadModel("Engagement");
            //ajout du 11/08/2020
            $DetailMatchModele = $this->loadModel('DetailMatch');
            $orderbyJoueur = "personne.nom, personne.prenom";


            $d["equipes"] = $EquipeModele->find();
            $d["joueurs"] = $JoueurModele->find(["orderby"=>$orderbyJoueur]);
         //   var_dump (   $d["joueurs"]);
            $d["journees"] = $JourneeModele->find();
            $d["arbitres"] = $ArbitreModele->find();
            $conditions = array('idChampionnat' => $idChampionnat);
            $params = array('conditions' => $conditions);
            $d["engagement"] = $EngagementModele->find($params);

            $idJournee=$rencontre[0]->idJournee;
            $conditions = array('journee.idJournee' => $idJournee);
            $params = array('conditions' => $conditions);
            $d["journee"] =  $JourneeModele->find($params);

            //ajout du 11/08/2020
            $conditions = array('idRencontre' => $idRencontre);
            $params = array('conditions' => $conditions);
            $d["matchs"] =  $DetailMatchModele->find($params);
            //var_dump ( $d["matchs"]);
            //var_dump (empty( $d["matchs"]));

			//ajout du 16/08/2020
			$idEquipeR=$rencontre[0]->idEquipeA; $d["idEquipeR"]=$idEquipeR;
			$idEquipeV=$rencontre[0]->idEquipeB; $d["idEquipeV"]=$idEquipeV;

            $conditions = array('equipe.idEquipe' => $idEquipeR);
            $params = array('conditions' => $conditions);
            $equipeR = $EquipeModele->find($params);
            $d["equipeR"] = $equipeR;
            $conditions = array('equipe.idEquipe' => $idEquipeV);
            $params = array('conditions' => $conditions);
            $equipeV = $EquipeModele->find($params);
            $d["equipeV"] = $equipeV;
            $idClubR=$equipeR[0]->idClub;
            $idClubV=$equipeV[0]->idClub;
            $d["idClubR"]=$idClubR;
            $d["idClubV"]=$idClubV;
           // var_dump ($idClubV);
         //   var_dump ($idClubR);
          	$conditions = array('joueur.idClub' => $idClubR);
		    $params = array('conditions' => $conditions);
            $d["joueursR"] = $JoueurModele->find($params);
			$conditions = array('joueur.idClub' => $idClubV);
			$params = array('conditions' => $conditions);
            $d["joueursV"] = $JoueurModele->find($params);
          //  var_dump ( $d["joueursV"] );
            // Ajout du 27/03/2023

           // var_dump ($d["matchs"]);
		    $this->set($d);
            $this->render("formRencontre");

        } 
				
		else 
		// à voir si on conserve cette partie
		{            
			$this->redirect("/admin/listeChampionnat");
            /* $EquipeModele = $this->loadModel("Equipe");
            $JoueurModele = $this->loadModel("Joueur");
            $JourneeModele = $this->loadModel("Journee");
            $ArbitreModele = $this->loadModel("Arbitre");

            $d["equipes"] = $EquipeModele->find();
            $d["joueurs"] = $JoueurModele->find();
            $d["journees"] = $JourneeModele->find();
            $d["arbitres"] = $ArbitreModele->find();

            $this->set($d);
            $this->render("formRencontre"); */
        }

    }
    function formRencontreDetail()
    {
        $this->filterAndGetUser(1);






        // création d'une rencontre (facultatif, cf import csv en début de saison)
        if (isset($_POST["creerrencontre"])) {

            $EquipeRencontreModele = $this->loadModel("EquipeRencontre");

            $equipeA = $_POST["equipea"];
            $equipeB = $_POST["equipeb"];
            $ScoreA = $_POST["scorea"];
            $ScoreB = $_POST["scoreb"];
            $Heure = $_POST["heure"];
            $Date = $_POST["date"];
            $Lieu = $_POST["lieu"];
            $Arbitre = $_POST["arbitre"];
            $Journee = $_POST["journee"];

            $EquipeRencontreModele->insertAI(
                ["heure", "date", "lieu", "scoreFinalA", "scoreFinalB", "idJournee", "idArbitre", "idEquipeA", "idEquipeB"],
                [$Heure, $Date, $Lieu, $ScoreA, $ScoreB, $Journee, $Arbitre, $equipeA, $equipeB]
            );
            $this->redirect("/admin/listeChampionnat");
        }
        elseif(isset($_POST["modifierrencontre"])) {
            // modification d'une rencontre (généralités)
         //   var_dump($_POST['modifierrencontre']);


            $RencontreModele = $this->loadModel("Rencontre");
            $JourneeModele = $this->loadModel ("Journee");
            $JourneeModele->table = "journee";
            $RencontreModele->table = "rencontre";

            $EngagementModele = $this->loadModel("Engagement");
            $idRencontre = $_GET['idRencontre'];
            //$idChampionnat= $_GET['championnat'];

            $equipeA = $_POST["equipea"];
            $equipeB = $_POST["equipeb"];
            $idEquipeR=$_POST["idEquipeR"];
            $idEquipeV=$_POST["idEquipeV"];
            $scoreA = $_POST["scoreA"];
            $scoreB = $_POST["scoreB"];
            $pdbA = $_POST["pdbA"];
            $pdbB = $_POST["pdbB"];
            $pointsABC = $_POST["ptsA"];
            $pointsXYZ = $_POST["ptsB"];
            $pointsA = $_POST["nbPointsA"];
            $pointsB = $_POST["nbPointsB"];
            $matchesGagnesR= $_POST["matchesGagnesR"];
            $matchesGagnesV= $_POST["matchesGagnesV"];
            $matchesPerdusR= $_POST["matchesPerdusR"];
            $matchesPerdusV= $_POST["matchesPerdusV"];
            $engagementR=$_POST["engagementR"];
            $engagementV=$_POST["engagementV"];
            // modif du 17/11/2021
            $verrou=$_POST["verrou"];

            if(isset($_POST["forfait"])) {$forfait = $_POST["forfait"]; }
            //ajout du 16/08/2020
            $joueurA = $_POST["joueurA"];
        //    var_dump ($joueurA);
            $joueurX = $_POST["joueurX"];
            $joueurB = $_POST["joueurB"];
            $joueurY = $_POST["joueurY"];
            $joueurC = $_POST["joueurC"];
            $joueurZ = $_POST["joueurZ"];
            //ajout du 26/08/2020
            $M1 = $_POST["m1"];
            $M2 = $_POST["m2"];
            $M3 = $_POST["m3"];
            $M4 = $_POST["m4"];
            $M5 = $_POST["m5"];

            $D1 = $_POST["d1"];
            $D2 = $_POST["d2"];
            $D3 = $_POST["d3"];
            $D4 = $_POST["d4"];
            $D5 = $_POST["d5"];
            // modif 27/08/2020
            $ligneMatch = $_POST["ligneMatch"];
            $EquipeModele = $this->loadModel("Equipe");
            $EquipeModele->table = "equipe";


            //ajout test du 17/08/2020
            // ajout test du 21/08/2021
            // inclure la vérification du verrou
            if($forfait == "J" && $verrou == "P") {  // à rétablir peut-être
                //ajout du 16/08/2020
                $DetailMatchModele = $this->loadModel('DetailMatch');
                $DetailMatchModele->table = "detailmatch";
                // ajout du 26/08/2020
                // modifié 27/08/2020
                // modifié 27/10/2020
                $nbMatchs = 9;
                for ($i = 0; $i < $nbMatchs; $i++) {
                    $donneesM = array("pointsA" => $pointsABC[$i], "pointsB" => $pointsXYZ[$i], "M1" => $M1[$i], "M2" => $M2[$i], "M3" => $M3[$i], "M4" => $M4[$i], "M5" => $M5[$i]);  // à remplacer par $M1[0]
                    $num = $ligneMatch[$i];
                    $conditionsM = array('idMatch' => $num);//$conditionsM = array('idMatch'  => $ligneMatch[$i]);
                    $paramsM = array('donnees' => $donneesM, 'conditions' => $conditionsM);
                    $DetailMatchModele->update($paramsM);
                }

                // modif 17/08/2020
                //$this->redirect("/admin/listeChampionnat");


                // modif 28/08/2020
                // maj rencontre : double avec score rencontre
                //$donnees = array("D1" => $D1, "D2" => $D2, "D3" => $D3, "D4" => $D4, "D5" => $D5, "scoreFinalA" => $ScoreA, "scoreFinalB" => $ScoreB);
                // maj rencontre : ajouter double dans rencontre
                // modif 27/10/2020
                // modif 21/08/2021


                $donnees = array("scoreFinalA" => $scoreA, "scoreFinalB" => $scoreB, "ptsDbA" => $pdbA, "ptsDbB" => $pdbB, "D1" => $D1, "D2" => $D2, "D3" => $D3, "D4" => $D4, "D5" => $D5, "verrou" => 'F');
                $conditions = array('idRencontre' => $idRencontre);
                $params = array('donnees' => $donnees, 'conditions' => $conditions);
                $RencontreModele->update($params);

                // MAJ points obtenus par équipe
                if ($scoreA < $scoreB) {
                    $pointsB += 3;
                    $pointsA++;
                } elseif ($scoreA > $scoreB) {
                    $pointsA += 3;
                    $pointsB++;
                } else {
                    $pointsB += 2;
                    $pointsA += 2;
                }
                $idChampionnat= $_GET['championnat'];
                // modif 27/10/2020 21/08/2021
                $matchesGagnesR+= $scoreA;
                $matchesGagnesV+= $scoreB;
                $matchesPerdusR+= $scoreB;
                $matchesPerdusV+= $scoreA;
                $donneesB = array("nbPoints" => $pointsB, "matchesGagnes" => $matchesGagnesV, "matchesPerdus" => $matchesPerdusV);
                //$conditionsB = array('idEquipe' => $idEquipeV);
                //$paramsB = array('donnees' => $donneesB, 'conditions' => $conditionsB);
                //$EquipeModele->update($paramsB);
                //$pointsB=99;$matchesGagnesV=88;$matchesPerdusV=55;
                //$donneesBB = array("nbPoints" => $pointsB, "matchesGagnes" => $matchesGagnesV, "matchesPerdus" => $matchesPerdusV);
                //$idChampionnat = 9;
                //$conditionsBB = array('idEquipe' => $idEquipeV, 'idChampionnat' => $idChampionnat);
                // à faire : mettre idengagement en hidden dans les formulaires via le modèle
                // récupérer idengagement avant l'update
                // ajouster avec SMASH
                $conditionsBB = array('idEngagement' => $engagementV);
                $paramsBB = array('donnees' => $donneesB, 'conditions' => $conditionsBB);
                $EngagementModele->update($paramsBB);

                $donneesA = array("nbPoints" => $pointsA, "matchesGagnes" => $matchesGagnesR, "matchesPerdus" => $matchesPerdusR);
                //$conditionsA = array('idEquipe' => $idEquipeR);
                //$paramsA = array('donnees' => $donneesA, 'conditions' => $conditionsA);
                //$EquipeModele->update($paramsA);
                $conditionsAA = array('idEngagement' => $engagementR);
                $paramsAA = array('donnees' => $donneesA, 'conditions' => $conditionsAA);
                $EngagementModele->update($paramsAA);
            }
            // modif 17/08/2020
          //  $this->redirect("/admin/listeChampionnat");
            //$this->redirect("/admin/liste");
            $this->redirect ("/admin/listeChampionnat");

        } elseif (isset($_GET['idRencontre'])) {

            $idRencontre = $_GET['idRencontre'];
          //  var_dump ($idRencontre);
            $this->modRenc = $this->loadModel('Rencontre');
            $conditions = array('idRencontre' => $idRencontre);
            $params = array('conditions' => $conditions);
            $rencontre = $this->modRenc->find($params);
           // var_dump ($rencontre);
            $d['rencontre'] = $rencontre;
            $idChampionnat= $_GET['championnat'];
            $d["championnat"]=$idChampionnat;
          //  var_dump ($idChampionnat);
           // var_dump ( $d["championnat"]);
            $EquipeModele = $this->loadModel("Equipe");
            $JoueurModele = $this->loadModel("Joueur");
            $JourneeModele = $this->loadModel("Journee");
            $ArbitreModele = $this->loadModel("Arbitre");
            //ajout du 11/08/2020
            $DetailMatchModele = $this->loadModel('DetailMatch');
            $EngagementModele = $this->loadModel('Engagement');
            $d["equipes"] = $EquipeModele->find();
            $d["joueurs"] = $JoueurModele->find();
            $d["journees"] = $JourneeModele->find();
            $d["arbitres"] = $ArbitreModele->find();
         //   var_dump ($d["rencontre"]);
            $conditions = array('idChampionnat' => $idChampionnat);
            $params = array('conditions' => $conditions);
            $d["engagement"] = $EngagementModele->find($params);
          //  var_dump ($d["engagement"]);
            //ajout du 11/08/2020
            $conditions = array('idRencontre' => $idRencontre);
            $params = array('conditions' => $conditions);
            $d["matchs"] =  $DetailMatchModele->find($params);
            //var_dump ($conditions);
           // var_dump ($params);
            //var_dump ( $d["matchs"]);
            //ajout du 28/10/2020
            $idEquipeR=$rencontre[0]->idEquipeA;
            $idEquipeV=$rencontre[0]->idEquipeB;
            $idArbitre=$rencontre[0]->idArbitre;
            $idJournee=$rencontre[0]->idJournee;

            $d["statut"] = $rencontre[0]->statut;
            $d["verrou"] = $rencontre[0]->verrou;

            $conditions = array('journee.idJournee' => $idJournee);
            $params = array('conditions' => $conditions);
            $d["journee"] =  $JourneeModele->find($params);

            $conditions = array('joueur.idEquipe' => $idEquipeR);
            $params = array('conditions' => $conditions);
            $d["joueursR"] = $JoueurModele->find($params);
            $conditions = array('joueur.idEquipe' => $idEquipeV);
            $params = array('conditions' => $conditions);
            $d["joueursV"] = $JoueurModele->find($params);

            $conditions = array('equipe.idEquipe' => $idEquipeR);
            $params = array('conditions' => $conditions);
            $equipeR = $EquipeModele->find($params);
            $d["equipeR"] = $equipeR;
            $conditions = array('equipe.idEquipe' => $idEquipeV);
            $params = array('conditions' => $conditions);
            $equipeV = $EquipeModele->find($params);
            $d["equipeV"] = $equipeV;

            $conditions = array('joueur.idJoueur' => $idArbitre);
            $params = array('conditions' => $conditions);
            $d["arbitre"] = $JoueurModele->find($params);

            // ajout du 05/11/2022
            // tableau de lettres-clés
            $d["cles"] = ["NJ" => ["A - X","B - Y","C - Z","B - X","A - Z","C - Y","B - Z","C - X","A - Y"],
                "D" => ["D - X","B - Y","C - Z","B - X","A - Z","C - Y","B - Z","C - X","D - Y"],
                "W" => ["A - X","B - Y","C - Z","W - X","A - Z","C - Y","B - Z","C - X","W - Y"]


                ];

            $this->set($d);
            if($rencontre[0]->WO == "J") {
                $this->render("formRencontreDetail");
            }
            else {
                $this->redirect("/admin/listeChampionnat");
            }
        }
//        else
//            // à voir si on conserve cette partie
//        {
//            $EquipeModele = $this->loadModel("Equipe");
//            $JoueurModele = $this->loadModel("Joueur");
//            $JourneeModele = $this->loadModel("Journee");
//            $ArbitreModele = $this->loadModel("Arbitre");
//
//            $d["equipes"] = $EquipeModele->find();
//            $d["joueurs"] = $JoueurModele->find();
//            $d["journees"] = $JourneeModele->find();
//            $d["arbitres"] = $ArbitreModele->find();
//
//            $this->set($d);
//            //$this->render("formRencontre");
//            //$this->render("formRencontreDetail");
//        }

    }

	function formRencontreSMASH()
    {
        $this->filterAndGetUser(1);

        // création d'une rencontre (facultatif, cf import csv en début de saison)
        if (isset($_POST["creerrencontre"])) {

            $EquipeRencontreModele = $this->loadModel("EquipeRencontre");

            $EquipeA = $_POST["equipea"];
            $EquipeB = $_POST["equipeb"];
            //$ScoreA = $_POST["scorea"];
            $ScoreA = 0;
            //$ScoreB = $_POST["scoreb"];
            $ScoreB = 0;
            $Heure = $_POST["heure"];
            $Date = $_POST["date"];
            $Lieu = $_POST["lieu"];
            $Arbitre = $_POST["arbitre"];
            $Journee = $_POST["journee"];

            $EquipeRencontreModele->insertAI(
                ["heure", "date", "lieu", "scoreFinalA", "scoreFinalB", "idJournee", "idArbitre", "idEquipeA", "idEquipeB"],
                [$Heure, $Date, $Lieu, $ScoreA, $ScoreB, $Journee, $Arbitre, $EquipeA, $EquipeB]
            );
            //$this->redirect("/admin/listeChampionnat");
        }
        elseif (isset($_POST["modifierrencontre"])) {
            // modification d'une rencontre (généralités)
            //var_dump($_POST['modifierrencontre']);

            // ajout 11/08/2020
            //$this->detail();

            $RencontreModele = $this->loadModel("Rencontre");
            $RencontreModele->table = "rencontre";
            $EngagementModele = $this->loadModel("Engagement");
            $idRencontre = $_GET['idRencontre'];
            $idChampionnat= $_POST['championnat'];
            $EquipeA = $_POST["equipea"];
            //var_dump ($EquipeA);
            $EquipeB = $_POST["equipeb"];
            $idEquipeR=$_POST["idEquipeR"];
            $idEquipeV=$_POST["idEquipeV"];

            $Heure = $_POST["heure"];
            $Date = $_POST["date"];
            $Lieu = $_POST["lieu"];
            //modif du 27/10/2020 gérer arbitre (id joueur ou texte brut
            $Arbitre = $_POST["arbitre"];
            $Journee = $_POST["journee"];
            $pointsA = $_POST["nbPointsA"];
            $pointsB = $_POST["nbPointsB"];
            if(isset($_POST["forfait"])) {$forfait = $_POST["forfait"]; }
            //ajout du 19/11/2021
            $verrou = $_POST["verrou"];
            //ajout du 16/08/2020
            $joueurA = $_POST["joueurA"];
            $joueurX = $_POST["joueurX"];
            $joueurB = $_POST["joueurB"];
            $joueurY = $_POST["joueurY"];
            $joueurC = $_POST["joueurC"];
            $joueurZ = $_POST["joueurZ"];
            //ajout du 21/08/2020
            //$statut = "S";

            $EquipeModele = $this->loadModel("Equipe");
            $EquipeModele->table = "equipe";

            $engagementR=$_POST["engagementR"];
            $engagementV=$_POST["engagementV"];

            //modif du 19/11/2021
            if($forfait!="J" && $verrou == "O"){
                $donnees = array("heure" => $Heure, "date" => $Date, "lieu" => $Lieu, "idArbitre" => $Arbitre, "WO" => $forfait, "verrou" => 'F');
                $conditions = array('idRencontre' => $idRencontre);
                $params = array('donnees' => $donnees, 'conditions' => $conditions);
                $RencontreModele->update($params);
                if($forfait=="A" ) {
                    $pointsB+=3;
                    $donneesB = array("nbPoints" => $pointsB);
                    //$conditionsB = array('idEquipe' => $idEquipeV);
                    //$paramsB = array('donnees' => $donneesB, 'conditions' => $conditionsB);
                    //$EquipeModele->update($paramsB);
                    //$conditionsB = array('idEquipe' => $idEquipeV, 'idChampionnat' => $idChampionnat );
                    $conditionsB = array('idEngagement' => $engagementV );
                    $paramsB = array('donnees' => $donneesB, 'conditions' => $conditionsB);
                    $EngagementModele->update($paramsB);
                }
                else {
                    $pointsA+=3;
                    $donneesA = array("nbPoints" => $pointsA);
                    //$conditionsA = array('idEquipe' => $idEquipeR);
                    //$paramsA = array('donnees' => $donneesA, 'conditions' => $conditionsA);
                    //$EquipeModele->update($paramsA);
                    $conditionsA = array('idEngagement' => $engagementR);
                    $paramsA = array('donnees' => $donneesA, 'conditions' => $conditionsA);
                    $EngagementModele->update($paramsA);
                }
               // $this->redirect("/admin/listeChampionnat");
            }

            //ajout test du 17/08/2020
            //modif du 19/11/2021
            if($forfait == "J" && $verrou == "O") {
                //modif du 19/11/2021
                $donnees = array("heure" => $Heure, "date" => $Date, "lieu" => $Lieu, "idArbitre" => $Arbitre, "verrou" => 'P');
                $conditions = array('idRencontre' => $idRencontre);
                $params = array('donnees' => $donnees, 'conditions' => $conditions);
                $RencontreModele->update($params);
                //ajout du 16/08/2020
                $DetailMatchModele = $this->loadModel('DetailMatch');
                //modif du 06/11/2022
                //ajout du 20/08/2021
                for($i=0;$i<9;$i++) {
                    $joueurR[$i]=$_POST["joueurR"][$i];
                    $joueurV[$i]=$_POST["joueurV"][$i];
                    $DetailMatchModele->insertAI(
                        ["idJR", "idJV", "idRencontre"],
                        [$joueurR[$i], $joueurV[$i], $idRencontre]
                    );
                }

            // modif 17/08/2020
            }
            else
            {
              //  $this->redirect("/admin/listeChampionnat");
            }
            //var_dump ("Test");
            $this->redirect("/admin/formRencontreDetail/?idRencontre=".$idRencontre."&championnat=".$idChampionnat);
        }
         elseif (isset($_GET['idRencontre'])) {
             $d["cles"] = [
                 "D" => ["D - X","B - Y","C - Z","B - X","A - Z","C - Y","B - Z","C - X","D - Y"],
                 "W" => ["A - X","B - Y","C - Z","W - X","A - Z","C - Y","B - Z","C - X","W - Y"]


             ];
            $idRencontre = $_GET['idRencontre'];
            $idChampionnat= $_GET['championnat'];
            $d["championnat"]=$idChampionnat;
            $this->modRenc = $this->loadModel('Rencontre');
            $conditions = array('idRencontre' => $idRencontre);
            $params = array('conditions' => $conditions);
            $rencontre = $this->modRenc->find($params);
            $d['rencontre'] = $rencontre;
            //ajout du 19/11/2021
            $d["statut"] = $rencontre[0]->statut;
            $d["verrou"] = $rencontre[0]->verrou;
            $EquipeModele = $this->loadModel("Equipe");
            $JoueurModele = $this->loadModel("Joueur");
            $JourneeModele = $this->loadModel("Journee");
            $ArbitreModele = $this->loadModel("Arbitre");
            //ajout du 11/08/2020
            $DetailMatchModele = $this->loadModel('DetailMatch');
            $EngagementModele = $this->loadModel('Engagement');
            $orderByArb = ["orderby" => "personne.nom"];
             $orderByJoueur = ["orderby" => "personne.nom"];

            $d["equipes"] = $EquipeModele->find();
            $d["joueurs"] = $JoueurModele->find($orderByJoueur);
            $d["journees"] = $JourneeModele->find();
            $d["arbitres"] = $ArbitreModele->find($orderByArb);
            $conditions = array('idChampionnat' => $idChampionnat);
            $params = array('conditions' => $conditions);
            $d["engagement"] = $EngagementModele->find($params);

            $idJournee=$rencontre[0]->idJournee;
            $conditions = array('journee.idJournee' => $idJournee);
            $params = array('conditions' => $conditions);
            $d["journee"] =  $JourneeModele->find($params);

            //ajout du 11/08/2020
            $conditions = array('idRencontre' => $idRencontre);
            $params = array('conditions' => $conditions);
            $d["matchs"] =  $DetailMatchModele->find($params);
            //ajout du 16/08/2020
            $idEquipeR=$rencontre[0]->idEquipeA; $d["idEquipeR"]=$idEquipeR;
            $idEquipeV=$rencontre[0]->idEquipeB; $d["idEquipeV"]=$idEquipeV;
            $conditions = array('equipe.idEquipe' => $idEquipeR);
            $params = array('conditions' => $conditions);
            $equipeR = $EquipeModele->find($params);
            $d["equipeR"] = $equipeR;
            $conditions = array('equipe.idEquipe' => $idEquipeV);
            $params = array('conditions' => $conditions);
            $equipeV = $EquipeModele->find($params);
            $d["equipeV"] = $equipeV;
            $idClubR=$equipeR[0]->idClub;
            $idClubV=$equipeV[0]->idClub;
           // var_dump ($idClubV);
           //  var_dump ($idClubR);
            $d["idClubR"]=$idClubR;
            $d["idClubV"]=$idClubV;
            $conditions = array('joueur.idClub' =>  $idClubR);
            $params = array('conditions' => $conditions);
            $d["joueursR"] = $JoueurModele->find($params);
            $conditions = array('joueur.idClub' => $idClubV);
            $params = array('conditions' => $conditions);
            $d["joueursV"] = $JoueurModele->find($params);

            $this->set($d);
          //  $this->render("formRencontreSMASH");

        }

        else
            // à voir si on conserve cette partie
        {
           // $this->redirect("/admin/listeChampionnat");
            /* $EquipeModele = $this->loadModel("Equipe");
            $JoueurModele = $this->loadModel("Joueur");
            $JourneeModele = $this->loadModel("Journee");
            $ArbitreModele = $this->loadModel("Arbitre");

            $d["equipes"] = $EquipeModele->find();
            $d["joueurs"] = $JoueurModele->find();
            $d["journees"] = $JourneeModele->find();
            $d["arbitres"] = $ArbitreModele->find();

            $this->set($d);
            $this->render("formRencontre"); */
        }

    }

    function listeJournee()
    {
        $this->filterAndGetUser(1);
        //$nomPoule = isset($_GET["nomPoule"])?$_GET["nomPoule"]):""; 
        if (isset($_GET['idchampionnat'])) {
            $modJournee = $this->loadModel("Journee");
            $modChamp = $this->loadModel("Championnat");
            $modPoules = $this->loadModel("Poule");
            $idChampionnat = $_GET['idchampionnat'];
            $conditions = array('idChampionnat' => $idChampionnat);
            $params = array('conditions' => $conditions);
            $d['journee'] = $modJournee->find($params);
            if (empty($d['journee'])) {
                $this->e404('Le calendrier du championnat sera prochainement publié.');
            }
            $conditions = array('championnat.idChampionnat' => $idChampionnat);
            $params = array('conditions' => $conditions);
            $d['championnat'] = $modChamp->findFirst($params);
            // Vérification de la présence de plusieurs poules dans le championnat
            $poules = $modPoules->find(["conditions" => ["idChampionnat" => $idChampionnat]], "TAB");
            $d['hasPoules'] = count($poules) !== 0;
            $d['lesPoules']=$poules ;
            $d['nomPoule'] = isset($_GET["nomPoule"]) ? $_GET["nomPoule"] : null;
            $this->set($d);
        } else {
            $this->e404('Page introuvable. Nous nous excusons pour cet incident.');
        }
    }

    function listeRencontre()
    {
        $this->filterAndGetUser(1);

        if (isset($_GET['idchampionnat'])) {
            // Récupération des modèles
            $modRencontre = $this->loadModel("Rencontre");
            $modJournee = $this->loadModel("Journee");
            $modEquipe = $this->loadModel('Equipe');
            $modChamp = $this->loadModel('Championnat');

            // Récupération des paramètres de la requête
            $idChampionnat = $_GET['idchampionnat'];
            $idJournee = $_GET['idjournee'];
            $nomPoule = isset($_GET['nompoule']) ? $_GET["nompoule"] : null;
            $equipes = [];

            $conditions = ['journee.idJournee' => $idJournee];

            if ($nomPoule) {
                $modRencontre->table .= " INNER JOIN poule ON poule.idChampionnat = championnat.idChampionnat";
                $conditions["nomPoule"] = $nomPoule;
            }

            $groupby = 'idEquipeA';
            $params = ['conditions' => $conditions, 'groupby' => $groupby];

            $rencontres = $modRencontre->find($params);
            $journee = $modJournee->find(["conditions" => ["idJournee" => $idJournee]])[0];

            foreach ($rencontres as $rencontre) {
                // Équipe A
                $conditions = ['equipe.idEquipe' => $rencontre->idEquipeA];
                $params = ['conditions' => $conditions];
                array_push($equipes, $modEquipe->find($params));
                // Équipe B
                $conditions = ['equipe.idEquipe' => $rencontre->idEquipeB];
                $params = ['conditions' => $conditions];
                array_push($equipes, $modEquipe->find($params));
            }

            $conditions = array('championnat.idChampionnat' => $idChampionnat);
            $params = array('conditions' => $conditions);

            $d['championnat'] = $modChamp->findFirst($params);
            $d['equipes'] = $equipes;
            $d['journee'] = $journee;
            $d['rencontre'] = $rencontres;

            $this->set($d);
        } else {
            $this->e404('Aucune rencontre trouvée. Nous nous execusons pour cet incident.');
        }
    }

    public function listeUtilisateur()
    {
        $this->filterAndGetUser(2);

        $compteModele = $this->loadModel("Compte");

        $users = $compteModele->find([
            "orderby" => "compte.identifiant"
        ], "TAB");

        $this->set(["users" => $users]);

        $this->render("listeUtilisateur");
    }

    public function listePersonne() {
        $this->filterAndGetUser(2);

        $personneModele = $this->loadModel("Personne");

        $personnes = $personneModele->find([
            "orderby" => "personne.nom"
        ], "TAB");

        $this->set(["personnes" => $personnes]);

        $this->render("listePersonne");
    }

    public function deleteUtilisateur($id)
    {
        $c_user = $this->filterAndGetUser(2);

        $compteModele = $this->loadModel("Compte");

        $user = $compteModele->find([
            "conditions" => ["idCompte" => $id]
        ], "TAB");

        if (!$user) {
            $this->e404("Cet utilisateur n'existe pas.");
        } elseif ($user[0]["idCompte"] === $c_user["idCompte"]) {
            $this->e404("Vous ne pouvez pas supprimer votre propre compte.");
        }

        $user = $user[0];

        $this->set(["user" => $user]);

        if (isset($_POST["passwd"])) {
            $password = Security::hardEscape($_POST["passwd"]);

            $validUser = $compteModele->getByLogin($_SESSION["identifiant"], $password);

            if (!$validUser) {
                $this->set(["info" => "Mot de passe incorrect."]);
            } else {
                // Suppression de l'utilisateur

                $arbitreModele = $this->loadModel("Arbitre");

                $arbitreModele->delete([
                    "conditions" => ["idArbitre" => $id]
                ]);
                $compteModele->delete([
                    "conditions" => ["idCompte" => $id]
                ]);

                $this->redirect("/admin/listeUtilisateur");
            }
        }
    }

    public function deletePersonne($id)
    {
        $c_user = $this->filterAndGetUser(2);

        $personneModele = $this->loadModel("Personne");
        $compteModele = $this->loadModel("Compte");

        $personne = $personneModele->find([
            "conditions" => ["idPersonne" => $id]
        ], "TAB");

        if (!$personne) {
            $this->e404("Cette personne n'existe pas.");
        } elseif ($personne[0]["idPersonne"] === $c_user["idCompte"]) {
            $this->e404("Vous ne pouvez pas vous supprimer vous-même.");
        }

        $personne = $personne[0];

        $this->set(["personne" => $personne]);

        if (isset($_POST["passwd"])) {
            $password = Security::hardEscape($_POST["passwd"]);

            $validUser = $compteModele->getByLogin($_SESSION["identifiant"], $password);

            if (!$validUser) {
                $this->set(["info" => "Mot de passe incorrect."]);
            } else {
                // Suppression de la personne

                $arbitreModele = $this->loadModel("Arbitre");

                $arbitreModele->delete([
                    "conditions" => ["idArbitre" => $id]
                ]);
                $compteModele->delete([
                    "conditions" => ["idCompte" => $id]
                ]);
                $personneModele->delete([
                    "conditions" => ["idPersonne" => $id]
                ]);

                $this->redirect("/admin/listePersonne");
            }
        }
    }

    public function formUtilisateur($id)
    {
        $c_user = $this->filterAndGetUser(1);

        $redirectURL = $c_user["typeCompte"] === "GÉRANT" ? "/admin/listeUtilisateur" : "/admin/listeChampionnat";

        $personneModele = $this->loadModel("Personne");
        $compteModele = $this->loadModel("Compte");
        $arbitreModele = $this->loadModel("Arbitre");

        $comptes = $compteModele->find([], "TAB");

        $personnes = $personneModele->find([
            "orderby" => "personne.prenom ASC"
        ], "TAB");

        $newForm = !isset($id);
        $types = Parser::getEnumValuesFromRaw($compteModele->getColumnFromTable("compte", "typeCompte")["Type"]);

        $filteredPersonnes = [];

        foreach ($personnes as $p) {
            $alreadyHasAnAccount = false;
            foreach ($comptes as $c) {
                if ($p["idPersonne"] === $c["idCompte"]) {
                    if (!(!$newForm && ($id === $p["idPersonne"]))) $alreadyHasAnAccount = true;
                }
            }
            if (!$alreadyHasAnAccount) array_push($filteredPersonnes, $p);
        }

        $d["newForm"] = $newForm;
        $d["types"] = $types;
        $d["personnes"] = $filteredPersonnes;
        $d["userId"] = $id;

        if ($newForm) {
            // Nouvel utilisateur
            $this->filterAndGetUser(2);

            if (isset($_POST["identifiant"], $_POST["password"], $_POST["typeCompte"], $_POST["idPersonne"])) {
                $identifiant = mb_strtolower(Security::shorten(Security::hardEscape($_POST["identifiant"]), 32));
                $password = Security::shorten($_POST["password"], 72);

                if (preg_match("/\W+/", $password))
                    $this->redirect($redirectURL);

                $typeCompte = $_POST["typeCompte"];
                $idPersonne = $_POST["idPersonne"];

                $compteModele->insert(
                    ["idCompte", "identifiant", "password", "typeCompte"],
                    [$idPersonne, $identifiant, Security::hash($password), $typeCompte]
                );

                if ($typeCompte === "ARBITRE") {
                    // Création d'une occurrence Arbitre
                    $arbitreModele->insert(["idArbitre"], [$idPersonne]);
                }

                $this->redirect($redirectURL);
            }
        } else {
            // Mise à jour d'un utilisateur

            if (($c_user["idCompte"] !== $id) && ($c_user["typeCompte"] !== "GÉRANT")) {
                $this->filterAndGetUser(2);
            }

            if (isset($_POST["identifiant"], $_POST["typeCompte"], $_POST["idPersonne"])) {
                $identifiant = mb_strtolower(Security::shorten(Security::hardEscape($_POST["identifiant"]), 32));
                $password = (isset($_POST["password"]) && strlen($_POST["password"]) > 0) ? Security::shorten($_POST["password"], 72) : "";
                $hash = $password ? Security::hash($password) : "";
                $typeCompte = $_POST["typeCompte"];
                $idPersonne = $_POST["idPersonne"];

                $donneesCompte = [
                    "idCompte" => $idPersonne,
                    "identifiant" => $identifiant,
                    "typeCompte" => $typeCompte
                ];

                if ($password) {
                    if (preg_match("/\W+/", $password)) {
                        $this->redirect($redirectURL);
                    } else
                        $donneesCompte["password"] = $hash;
                }

                if ($typeCompte === "ARBITRE" && $idPersonne !== $id) {
                    $arbitreModele->update([
                        "donnees" => [
                            "idArbitre" => $idPersonne
                        ],
                        "conditions" => [
                            "idArbitre" => $id
                        ]
                    ]);
                } else {
                    $arbitreModele->delete([
                        "conditions" => ["idArbitre" => $id]
                    ]);
                }

                $compteModele->update([
                    "donnees" => $donneesCompte,
                    "conditions" => [
                        "idCompte" => $id
                    ]
                ]);

                if ($c_user["idCompte"] === $id) {
                    Session::set("identifiant", $identifiant);
                    if ($password) {
                        Session::set("hash", $hash);
                    }
                }

                $this->redirect($redirectURL);
            }

            $user = $compteModele->find([
                "conditions" => ["idCompte" => $id]
            ], "TAB");

            if (!$user)
                $this->e404("Cet utilisateur n'existe pas.");
            elseif (!$personnes)
                $this->e404("Il n'existe aucune personne dans la base de données.");

            $d["user"] = $user[0];
        }

        $this->set($d);

        $this->render("formUtilisateur");
    }

    public function formPersonne($id)
    {
        $this->filterAndGetUser(2);

        // Limites possible de l'âge
        $ageBounds = [15, 150];

        $redirectURL = "/admin/listePersonne";

        $personneModele = $this->loadModel("Personne");

        $newForm = !isset($id);

        $d["c_user"] = $newForm;
        $d["newForm"] = $newForm;
        $d["ageBounds"] = $ageBounds;

        $isAllSet = isset($_POST["nom"], $_POST["prenom"], $_POST["age"], $_POST["sexe"], $_POST["mail"], $_POST["adresse"]);


        if ($isAllSet) {

            $nom = Security::shorten(Security::hardEscape($_POST["nom"]), 64);
            $prenom = Security::shorten(Security::hardEscape($_POST["prenom"]), 64);
            $age = $_POST["age"];
            $sexe = $_POST["sexe"];
            $mail = filter_var(Security::shorten(Security::hardEscape($_POST["mail"]), 64), FILTER_VALIDATE_EMAIL);
            $adresse = Security::shorten(Security::hardEscape($_POST["adresse"]), 128);

            // L'adresse e-mail doit être valide.
            if (!$mail)
                $this->redirect($redirectURL);

            // L'âge doit être compris entre 15 et 150 (inclus).
            if (!Security::valueIsBetween($age, $ageBounds[0], $ageBounds[1]) || !is_numeric($age))
                $this->redirect($redirectURL);
        }

        if ($newForm) {
            // Nouvelle personne

            if ($isAllSet) {
                $personneModele->insert(
                    ["nom", "prenom", "age", "sexe", "mail", "adresse"],
                    [$nom, $prenom, $age, $sexe, $mail, $adresse]
                );

                $this->redirect($redirectURL);
            }
        } else {
            // Mise à jour d'une personne

            if ($isAllSet) {
                $personneModele->update([
                    "donnees" => [
                        "nom" => $nom,
                        "prenom" => $prenom,
                        "age" => $age,
                        "sexe" => $sexe,
                        "mail" => $mail,
                        "adresse" => $adresse
                    ],
                    "conditions" => [
                        "idPersonne" => $id
                    ]
                ]);

                $this->redirect($redirectURL);
            }

            $personne = $personneModele->find([
                "conditions" => ["idPersonne" => $id]
            ], "TAB");

            if (!$personne)
                $this->e404("Cet utilisateur n'existe pas.");

            $d["personne"] = $personne[0];
        }

        $this->set($d);

        $this->render("formPersonne");
    }

    function detail()
    {
        if (isset($_GET['nomPoule'])) {
            $nomPoule = $_GET['nomPoule'];
        } else {
            $nomPoule = "";
        }
        $d['nomPoule'] = $nomPoule;

        $idRencontre = $_GET['idRencontre'];
        $this->modRenc = $this->loadModel('Rencontre');
        $conditions = array('idRencontre' => $idRencontre);
        $params = array('conditions' => $conditions);
        $rencontre = $this->modRenc->find($params);
        $d['rencontre'] = $rencontre;

        $d['typeRencontre'] = array('A-X', 'B-Y', 'C-Z', 'B-X', 'A-Z', 'C-Y', 'B-Z', 'C-X', 'A-Y');

        $modEquipe = $this->loadModel('Equipe');
        $equipes = $modEquipe->find(array('conditions' => 1));
        $d['equipes'] = $equipes;

        $modPoule = $this->loadModel('Poule');
        $projection = 'nomPoule';
        $conditions = array('idChampionnat' => $rencontre[0]->idChampionnat, 'idEquipe' => $equipes[0]->idEquipe);
        $groupby = 'nomPoule';
        $params = array('projection' => $projection, 'conditions' => $conditions, 'groupby' => $groupby);
        $d['poules'] = $modPoule->find($params);

        $modJoueur = $this->loadModel('Joueur');
        $d['joueurs'] = $modJoueur->find(array('conditions' => 1));

        $modDivision = $this->loadModel('Division');
        $d['divisions'] = $modDivision->find(array('conditions' => 1));

        $modDetailMatch = $this->loadModel('DetailMatch');
        $conditions = array('idRencontre' => $idRencontre);
        $params = array('conditions' => $conditions);
        $d['matchs'] = $modDetailMatch->find($params);

        if (empty($d['matchs'])) {
            $this->e404('Les résultats de la rencontre seront prochainement publiés.');
        }

        $this->set($d);
    }
    function modifChampionnat(){
        $this->filterAndGetUser(1);
        $championnatModele = $this->loadModel("Championnat");
        $journeeModele = $this->loadModel ("Journee");
        $idChampionnat = $_GET["idchampionnat"];
        $d["championnats"]= $championnatModele->find(["conditions" => "idChampionnat = ".$idChampionnat] );
        $d["journees"]= $journeeModele->find(["projection" => "count(*) as nombreJournee ","conditions" => "idChampionnat = ".$idChampionnat] );
        //var_dump (  $d["journees"]);
        if (isset($_POST["modifChampionnat"])) {


            $nomChampionnat = $_POST["nomChampionnat"];
            $typeChampionnat = $_POST["typeChampionnat"];
            $nombreJournees = $_POST["nombreJournee"];
            $idDivision = $_POST["idDivision"];

            $valid1 = filter_var_array(
                [
                    "nomChampionnat" => $nomChampionnat,
                    "typeChampionnat" => $typeChampionnat,
                    "nombreJournees" => $nombreJournees,
                    "idDivision" => $idDivision
                ],
                [
                    "nomChampionnat" => FILTER_SANITIZE_STRING,
                    "typeChampionnat" => FILTER_SANITIZE_STRING,
                    "nombreJournees" => FILTER_VALIDATE_INT,
                    "idDivision" => FILTER_VALIDATE_INT
                ]
            );

            $nomChampionnat = Security::shorten($nomChampionnat, 64);

            $typesChampionnat = Parser::getEnumValuesFromRaw(
                $championnatModele->getColumnFromTable("championnat", "typeChampionnat")["Type"]
            );

            $valid2 = in_array($typeChampionnat, $typesChampionnat);

            if ($valid1 && $valid2) {
                $championnatModele->update([
                   "donnees"=>
                    [
                    "nomChampionnat"=>$nomChampionnat,
                    "typeChampionnat"=>$typeChampionnat,
                    "idDivision"=>$idDivision
                ],
                    "conditions"=>[
                        "idChampionnat" => $idChampionnat


                ]]);
                $this->redirect("/admin/listeChampionnat");
            } else {
                $this->redirect("/admin/modifChampionnat");
            }
        }

        else {

            $divisionModele = $this->loadModel("division");

            $d["divisions"] = $divisionModele->find();
            $d["typesChampionnat"] = Parser::getEnumValuesFromRaw(
                $championnatModele->getColumnFromTable("championnat", "typeChampionnat")["Type"]
            );

        }

        $this->set($d);
        $this->render ("modifChampionnat");
    }

    function listeTournoi()
    {
        $this->filterAndGetUser(1);
    
        $this->modMatch = $this->loadModel('MatchIndividuel');
        $orderby = "match_individuel.idmatch";
        $params = array();
        $params = array('orderby' => $orderby);
        $d['Matchs'] = $this->modMatch->find($params);
    
        $this->modTournoi = $this->loadModel('Tournoi');
        $tournois = $this->modTournoi->find();
        $d['Tournois'] = json_decode(json_encode($tournois), true);

        if (empty($d['Matchs'])) {
            $this->e404('Page introuvable');
        }
    
        $this->set($d);
        $this->render("listeTournoi");
    }    
    
    public function listeMatchIndividuel($idTournoi)
    {
        $this->filterAndGetUser(1);

        if ($idTournoi === null) {
            $this->e404('Tournoi introuvable');
        }

        $tournoiModele = $this->loadModel("Tournoi");
        $tournoi = $tournoiModele->getTournoiById($idTournoi);
        
        if (!$tournoi) {
            $this->e404('Tournoi introuvable');
        }

        $matchModele = $this->loadModel('MatchIndividuel');
        $matches = $matchModele->find(array('conditions' => array('idTournoi' => $idTournoi), 'orderby' => 'idMatch'));

        $this->set('matches', $matches);
        $this->set('tournoi', $tournoi);
        $this->render("listeMatchIndividuel");
    }
    
    public function FormDetailMatch($idMatch)
    {
        $this->filterAndGetUser(1);

        if ($idMatch === null) {
            $this->e404('Match introuvable');
        }

        $matchModel = $this->loadModel("MatchIndividuel");
        $matches = $matchModel->find(array('conditions' => array('idMatch' => $idMatch)));

        if (empty($matches)) {
            $this->e404('Match introuvable');
        }

        // Instanciez votre modèle
        $model = new MatchIndividuel();
        $matches = $model->find([
            "conditions" => ["idmatch" => $idMatch]
        ]);
        $idTournoi = $matches['0']->idTournoi;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $JR = $_POST['JR'];
            $JV = $_POST['JV'];
            $M1 = $_POST['M1'];
            $M2 = $_POST['M2'];
            $M3 = $_POST['M3'];
            $M4 = $_POST['M4'];
            $M5 = $_POST['M5'];
            $forfait = $_POST['forfait'];
            $tour = $_POST['parametre'];
            $date = $_POST['date'];

            $updateData = array(
                'JR' => $JR,
                'JV' => $JV,
                'M1' => $M1,
                'M2' => $M2,
                'M3' => $M3,
                'M4' => $M4,
                'M5' => $M5,
                'forfait' => $forfait,
                'tour' => $tour,
                'date' => $date
            );
        
            $matchModel->update(['donnees' => $updateData, 'conditions' => ['idMatch' => $idMatch]]);
        
            $this->redirect("/admin/listeMatchIndividuel/" . $idTournoi);
            exit();
        }        

        $this->set('matches', $matches[0]); 
        $this->render("FormDetailMatch");
    }

    public function SupprimerMatch($idMatch)
    {
        
        // Assurez-vous d'importer le fichier contenant la classe MatchIndividuel
        require_once '../model/MatchIndividuel.php';

        // Instanciez votre modèle
        $model = new MatchIndividuel();
        $matches = $model->find([
            "conditions" => ["idmatch" => $idMatch]
        ]);
        $idTournoi = $matches['0']->idTournoi;
        // Vérifiez si le modèle a été instancié correctement
        if ($model) {
            // Appelez la méthode deleteMatch() sur votre modèle pour supprimer la ligne
            $model->deleteMatch($idMatch);
        } else {
            echo "Erreur lors de l'instanciation du modèle.";
        }
        $this->redirect("/admin/listeMatchIndividuel/" . $idTournoi);
        //header('Location: ' . BASE_URL . DS . "admin" . DS . "listeMatchIndividuel/" . $idTournoi);
        exit();
    }

    public function formConfirmationSupprMatch($idMatch)
    {
        $this->filterAndGetUser(1);

        if ($idMatch === null) {
            $this->e404('Match introuvable');
        }

        $matchModel = $this->loadModel("MatchIndividuel");
        $matches = $matchModel->find(array('conditions' => array('idmatch' => $idMatch), 'orderby' => 'idmatch'));

        if (empty($matches)) {
            $this->e404('Match introuvable');
        }
        $d['matches']=$matches;
        $d['idTournoi']=$matches['0']->idTournoi;
        $this->set($d);
        //$this->render("formConfirmationSupprMatch");

    }

    public function formMatchIndividuel()
    {
        $this->filterAndGetUser(2);

        if (isset($_POST["formMatchIndividuel"])) {
            $MatchIndividuelModele = $this->loadModel("MatchIndividuel");

            $joueur1 = $_POST["JR"];
            $joueur2 = $_POST["JV"];
            $date = $_POST["date"];
            $tour = $_POST["parametre"];
            $forfait = $_POST["forfait"];

            // Vérification des noms de colonnes et des données
            $colonnes = ["JV", "JR", "date", "tour", "forfait"];
            $donnees = [$joueur2, $joueur1, $date, $tour, $forfait];

            // Insertion du match individuel
            $lastInsertId = $MatchIndividuelModele->insertAI($colonnes, $donnees);

            if ($lastInsertId !== false) {
                $this->redirect("/admin/listeTournoi");
            } else {
                // Affichage d'un message d'erreur
                echo "Une erreur s'est produite lors de l'insertion du match individuel.";
            }
        } else {
            // ...
        }
    }

    function formTournoi()
    {
        $this->filterAndGetUser(2);

        if (isset($_POST["creerTournoi"])) {
            $TournoiModele = $this->loadModel("Tournoi");

            $libelle = $_POST["libelle"];
            $dateTournoi = $_POST["dateTournoi"];
            $lieu = $_POST["lieu"];
            $jugeArbitre = $_POST["jugeArbitre"];
            $categorie = $_POST["categorie"];

            $valid1 = filter_var_array(
                [
                    "libelle" => $libelle,
                    "dateTournoi" => $dateTournoi,
                    "lieu" => $lieu,
                    "jugeArbitre" => $jugeArbitre,
                    "categorie" => $categorie
                ],
                [
                    "libelle" => FILTER_SANITIZE_STRING,
                    "dateTournoi" => FILTER_SANITIZE_STRING,
                    "lieu" => FILTER_SANITIZE_STRING,
                    "jugeArbitre" => FILTER_SANITIZE_STRING,
                    "categorie" => FILTER_SANITIZE_STRING
                ]
            );

            $libelle = Security::shorten($libelle, 64);

            $categoriesPossibles = Parser::getEnumValuesFromRaw(
                $TournoiModele->getColumnFromTable("tournoi", "categorie")["Type"]
            );

            $valid2 = in_array($categorie, $categoriesPossibles);

            if ($valid1 && $valid2) {
                $TournoiModele->insertAI(
                    ["libelle", "categorie", "dateTournoi", "lieu", "jugeArbitre"],
                    [$libelle, $categorie, $dateTournoi, $lieu, $jugeArbitre]
                );
                $this->redirect("/admin/listeTournoi");
            } else {
                $this->redirect("/admin/formTournoi");
            }
        } else {
            $TournoiModele = $this->loadModel("Tournoi");

            $d["categories"] = Parser::getEnumValuesFromRaw(
                $TournoiModele->getColumnFromTable("tournoi", "categorie")["Type"]
            );

            $this->set($d);
            $this->render("formTournoi");
        }
    }
}