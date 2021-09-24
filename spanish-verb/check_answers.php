<?php 
    
    echo "<script>
        function onFormSubmit(form) {

            switch (" . $question_type . ") {
                case 1:
                    // Store data from the form
                    var data = $('#form-1-sql').serializeArray();
                    
                    // Save data in a cookie to access it later
                    document.cookie = 'my_answers=' + data;
        
                    
                    for (var i = 0; i < 4; i++) {
                        console.log(data[i].value);
                    }

                break;
            case 2:
                    // Store data from the form
                    var data = $('#form-2-sql').serializeArray();

                    // Modifies array
                    const removeNth = (arr, n) => {
                        for(let i = n-1; i < arr.length; i += n){
                           arr.splice(i, 1);
                        };
                    };
                    removeNth(data, 1);
                    
                    // Save data in a cookie to access it later
                    document.cookie = 'my_answers=' + data;

                    for (var i = 0; i < 4; i++) {
                        //console.log(data[i].value);
                    }







                    break;



                case 3:
                    // Store data from the form
                    var data = $('#form-3-sql').serializeArray();

                    // Save data in a cookie to access it later
                    document.cookie = 'my_answers=' + data;

                    for (var i = 0; i < 4; i++) {
                        //console.log(data[i].value);
                    }




                    break;
            };


            // Prevent form from submitting
            return false;
        }
    </script>";
?>