<?php
$mysqli = new mysqli('3.109.14.4', 'ostechnix', 'Password123#@!', 'spaceece');

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}


if(isset($_POST['subscribe'])){
    $email=$_POST['email'];

   

                $sql = mysqli_query($mysqli, "SELECT * from subscription Where email='$email'") or die('Sql Query3 Error' . mysqli_error($mysqli));
                if (mysqli_num_rows($sql) > 0) {
                   while ($result = mysqli_fetch_assoc($sql)) {
                    echo "This Email. $email is already registered <br>";
                      
                   }
               } else {
    
                $query3 = mysqli_query($mysqli, "INSERT into subscription(email) values('$email')")
                or die('Sql Query4 Error' . mysqli_error($mysqli));
                $toEmail = $email; 
             $sent = sendEmail( $headers,$toEmail, $emailSubject,$emailBody);
              
                if( $sent==='Success'){
                    
                echo "Successfully Registered $email";
                }else{
                    echo "Error";
                }


                   }
           
            function sendEmail($headers,$toEmail, $emailSubject, $emailBody){
                $eol = "\r\n";
                $headers = "From: 'SpacActive' <'contactus@spacece.co'>" . $eol;
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
              
              
                $emailSubject = 'Activity';
            
            
            
                $emailBody = "Hello " . $toEmail . ",<br><br>";
                $emailBody .= "Wishing you a very good morning and a great day ahead.<br><br>";
                $emailBody .= "Please find the activity for your children below. We are sure that it will make children's days full of fun and engaging.<br><br>";
                $emailBody .= "<b>Activity:</b> <br><br>";
                if (mail($toEmail, $emailSubject, $emailBody, $headers)) {
                    echo "Success";
                }else{
                    echo "Error";
                }
            }

}