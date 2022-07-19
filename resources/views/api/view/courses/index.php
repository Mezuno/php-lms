<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';
require $view_course_link;

$pageName = 'Курс '.$courseDataFromDB['title_course'];
require $header_link;
include $cookie_error_link;

?>

<div class="bg-w80p-mt70 p20 brd-rd6">

    <div class="mb20"><?= $courseDataFromDB['title_course'].' by' ?>
    <?= $courseDataFromDB['login'].'<br>' ?></div>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/jfKfPfyJRdk"
        title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
    </iframe><br><br>

    <a href="/users" class="rounded-button mb20"><i class="fa-solid fa-arrow-left"></i> Список пользователей</a><br>
    <a href="/courses" class="rounded-button "><i class="fa-solid fa-arrow-left"></i> Список курсов</a>
    
</div>