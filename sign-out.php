<?php
session_start();
session_destroy();
$_SESSION['message'] = ['type' => 's', 'text' => 'Logged out successfully.'];
header("Location: ./signin");
exit;
?>