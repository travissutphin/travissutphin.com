<?php
// Include the enhanced contact handler
require_once dirname(__DIR__, 2) . '/lib/contact-handler.php';

// Handle form submission
$success = false;
$error = false;
$submission_id = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Verify CSRF token
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            throw new Exception('Invalid security token. Please refresh and try again.');
        }

        // Get client IP
        $client_ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

        // Check rate limiting
        if (!check_rate_limit($client_ip)) {
            throw new Exception('Too many submissions. Please try again in an hour.');
        }

        // Check honeypot (anti-spam)
        if (!check_honeypot($_POST)) {
            // Silently reject bot submissions
            $success = true; // Show success to confuse bots
            $submission_id = 'BOT-' . uniqid();
        } else {
            // Sanitize and validate input
            $clean_data = sanitize_contact_input($_POST);

            // Save submission to local file
            $submission_id = save_submission($clean_data, $client_ip);

            // Send thank you email to submitter
            $thank_you_sent = send_thank_you_email($clean_data);

            // Send notification to admin
            $admin_notified = send_admin_notification($clean_data, $submission_id);

            // Check if emails sent successfully
            if (!$thank_you_sent || !$admin_notified) {
                $debug_info = "Contact form email failure - Thank you: " . ($thank_you_sent ? 'OK' : 'FAILED') .
                             ", Admin: " . ($admin_notified ? 'OK' : 'FAILED');
                error_log($debug_info);

                // In development, show more details
                if (DEBUG_MODE) {
                    throw new Exception($debug_info . ' - Check server logs for Resend API details. Ref: ' . $submission_id);
                } else {
                    throw new Exception('Your message was saved but email notifications failed. We will review your submission manually. Reference ID: ' . $submission_id);
                }
            }

            $success = true;

            // Clear form data
            $_POST = [];
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<section class="contact-section py-16 px-4">
    <div class="floating-element floating-element-1"></div>
    <div class="floating-element floating-element-2"></div>
    <div class="max-w-3xl mx-auto relative z-10">
        <h1 class="contact-title text-4xl font-bold text-center mb-8">Get In Touch</h1>
        <p class="contact-subtitle text-xl text-center mb-12">
            Ready to discuss your project? I'd love to hear from you.
        </p>

        <?php if ($success): ?>
            <div class="bg-green-50 dark:bg-green-900/20 border-2 border-green-500 rounded-lg p-6 mb-8">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i data-lucide="check-circle" class="w-8 h-8 text-green-500"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-green-800 dark:text-green-300 mb-2">
                            Thank You for Contacting Me!
                        </h3>
                        <div class="text-green-700 dark:text-green-400">
                            <p class="mb-2">Your message has been successfully received.</p>
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                <li>A confirmation email has been sent to your address</li>
                                <li>I typically respond within 24 hours during business days</li>
                                <li>For urgent matters, feel free to follow up at <?php echo SITE_EMAIL; ?></li>
                            </ul>
                            <?php if ($submission_id && !str_starts_with($submission_id, 'BOT-')): ?>
                                <p class="mt-3 text-xs opacity-75">
                                    Reference ID: <?php echo e($submission_id); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <?php render_partial('alert', [
                'type' => 'error',
                'title' => 'Error',
                'message' => $error
            ]); ?>
        <?php endif; ?>

        <div class="contact-card p-8">
            <?php render_partial('contact-form'); ?>
        </div>

        <div class="connect-section mt-12 text-center">
            <h2 class="connect-title text-2xl font-bold mb-6">Other Ways to Connect</h2>

            <div class="flex justify-center items-center space-x-2 mb-4">
                <div class="email-icon-container w-10 h-10 rounded-full flex items-center justify-center">
                    <i data-lucide="mail" class="w-5 h-5 text-white"></i>
                </div>
                <a href="mailto:<?php echo SITE_EMAIL; ?>" class="connect-email font-medium">
                    <?php echo SITE_EMAIL; ?>
                </a>
            </div>

            <div class="flex justify-center items-center space-x-2 connect-info">
                <i data-lucide="clock" class="w-4 h-4 text-primary-green"></i>
                <span>Response time: Usually within 24 hours</span>
            </div>
        </div>
    </div>
</section>