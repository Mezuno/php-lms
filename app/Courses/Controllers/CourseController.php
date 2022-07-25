<?php

namespace app\Courses\Controllers;

use app\Core\Controller as Controller;
use app\Users\Models\User as User;
use app\Courses\Models\Course as Course;
use app\Core\View as View;
use app\Users\Models\Authorization as Authorization;
use app\Users\Validation\UserValidation as UserValidation;
use app\Core\Helpers\Pagination as Pagination;

class CourseController extends Controller
{
    private User $userModel;
    private Authorization $authModel;
    private Course $courseModel;
    private array $authUserData = [];
    private array $cookieErrors = [];
    private array $formErrors = [];
    private bool $success = false;
    private array $inputData = [];

    public function __construct()
    {
        session_start();
        $this->userModel = new User();    
        $this->courseModel = new Course();    
        $this->authModel = new Authorization();
        if ($this->authModel->checkAuth()) {
            $this->authUserData = $this->authModel->getAuthUser();
        }
    }

    public function indexAction()
    {
        if (!$this->authModel->checkAuth()) {
            $this->authModel->redirectToLogin();
        }
        
        $coursesCount = $this->courseModel->getCoursesCount();
        $paginationParams = Pagination::runPagination($coursesCount);
        
        $arrCourses = $this->courseModel->getCourses($paginationParams['limit'], $paginationParams['page']);
        
        View::render('courses', [
            'coursesData' => $arrCourses,
            'coursesCount' => $coursesCount[0],
            'paginationParams' => $paginationParams,
            'authUserData' => $this->authUserData[0]
        ]);
    }

    public function showCourse($id)
    {
        $courseData = $this->courseModel->getCourse($id); 
        
        View::render('/api/view/courses/index', [
            'courseData' => $courseData,
            'coursesCount' => $coursesCount[0],
            'paginationParams' => $paginationParams,
            'authUserData' => $this->authUserData[0]
        ]);
    }
}
