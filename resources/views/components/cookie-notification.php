<?php if(isset($_COOKIE['error'])): ?>
<div class="error"><?= $_COOKIE['error'] ?></div>
<?php endif ?>
<?php if(isset($_COOKIE['success'])): ?>
<div class="success"><?= $_COOKIE['success'] ?></div>
<?php endif ?>