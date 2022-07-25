<?php

namespace app\Courses\Models;

use app\Core\Database as Database;

class Course
{
    private $dbConnect;

    public function __construct()
    {
        $this->dbConnect = new Database();
    }

    public function getCourses($limit, $page)
    {
        return $this->dbConnect->select("SELECT `course_id`, `course_title`, `course_author`, `course_content`, `user_login`
                                         FROM new_schema.courses
                                         INNER JOIN new_schema.users ON courses.course_author = users.user_id
                                         WHERE `course_deleted_at` IS NULL
                                         ORDER BY `course_id` DESC
                                         LIMIT ?, ?", [($page-1)*$limit, $limit]);
    }

    public function getCoursesCount()
    {
        return $this->dbConnect->select("SELECT count(*) FROM courses WHERE course_deleted_at IS NULL");   
    }

    public function getCourse($id)
    {
        return $this->dbConnect->select("SELECT * FROM courses
                                        INNER JOIN new_schema.users ON courses.course_author = users.user_id
                                        WHERE `course_deleted_at` IS NULL
                                        AND `course_id` = ?", [$id]);
    }

}
