<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;


class PostManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "message";

    public function __construct(){
        parent::connect();
    }



    public function findPostsByTopic($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.topic_id = :id
                ORDER BY creationDate";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    public function getLastPostByTopic($id) {
        $sql = "SELECT * 
        FROM ".$this->tableName." t 
        WHERE t.topic_id = :id
        ORDER BY creationDate DESC
        LIMIT 1";

        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
);
    }

    public function findTopicId($id) {

        $sql = "SELECT topic_id
                FROM ".$this->tableName." t 
                WHERE t.id_message = :id";

        return  $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }   

    public function update($id, $text) {
        
        $sql = "UPDATE message
                SET text = :text
                WHERE id_message = :id";

        return  $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id, 'text' => $text]), 
            $this->className
        );
    }

}
