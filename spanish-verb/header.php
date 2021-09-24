<!--- Creates the header that is present in all of the pages presented to the user
--->
<nav id="nav-bar">
    <p id="nav-title">Spanish Verb Helper</p>
    <form method="post" action="" id="test-form">
        <button class="myButton2" id="take-test-btn" name="take-test-btn">Take Test</button>
    </form>
</nav>

<!--- Checks if the Take test button is activated through a user click while retrieving information through post
---> 
<?php 
    if (isset($_POST['take-test-btn'])) {

        header("Location: test.php");
    }

?>

