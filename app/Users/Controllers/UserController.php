<?php

namespace app\Users\Controllers;

use app\Core\Controller as Controller;
use app\Users\Models\User as User;
use app\Core\View as View;
use app\Users\Models\Authorization as Authorization;
use app\Users\Validation\UserValidation as UserValidation;
use app\Core\Helpers\Pagination as Pagination;

class UserController extends Controller
{
    private User $userModel;
    private Authorization $authModel;
    private array $authUserData = [];
    private array $cookieErrors = [];
    private array $formErrors = [];
    private bool $success = false;
    private array $inputData = [];

    public function __construct()
    {
        session_start();
        $this->userModel = new User();        
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
        
        $usersCount = $this->userModel->getUsersCount();
        $paginationParams = Pagination::runPagination($usersCount);
        
        $arrUsers = $this->userModel->getUsers($paginationParams['limit'], $paginationParams['page']);
        
        View::render('users', [
            'usersData' => $arrUsers,
            'usersCount' => $usersCount[0],
            'paginationParams' => $paginationParams,
            'authUserData' => $this->authUserData[0]
        ]);
    }
    
    public function createAction()
    {
        if (!$this->authModel->checkAuth()) {
            $this->authModel->redirectToLogin();
        }
        if (!$this->authModel->checkAdmin()) {
            $this->authModel->redirectToUsers();
        }

        if (isset($_POST['submit'])) {

            $this->inputData = [
                'login' => $_POST['login'] ?? '',
                'password' => $_POST['password'] ?? '',
                'email' => $_POST['email'] ?? '',
                'passwordRepeat' => $_POST['passwordRepeat'] ?? '',
                'role' => (int)$_POST['role'] ?? 0,
            ];
    
            foreach ($this->inputData as $key => $value) {
                if (!isset($value) || empty($value)) {
                    array_push($this->formErrors, 'Поле ' . $key . ' не может быть пустым.');
                }
            }
    
            if ($this->formErrors != []) {
                $this->success = false;
    
                View::render('api/create/users/index', [
                    'createSuccess' => $this->success,
                    'createErrors' => $this->formErrors,
                    'authUserData' => $this->authUserData[0],
                    'inputData' => $this->inputData,
                ]);
    
            }

            $newUser = new UserValidation(0, $this->inputData['login'], $this->inputData['email'], $this->inputData['password'], $this->inputData['passwordRepeat'], $this->inputData['role']);

            $this->formErrors = $newUser->isValidCreateData();

            if ($this->formErrors != []) {
                $this->success = false;

                View::render('api/create/users/index', [
                    'createSuccess' => $this->success,
                    'createErrors' => $this->formErrors,
                    'authUserData' => $this->authUserData[0],
                    'inputData' => $this->inputData,
                ]);
            }

            $this->inputData['password'] = md5(md5($this->inputData['password'].'yalublulipton'));

            $createResult = $this->userModel->createUser([$this->inputData['login'], $this->inputData['email'], $this->inputData['password'], $this->inputData['role']]);

            if ($createResult) {

                $this->success = true;

                View::render('api/create/users/index', [
                    'createSuccess' => $this->success,
                    'authUserData' => $this->authUserData[0],
                    'inputData' => $this->inputData,
                ]);
            }
        }

        View::render('api/create/users/index', [
            'authUserData' => $this->authUserData[0],
        ]);
    }
    
