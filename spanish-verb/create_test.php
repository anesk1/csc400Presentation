<?php
    include "db.php";
    session_start();

    /* Get Random Verb - Start */
    $random_test_verb = "SELECT * FROM verbs ORDER BY RAND() LIMIT 1";
    $test_verb = array();

    if ($result = $DBcon->query($random_test_verb)) {
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $test_verb[] = $row;
        }
    }
    /* Get Random Verb - End */

    $verb = json_encode($test_verb[0]['verb']);
    $verb = str_replace('"', "", $verb);

    $test_verb_id = json_encode($test_verb[0]['id']);
    $test_verb_id = str_replace('"', "", $test_verb_id);

    $test_verb_type = json_encode($test_verb[0]['type']);
    $test_verb_type = str_replace('"', "", $test_verb_type);



    /* Get Test Questions - Start */
    $test_questions = "SELECT * FROM `tests` WHERE verbId = '$test_verb_id'";
    $questions = array();

    if ($result = $DBcon->query($test_questions)) {
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $questions[] = $row;
        }
    }
    /* Get Test Questions - End */
    
    $question_type = json_encode($questions[0]['type']);
    $question_type = str_replace('"', "", $question_type);

    $tenses = array('Past', 'Present', 'Future');
    $random_index = array_rand($tenses, 1);
    $test_tense = $tenses[$random_index];

    if ($question_type === '3') {
        $test_tense = 'Present';
    }

    echo "<script>
        $('#test-verb-holder').text('Verb:  ". $verb . "');
        $('#test-tense-holder').text('" . $test_tense . " Tense');
    </script>";

    //$test_tense = str_replace('"', '', $test_tense);
    $test_tense = lcfirst($test_tense);

    // Determine which form to display
    switch ($question_type) {
        case 1:
            echo "<script>$('#test-form-type-placeholder').text('Fill In The Blanks Test');</script>";

            echo "
                <form action='' id='form-1-test' onsubmit='return onFormSubmit(this);'>";

                for ($x = 0; $x < 4; $x++) {
                    echo "
                        <div class='row'>
                            <label>" . $questions[$x]['question_start'] . "</label>
                            <input type='text' id='test-form-1-answer-" . $x + 1 . "' name='test-form-1-answer-" . $x + 1 . "'>
                            <label>" . $questions[$x]['question_end'] . "</label>
                        </div>
                    ";
                }
                    
                echo "<div class='row' id='test-btns'>
                    <input type='submit' class='myButton' id='test-check-btn' name='test-check-btn' value='Check Answers'>
                </div>";
                echo "</form>
            ";

            break;
        case 2:
            echo "<script>$('#test-form-type-placeholder').text('Choose An Option Test');</script>";

            echo "
                <form action='' id='form-2-test' onsubmit='return onFormSubmit(this);'>";

                $counter = 1;

                for ($x = 0; $x < 4; $x++) {
                    echo "
                        <div class='row'>
                            <label for='form-2-input-" . $counter . "'>" . $questions[$x]['question_start'] . "</label>
                            <input type='text' value='' id='test-form-2-input-" . $counter . "' name='radio-choice-" . $counter . "' required>
                            <label for='form-2-input" . $counter . "'>" . $questions[$x]['question_end'] . "</label>
                        </div>
                    ";


                    echo "<div class='row'>";

                        for ($y = 1; $y < 5; $y++) {
                            $options = "option" . $y . "";

                            echo "
                                <div class='row'>
                                    <input type='radio' id='form-2-answer-" . $counter . "' name='form-2-answer-" . $counter . "' value='" . $questions[$x][$options] . "'>
                                    <label for='test-2-section-" . $y . "'>" . $questions[$x][$options] . "</label>
                                </div>
                            ";
                        }

                    echo "</div>";
                    
                    $counter++;
                }

                echo "<div class='row' id='test-btns'>
                    <input type='submit' class='myButton' id='test-check-btn' name='test-check-btn' value='Check Answers'>
                </div>";
                echo "</form>
            ";

            $radio_answer_1 = "form-2-answer-1";
            $radio_choice_1 = "radio-choice-1";
            $radio_answer_2 = "form-2-answer-2";
            $radio_choice_2 = "radio-choice-2";
            $radio_answer_3 = "form-2-answer-3";
            $radio_choice_3 = "radio-choice-3";
            $radio_answer_4 = "form-2-answer-4";
            $radio_choice_4 = "radio-choice-4";

            echo "<script>
                $(document).ready(function() {
                    $('input[name=" . $radio_answer_1 . "]').on('change', function() {
                        $('input[name=" . $radio_choice_1 . "]').val($('input[name=" . $radio_answer_1 . "]:checked').val());
                    });
                });
                $(document).ready(function() {
                    $('input[name=" . $radio_answer_2 . "]').on('change', function() {
                        $('input[name=" . $radio_choice_2 . "]').val($('input[name=" . $radio_answer_2 . "]:checked').val());
                    });
                });
                $(document).ready(function() {
                    $('input[name=" . $radio_answer_3 . "]').on('change', function() {
                        $('input[name=" . $radio_choice_3 . "]').val($('input[name=" . $radio_answer_3 . "]:checked').val());
                    });
                });
                $(document).ready(function() {
                    $('input[name=" . $radio_answer_4 . "]').on('change', function() {
                        $('input[name=" . $radio_choice_4 . "]').val($('input[name=" . $radio_answer_4 . "]:checked').val());
                    });
                });
            </script>";

            break;
        case 3:
            echo "<script>$('#test-form-type-placeholder').text('Match The Statements Test');</script>";

            echo "
                <form action='' id='form-3-test' onsubmit='return onFormSubmit(this);'>";

                echo "<div class='row'>";

                    echo "<div class='column'>";
                    
                        for ($z = 0; $z < 4; $z++) {
                            echo "<div class='row'>
                                <label>" . $questions[$z]['question_start'] . "</label>
                            </div>";
                        }

                    echo "</div>";

                    echo "<div class='column'>";
                    
                        for ($z = 0; $z < 4; $z++) {
                            echo "<div class='row'>
                                <label>" . $questions[$z]['question_end'] . "</label>
                            </div>";
                        }

                    echo "</div>";

                    echo "<div class='column'>";
                    
                        for ($z = 0; $z < 4; $z++) {
                            echo "<div class='row'>
                                <input type='text' id='test-form-3-answer-" . $z + 1 . "' name='test-form-3-answer-" . $z + 1 . "'>
                            </div>";
                        }

                    echo "</div>";
                
                echo "</div>";

                echo "<div class='row' id='test-btns-3'>
                    <input type='submit' class='myButton' id='test-check-btn' name='test-check-btn' value='Check Answers'>
                </div>";
                echo "</form>
            ";

            break;
    };

    if (isset($_POST['practice-more-btn'])) {
        echo "<script>location.href = 'index.php'</script>";
    }


    echo "<script>
        function onFormSubmit(form) {
            var questions_counter = 4;
            var correct_counter = 0;
            var incorrect_counter = 0;
            var percent_correct = 0;

            var correctAnswers = " . json_encode($questions) . ";
            var test_tense = " . json_encode($test_tense) . ";
            var tense_answer = 'answer_';
            tense_answer = tense_answer.concat('', test_tense);
            

            switch (" . $question_type . ") {
                case 1: 
                    var data = $('#form-1-test').serializeArray();

                    for (var i = 0; i < 4; i++) {

                        if (data[i].value === correctAnswers[i][tense_answer]) {

                            if (i === 0) {
                                $('#test-form-1-answer-1').css('border', '3px solid green');
                                correct_counter++;

                            } else if (i === 1) {
                                $('#test-form-1-answer-2').css('border', '3px solid green');
                                correct_counter++;

                            } else if (i === 2) {
                                $('#test-form-1-answer-3').css('border', '3px solid green');
                                correct_counter++;

                            } else {
                                $('#test-form-1-answer-4').css('border', '3px solid green');
                                correct_counter++;

                            }
                            
                        } else {
                            if (i === 0) {
                                $('#test-form-1-answer-1').css('border', '3px solid red');
                                incorrect_counter++;

                            } else if (i === 1) {
                                $('#test-form-1-answer-2').css('border', '3px solid red');
                                incorrect_counter++;

                            } else if (i === 2) {
                                $('#test-form-1-answer-3').css('border', '3px solid red');
                                incorrect_counter++;

                            } else {
                                $('#test-form-1-answer-4').css('border', '3px solid red');
                                incorrect_counter++;

                            }
                            
                        }
                    }
                    

                    break;
                case 2: 
                    var data = $('#form-2-test').serializeArray();
                    
                    const removeNth = (arr, n) => {
                        for(let i = n-1; i < arr.length; i += n){
                           arr.splice(i, 1);
                        };
                    };
                    removeNth(data, 1);

                    for (var i = 0; i < 4; i++) {

                        if (data[i].value === correctAnswers[i][tense_answer]) {

                            if (i === 0) {
                                $('#test-form-2-input-1').css('border', '3px solid green');
                                correct_counter++;

                            } else if (i === 1) {
                                $('#test-form-2-input-2').css('border', '3px solid green');
                                correct_counter++;

                            } else if (i === 2) {
                                $('#test-form-2-input-3').css('border', '3px solid green');
                                correct_counter++;

                            } else {
                                $('#test-form-2-input-4').css('border', '3px solid green');
                                correct_counter++;

                            }
                            
                        } else {
                            if (i === 0) {
                                $('#test-form-2-input-1').css('border', '3px solid red');
                                incorrect_counter++;

                            } else if (i === 1) {
                                $('#test-form-2-input-2').css('border', '3px solid red');
                                incorrect_counter++;

                            } else if (i === 2) {
                                $('#test-form-2-input-3').css('border', '3px solid red');
                                incorrect_counter++;

                            } else {
                                $('#test-form-2-input-4').css('border', '3px solid red');
                                incorrect_counter++;

                            }
                            
                        }
                    }


                    break;
                case 3: 
                    var data = $('#form-3-test').serializeArray();

                    for (var i = 0; i < 4; i++) {

                        if (data[i].value === correctAnswers[i][tense_answer]) {

                            if (i === 0) {
                                $('#test-form-3-answer-1').css('border', '3px solid green');
                                correct_counter++;

                            } else if (i === 1) {
                                $('#test-form-3-answer-2').css('border', '3px solid green');
                                correct_counter++;

                            } else if (i === 2) {
                                $('#test-form-3-answer-3').css('border', '3px solid green');
                                correct_counter++;

                            } else {
                                $('#test-form-3-answer-4').css('border', '3px solid green');
                                correct_counter++;

                            }
                            
                        } else {
                            
                            if (i === 0) {
                                $('#test-form-3-answer-1').css('border', '3px solid red');
                                incorrect_counter++;

                            } else if (i === 1) {
                                $('#test-form-3-answer-2').css('border', '3px solid red');
                                incorrect_counter++;

                            } else if (i === 2) {
                                $('#test-form-3-answer-3').css('border', '3px solid red');
                                incorrect_counter++;

                            } else {
                                $('#test-form-3-answer-4').css('border', '3px solid red');
                                incorrect_counter++;

                            }

                        }
                    }


                    break;
            };
            
            percent_correct = ((correct_counter / questions_counter) * 100).toFixed(2);

            if (Number.isNaN(percent_correct)) {
                percent_correct = 0.00;
            }

            document.getElementById('questions-counter').innerHTML = questions_counter + ' Questions';
            document.getElementById('correct-counter').innerHTML = correct_counter + ' Correct Answers';
            document.getElementById('incorrect-counter').innerHTML = incorrect_counter + ' Incorrect Answers';
            document.getElementById('correct-percent').innerHTML = percent_correct + '% Correct Answers Percentage';
            
            return false;
        }
    </script>";

?>