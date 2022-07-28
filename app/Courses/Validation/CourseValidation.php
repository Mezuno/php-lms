<?php

namespace app\Courses\Validation;

use app\Courses\Models\Course as Course;

class CourseValidation
{
    public function __construct(
        private string $title = '',
        private array $content = [],
        private array $errorsOfVerify = [],
        private int $contentId = 0,
    )
    {
        
    }

    public function isValidCreateData()
    {
        $this->isValidTitle();

        return $this->errorsOfVerify;
    }

    public function isValidUpdateData($content = [])
    {
        $this->content = $content;

        for ($i = 0; $i < count($content); $i++) {
            if ($content[$i]['type'] == 'Text') {
                $this->contentId = $content[$i]['id'];
                $this->text = $content[$i]['content'];
                $this->isValidText();
            }
            if ($content[$i]['type'] == 'Article') {
                $this->contentId = $content[$i]['id'];
                $this->article = $content[$i]['content'];
                $this->isValidArticle();
            }
            if ($content[$i]['type'] == 'Video') {
                $this->contentId = $content[$i]['id'];
                $this->link = $content[$i]['content'];
                $this->isValidLink();
            }
        }

        // var_dump($this->errorsOfVerify);
        // die;

        return $this->errorsOfVerify;
    }

    public function isValidCreateContentData()
    {
        $this->isValidContentType();
        if ($content == 'Text') $this->isValidText();
        if ($content == 'Article') $this->isValidArticle();
        if ($content == 'Video') $this->isValidLink();

        return $this->errorsOfVerify;
    }

    public function isValidTitle($title)
    {
        if (strlen($title) < 3) {
            array_push($this->errorsOfVerify, 'Контент №'.'Контент №'.$this->contentId.'. Минимальная длина названия курса 3 символа');
        }

        if (strlen($title) > 50) {
            array_push($this->errorsOfVerify, 'Контент №'.$this->contentId.'. Максимальная длина названия курса 50 символов');
        }

        if (!preg_match("/^[a-zA-ZАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя!,.?0-9\s\-_]+$/", $title)) {
            array_push($this->errorsOfVerify, 'Контент №'.$this->contentId.'. В названии разрешены: латинские символы и кириллица, цифры и символы "!", "?", ",", ".", "-" и "_"');
        }

        return $this->errorsOfVerify;
    }

    private function isValidText()
    {
        if (strlen($this->text) < 3) {
            array_push($this->errorsOfVerify, 'Контент №'.$this->contentId.'. Минимальная длина контента текст 3 символа');
        }

        if (strlen($this->text) > 10000) {
            array_push($this->errorsOfVerify, 'Контент №'.$this->contentId.'. Максимальная длина текста курса 10000 символов');
        }

        if (!preg_match("/^[a-zA-ZАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя\!\,\.\?0-9\s\-_]+$/", $this->text)) {
            array_push($this->errorsOfVerify, 'Контент №'.$this->contentId.'. В тексте разрешены: латинские символы и кириллица, цифры и символы "!", "?", ",", ".", "-" и "_"');
        }
    }

    private function isValidArticle()
    {
        if (strlen($this->article) < 3) {
            array_push($this->errorsOfVerify, 'Контент №'.$this->contentId.'. Минимальная длина контента заголовок 3 символа');
        }

        if (strlen($this->article) > 200) {
            array_push($this->errorsOfVerify, 'Контент №'.$this->contentId.'. Максимальная длина заголовков курса 200 символов');
        }

        if (!preg_match("/^[a-zA-ZАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя!,.?0-9\s\-_]+$/", $this->article)) {
            array_push($this->errorsOfVerify, 'Контент №'.$this->contentId.'. В заголовке разрешены: латинские символы и кириллица, цифры и символы "!", "?", ",", ".", "-" и "_"');
        }
    }

    private function isValidLink()
    { 
        if (!preg_match("/^((ftp|http|https):\/\/)?(www\.)?([A-Za-zА-Яа-я0-9]{1}[A-Za-zА-Яа-я0-9\-]*\.?)*\.{1}[A-Za-zА-Яа-я0-9-]{2,8}(\/([\w#!:.?+=&%@!\-\/])*)?/", filter_var($this->link, FILTER_VALIDATE_URL))) {
            array_push($this->errorsOfVerify, 'Контент №'.$this->contentId.'. Проверьте корректность ссылки');
        }
    }

    private function isValidContentType()
    {
        if ($this->contentType != 'Text' && $this->contentType != 'Article' && $this->contentType != 'Video') {
            array_push($this->errorsOfVerify, 'Контент №'.$this->contentId.'. Неверный тип контента');
        }
    }



}