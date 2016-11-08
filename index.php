<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Earbook</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <body>
    <div class="center">
        <header>
            <div class="logo">
                <img alt="Earbook" src="logo.png"/>
            </div>
            <div class="menu">
                <a href = "index.php" class="button">rate</a>
                <a href="leaderboard.php" class="button">leaderboards</a>
                <a href="submission.php" class="button">submission</a>
            </div>
        </header>
        <?php
            include 'connect.php';

            if (isset($_POST['leftw']) && isset($_POST['right'])) {
                $chosen = $_POST['leftw'];
                $not_chosen = $_POST['right'];
                mysqli_query($con, "UPDATE `ears` SET `wins` = `wins` + 1, `percent`= 100 * `wins` / (`wins` + `losses`) WHERE `name`= '".$chosen."'");
                mysqli_query($con, "UPDATE `ears` SET `losses` = `losses` + 1, `percent`= 100 * `wins` / (`wins` + `losses`) WHERE `name`= '".$not_chosen."'");
            } else if(isset($_POST['rightw']) && isset($_POST['left'])) {
                $chosen = $_POST['rightw'];
                $not_chosen = $_POST['left'];
                mysqli_query($con, "UPDATE `ears` SET `wins` = `wins` + 1, `percent`= 100 * `wins` / (`wins` + `losses`) WHERE `name`= '".$chosen."'");
                mysqli_query($con, "UPDATE `ears` SET `losses` = `losses` + 1, `percent`= 100 * `wins` / (`wins` + `losses`) WHERE `name`= '".$not_chosen."'");
            }

            mt_srand();
            $ear1 = mt_rand(1, 22);
            $ear2 = mt_rand(1, 22);
            if ($ear1 == $ear2) {
                while($ear1 == $ear2) {
                    $ear2 = mt_rand(1, 23);
                }
            }

            $query = "SELECT * FROM `ears` WHERE id=".$ear1." LIMIT 1";

            $name1 = "";
            if($query_run = mysqli_query($con, $query)) {
                while($query_row = mysqli_fetch_assoc($query_run)) {
                    $name1 = $query_row['name'];
                    $image = $query_row['image'];

                    echo "<img src = \"images/" . $query_row['image'] . "\" width=\"300\" height=\"300\"/>";
                }
            }

            echo "<img src=\"vs.png\"/>";

            $query = "SELECT * FROM `ears` WHERE id=".$ear2." LIMIT 1";

            $name2 = "";
            if($query_run = mysqli_query($con, $query)) {
                while($query_row = mysqli_fetch_assoc($query_run)) {
                    $name2 = $query_row['name'];
                    $image = $query_row['image'];

                    echo "<img src = \"images/".$image."\" width=\"300\" height=\"300\"/>";
                }
            }
            echo "<div class=\"left\">";
            echo "<form name=\"input\" action=\"http://alonzoh.me/earbook/\" method=\"post\"><input type='hidden' name='right' value=\"".$name2."\"><input type='hidden' name='leftw' value=\"".$name1."\"><input type='submit' value=\"+1 this ear!\"></form></div>";
            echo "<div class=\"right\">";
            echo "<form name=\"input\" action=\"http://alonzoh.me/earbook/\" method=\"post\"><input type='hidden' name='left' value=\"".$name1."\"><input type='hidden' name='rightw' value=\"".$name2."\"><input type='submit' value=\"+1 this ear!\"></form></div>";
            
            mysqli_close();
        ?>
        Click the button corresponding to the ear you want to +1
        <br/>
        <footer>
            (c) 2014 Alonzo Hernandez | <a href="https://www.google.com/chrome/browser/">Please use Chrome</a> | <a href ="index.php">rate some ears</a> | <a href="leaderboard.php">leaderboards</a> | <a href="submission.php">earfie submission guidelines</a>
        </footer>
    </div>
    
    </body>
</html>
