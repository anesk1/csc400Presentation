
<?php 
    if (!isset($_SESSION)) {
        session_start();
    }

    $practice_questions = $_SESSION['practice_questions'];
    $verb_tense = $_SESSION['verb_tense'];
    $answer_sql = "answer_" . $verb_tense;
    
    // Check the question type to figure our what form to use
    //$question_type = json_encode($practice_questions[0]['type']);
    $question_type = json_encode($practice_questions[0]['Fill in the blank']);
    $question_type = str_replace('"', "", $question_type);
    
    switch ($question_type) {
        case 1:
            $form_number = 1;
            $question_counter = 1;

            echo "<p id='practice-container-title'>Fill in the blanks:</p> ";

            echo "
                <form action='' method='post' id='form-1-sql' onsubmit='return onFormSubmit(this);'>";

                foreach ($practice_questions as $question) {
                    echo "
                        <div class='row'>
                            <label for='form-" . $form_number . "-answer-" . $question_counter . "'>" . $question['question_start'] . "</label>
                            <input type='text' id='form-" . $form_number . "-answer-" . $question_counter . "' name='form-" . $form_number . "-answer-" . $question_counter . "'>
                            <label for='form-" . $form_number . "-answer-" . $question_counter . "'>" . $question['question_end'] . "</label>
                        </div>
                    ";

                    $question_counter++;
                }
  
            echo "
                    <input type='submit' class='myButton2' id='check-answers-btn' name='check-answers-btn' value='Check Answers'>
                </form>
            ";

            break;
        
        case 2:
            $form_number = 2;
            $question_counter = 1;
            $answer = 1;
            $choice = 1;

            echo "<p id='practice-container-title-2'>Completing the sentence:</p> ";

            echo "
                <form action='' method='post' id='form-2-sql' onsubmit='return onFormSubmit(this);'>";

                foreach ($practice_questions as $question) {
                    echo "
                        <div class='row'>
                            <label for='form-" . $form_number . "-answer-" . $question_counter . "'>" . $question['question_start'] . "</label>
                            <input type='text' value='' name='form-" . $form_number . "-answer-" . $question_counter . "' required>
                            <label for='form-" . $form_number . "-answer-" . $question_counter . "'>" . $question['question_end'] . "</label>
                        </div>
                    ";

                    echo "<div class='row' id='radio-row-" . $question_counter . "'>"; 

                        for ($i = 1; $i < 5; $i++) {
                            echo "
                                <input type='radio' name='radio-choice-" . $choice . "' id='radio-choice-" . $answer . "' value='" . $question['option' . $answer] . "'>
                                <label for='radio-choice-" . $answer . "'>" . $question['option' . $answer] . "</label>
                            ";

                            $answer++;
                        }

                        $answer = 1;
                        $question_counter++;
                        $choice++;

                    echo "</div>";
                }
  
            echo "
                    <input type='submit' class='myButton2' id='check-answers-btn-2' name='check-answers-btn' value='Check Answers'>
                </form>
            ";

            $radio_choice_1 = "radio-choice-1";
            $radio_input_1 = "form-2-answer-1";
            $radio_choice_2 = "radio-choice-2";
            $radio_input_2 = "form-2-answer-2";
            $radio_choice_3 = "radio-choice-3";
            $radio_input_3 = "form-2-answer-3";
            $radio_choice_4 = "radio-choice-4";
            $radio_input_4 = "form-2-answer-4";

            echo "<script>
                $(document).ready(function() {
                    $('input[name=" . $radio_choice_1 . "]').on('change', function() {
                        $('input[name=" . $radio_input_1 . "]').val($('input[name=".$radio_choice_1."]:checked', '#form-2-sql').val());
                    });
                    $('input[name=" . $radio_choice_2 . "]').on('change', function() {
                        $('input[name=" . $radio_input_2 . "]').val($('input[name=".$radio_choice_2."]:checked', '#form-2-sql').val());
                    });
                    $('input[name=" . $radio_choice_3 . "]').on('change', function() {
                        $('input[name=" . $radio_input_3 . "]').val($('input[name=".$radio_choice_3."]:checked', '#form-2-sql').val());
                    });
                    $('input[name=" . $radio_choice_4 . "]').on('change', function() {
                        $('input[name=" . $radio_input_4 . "]').val($('input[name=".$radio_choice_4."]:checked', '#form-2-sql').val());
                    });
                });
            </script>";

            break;
        case 3:
            $form_number = 3;
            $counter = 1;
            $verb_tense = 'present';
            $answer_sql = 'answer_present';


            echo "<p id='practice-container-title-3'>Match the left column with the right:</p> ";

            echo "
                <form action='' method='post' id='form-3-sql' onsubmit='return onFormSubmit(this);'>";

                for ($column = 1; $column < 4; $column++) {
                    echo "<div class='column'>";

                    foreach ($practice_questions as $question) {

                        if ($column === 1) {
                            echo "<label for='form-3-input-" . $counter ."' id='form-3-ques-start-" . $counter . "'>" . $question['question_start'] . "</label>";

                        } else if ($column === 2) {
                            echo "<label for='form-3-input-" . $counter ."' id='form-3-ques-end-" . $counter . "'>" . $question['question_end'] . "</label>";
                        } else {
                            echo "<input type='text' id='form-3-input-" . $counter ."' name='form-3-input-" . $counter ."'>";
                        }
    
                        $counter++;
                    }

                    $counter = 1;
                    echo "</div>";
                }
  
            echo "
                    <input type='submit' class='myButton2' id='check-answers-btn2' name='check-answers-btn2' value='Check Answers'>
                </form>
            ";

            include "./notifications/matching-warning.php";
            
            break;
    };

    //Checking answers
    echo "<script>
        function onFormSubmit(form) {
            var correctAnswers = " . json_encode($practice_questions) . ";
            var tense_sql = 'answer_" . $_SESSION['verb_tense'] . "';


            switch (" . $question_type . ") {
                case 1: 
                    // Store data from the form
                    var data = $('#form-1-sql').serializeArray();

                    // Compare answers
                    for (var i = 0; i < 4; i++) {
                        if (data[i].value === correctAnswers[i][tense_sql]) {

                            if (i === 0) {
                                $('#form-1-answer-1').css('border', '3px solid green');
                            } else if (i === 1) {
                                $('#form-1-answer-2').css('border', '3px solid green');
                            } else if (i === 2) {
                                $('#form-1-answer-3').css('border', '3px solid green');
                            } else {
                                $('#form-1-answer-4').css('border', '3px solid green');
                            }

                        } else {

                            if (i === 0) {
                                $('#form-1-answer-1').css('border', '3px solid red');
                            } else if (i === 1) {
                                $('#form-1-answer-2').css('border', '3px solid red');
                            } else if (i === 2) {
                                $('#form-1-answer-3').css('border', '3px solid red');
                            } else {
                                $('#form-1-answer-4').css('border', '3px solid red');
                            }

                        }
                    }
    
                    break;
                case 2: 

                    // Store data from the form
                    var data = $('#form-2-sql').serializeArray();

                    const removeNth = (arr, n) => {
                        for(let i = n-1; i < arr.length; i += n){
                           arr.splice(i, 1);
                        };
                    };
                    removeNth(data, 1);

                    // Compare answers
                    for (var i = 0; i < 4; i++) {
                    
                        if (data[i].value === correctAnswers[i][tense_sql]) {

                            if (i === 0) {
                                $('#form-2-sql > div:nth-child(1) > input').css('border', '3px solid green');

                            } else if (i === 1) {
                                $('#form-2-sql > div:nth-child(3) > input').css('border', '3px solid green');

                            } else if (i === 2) {
                                $('#form-2-sql > div:nth-child(5) > input').css('border', '3px solid green');

                            } else {
                                $('#form-2-sql > div:nth-child(7) > input').css('border', '3px solid green');
                            }

                        } else {
                            
                            if (i === 0) {
                                $('#form-2-sql > div:nth-child(1) > input').css('border', '3px solid red');

                            } else if (i === 1) {
                                $('#form-2-sql > div:nth-child(3) > input').css('border', '3px solid red');

                            } else if (i === 2) {
                                $('#form-2-sql > div:nth-child(5) > input').css('border', '3px solid red');

                            } else {
                                $('#form-2-sql > div:nth-child(7) > input').css('border', '3px solid red');
                            }

                        }
                    }


                    break;
                case 3: 
                    // Store data from the form
                    var data = $('#form-3-sql').serializeArray();

                    // Compare answers
                    for (var i = 0; i < 4; i++) {
                        if (data[i].value === correctAnswers[i][tense_sql]) {

                            if (data[i].value === '') {
                                if (i === 0) {
                                    $('#form-3-input-1').css('border', '3px solid red');
                                } else if (i === 1) {
                                    $('#form-3-input-2').css('border', '3px solid red');
                                } else if (i === 2) {
                                    $('#form-3-input-3').css('border', '3px solid red');
                                } else {
                                    $('#form-3-input-4').css('border', '3px solid red');
                                }

                            } else {
                                if (i === 0) {
                                    $('#form-3-input-1').css('border', '3px solid green');
                                 } else if (i === 1) {
                                     $('#form-3-input-2').css('border', '3px solid green');
                                 } else if (i === 2) {
                                     $('#form-3-input-3').css('border', '3px solid green');
                                 } else {
                                     $('#form-3-input-4').css('border', '3px solid green');
                                 }
                            }
                            
                        } else {

                            if (i === 0) {
                                $('#form-3-input-1').css('border', '3px solid red');
                            } else if (i === 1) {
                                $('#form-3-input-2').css('border', '3px solid red');
                            } else if (i === 2) {
                                $('#form-3-input-3').css('border', '3px solid red');
                            } else {
                                $('#form-3-input-4').css('border', '3px solid red');
                            }

                        }
                    }


                    break;
            };

            // Prevent form from submitting
            return false;
        }
    </script>";

?>