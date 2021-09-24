
$(document).ready(function() {
    // var index_form, verb_type;

    // When you click the Spanish Verb Helper button it will redirect you to the index file
    $("#nav-title").click(function() {
        window.location = "index.php";
    });

    // When you click the next button it will redirect you to the tense file
    $("#index-next").submit(function() {
        window.location = "tense.php";
    });
});
