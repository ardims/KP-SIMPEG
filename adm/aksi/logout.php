<?php
    header("location:../");
?>
<?php
    session_start();
    session_destroy();
    header("location:../");
?>