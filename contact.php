<?php
include 'includes/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $name = $_POST['inputname'];
    $email = $_POST['email'];
    $msg = $_POST['message'];
    $inquiry = $_POST['inquiry'];
    $to = get_info('adminemail');
    $subject = "Contact form entry - $name";
    $message =  'Name: ' . $name . "<br>Contact Email: " . $email . '<br>Inquiry: ' . $inquiry . '<br>Message: <br>' . $msg;
    $header = 'From: ' . get_info('adminemail') . "\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: text/html; charset=utf-8\r\n";
    mail($to, $subject, $message, $header);
?>
    <h2>Thank you for reaching out!</h2>
    <p>I will response as soon as possible:)</p>
<?php else : ?>
    <section class="wraper">
        <h3>Get in touch or email me directly on <a href="mailto:<?php echo get_info('email'); ?>"><?php echo get_info('email'); ?></a></h3>
        <form action="<?php echo $bodyclass; ?>" method="post" class="flexbox column container">
            <label for="inputname">Name</label>
            <input type="text" name="inputname" id="inputname" placeholder="Name" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="inquiry">Inquiry</label>
            <select name="inquiry" id="inquiry" required>
                <option value="none" disabled selected>Select your inquery</option>
                <option value="opt1">Composing</option>
                <option value="opt2">Collaboration</option>
                <option value="other">Other</option>
            </select>
            <label for="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="10" required placeholder="Enter your message here..."></textarea>
            <input type="submit" value="Send Message" class="btn">
        </form>
    <?php endif; ?>

    </section>
    <?php include 'includes/footer.php'; ?>