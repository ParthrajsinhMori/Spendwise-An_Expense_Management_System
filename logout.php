<?php
    session_start();
?>

<?php
    if(!isset($_SESSION["username"])){
        echo "<script type='text/javascript'>window.location.href='login.php'</script>";
    }
?>

<?php
    session_unset();
    session_destroy();

    echo "<script type='text/javascript'>window.location.href='login.php'</script>";

?>