<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter Clone</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require("database.php");?>

    <h1>Twitter Clone (very basic!)</h1>
    <?php
        $statement = $db->prepare("
            SELECT 
                text, 
                username, 
                DATE_FORMAT(postdate, '%M %d, %Y - %h:%i:%s %p') AS postdate
            FROM 
                tweets 
                JOIN users USING (user_id) 
            ORDER BY tweet_id DESC
        ");
        $statement->execute();
        $result = $statement->fetchAll();
        // print_r($result);
        foreach( $result as $tweet ):
    ?>
    <div class="tweet">
        <img src="https://www.gravatar.com/avatar/nothing" alt="avatar" class="avatar">
        <div class="content">
            <span class="name-with-handle">
                <span class="name">
                    <?php echo $tweet['username'];?>
                </span>
                <span class="handle">
                    <?php echo "@".$tweet['username'];?>
                </span>
            </span>
            <span class="time">
                <?php echo $tweet['postdate'];?>
            </span>
            <div class="message">
                <?php echo $tweet['text'];?>
            </div>
            <div class="buttons">
                <i class="fas fa-reply"></i>
                <i class="fas fa-retweet"></i>
                <i class="fas fa-heart"></i>
                <i class="fas fa-ellipsis-h"></i>
            </div>
        </div>
    </div>
    <?php endforeach;?>


    <form action="addTweet.php" method="POST">
        <div>
            <label for="handle">Handle</label>
            <input type="text" required name="handle" id="handle">
        </div>
        <div>
            <label for="text">Text</label>
            <textarea name="text" id="text" required></textarea>
        </div>
        <button type="submit">
            Post Tweet
            <i class="fas fa-caret-right"></i>
        </button>
    </form>


    
    
</body>
</html>