<?php
class EquipeJoueur extends Model
{
    public function getJoueursByEquipeId($idEquipe)
    {
        return $this->find('joueur', ['conditions' => ['idEquipe' => $idEquipe]]);
    }
}
?>