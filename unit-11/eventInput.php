<?php
    session_start();

    if ($_SESSION['isUserValid']) {
    } else {
        header("Location: ../login.php");
    }
    /* This form will accept the Event information as a self posting form.
        The server portion will do simple validation.
        If all the validation passes then the server will INSERT a new record into the 
        wdv341Events database.  If this is successful it will display a confirmation message
        instead of the form.

        if(form was submitted){
            //this area runs when the form is submitted and has form data to work with
            //data validation
            //put it into the database
        }
        else{
            //inside the page content
        }

        if(form is requested){
            //the user has requested the form and needs to see it
            //Output: display the form
        }
        else{
            //form was submitted and processed
            //Output: display the confirmation page
        }        


    */
    //flag or switch variable - it tells us whether or not you submit the form
    $formRequested = true;

    if( isset($_POST['submit']) ){
        //the form was SUBMITTED!!!! 
        //process the form data into the database INSERT DATABASE CODE HERE!!!
        $formRequested = false;     //the form was SUBMITTED, the database updated, display confirmation
    }
    else{
        //not sure what this will do, if anything
    }
?>
    <html>
    <head>
        <title>WDV341 Self Posting Form - Event Input</title>
    </head>

    <body>
        <h1>WDV341 Intro PHP</h1>
        <h2>Self Posting Form - Event Input</h2>
<?php    
    if($formRequested){
        //form was requested
        //display Form
?>
        <form method="post" action="eventInput.php">
            <h3>Event Input Form</h3>
            <!-- Insert form fields label/input for each field in the event table -->
            <p>
                <input type="submit" name="submit" Value="Submit">
                <input type="reset">
            </p>
        </form>
<?php
    }
    else{
        //display confirmation
?>
    <h3>Thank You!</h3>
    <p>Your event has been added to the database. Please check your new event in the Display Events process.</p>

<?php
    }

?>
    </body>
    </html>