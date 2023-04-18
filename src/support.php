<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/css/style.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <title>Silicon Stadium</title>
    <link rel="icon" type="image/x-icon" href="../src/picSource/favicon.ico">
</head>

<body id="supportPage">

    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../src/index.php">
                <img src="../src/picSource/favicon.ico" alt="Bootstrap" width="30" height="24">
                Silicon Stadium</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../src/fantasy.php">Fantasy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../src/support.php">Support</a>
                    </li>
                    <li class="nav-item nav-justify-content-end">
                        <a class="nav-link" href="../src/logout.php">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
            <li class="nav-item" style="color:aliceblue">
                <?php
                $_SESSION["TEST"] = True;
                require_once 'config.php';
                require 'php/DBconnect.php';
                error_reporting(E_ALL);
                ini_set('display_errors', True);
                $connection = connect();
                if (isset($_SESSION['userid'])) {
                    $user_id = $_SESSION['userid'];
                    if (isset($_SESSION['email'])) {
                        $user_email = $_SESSION['email'];
                    } else {
                        $user_email = 'dummyBOI@aol.com';
                    }
                } else {
                    $user_name = 'guest';
                }
                echo $user_email;
                ?>
            </li>
        </div>
    </nav>
    <div id="support-page-content" style="color: white; font-family: 'Bangers', cursive; font-size: xx-large; font-weight: 500; text-shadow: -2px 2px 0px black;">

        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="true">Contact Us</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="documentation-tab" data-bs-toggle="tab" data-bs-target="#documentation-tab-pane" type="button" role="tab" aria-controls="documentation-tab-pane" aria-selected="false">Documentation</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq-tab-pane" type="button" role="tab" aria-controls="faq-tab-pane" aria-selected="false">FAQ</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                Our Team:<br>
                Logan Whitfield<br>
                Kevin Hayes<br>
                Clayton Winters<br>
                Carlos Ruis<br>
                Nate Davis<br>
                The best way to reach us is emailing guest@aol.com to set up an appointment with our team.
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="documentation-tab-pane" role="tabpanel" aria-labelledby="documentation-tab" tabindex="0">
                Our model will enhance the experience of football and fantasy football with friends and family, 
                by providing users with more accurate predictions of player performance. <br>Our goal is to provide an entry-level tool that will allow anyone to get into fantasy football, 
                without needing extensive knowledge of the game. <br>Showing the users player and team past statistics in an easy viewing experience. <br>At the same time, 
                we understand that experts need more granularity in their predictions and we will provide them with a deeper level of analysis and insight.<br>
                Our goal of building a convolutional neural network for fantasy football is to streamline the statistical analysis behind the game and make it more accessible to users. <br>
                By using advanced machine learning techniques, we aim to provide users with more informed decisions when it comes to drafting and managing their fantasy teams. <br>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="faq-tab-pane" role="tabpanel" aria-labelledby="faq-tab" tabindex="0">
                    Q: Why are you all so awesome?<br>
                    A: We just are!<br>
                    Q: What data is being used for predictions?<br>
                    A: Currently we are using 55 different data points for each player. <br>
                    Q: Common terms defined. While most displayed statistics are self-explanatory there are some that are not so obvious:<br>
                    1. Rush- This terminology simply refers to the act of running with the ball, with the stipulation that the ball is not thrown during the play.<br>
                    2. Broken tackle- This refers to when a player is tackled by an opposing player but manages not to stop progressing forward. 
                    Often this will seem like the person breaking the tackle brushes the tackler away. <br>
                    3. Blitzed- This refers to a play where the defense sends five or more defenders directly into the offensive backfield to attack the ball carrier and disrupt the offense<br>
                    4. Fumble- When a ball is dropped but the play is still active, the ball can be recovered by either team, thereby gaining possession of it.<br>

                </div>
            </div>
        </div>
</body>

</html>