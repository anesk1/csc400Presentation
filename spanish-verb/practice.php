
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Spanish Verb Conjugation Helper</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="./css/index.css">
        <script src="./js/practice.js"></script>
    </head>

    <body id="practice-body">
        <?php include "header.php" ?>

        <div id="practice-container">
            <p id="container-title">Practice First</p>

            <?php include "progress.php" ?>

            <div id="practice-form-info-container">
                <!-- <p id="practice-container-title">Practice</p> 
                <p id="practice-container-subtitle">Practice at least 5 verbs before taking the Test!</p> -->

                <p id="practice-sql-verb">Verb: </p>
                <p id="practice-sql-definition">Verb definition placeholder</p>

                <p id="practice-sql-conjugations-title">conjugations title placeholder</p>
                <p id="practice-sql-conjugations">conjugations placeholder</p>
            </div>

            <?php include "form.php" ?>

        </div>
    </body>
</html>

<?php 
    include "db.php";

    if (!isset($_SESSION)) {
        session_start();
    }
    
    $verb_tense = $_SESSION['verb_tense'];
    $verb = $_SESSION['sql_verb'];

    echo "<script>
        $(document).ready(function() {
            $('#practice-sql-verb').html($('#practice-sql-verb').text() + " . json_encode($verb[0]['verb']) . ");
            $('#practice-sql-definition').html(" . json_encode($verb[0]['definition']) . ");

            $('#practice-sql-conjugations-title').html('" . ucfirst($verb_tense) . "' + ' Conjugations');
            $('#practice-sql-conjugations').html(". json_encode($verb[0][$verb_tense]) .");
        });
    </script>";

?>

