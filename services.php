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
    <title>Our Services</title>
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

        .services-container {
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
            /* text-decoration: underline; */
        }
    </style>

    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

</head>

<body>
    <?php include ("app/include/header.php")
    ;

    ?>
    <!-- content -->

    <  <div class="services-container">
        <h1>Our Services</h1>
        <p>At FewaBoat Blogs, we offer a range of services designed to enhance your boating experience on Phewa Lake. Whether you are a local resident, a tourist, or a boating enthusiast, our services cater to your needs and interests.</p>

        <h2>Blog Updates</h2>
        <p>Stay informed with our regular blog updates featuring the latest news, events, and articles about boating activities on Phewa Lake. Our content is curated to keep you engaged and knowledgeable about all things related to boating.</p>

        <h2>Event Promotion</h2>
        <p>We promote various boating events and activities happening on Phewa Lake. From boat races to community gatherings, we ensure you are always in the loop about exciting events that you can participate in or attend.</p>

        <h2>Feedback and Engagement</h2>
        <p>We value your feedback and experiences. Our platform allows you to share your thoughts, suggestions, and boating stories. Engage with fellow boating enthusiasts and contribute to our growing community.</p>

        <h2>Boating Tips and Guides</h2>
        <p>Access a wealth of information through our boating tips and guides. Whether you are a beginner or an experienced boater, our guides provide valuable insights to enhance your boating skills and safety.</p>

        <h2>Advertising Opportunities</h2>
        <p>For businesses and event organizers, we offer advertising opportunities to reach a targeted audience interested in boating activities. Promote your services, products, or events through our platform.</p>

        <h2>Contact Us</h2>
        <p>If you have any questions about our services or need further information, please feel free to reach out to us. We are here to assist you!</p>
        
        <p>Email: <a href="mailto:info@fewaboatblogs.com">info@fewaboatblogs.com</a></p>
        <p>Phone: +977-1234567890</p>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>