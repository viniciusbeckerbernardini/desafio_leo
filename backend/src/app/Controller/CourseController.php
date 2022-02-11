<?php

namespace app\Controller;

use app\DAO\CourseDAO;
use app\Model\Course;

class CourseController
{
    private Course $course;
    private CourseDAO $courseDAO;

    public function __construct()
    {
        $this->courseDAO = new CourseDAO();
        $this->course = new Course();
    }

    public function __destruct()
    {
        unset($this->courseDAO);
        unset($this->course);
    }

    public function index()
    {
        echo $this->courseDAO->getAll();
    }

    public function find()
    {

    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}