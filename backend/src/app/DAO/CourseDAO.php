<?php

namespace app\DAO;


use app\Model\Course;

class CourseDAO{

    private \PDO $connection;
    private Course $course;

    public function __construct()
    {
        $this->connection = new \PDO('mysql:host=localhost;dbname=leo_challenge','vinicius','vinicius');
    }

    public function __destruct()
    {
        unset($this->connection);
        unset($this->course);
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
        string $backgroundImage,
        string $redirectionURL
    ):?string {

        $statement = $this->connection->prepare(`
        INSERT INTO course (name, description, backgroundImage, redirectionUrl)
        VALUES (:name, :description, :backgroundImage, :redirectionUrl)
        `);

        $statement->bindParam(':name',$name);
        $statement->bindParam(':description',$description);
        $statement->bindParam(':backgroundImage',$backgroundImage);
        $statement->bindParam(':redirectionUrl',$redirectionURL);

        $statement->execute();

        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return json_encode($data);
    }

    public function update(
        string $id,
        string $name,
        string $description,
        string $backgroundImage,
        string $redirectionURL
    ):?string {
        $statement = $this->connection->prepare(`
        UPDATE course SET name = :name, description = :description, backgroundImage = :backgroundImage, redirectionUrl = :redirectionUrl
        WHERE id = :id
        `);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':description',$description);
        $statement->bindParam(':backgroundImage',$backgroundImage);
        $statement->bindParam(':redirectionUrl',$redirectionURL);

        $statement->execute();

        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return json_encode($data);
    }

    public function delete($id):bool {
        $statement = $this->connection->prepare(`
        DELETE from course id = :id
        `);
        $statement->bindParam(':id',$id);

        if($statement->execute()){
            return true;
        }

        return false;
    }


}