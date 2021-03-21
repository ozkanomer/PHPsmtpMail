<?php
    if(isset($_POST["btn-send"])){
        require 'phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer(); /* Create a PHPMailer instance */

        $mail->IsSMTP();
        $mail->SMTPSecure = 'ssl'; // tsl or ssl suggest
        $mail->Host = 'smtp.exapmle.com'; // SMTP Server
        $mail->SMTPAuth = true;
        $mail->Username = 'smtp.mail.account@example.com'; // SMTP mail account
        $mail->Password = "smtppassword"; // SMTP mail account's password
        $mail->Port = 465; // SMTP Port
        $mail->SMTPSecure = true;

        $mail->setFrom($_POST['Email'], $_POST['Name']);
        $mail->addAddress('wheremailgo@example.com'); // Set sending addres where want you send
        $mail->addReplyTo($_POST['Email'],$_POST['Name']); // Reply addres

        $mail->isHTML(true);
        $mail->Subject= 'Form Submission: '.$_POST['Subject'];
        $mail->Body= '<h1 align=center>Name :'.$_POST['UName'].'<br>Message: '.$_POST['msg'].'</h1>';

        if(!$mail->send()){
            header('location:contact.php?error'); // Error
        }
        else{
            header('location:contact.php?succes'); // Succes
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Contact Page</title>
    <style>
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
            border-radius: 6px;
            margin-top: 10px;
            margin-bottom: 15px;
        }
        .succes {
            padding: 20px;
            background-color: #3c763d;
            color: white;
            border-radius: 6px;
            margin-top: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <div class="card-title">
                        <h2 class="text-center py-2"> Contact Us </h2>
                        <hr>
                        <?php
                        $Msg = "";
                        if(isset($_GET['error']))
                        {
                            $Msg = " An error occured! ";
                            echo '<div class="alert">'.$Msg.'</div>';
                        }

                        if(isset($_GET['succes']))
                        {
                            $Msg = " Your message has been sent! Thanks for contact us.";
                            echo '<div class="succes">'.$Msg.'</div>';
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <input type="text" name="Name" placeholder="Name" class="form-control mb-2">
                            <input type="email" name="Email" placeholder="Email" class="form-control mb-2">
                            <input type="text" name="Subject" placeholder="Subject" class="form-control mb-2">
                            <textarea name="message" placeholder="Write Message" class="form-control"></textarea>
                            <button name="btn-send" class="btn btn-success mt-2"> Send </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>