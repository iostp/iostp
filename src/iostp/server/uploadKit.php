<?php

$filepath     = $_FILES['file']['tmp_name'];

echo file_get_contents($filepath);
trigger_error("file:   ".file_get_contents($filepath), E_USER_NOTICE);

?>
