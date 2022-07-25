<?php 

return [

    'users' => [
        'controller' => 'User',
        'action' => 'indexAction' 
    ],
    
    // 'users/[0-9]+' => [
    //     'controller' => 'User',
    //     'action' => 'profile' 
    // ],
    
    // 'users/[0-9]+/update' => [
    //     'controller' => 'User',
    //     'action' => 'update' 
    // ],
    
    // 'users/[0-9]+/create' => [
    //     'controller' => 'User',
    //     'action' => 'create' 
    // ],
    
    'users/[0-9]+/delete' => [
        'controller' => 'User',
        'action' => 'deleteAction' 
    ],

    'users/[0-9]+/update' => [
        'controller' => 'User',
        'action' => 'updateAction' 
    ],

    'users/create' => [
        'controller' => 'User',
        'action' => 'createAction' 
    ],

    'login' => [
        'controller' => 'User',
        'action' => 'loginAction'
    ],

    'register' => [
        'controller' => 'User',
        'action' => 'registerAction'
    ],

    'users/(\d+)' => [
        'controller' => 'User',
        'action' => 'showProfile'
    ],

    'users/(\d+)/update/avatar' => [
        'controller' => 'User',
        'action' => 'changeAvatar'
    ],

    'courses' => [
        'controller' => 'Course',
        'action' => 'indexAction'
    ],

    'courses/(\d+)' => [
        'controller' => 'Course',
        'action' => 'showCourse'
    ],

];










// return [

//     "/" => [
//         "filename" => "index"
//     ],
//     "" => [
//         "filename" => "index"
//     ],

//     // log reg
//     "login" => [
//         "filename" => "resources/views/login"
//     ],

//     "register" => [
//         "filename" => "resources/views/register"
//     ],

//     "register/action" => [
//         "filename" => "includes/register-user"
//     ],


//     // users table
//     "users" => [
//         "filename" => "resources/views/users"
//     ],

//     "users/list/[0-9]+" => [
//         "filename" => "resources/views/users"
//     ],

//     "users/list/\-[0-9]+" => [
//         "filename" => "resources/views/404"
//     ],

//     // courses table
//     "courses" => [
//         "filename" => "resources/views/courses"
//     ],
//     "courses/list/[0-9]+" => [
//         "filename" => "resources/views/courses"
//     ],
//     "courses/list/\-[0-9]+" => [
//         "filename" => "resources/views/404"
//     ],


//     // users profile
//     "users/[0-9]+" => [
//         "filename" => "resources/views/profile"
//     ],


//     // users crud
//     "users/create" => [
//         "filename" => "resources/views/api/create/users/index"
//     ],

//     "users/create/n" => [
//         "filename" => "resources/views/api/create/users/index-n"
//     ],

//     "users/[0-9]+/delete" => [
//         "filename" => "api/delete/users/index"
//     ],

//     "users/[0-9]+/update" => [
//         "filename" => "resources/views/api/update/users/index"
//     ],

//     // users crud
//     "courses/create" => [
//         "filename" => "resources/views/api/create/courses/index"
//     ],

//     "courses/[0-9]+/delete" => [
//         "filename" => "api/delete/courses/index"
//     ],

//     "courses/[0-9]+/update" => [
//         "filename" => "resources/views/api/update/courses/index"
//     ],

//     "courses/[0-9]+" => [
//         "filename" => "resources/views/api/view/courses/index"
//     ],

//     "OOP" => [
//         "filename" => "index2"
//     ],

// ];
