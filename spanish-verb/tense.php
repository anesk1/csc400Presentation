
<!DOCTYPE html>
<html lang="en">
    <!---Tense Selection Page
    --->
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Spanish Verb Conjugation Helper</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="./css/index.css">
        <script src="./js/tense.js"></script>
    </head>

    <body>
        <?php include "header.php" ?>

        <!--- Sets up the information for the user to understand the page.
        --->

        <div id="main-container">
            <p id="container-title">Practice First</p>

            <?php include "progress.php" ?>

            <p id="info-title">Select Verb Tense</p>
            <p id="info-subtitle">Verb Tense:</p>

            <form action="" method="post" id="index-form">
                <div class="options">
                    <div id="option-1">
                        <input type="radio" class="tense-form-choice" name="tense-form-choice" id="tense-form-past" value="past">
                        <label>PAST</label>
                    </div>
                    <div id="option-2">
                        <input type="radio" class="tense-form-choice" name="tense-form-choice" id="tense-form-present" value="present">
                        <label>PRESENT</label>
                    </div>
                    <div id="option-3">
                        <input type="radio" class="tense-form-choice" name="tense-form-choice" id="tense-form-future" value="future">
                        <label>FUTURE</label>
    
                    </div>
                </div>
                <br>
                <br>
                <input type="submit" class="myButton" id="tense-next" name="tense-next" value="Next">
            </form>
        </div>
    </body>
</html>

<?php
    if(isset($_POST['tense-next'])) {
        if(!empty($_POST['tense-form-choice'])) {
            session_start();

            $verb_tense = $_POST['tense-form-choice'];
            $_SESSION['verb_tense'] = $verb_tense;

            include "get_verb.php";     // This file includes $verb[] where all the sql search - database info. is stored

            $_SESSION['sql_verb'] = $verb;
            //echo json_encode($verb[0]);

            include "get_test.php";
            header("location: practice.php");
        } else {
            include "./notifications/tense-error.php";
        }
    }
?>
