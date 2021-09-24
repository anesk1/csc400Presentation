<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Spanish Verb Conjugation Helper</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="./css/test.css">
        <script src="./js/index.js"></script>
    </head>

    <body>
        <?php include "header.php" ?>

        <div id="test-container">
            <div id="test-info-container">
                <p id="test-verb-holder">Verb: *placeholder*</p>
                <p id="test-tense-holder">*placeholder* Tense</p>
                <p id="test-form-type-placeholder">*question type placeholder* Test</p>
            </div>

            <?php include "create_test.php" ?>

            <div id="test-results-container">
                <p id='results-title'>Your Results:</p>
                <div class="line"></div>
                <p id='questions-counter'>4 Questions</p>
                <p id='correct-counter'>0 Correct Answers</p>
                <p id='incorrect-counter'>0 Incorrect Answers</p>
                <p id='correct-percent'>0.00% Correct Answers Percentage</p>
            </div>

        </div>
    </body>
</html>