    public function updateAction($id)
    {
        if (!$this->authModel->checkAuth()) {
            $this->authModel->redirectToLogin();
        } else {
            $userData = $this->userModel->getUser($id);
        }

        if ($this->authUserData[0]['user_id'] != $id) {
            if (!$this->authModel->checkAdmin()) {
                $this->authModel->redirectToUsers();
            }
        }

        if (isset($_POST['submit'])) {

            $this->inputData = [
                'login' => $_POST['login'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'passwordRepeat' => $_POST['passwordRepeat'],
            ];

            foreach ($this->inputData as $key => $value) {
                if (!isset($value) || empty($value)) {
                    array_push($this->formErrors, 'Поле ' . $key . ' не может быть пустым.');
                }
            }

            $newUser = new UserValidation($id, $this->inputData['login'] ?? '', $this->inputData['email'] ?? '', $this->inputData['password'] ?? '', $this->inputData['passwordRepeat'] ?? '');
            $this->formErrors = $newUser->isValidUpdateData();

            if ($this->authModel->checkAdmin()) {

                if (!$this->formErrors) {

                    $this->inputData['password'] = md5(md5($this->inputData['password'].'yalublulipton'));
                    $result = $this->userModel->updateUser($this->inputData['login'], $this->inputData['email'], $this->inputData['password'], $id);

                }
            }
            
            if (!$this->formErrors) {
                $this->inputData['password'] = md5(md5($this->inputData['password'].'yalublulipton'));
                $result = $this->userModel->updateUser($this->inputData['login'], $this->inputData['email'], $this->inputData['password'], $id);
            }

            if (!$this->formErrors) {
                $this->success = true;
            }
        }

        View::render('api/update/users/index', [
            'userData' => $userData[0],
            'inputData' => $this->inputData ?? [],
            'updateSuccess' => $this->success,
            'updateErrors' => $this->formErrors,
            'authUserData' => $this->authUserData[0]]);
    }

    public function deleteAction($id)
    {
        $deleteErrors = '';

        if ($this->authModel->checkAuth()) {
            header('Location: /login');
        } else {
            $this->authUserData = $this->authModel->getAuthUserData();
        }

        if ($this->authModel->checkAdmin()) {

            $userData = $this->userModel->getUser($id);

            if ($userData[0]['role_title'] != 'Admin') {
                $deleteResult = $this->userModel->deleteUser($id);  
            } else {
                setcookie('error', 'Незя удалить другого админа ;(', time()+1, '/');
            } 
 
        } else {
            setcookie('error', 'Ты не админ куда ты лезешь?', time()+1, '/');
        }

        if ($deleteResult) {
            setcookie('success', 'Пользователь id' . $id . ' успешно уделён.', time()+1, '/');
        }

        header('Location: /users');
        die;
    }

    public function loginAction()
    {
        if ($this->authModel->checkAuth()) {
            header('Location: /users');
            die;
        }

        if (isset($_POST['submit']) && isset($_POST['password']) && isset($_POST['login'])) {
            $submit = $_POST['submit'];
            $login = $_POST['login'];
            $password = $_POST['password'];
        }

        if (!isset($login)) {
            array_push($this->formErrors, 'Введите логин');
        }
        if (!isset($password)) {
            array_push($this->formErrors, 'Введите пароль');
        }

        if (isset($submit)) {

            if (empty($login)) {
                array_push($this->formErrors, 'Введите логин');
            }
            if (empty($password)) {
                array_push($this->formErrors, 'Введите пароль');
            }

            if ($this->formErrors != []) {

                View::render('login', [
                    'authErrors' => $this->formErrors,
                    'inputData' => [
                        'login' => $login,
                        'password' => $password
                    ]
                ]);

            } else {

                $password = md5(md5($password.'yalublulipton'));

                $userTokenAndId = $this->authModel->authUser($login, $password);

                if (!$userTokenAndId) {
                    array_push($this->formErrors, 'Неверный логин или пароль');
                    View::render('login', [
                        'authErrors' => $this->formErrors,
                        'inputData' => [
                            'login' => $login,
                        ]
                    ]);
                } elseif ($userTokenAndId[0]['user_token'] == NULL) {
                    $newToken = password_hash($password.'CheZaH', PASSWORD_BCRYPT);
                    $this->userModel->setToken($userTokenAndId[0]['user_id'], $newToken);
                }

                session_start();
                $_SESSION['user_token'] = $userTokenAndId[0]['user_token'] ?? $newToken;

                header('Location: /users');
                die;
            }            
        }
        View::render('login');
    }

    public function registerAction()
    {
        $regErrors = [];

        if ($this->authModel->checkAuth()) {
            header('Location: /users');
        }

        if (isset($_POST['submit'])) {

            $inputData = [
                'login' => $_POST['login'] ?? '',
                'password' => $_POST['password'] ?? '',
                'email' => $_POST['email'] ?? '',
                'passwordRepeat' => $_POST['passwordRepeat'] ?? '',
            ];
    
            foreach ($inputData as $key => $value) {
                if (!isset($value) || empty($value)) {
                    array_push($regErrors, 'Поле ' . $key . ' не может быть пустым.');
                }
            }
    
            if ($regErrors != []) {
    
                View::render('register', [
                    'regErrors' => $regErrors,
                    'inputData' => [
                        'login' => $inputData['login'],
                        'email' => $inputData['email'],
                    ]
                ]);
    
            }

            $newUser = new UserValidation(0, $inputData['login'], $inputData['email'], $inputData['password'], $inputData['passwordRepeat']);

            $regErrors = $newUser->isValidRegisterData();

            if ($regErrors != []) {

                View::render('register', [
                    'regErrors' => $regErrors,
                    'inputData' => [
                        'login' => $inputData['login'],
                        'email' => $inputData['email'],
                    ]
                ]);
            }

            $inputData['password'] = md5(md5($inputData['password'].'yalublulipton')); 

            $regResult = $this->userModel->registerUser($inputData['login'], $inputData['email'], $inputData['password']);

            if ($regResult) {

                $regSuccess = 'Бро хорош зарегался!';

                View::render('register', [
                    'regSuccess' => $regSuccess,
                    'inputData' => [
                        'login' => $inputData['login'],
                        'email' => $inputData['email'],
                    ]
                ]);
            }
        }

        View::render('register');
    }

    public function showProfile($id)
    {
        $userData = $this->userModel->getUser($id);

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            if (!$this->authModel->checkAuth()) {
                $this->authModel->redirectToLogin();
            }

            if ($this->authUserData[0]['user_id'] !== (int)$id) {
                if (!$this->authModel->checkAdmin()) {
                    $this->authModel->redirectToUsers();
                }
            }


            View::render('profile', ['userData' => $userData, 'authUserData' => $this->authUserData]);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $path = $_SERVER['DOCUMENT_ROOT'].'/resources/img/users/profile/avatar/';

            $allow = ['png', 'jpg', 'jpeg'];

            $inputName = 'avatar';

            if (isset($_FILES[$inputName])) {
                $name = $_FILES['avatar']['name'];

                $parts = pathinfo($name);
    
                if (empty($name) || empty($parts['extension'])) {
                    $error = 'Недопустимый тип файла';
                }
                if (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                    $error = 'Недопустимый тип файла';
                }
                if (mime_content_type($_FILES[$inputName]['tmp_name']) != 'image/jpeg'
                && mime_content_type($_FILES[$inputName]['tmp_name']) != 'image/jpg'
                && mime_content_type($_FILES[$inputName]['tmp_name']) != 'image/png') {
                    $error = 'Недопустимый тип файла';
                } 
                if(empty($error)) {
                    
                    $i = 0;
                    $prefix = '';
                    while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
                        $prefix = '(' . ++$i . ')';
                    }
                    $name = $parts['filename'] . $prefix . '.' . $parts['extension'];				
                }

                //$oldAvatarPath = $db->query("SELECT avatar_filename FROM users WHERE avatar_filename IS NOT NULL AND id = '".$this->authUserData['id']."'")->fetch();

                if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $path . $name)) {
                    $success = 'Фото успешно обновлено.';
                } else {
                    $error = 'Не удалось загрузить файл.';
                }

