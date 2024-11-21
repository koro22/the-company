<?php
include "../classes/user.php";

$user = new User();

$user->update($_POST,$_FILES);


