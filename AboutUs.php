<?php include ("path.php");
?>


<?php
include (ROOT_PATH . "/app/controller/users.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0" ,maximum-scale=1.0,user-scalable=no>
    <title>About Us</title>
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <!-- poppins font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="assets/images/fav-icon.svg" />

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/70e6448a33.js" crossorigin="anonymous">
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .about-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #007BFF;
        }

        h2 {
            color: #0056b3;
            margin-top: 20px;
        }

        p {
            line-height: 1.6;
        }

       .about-container ul {
            list-style-type: square;
            margin: 20px 0;
            padding-left: 20px;
        }

       .about-container ul li {
            margin: 10px 0;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

</head>

<body>
    <?php include ("app/include/header.php")
    ;

    ?>
    <!-- content -->

    <div class="about-container">
        <h1>About Us</h1>
        <p>Welcome to FewaBoat Blogs! We are dedicated to providing you with the latest news, events, and updates about
            boating activities on Phewa Lake. Our goal is to create a vibrant community of boating enthusiasts,
            tourists, and local residents who can stay informed and engaged with all the happenings at Phewa Lake.</p>

        <h2>Our Mission</h2>
        <p>Our mission is to enhance the boating experience on Phewa Lake by offering timely information, promoting
            exciting events, and fostering a community of passionate boaters. We believe that by sharing valuable
            insights and updates, we can make boating on Phewa Lake even more enjoyable for everyone.</p>

        <h2>What We Offer</h2>
        <ul>
            <li>Up-to-date information on boating events and activities</li>
            <li>Insightful blog posts and articles about boating on Phewa Lake</li>
      
        </ul>

        <h2>Contact Us</h2>
        <p>If you have any questions, suggestions, or feedback, please feel free to reach out to us. We are always here
            to help and would love to hear from you!</p>

        <p>Email: <a href="mailto:info@fewaboatblogs.com">info@fewaboatblogs.com</a></p>
        <p>Phone: +977-1234567890</p>

        <p>Thank you for visiting FewaBoat Blogs. We hope you enjoy your time on our website and find it to be a
            valuable resource for all things related to boating on Phewa Lake.</p>
    </div>













    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>