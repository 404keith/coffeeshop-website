<?php

require_once APP_ROOT.'/config/session.php';
session_unset();
session_destroy();
header('Location: /');
die();
