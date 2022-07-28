<?php

namespace app\Courses\Controllers;

use app\Core\Controller as Controller;
use app\Users\Models\User as User;
use app\Courses\Models\Course as Course;
use app\Core\View as View;
use app\Courses\Validation\CourseValidation as CourseValidation;
use app\Users\Models\Authorization as Authorization;
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
            'pageName' => 'Курсы',
            'coursesData' => $arrCourses,
            'coursesCount' => $coursesCount[0],
            'paginationParams' => $paginationParams,
            'authUserData' => $this->authUserData[0]
        ]);
    }

    public function showOwn()
    {
        if (!$this->authModel->checkAuth()) {
            $this->authModel->redirectToLogin();
        }
        $coursesCount = $this->courseModel->getOwnCoursesCount($this->authUserData[0]['user_id']);
        $paginationParams = Pagination::runPagination($coursesCount);
        
        $arrCourses = $this->courseModel->getOwnCourses($this->authUserData[0]['user_id'], $paginationParams['limit'], $paginationParams['page']);
        
        View::render('courses', [
            'pageName' => 'Мои курсы',
            'coursesData' => $arrCourses,
            'coursesCount' => $coursesCount[0],
            'paginationParams' => $paginationParams,
            'authUserData' => $this->authUserData[0]
        ]);
    }

    public function showCourse($id)
    {
        if (!$this->authModel->checkAuth()) {
            $this->authModel->redirectToLogin();
        }

        $courseData = $this->courseModel->getCourse($id);

        if ($courseData[0]['course_deleted_at'] != NULL) {
            setcookie('error', 'Курс удалён. Восстановите курс, чтобы просмотреть.', time()+1, '/');
            header('Location: /courses');
            die;
        }

        if ($courseData[0]['course_content'] != NULL) {

            $courseJson = json_decode($courseData[0]['course_content']);

            $courseJsonToView = [];
            foreach ($courseJson as $key => $value) {
                $value = get_object_vars($value);
                array_push($courseJsonToView, $value);
            }
        }

        View::render('/api/view/courses/index', [
            'courseData' => $courseData,
            'courseJson' => $courseJsonToView ?? [],
            'authUserData' => $this->authUserData[0]
        ]);
    }

    public function createCourse()
    {
        if (!$this->authModel->checkAuth()) {
            $this->authModel->redirectToLogin();
        }

        if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
    
            $newCourse = new CourseValidation();
            $this->formErrors = $newCourse->isValidTitle($title);

            if ($this->formErrors == []) {
                if ($this->courseModel->createCourse($title, $this->authUserData[0]['user_id'])) {
                    setcookie('success', 'Курс '. $title . ' успешно создан!', time()+1, '/');
                }

                $coursesCount = $this->courseModel->getCoursesCount();
                $paginationParams = Pagination::runPagination($coursesCount);
                
                $arrCourses = $this->courseModel->getCourses($paginationParams['limit'], $paginationParams['page']);
                header('Location: /courses');
                die;
            }

            View::render('api/create/courses/index', [
                'createErrors' => $this->formErrors,
                'authUserData' => $this->authUserData[0],
            ]);

        }

        View::render('api/create/courses/index', [
            'authUserData' => $this->authUserData[0],
        ]);
    }

    public function updateCourse($id)
    {
        if (!$this->authModel->checkAuth()) {
            $this->authModel->redirectToLogin();
        }

        $courseData = $this->courseModel->getCourse($id);

        if ($courseData[0]['course_deleted_at'] != NULL) {
            setcookie('error', 'Курс удалён. Восстановите курс, чтобы редактировать.', time()+1, '/');
            header('Location: /courses');
            die;
        }

        if ($courseData[0]['course_author'] != $this->authUserData[0]['user_id'] && !($this->authModel->checkAdmin())) {
            setcookie('error', 'У вас нет доступа.', time()+1, '/');
            header('Location: /courses');
            die;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $courseData = $this->courseModel->getCourse($id);

            if ($courseData[0]['course_content'] != NULL) {

                $courseJson = json_decode($courseData[0]['course_content']);

                $courseJsonToView = [];
                foreach ($courseJson as $key => $value) {
                    $value = get_object_vars($value);
                    array_push($courseJsonToView, $value);
                }
            }

            View::render('/api/update/courses/index', [
                'courseData' => $courseData,
                'courseJson' => $courseJsonToView ?? [],
                'authUserData' => $this->authUserData[0]
            ]);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_button'])) {

            $courseJson = [];
            $updatedCourse = new CourseValidation();
            $courseTitle = htmlspecialchars($_POST['course_title']);

            $this->formErrors = $updatedCourse->isValidTitle($courseTitle);

            $i = 1;
            while (isset($_POST['course_type'.$i]) && isset($_POST['course_content'.$i])) {

                $courseType = htmlspecialchars($_POST['course_type'.$i]);
                $courseContent = htmlspecialchars($_POST['course_content'.$i]);

                array_push($courseJson, [
                    "id" => count($courseJson)+1,
                    "type" => $courseType,
                    "content" => $courseContent,
                ]);
                $i++;
            }

            $contentErrors = $updatedCourse->isValidUpdateData($courseJson);
            $this->formErrors = array_merge($this->formErrors, $contentErrors);

            if ($this->formErrors != []) {
                View::render('/api/update/courses/index', [
                    'updateErrors' => $this->formErrors,
                    'courseData' => $courseData,
                    'courseJson' => $courseJson,
                    'authUserData' => $this->authUserData[0]
                ]);
            }

            $courseJson = json_encode($courseJson);
            $resultUpdateContent = $this->courseModel->updateContent($courseJson, $id);
            $resultUpdateTitle = $this->courseModel->updateTitle($_POST['course_title'], $id);

            if ($resultUpdateContent && $resultUpdateTitle) {
                setcookie('success', 'Курс ' . $id . ' успешно обновлён.', time()+1, '/');
                header('Location: /courses/'.$id.'/update');
                die;
            }

        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_field_button'])) {
            $fieldId = $_POST['field_id'];
            $courseJson = [];

            $courseData = $this->courseModel->getCourse($id);
            if ($courseData[0]['course_content'] != NULL) {
                $courseJson = json_decode($courseData[0]['course_content']);
            }

            foreach ($courseJson as $key => $value) {
                $value = get_object_vars($value);
                if ($value['id'] == $fieldId) {
                    unset($courseJson[$value['id']-1]);
                }
            }

            $courseJson = json_encode($courseJson);

            $this->courseModel->updateContent($courseJson, $id);


            $courseData = $this->courseModel->getCourse($id);
            $courseJson = json_decode($courseData[0]['course_content']);

            $courseJsonToView = [];
            foreach ($courseJson as $key => $value) {
                $value = get_object_vars($value);
                array_push($courseJsonToView, $value);
            }
            View::render('/api/update/courses/index', [
                'courseData' => $courseData,
                'courseJson' => $courseJsonToView,
                'authUserData' => $this->authUserData[0]
            ]);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_field_button'])) {
            $courseContent = $_POST['course_content'];
            $courseType = $_POST['course_type'];


            $courseData = $this->courseModel->getCourse($id);
            if ($courseData[0]['course_content'] != NULL) {
                $courseJson = json_decode($courseData[0]['course_content']);
            } else {
                $courseJson = [];
            }

            array_push($courseJson, ["id" => count($courseJson)+1, "type" => $courseType, "content" => $courseContent]);

            // $updatedCourse = new CourseValidation();
            // $contentErrors = $updatedCourse->isValidUpdateData($courseJson);
            // $this->formErrors = array_merge($this->formErrors, $contentErrors);
            // if ($formErrors != []) {
            //     View::render('/api/update/courses/index', [
            //         'updateErrors' => $this->formErrors,
            //         'courseData' => $courseData,
            //         'courseJson' => $courseJson,
            //         'authUserData' => $this->authUserData[0]
            //     ]);
            // }

            $courseJson = json_encode($courseJson);
            $this->courseModel->updateContent($courseJson, $id);

            $courseData = $this->courseModel->getCourse($id);
            $courseJson = json_decode($courseData[0]['course_content']);

            $courseJsonToView = [];
            foreach ($courseJson as $key => $value) {
                $value = get_object_vars($value);
                array_push($courseJsonToView, $value);
            }
            
            View::render('/api/update/courses/index', [
                'courseData' => $courseData,
                'courseJson' => $courseJsonToView,
                'authUserData' => $this->authUserData[0]
            ]);
        }
    }

    public function deleteCourse($id)
    {
        $courseData = $this->courseModel->getCourse($id);

        if (!$courseData) {
            setcookie('error', 'Курс '.$id.' не существует.', time()+1, '/');
            header('Location: /courses');
            die;
        }

        if ($this->authUserData[0]['role_title'] == 'Admin'
        || ($courseData[0]['course_author'] == $this->authUserData[0]['user_id'])) {
            $this->courseModel->deleteCourse($id);
            setcookie('success', 'Курс '.$courseData[0]['course_title'].' успешно удалён!', time()+1, '/');
        }

        header('Location: /courses');
        die;
    }

    public function recoveryCourse($id)
    {
        $courseData = $this->courseModel->getCourse($id);

        if ($courseData[0]['course_author'] == $this->authUserData[0]['user_id']
        || $this->authUserData[0]['role_title'] == 'Admin') {
            $this->courseModel->recoveryCourse($id);
            setcookie('success', 'Курс '.$courseData[0]['course_title'].' успешно восстановлен!', time()+1, '/');
        }

        header('Location: /courses');
        die;

    }

}
