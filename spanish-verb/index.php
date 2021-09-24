<!--- The initial file that will be loaded to start the process of viewing the project
--->
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Spanish Verb Conjugation Helper</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="./css/index.css">
        <script src="./js/index.js"></script>
    </head>

    <body>
        <!--- Starts off by including the header file
        --->
        <?php include "header.php" ?>


        <!--- Gives a title to tell the user to first practice
        Then the progress steps will be demonstrated as well as tell the user to make a 
        selection and show the potential selection through a series of buttons
        --->
        <div id="main-container">
            <p id="container-title">Practice First</p>

            <?php include "progress.php" ?>

            <p id="info-title">Select Between AR, ER and IR Verbs</p>
            <p id="info-subtitle">Verb Finishes In:</p>

            <form action="" method="post" id="index-form">
                <div class="options">
                    <div id="option-1">
                        <input type="radio" class="index-form-choice" name="index-form-choice" id="index-form-ar" value="ar">
                        <label>AR</label>
                    </div>
                    <div id="option-2">
                        <input type="radio" class="index-form-choice" name="index-form-choice" id="index-form-er" value="er">
                        <label>ER</label>
                    </div>
                    <div id="option-3">
                        <input type="radio" class="index-form-choice" name="index-form-choice" id="index-form-ir" value="ir">
                        <label>IR</label>
    
                    </div>
                </div>
                <br>
                <br>
                <input type="submit" class="myButton" id="index-next" name="index-next" value="Next">
            </form>
            <!-- <button class="myButton" id="index-next" onclick="redirect()">Next</button> -->
        </div>
    </body>
</html>

<?php
     
    if(isset($_POST['index-next'])) {
        if(!empty($_POST['index-form-choice'])) {
            session_start();

            $verb_ending = $_POST['index-form-choice'];
            $_SESSION['verb_ending'] = $verb_ending;
            //echo $_SESSION['verb_ending'];

            header("location: tense.php");
        } else {
            include "./notifications/verb-error.php";
        }
    }
?>
