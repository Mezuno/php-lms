<?php

$courseData = $dataFromServer['courseData'][0];
$authUserData = $dataFromServer['authUserData'];
$courseContent = $dataFromServer['courseJson'] ?? [];

require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';

$pageName = 'Курс '.$courseData['course_title'];
require $header_link;
include $cookie_error_link;

?>

<div class="bg-w80p-mt70 p20 brd-rd6 flex-col">

    <div class="mb20 flex-row flex-just-spbtw">
        <?= $courseData['course_title'].' by' ?>
        <?= $courseData['user_login'].'<br>' ?>
        <a href="/courses/<?= $courseData['course_id'] ?>/update" class="action-button"><i class="fa-solid fa-pen"></i></a>
    </div>
    <?php foreach ($courseContent as $key => $value) { ?>
    <?php if ($value['type'] == 'Article') { ?>
        <div class="mb20 course__article"><?= $value['content'] ?></div>
    <?php } elseif ($value['type'] == 'Text') { ?>
        <div class="mb20 course__text"><?= $value['content'] ?></div>
    <?php } elseif ($value['type'] == 'Video') { ?>
        <iframe width="560" height="315"
            src="https://www.youtube.com/embed/<?= $value['content'] ?>"
            title="YouTube video player" frameborder="0"
            class="pb20"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            encrypted-media
            allowfullscreen>
        </iframe><br><br>
    <?php }} ?>

    
    <a href="/courses" class="rounded-button "><i class="fa-solid fa-arrow-left"></i> Список курсов</a>
    
</div>