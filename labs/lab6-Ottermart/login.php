<?php
    session_start();
?>

<form method="POST" action="loginProcess.php">
    Username: <input type="text" name="username"/> <br />
    Password: <input type="password" name="password/> <br />
    
    <input type="submit" class='btn btn-primary' name="submitForm" value="Login!" />
    <br /><br />
    
    <?php
        if($_SESSION['incorrect']){
            echo "<p class = 'lead' id = 'error' stle='color:red'>";
            echo "<strong>Incorrect Username or Password!</strong></p>";
        }
    ?>
    
</form>