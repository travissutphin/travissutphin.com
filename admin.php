<?php
require_once 'config.php';
require_once 'lib/functions.php';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Invalid request. Please try again.';
    } else {
        $password = $_POST['password'] ?? '';

        // Check rate limiting
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 0;
            $_SESSION['first_attempt_time'] = time();
        }

        if ($_SESSION['login_attempts'] >= MAX_LOGIN_ATTEMPTS) {
            $time_passed = time() - $_SESSION['first_attempt_time'];
            if ($time_passed < LOGIN_LOCKOUT_TIME) {
                $remaining = LOGIN_LOCKOUT_TIME - $time_passed;
                $error = "Too many failed attempts. Please try again in " . ceil($remaining / 60) . " minutes.";
            } else {
                // Reset attempts after lockout period
                $_SESSION['login_attempts'] = 0;
                $_SESSION['first_attempt_time'] = time();
            }
        }

        if (!isset($error)) {
            // Verify password (you need to generate a proper hash and update config.php)
            // For testing: password is "admin123" - CHANGE THIS IN PRODUCTION
            $test_hash = '$2y$10$YLgH8z.FKxP7.MJNklTFqeuqvwwMqhZj0rFaDvlfQBKgUqhFc.Xbm';

            if (password_verify($password, $test_hash)) {
                $_SESSION['admin_authenticated'] = true;
                $_SESSION['last_activity'] = time();
                header('Location: ' . BASE_PATH . '/admin');
                exit;
            } else {
                $_SESSION['login_attempts']++;
                $error = 'Invalid password.';
            }
        }
    }
}

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: ' . BASE_PATH . '/admin');
    exit;
}

// Check if authenticated
$is_authenticated = is_authenticated();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo SITE_NAME; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-green': '#2be256',
                        'dark-green': '#005a00',
                        'primary-blue': '#3d608f',
                        'light-blue': '#8dace1',
                        'dark': '#1a1a1a',
                        'gray-dark': '#4a4a4a',
                        'gray-light': '#f8f9fa'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-light min-h-screen">
    <?php if (!$is_authenticated): ?>
        <!-- Login Form -->
        <div class="min-h-screen flex items-center justify-center px-4">
            <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
                <h1 class="text-2xl font-bold text-center text-dark-green mb-6">Admin Login</h1>

                <?php if (isset($error)): ?>
                    <?php render_partial('alert', ['type' => 'error', 'message' => $error]); ?>
                <?php endif; ?>

                <form method="POST">
                    <input type="hidden" name="action" value="login">
                    <input type="hidden" name="csrf_token" value="<?php echo e(get_csrf_token()); ?>">

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-dark mb-2">
                            Password
                        </label>
                        <input type="password"
                               id="password"
                               name="password"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-green focus:border-transparent">
                    </div>

                    <button type="submit"
                            class="w-full bg-primary-green text-white font-semibold py-3 px-6 rounded-lg hover:bg-dark-green transition-colors">
                        Login
                    </button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <!-- Admin Dashboard -->
        <div class="container mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-dark-green">Admin Dashboard</h1>
                <a href="<?php echo BASE_PATH; ?>/admin?action=logout"
                   class="text-red-600 hover:text-red-800 font-semibold">
                    Logout
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">Blog Management</h2>
                <p class="text-gray-dark mb-4">Blog CRUD functionality will be implemented in Week 4.</p>

                <div class="border-t pt-4 mt-6">
                    <h3 class="font-semibold mb-2">System Information</h3>
                    <ul class="text-sm text-gray-dark">
                        <li>Session timeout: <?php echo SESSION_TIMEOUT / 60; ?> minutes</li>
                        <li>Max login attempts: <?php echo MAX_LOGIN_ATTEMPTS; ?></li>
                        <li>Environment: <?php echo DEBUG_MODE ? 'Development' : 'Production'; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>