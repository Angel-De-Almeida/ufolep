<?php

class MatchIndividuel extends Model
{
    public $table = "match_individuel";

    public function where($conditions)
    {
        // Vérifiez si des conditions ont été fournies
        if (!empty($conditions)) {
            $query = "SELECT * FROM " . $this->table . " WHERE ";

            $params = [];
            $whereConditions = [];

            foreach ($conditions as $column => $value) {
                $whereConditions[] = $column . " = :" . $column;
                $params[":" . $column] = $value;
            }

            $query .= implode(" AND ", $whereConditions);

            $statement = $this->db->prepare($query);
            $statement->execute($params);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }
    
    public function deleteMatch($idMatch)
    {
        $query = "DELETE FROM " . $this->table . " WHERE idmatch = :idmatch";
        $statement = $this->db->prepare($query);
        $statement->execute(['idmatch' => $idMatch]);
    }

}





