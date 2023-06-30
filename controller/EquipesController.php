<?php 
class EquipesController extends Controller
{
    private $modEquipe = null;

    function liste()
    {
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
        $this->render("liste");
    }

    private $modJoueur = null;
    
    function Equipe() {
        $this->modJoueur = $this->loadModel('Joueur');
        $projection = 'personne.nom, personne.prenom, joueur.idJoueur, equipe.nomEquipe, joueur.nbPoints';
        $orderby = 'joueur.nbPoints desc';
    
        // Récupérer l'id de l'équipe à partir de la requête GET
        $idEquipe = isset($_GET["idEquipe"]) ? $_GET["idEquipe"] : null;
        $d['idEquipe'] = $idEquipe;
    
        if ($idEquipe) {
            // Utiliser l'id de l'équipe pour obtenir le nom de l'équipe
            $this->modEquipe = $this->loadModel('Equipe');
            $condition = "equipe.idEquipe = " . $idEquipe;
            $params = array('conditions' => $condition);
            $equipe = $this->modEquipe->findFirst($params);
    
            // Passer le nom de l'équipe à la vue
            $this->set('nomEquipe', $equipe->nomEquipe);
        }
    
        // Effectuer la recherche des joueurs
        if ($idEquipe) {
            $condition = "joueur.idEquipe = " . $idEquipe;
        } else {
            $condition = 1;
        }
    
        $params = array('conditions' => $condition, 'projection' => $projection, 'orderby' => $orderby);
        $d['joueurs'] = $this->modJoueur->find($params);
    
        if (empty($d['joueurs'])) {
            $this->e404('Page introuvable');
            $this->render("Equipe");
        }
    
        $this->set($d);
    }
    

    function detail($id) {
        //$idJoueur = trim($id);
        $idJoueur=$_GET['idJoueur'];
        $d['idEquipe']=$_GET['idEquipe'];
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
}
?>
