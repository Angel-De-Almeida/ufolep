<?php

class Tournoi extends Model
{
    public $table = "tournoi";
    public $primaryKey = "idTournoi";
    protected $fillable = ['libelle', 'dateTournoi'];

    public function getTournoiById($id)
    {
        return $this->findFirst(array('conditions' => array('idTournoi' => $id)));
    }
}
