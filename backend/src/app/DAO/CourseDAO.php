<?php

namespace app\DAO;


class CourseDAO{

    private \PDO $connection;

    public function __construct()
    {
        $this->connection = new \PDO('mysql:host=localhost;dbname=desafio_leo','root','root123456');
    }

    public function __destruct()
    {
        unset($this->connection);
    }


    public function get(int $id):?string {
        $statement = $this->connection->prepare('SELECT * FROM course WHERE id = :id');
        $statement->bindParam(':id',$id);
        $statement->execute();
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($data);
    }

    public function getAll():?string {
        $statement = $this->connection->prepare('SELECT * FROM course');
        $statement->execute();
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($data);
    }

    public function create(
        string $name,
        string $description,
        string $redirectionURL,
        string $backgroundImage
    ):?string {

        $statement = $this->connection->prepare("INSERT INTO course (name, description, backgroundImage, redirectionUrl) VALUES (:name, :description, :backgroundImage, :redirectionUrl)");

        $statement->bindParam(':name',$name);
        $statement->bindParam(':description',$description);
        $statement->bindParam(':backgroundImage',$backgroundImage);
        $statement->bindParam(':redirectionUrl',$redirectionURL);

        if($statement->execute()){
            return json_encode(['message'=>'course created']);
        }
        var_dump($statement->errorInfo());
        throw new \Exception('Error: course not created properly',500);
    }

    public function update(
        string $id,
        string $name,
        string $description,
        string $backgroundImage,
        string $redirectionURL
    ):?string {
        if($backgroundImage == ''){
            $statement = $this->connection->prepare("
        UPDATE course SET name = :name, description = :description, redirectionUrl = :redirectionUrl
        WHERE id = :id
        ");
        }else {
            $statement = $this->connection->prepare("
        UPDATE course SET name = :name, description = :description, backgroundImage = :backgroundImage, redirectionUrl = :redirectionUrl
        WHERE id = :id
        ");
            $statement->bindParam(':backgroundImage',$backgroundImage);
        }
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':description',$description);
        $statement->bindParam(':redirectionUrl',$redirectionURL);

        if($statement->execute()){
            return json_encode(['message'=>'course updated']);
        }
        throw new \Exception('Error: course not updated properly',500);
    }

    public function delete($id):string {
        $statement = $this->connection->prepare("DELETE from course WHERE id = :id");
        $statement->bindParam(':id',$id);

        if($statement->execute()){
            return json_encode(['message'=>'course deleted']);
        }

        throw new \Exception('Error: course not deleted properly',500);
    }


}