<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email'])) {
    $recipient_email = $_GET['email'];
} else {
    // Redirect if email parameter is not provided
    header("Location: admin_panel.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reply_message'])) {
    $reply_message = $_POST['reply_message'];
    
    // Send email to user
    $subject = "Reply to your comment";
    $message = "Hello,\n\nYou have received a reply to your comment:\n\n" . $reply_message . "\n\nBest regards,\nYour Blog Team";
    $headers = "From: timilsinabipin20@gmail.com";

    if (mail($recipient_email, $subject, $message, $headers)) {
        echo "Reply sent successfully";
    } else {
        echo "Error sending reply";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Comment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Reply to Comment</h1>
    
    <p>Replying to: <?php echo $recipient_email; ?></p>
    
    <!-- Reply Form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="reply_message">Reply Message:</label><br>
        <textarea id="reply_message" name="reply_message" rows="4" required></textarea><br>
        <button type="submit">Send Reply</button>
    </form>
</body>
</html>
