<?php

class JoueurController extends Controller {

    private $modJoueur = null;
    
    function liste() {
        $this->modJoueur = $this->loadModel('Joueur');
        $projection = 'personne.nom, personne.prenom, joueur.idJoueur, joueur.nbPoints';
        $orderby = 'joueur.nbPoints desc';
  if (isset($_GET["idEquipe"])) {
        $id=$_GET["idEquipe"];

  }
        if (isset($id)){
      $condition = "joueur.idEquipe=".$id; }
     else{
         $id ="";
            $condition = 1;
    }

        $params = array('conditions' => $condition, 'projection' => $projection, 'orderby' => $orderby);
        $d['joueurs'] = $this->modJoueur->find($params);

        if (empty($d['joueurs'])) {
            $this->e404('Page introuvable');
        }

        //var_dump ($d['joueurs']);
       // var_dump ($id);

        $this->set($d);
    }

    function detail($id) {
        $idJoueur = trim($id);
        $visible = 1;
        $this->modJoueur = $this->loadModel('Joueur');
        $params = array();
        $projection = 'personne.nom, personne.prenom, personne.age, personne.mail, personne.adresse, joueur.licenceJoueur, joueur.nbPoints, equipe.nomEquipe, joueur.idJoueur';
        $conditions = array('idJoueur' => $idJoueur, 'visible' => $visible);
        $params = array('projection'=>$projection, 'conditions' => $conditions);
        $d['joueur'] = $this->modJoueur->findFirst($params);

        if (empty($d['joueur'])) {
            $this->e404('Informations inaccessibles');
        }
        $this->set($d);
    }
    function modif($id){
        $idJoueur = trim($id);
        $visible = 1;
        $this->modJoueur = $this->loadModel('Joueur');
        $params = array();
        $projection = 'personne.nom, personne.prenom, personne.age, personne.mail, personne.adresse, joueur.licenceJoueur, joueur.nbPoints, equipe.nomEquipe, joueur.idJoueur';
        $conditions = array('idJoueur' => $idJoueur, 'visible' => $visible);
        $params = array('projection'=>$projection, 'conditions' => $conditions);
        $d['joueur'] = $this->modJoueur->findFirst($params);

        if (empty($d['joueur'])) {
            $this->e404('Informations inaccessibles');
        }
        if (isset($_POST["saisie"])){
            $score = $_POST["score"];
            $update = ["nbPoints" => $score];
            $conditionsU = ["idJoueur" => $idJoueur] ;

            $this->modJoueur->update(["donnees"=>$update,"conditions"=>$conditionsU]);
            $this->render ("/joueur/liste");
        }
        $this->set($d);
    }
}