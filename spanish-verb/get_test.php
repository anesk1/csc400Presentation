<?php 

    // Include the database and starts the session when the session variable is no longer null

    include "db.php";

    if (!isset($_SESSION)) {
        session_start();
    }

    $verb_id = $_SESSION['verb_id'];

    // Question Types:
    // 1: Fill in the blank
    // 2: Multiple choice - complete the sentence
    // 3: Matching columns

    // Access to the test section of the database and selects a verb from the database to be demonstrated to the user
    // Then creates an array for the questions for them to be stored and shown to the user
    //$test_sql = "SELECT * FROM `tests` WHERE verbId = '$verb_id'";
    $test_sql = "SELECT * FROM `tests` WHERE verbId = '$1'";
    $practice_questions = array();

    if ($result = $DBcon->query($test_sql)) {
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $practice_questions[] = $row;
        }
    }

    //echo json_encode($practice_questions);
    $_SESSION['practice_questions'] = $practice_questions;

    //echo json_encode($practice_questions);
    //echo json_encode($verb[0]['definition']);
?>