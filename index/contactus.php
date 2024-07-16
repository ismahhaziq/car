<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index/contactus.css"> <!--link to css file-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Contact Us | Abe Nuar's Car Rental</title>
    
</head>

<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="aboutus.php">About Us</a>
        <a href="carlisting.php">Car Listing</a>
        <a href="faqs.php">FAQ</a>
        <a href="contactus.php">Contact Us</a>
        <a href="login.php" class="icon">👤</a> <!-- Replace with your icon or font icon -->
    </div>

    </head>

    <body>
        <div class="contact-section">
            <div class="container">
                <h1>Contact Us</h1>
                <p>If you have any questions, comments, or concerns, please feel free to reach out to us. We are here to
                    help and will respond to your inquiry as soon as possible.</p>
                <form class="contact-form" action="contactus.php" method="POST">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
        <!-- Footer Section -->
        <?php include 'footer.php'; ?>

        </form>
    </body>

</html>