<?php
/**
 * Created by PhpStorm.
 * User: mahdi
 * Date: 12/12/2017
 * Time: 15:28
 */

namespace Application\Repository;


use Application\Lecturer;
use Application\LecturerCollection;

class LecturerRepository
{
    private $db;
    public $dbResult;
    public $result;

    public function __construct(\PDO $db)
    {
      $this->db = $db;
    }

    public function findAll()
    {
        $dbResult = $this->db->query("SELECT * FROM lecturer");
        $data = [];
        while ($result = $dbResult->fetch(\PDO::FETCH_ASSOC)) {
            $data[] = new Lecturer($result['nom'], $result['prenom']);
        }
        return new LecturerCollection(... $data);
    }
}