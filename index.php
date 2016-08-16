<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wie gut passt ihr zusammen? Teste es hier!</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
    <p>Du willst herausfinden wie gut zwei Personen zusammenpassen?</p><p>Kein Problem, gib einfach ihre Namen hier ein und lass dir eine Zahl berechnen!</p>
    <?php
    include("calc.php");
    $male="";
    $female="";
    $algorithm="";
    $match_value = 0;
    $al1checked = "checked";
    $al2checked = "";
    if(isset($_POST['female']) && isset($_POST['male'])){
        $male=$_POST['male'];
        $female=$_POST['female'];
        $algorithm=$_POST["algoradio"];
        if(strcmp($algorithm, "al1") == 0){
            $match_value = get_valdict_match($male, $female);
        } else {
            $match_value = get_match_value($male, $female);
            $al1checked = "";
            $al2checked = "checked";
        }
        echo '<section id="result"><p>Der Wert von <i>' . $female . '</i> und <i>' . $male . '</i> ist: <h3> ' . round($match_value) . '</h3></p>';
        if(strcmp($male, $female) == 0){
            echo '<p>Interressante Eingabe :P Falls du rumprobierst, coole Art zu denken.</p>';
        }
        echo '</section>';
    }
    echo '
    <form action="index.php" role="form" method="post">
        <div class="row">
            <div class="form-group col-xs-5 col-lg-2">
                <label for="fem">Name der weiblichen Person:</label>
                <input id="fem" type="text" class="form-control" name="female" value="' . $female . '">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-5 col-lg-2">
                <label for="mal">Name der m&auml;nnlichen Person:</label>
                <input id="mal" type="text" class="form-control" name="male" value="' . $male . '">
             </div>
        </div>
        <div class="row">
            <div class="radio">
                <label class="radio"><input type="radio" name="algoradio" value="al1" ' . $al1checked . '>Algorithmus 1</label>
            </div>
        </div>
        <div class="row">
            <div class="radio">
                <label class="radio"><input type="radio" name="algoradio" value="al2" ' . $al2checked . '>Algorithmus 2</label>
            </div>
        </div>
        <div class="row">
            <input class="btn btn-primary" id="button" type="submit" value="Berechnen!">
        </div>
    </form>';
    ?>
    </main>


    <? # Color the result section accordingly
        if ($match_value >= 100){
            echo "<script>
                $('#result').css('background-color', 'lightgreen');
                </script>";
        } elseif ($match_value >= 50){
            echo "<script>
                $('#result').css('background-color', 'orange');
                </script>";
        } elseif ($match_value >= 0){
            echo "<script>
                $('#result').css('background-color', 'grey');
                </script>";
        }
    ?>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
