<?php
    $user_status = 24;

    switch($user_status){
        case 1:
            echo "<p style='background-color:#000; color:#FFF;'> Welcome Administrator </p>";
        break;
        case 2:
            echo "<p style='background-color:#00ff00; color:#FFF;'> Welcome Moderator </p>";
        break;
        case 3:
            echo "<p style='background-color:#0000ff; color:#FFF;'> Welcome User </p>";
        break;
        default:
            echo "<p style='background-color:#ff0000; color:#FFF;'>Error: Unknown User Type </p>";
        break;
    }

?>