                if (!empty($success)) {

                    if (file_exists($path.md5($this->authUserData[0]['user_id']).'.png'))
                    unlink($path.md5($this->authUserData[0]['user_id']).'.png');
                    if (file_exists($path.md5($this->authUserData[0]['user_id']).'.jpeg'))
                    unlink($path.md5($this->authUserData[0]['user_id']).'.jpeg');
                    if (file_exists($path.md5($this->authUserData[0]['user_id']).'.jpg'))
                    unlink($path.md5($this->authUserData[0]['user_id']).'.jpg');
                    
                    $avatarNameToUpload = md5($this->authUserData[0]['user_id']).'.'.$parts['extension'];
                    rename($path.$name, $path.$avatarNameToUpload);

                    $avatarPathToUpload = '/resources/img/users/profile/avatar/'.$avatarNameToUpload;

                    $this->userModel->updateAvatarPath($id, $avatarPathToUpload);
        
                    setcookie('success', $success, time()+1, '/');

                    header('Location: /users/'.$userData[0]['user_id']);
                    // View::render('profile', ['userData' => $userData[0], 'authUserData' => $this->authUserData[0]]);
                } else {
                    setcookie('error', $error, time()+1, '/');
                    header('Location: /users/'.$userData[0]['user_id']);
                    // View::render('profile', ['userData' => $userData[0], 'authUserData' => $this->authUserData[0]]);
                }
            }
        }
    }
}
