<?php

namespace app\DAO;


use app\Model\Course;

class CourseDAO{

    private \PDO $connection;
    private Course $course;

    public function __construct()
    {
        $this->connection = new \PDO('mysql:host=localhost;dbname=desafio_leo','vinicius','vinicius');
    }

    public function __destruct()
    {
        unset($this->connection);
        unset($this->course);
    }


    public function get(int $id):array {
            
    }

    public function getAll():array {

    }

    public function create():array {

    }

    public function update():array {

    }

    public function delete():bool {

    }


}