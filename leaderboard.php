<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Earbook Leaderboards</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="shortcut icon" href="favicon.ico" />
        <script src="sorttable.js"></script>
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
            Click on a name to see the image associated with it. By clicking on the headers, you can sort by the category.
            <?php 
                include 'connect.php';

                $query = "SELECT * FROM `ears` ORDER BY (wins - losses) DESC";
                $rank = 1;

                if($query_run = mysqli_query($con, $query)) {
                    echo "<table border\1\" style=\"width:800px\" class=\"sortable\">";
                    echo "<tr><th>Name</th><th>Rank</th><th>Wins</th><th>Losses</th><th>Percent</th></tr>";
                    while($query_row = mysqli_fetch_assoc($query_run)) {
                        echo "<tr>";
                        $name = $query_row['name'];
                        $wins = $query_row['wins'];
                        $loses = $query_row['losses'];
                        $percent = $query_row['percent'];
                        $image = $query_row['image'];

                        echo "<td><a href=\"".$image."\">".$name."</a></td>";
                        echo "<td>".$rank."</td>";
                        echo "<td>".$wins."</td>";
                        echo "<td>".$loses."</td>";
                        echo "<td>".$percent."%</td>";
                        echo "</tr>";
                        $rank++;
                    }
                    echo "</table>";
                }
            ?>
            <p>Remember that by Aronzo's Roor, we all equate to winners.</p>
            <footer>
                (c) 2014 Alonzo Hernandez | <a href="https://www.google.com/chrome/browser/">Please use Chrome</a> | <a href ="index.php">rate some ears</a> | <a href="leaderboard.php">leaderboards</a> | <a href="submission.php">earfie submission guidelines</a>
            </footer>
        </div>
    </body>
</html>
