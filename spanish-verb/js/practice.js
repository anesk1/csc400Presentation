
$(document).ready(function() {
    var practice_form;
    

    // Mark every other button as completed
    $("#verb-type-button").addClass("disabled");
    $("#verb-type-button").css("background-color", "#108024");
    $("#type-number-container").css("background-color", "#2ca142");
    $("#verb-tense-button").css("background-color", "#108024");
    $("#tense-number-container").css("background-color", "#2ca142");

    $("#practice-test-button").removeClass("disabled");

    $("#nav-title").click(function() {
        window.location = "index.php";
    });

    $("#tense-next").click(function() {
        practice_form = $("#practice-form").serializeArray();
        //console.table(data);s
        //console.table(practice_form[0].value);
        console.log("Tense: " + tense.verb_tense + "   Type: " + type.verb_type);

        window.location = "practice.php";
    });

});


