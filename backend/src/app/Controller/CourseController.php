<?php

namespace app\Controller;

use app\DAO\CourseDAO;
use app\Model\Course;

class CourseController
{
    private CourseDAO $courseDAO;

    public function __construct()
    {
        $this->courseDAO = new CourseDAO();
    }

    public function __destruct()
    {
        unset($this->courseDAO);
    }

    public function index()
    {
        echo $this->courseDAO->getAll();
    }

    public function find()
    {
        try {
            $id = filter_input(INPUT_GET,'id');

            $course = new Course();
            $course->setId($id);
            $deletedCourse = $this->courseDAO->get($course->getId());

            echo $deletedCourse;

        }catch (\Exception $e){
            http_response_code($e->getCode());
            echo json_decode(['message'=>$e->getMessage()]);
        }
    }

    public function create()
    {
        try {
            $name = filter_input(INPUT_POST,'name');
            $description = filter_input(INPUT_POST,'description');
            $redirectionUrl = filter_input(INPUT_POST,'redirectionUrl');
            $backgroundImage = Course::moveBackgroundImage("backgroundImage");
            $course = new Course($name,$description,$redirectionUrl,$backgroundImage);
            $createdCourse = $this->courseDAO->create(
                $course->getName(),
                $course->getDescription(),
                $course->getRedirectionURL(),
                $course->getBackgroundImage()
            );

            echo $createdCourse;

        }catch (\Exception $e){
            http_response_code($e->getCode());
            echo json_decode(['message'=>$e->getMessage()]);
        }
    }

    public function update()
    {
        try {
            $id = filter_input(INPUT_GET,'id');
            $name = filter_input(INPUT_POST,'name');
            $description = filter_input(INPUT_POST,'description');
            $redirectionUrl = filter_input(INPUT_POST,'redirectionUrl');
            if($_FILES['backgroundImage']){
                $backgroundImage = Course::moveBackgroundImage("backgroundImage");
            }else{
                $backgroundImage = "";
            }
            $course = new Course($name,$description,$redirectionUrl,$backgroundImage,$id);
            $updatedCourse = $this->courseDAO->update(
                $course->getId(),
                $course->getName(),
                $course->getDescription(),
                $course->getBackgroundImage(),
                $course->getRedirectionURL()
            );

            echo $updatedCourse;

        }catch (\Exception $e){
            http_response_code($e->getCode());
            echo json_decode(['message'=>$e->getMessage()]);
        }
    }

    public function delete()
    {
        try {
            $id = filter_input(INPUT_GET,'id');

            $course = new Course();
            $course->setId($id);
            $deletedCourse = $this->courseDAO->delete($course->getId());

            echo $deletedCourse;

        }catch (\Exception $e){
            http_response_code($e->getCode());
            echo json_decode(['message'=>$e->getMessage()]);
        }
    }
}