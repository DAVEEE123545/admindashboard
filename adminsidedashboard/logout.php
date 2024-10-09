<?php
session_start();
session_destroy();
header("Location: logins.html");
exit();
?>