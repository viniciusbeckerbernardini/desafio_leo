<?php
require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'vendor/autoload.php');

use \app\Controller\CourseController;

function courseId(){
    if(isset($_GET['id'])){
        $id = filter_input(INPUT_GET,"id");
        return $id;
    }
}

function router()
{
    $uri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    $coursesController = new CourseController();

    if ($method == "GET")
    {
        switch ($uri) {
            case '/api/courses':
                $coursesController->index();
                break;
            case '/api/courses?id='.courseId():
                $coursesController->find();
                break;
            default:
                echo "Rota não exitente";
                break;
        }

    }

    if ($method == "POST")
    {
        switch ($uri) {
            case '/api/courses':
                $coursesController->create();
                break;
            case '/api/courses/edit?id='.courseId():
                $coursesController->update();
                break;
            case '/api/courses/delete?id='.courseId():
                $coursesController->delete();
                break;
            default:
                echo "Rota não exitente";
                break;
        }

    }

}