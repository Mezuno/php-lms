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
        return $this->dbConnect->select("SELECT `course_id`, `course_title`, `course_author`, `course_content`, `course_deleted_at`, `user_login`
                                         FROM new_schema.courses
                                         INNER JOIN new_schema.users ON courses.course_author = users.user_id
                                         ORDER BY `course_id` DESC
                                         LIMIT ?, ?", [($page-1)*$limit, $limit]);
    }

    public function getOwnCourses($owner, $limit, $page)
    {
        return $this->dbConnect->select("SELECT `course_id`, `course_title`, `course_author`, `course_content`, `course_deleted_at`, `user_login`
                                         FROM new_schema.courses
                                         INNER JOIN new_schema.users ON courses.course_author = users.user_id
                                         WHERE `course_author` = ?
                                         ORDER BY `course_id` DESC
                                         LIMIT ?, ?", [$owner,($page-1)*$limit, $limit]);
    }

    public function getCoursesCount()
    {
        return $this->dbConnect->select("SELECT count(*) FROM courses");   
    }

    public function getOwnCoursesCount($owner)
    {
        return $this->dbConnect->select("SELECT count(*) FROM courses WHERE `course_deleted_at` IS NULL AND `course_author` = ?", [$owner]);   
    }

    public function getCourse($id)
    {
        return $this->dbConnect->select("SELECT * FROM courses
                                        INNER JOIN new_schema.users ON courses.course_author = users.user_id
                                        AND `course_id` = ?", [$id]);
    }

    public function createCourse($title, $author)
    {
        return $this->dbConnect->create("INSERT INTO courses (`course_title`, `course_author`) VALUES (?, ?)", [$title, $author]);
    }

    public function updateContent($content, $id)
    {
        return $this->dbConnect->update("UPDATE courses SET `course_content` = ? WHERE `course_id` = ?", [$content, $id]);
    }

    public function updateTitle($title, $id)
    {
        return $this->dbConnect->update("UPDATE courses SET `course_title` = ? WHERE `course_id` = ?", [$title, $id]);
    }

    public function deleteCourse($id)
    {
        return $this->dbConnect->update("UPDATE courses SET `course_deleted_at` = NOW() WHERE `course_id` = ?", [$id]);
    }

    public function recoveryCourse($id)
    {
        return $this->dbConnect->update("UPDATE courses SET `course_deleted_at` = NULL WHERE `course_id` = ?", [$id]);
    }

}
