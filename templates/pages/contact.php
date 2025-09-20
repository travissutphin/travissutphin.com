<?php
// Handle form submission
$success = false;
$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Invalid request. Please try again.';
    } else {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';

        if (empty($name) || empty($email) || empty($message)) {
            $error = 'Please fill in all required fields.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } else {
            // Prepare email
            $to = SITE_EMAIL;
            $subject = 'New Contact Form Submission from ' . $name;

            // HTML email body
            $body = "<html><body style='font-family: Arial, sans-serif;'>";
            $body .= "<h2 style='color: #005a00;'>New Contact Form Submission</h2>";
            $body .= "<p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>";
            $body .= "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
            $body .= "<p><strong>Message:</strong></p>";
            $body .= "<p style='background-color: #f8f9fa; padding: 15px; border-left: 4px solid #2be256;'>" . nl2br(htmlspecialchars($message)) . "</p>";
            $body .= "<hr style='margin-top: 30px; border: 1px solid #e0e0e0;'>";
            $body .= "<p style='color: #666; font-size: 12px;'>This message was sent from the contact form on travissutphin.com</p>";
            $body .= "</body></html>";

            // Headers for HTML email
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8\r\n";
            $headers .= "From: " . SITE_NAME . " <noreply@" . $_SERVER['HTTP_HOST'] . ">\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            // Send email
            if (mail($to, $subject, $body, $headers)) {
                $success = true;
                // Clear form data
                $_POST = [];
            } else {
                $error = 'Failed to send message. Please try again later.';
            }
        }
    }
}
?>

<section class="py-16 px-4">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-4xl font-bold text-center text-dark-green mb-8">Get In Touch</h1>
        <p class="text-xl text-center text-gray-dark mb-12">
            Ready to discuss your project? I'd love to hear from you.
        </p>

        <?php if ($success): ?>
            <?php render_partial('alert', [
                'type' => 'success',
                'title' => 'Message Sent!',
                'message' => 'Thank you for your message. I\'ll get back to you within 24 hours.'
            ]); ?>
        <?php endif; ?>

        <?php if ($error): ?>
            <?php render_partial('alert', [
                'type' => 'error',
                'title' => 'Error',
                'message' => $error
            ]); ?>
        <?php endif; ?>

        <div class="bg-white rounded-lg shadow-md p-8">
            <?php render_partial('contact-form'); ?>
        </div>

        <div class="mt-12 text-center">
            <h2 class="text-2xl font-bold text-dark-green mb-6">Other Ways to Connect</h2>

            <div class="flex justify-center items-center space-x-2 mb-4">
                <div class="w-10 h-10 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center">
                    <i data-lucide="mail" class="w-5 h-5 text-white"></i>
                </div>
                <a href="mailto:<?php echo SITE_EMAIL; ?>" class="text-primary-blue hover:text-dark-green font-medium">
                    <?php echo SITE_EMAIL; ?>
                </a>
            </div>

            <div class="flex justify-center items-center space-x-2 text-gray-dark">
                <i data-lucide="clock" class="w-4 h-4 text-primary-green"></i>
                <span>Response time: Usually within 24 hours</span>
            </div>
        </div>
    </div>
</section>