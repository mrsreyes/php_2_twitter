<?php
    
    require("database.php");

    if( isset($_POST ) && !empty($_POST)){
        $handle = $_POST['handle'];
        $text = $_POST['text'];

        // check to see if the user is in the system
        $statement = $db->prepare("
            SELECT COUNT(*) FROM users
            WHERE username = '$handle'
        ");
        $statement->execute();
        $count = $statement->fetchColumn();
        
        
        // user not found, create new user
        if( $count == 0 ){
            $statement = $db->prepare("
                INSERT INTO users VALUES (NULL, '$handle')
            ");
            $statement->execute();
        }


        $statement = $db->prepare("
            SELECT user_id FROM users WHERE username = '$handle'
        ");
        $statement->execute();
        $result = $statement->fetch();
        $user_id = $result['user_id'];

        $statement = $db->prepare("
            INSERT INTO tweets
            VALUES (NULL, $user_id, NOW(), '$text')
        ");
        $statement->execute();
        $tweet_id = $db->lastInsertId();
        if( $tweet_id > 0 ){
            header('Location: ./index.php');
        } else {
            echo "Problem...";
            die();
        }
        
    }
    else {
        header('Location: ./index.php');
    }