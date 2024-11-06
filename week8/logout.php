<?php

include('inc/functions.php');
session_destroy();
Header('Location: login.php');