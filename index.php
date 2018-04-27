<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sorts+Mill+Goudy" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet" type="text/css">

        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
        
            function validateForm() {
                
                return false;
           
            }
            
        </script>
        
        <script>
            $(document).ready( function() {
                
                $("#subBtn").click(function(){
                    if($("#zipError").html() == "Zipcode not valid.") {
                        alert("Zipcode not valid.");
                    } else if($("#pass1").val() != $("#pass2").val()){
                        alert("Passwords do not match.");
                    } else if($("#error").html() == "Username is taken.") {
                        alert("Username is not valid.");
                    } else {
                        alert("Everything looks good!");
                        location.reload();
                    }
                });
                
                $("#pass1").change( function() {

                    if($("#pass1").val() != $("#pass2").val()){
                        $("#passwordCheck").html("Passwords do not match.");
                        $("#passwordCheck").css("color","red");
                    } else {
                        $("#passwordCheck").html("");
                    }
                });
                
                $("#pass2").change( function() {

                    if($("#pass1").val() != $("#pass2").val()){
                        $("#passwordCheck").html("Passwords do not match.");
                        $("#passwordCheck").css("color","red");
                    } else {
                        $("#passwordCheck").html("");
                    }
                });
                
                $("#username").change( function() {

                   $.ajax({

                        type: "GET",
                        url: "checkUsername.php",
                        dataType: "json",
                        data: { "username": $('#username').val()},
                        success: function(data,status) {
                            if(!data) {
                                $("#error").html("Username is available");
                                $("#error").css("color","green");
                            } else {
                                $("#error").html("Username is taken.");
                                $("#error").css("color","red");
                            }
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                });
                
                $('#zipCode').change( function(){ 
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
                        dataType: "json",
                        data: { "zip": $('#zipCode').val()},
                        success: function(data,status) {
                            if(!data) {
                                $("#zipError").html("Zipcode not valid.");
                                $("#zipError").css("color","red");
                            } else {
                                $("#zipError").html("");
                                $('#city').html(data.city);
                                $('#lat').html(data.latitude);
                                $('#long').html(data.longitude);
                            }
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                });
                
                $('#state').change( function(){ 
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
                        dataType: "json",
                        data: { "state": $('#state').val()},
                        success: function(data,status) {
                            
                            $('#county').html("<option> -- Select One -- </option>");
                            for(var i = 0; i < data.length; i++) {
                                $('#county').append("<option value='" + data[i].county + "'>" + data[i].county + "</option>");
                            }
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                });
            }); //documentReady (doesn't run until whole html page has been loaded)
            
        </script>
        
    </head>

    <body>
    
       <h1> Sign Up Form </h1>
    
        <form onsubmit="return validateForm()">
            <fieldset>
               <legend><span id="title2">Sign Up</span></h3></legend>
                <h3>First Name:  <input type="text" id="firstName"></h3>
                <h3>Last Name:   <input type="text" id="lastName"></h3> 
                <h3>Email:       <input type="text" id="email"></h3>
                <h3>Phone Number: <input type="text"><span id="specifics"> Ex. (XXX) - XXX - XXXX</span></h3>
                <h3>Zip Code:    <input type="text" id="zipCode"><span id="zipError"></span></h3>
                <h3>City: <span id="city">Please enter a zipcode</span> </h3>
                <h3>Latitude: <span id="lat">Please enter a zipcode</span> </h3>
                <h3>Longitude: <span id="long">Please enter a zipcode</span> </h3>
                <h3>State: 
                <select id="state">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select></h3>
                
                <h3>Select a County: <select id="county"></select></h3>
                
                <h3>Desired Username: <input type="text" id="username"><span id="error"> * Must be unique</span></h3>
                
                <h3>Password: <input type="password" id="pass1"></h3>
                
                <h3>Type Password Again: <input type="password" id = "pass2"></h3>
                <h3><div id="passwordCheck"></div></h3>
                
                <input type="submit" id= "subBtn" value="Sign up!">
                
                <div id="recAdded"></div>
            </fieldset>
        </form>
    
    </body>
    
    <footer>
        Created by Faith Shatto
    </footer>
</html>