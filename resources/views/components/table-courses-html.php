
<tr>
    <td class="td-userdata"></td>
    <td class="td-userdata"></td>
    <td class="td-userdata"><a href="/courses/<?= $courseData['id_course']?>"><?= $courseData['title_course'] ?></a></td>
    <td class="td-userdata"><a href="/users/<?= $courseData['author_course']?>"><?= $courseData['login'] ?></a></td>
    <td class="td-userdata"><b></b></td>
    <td class="td-buttons">

        <a class="action-button" href="/courses/<?= $courseData['id_course'] ?>/update"><i class="fa-solid fa-pen"></i></a>

        <a class="action-button red" onclick="
            document.getElementById('delete-modal-<?= $courseData['id_course'] ?>').style.display = 'flex'
            ">
            <i class="fa-solid fa-trash"></i>
        </a>

    </td> <!-- td-buttons end -->
</tr>

<div class="delete-modal" id="delete-modal-<?= $courseData['id_course'] ?>">
    <p class="delete-modal-text mb20 mr20">Вы действительно хотите удалить курс <?= $courseData['title_course'] ?>?</p>
    <div class="flex-row">
        <a href="/courses/<?= $courseData['id_course'] ?>/delete" class="action-button mt20">Да</a>
        <a onclick="document.getElementById('delete-modal-<?= $courseData['id_course'] ?>').style.display = 'none'" class="action-button ml20 mt20">Нет</a>
    </div>
</div>
