

$(document).ready(function() {
    var tense_form, verb_tense;

    // Mark verb tense progress button as completed
    $("#verb-tense-button").removeClass("disabled");
    $("#verb-type-button").addClass("disabled");
    $("#verb-type-button").css("background-color", "#108024");
    $("#type-number-container").css("background-color", "#2ca142");

    $("#nav-title").click(function() {
        window.location = "index.php";
    });

    $("#tense-back").click(function() {
        window.location = "index.php";
    });

});


