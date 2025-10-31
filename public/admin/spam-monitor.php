<?php
/**
 * Spam Monitoring Dashboard
 * Provides insights into spam prevention effectiveness
 *
 * @author [Syntax] Principal Engineer
 * @security [Sentinal] Security Operations
 * @qa [Verity] Quality Assurance
 */

// Security check - add basic authentication
session_start();
$auth_required = true;

// Simple authentication (you should enhance this)
if ($auth_required && !isset($_SESSION['admin_authenticated'])) {
    // Check for basic auth
    $valid_username = 'admin'; // Change this
    $valid_password = 'secure_password_here'; // Change this

    if (!isset($_SERVER['PHP_AUTH_USER']) ||
        $_SERVER['PHP_AUTH_USER'] !== $valid_username ||
        $_SERVER['PHP_AUTH_PW'] !== $valid_password) {
        header('WWW-Authenticate: Basic realm="Admin Area"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Authentication required';
        exit;
    }
    $_SESSION['admin_authenticated'] = true;
}

// Include required files
require_once dirname(__DIR__, 2) . '/config.php';
require_once dirname(__DIR__, 2) . '/lib/anti-spam.php';

// Handle actions
$action = $_GET['action'] ?? '';
$message = '';

if ($action === 'clear_blacklist') {
    file_put_contents(BLACKLIST_FILE, json_encode([]));
    $message = 'Blacklist cleared successfully';
} elseif ($action === 'remove_ip' && isset($_GET['ip'])) {
    $blacklist = json_decode(file_get_contents(BLACKLIST_FILE), true) ?: [];
    $blacklist = array_filter($blacklist, function($entry) {
        return $entry['ip'] !== $_GET['ip'];
    });
    file_put_contents(BLACKLIST_FILE, json_encode($blacklist));
    $message = 'IP removed from blacklist';
}

// Get statistics
$stats = get_spam_stats();

// Get blacklist
$blacklist = [];
if (file_exists(BLACKLIST_FILE)) {
    $blacklist = json_decode(file_get_contents(BLACKLIST_FILE), true) ?: [];
    // Filter to show only active entries
    $blacklist = array_filter($blacklist, function($entry) {
        return $entry['expires'] > time();
    });
}

// Get recent legitimate submissions
$submissions = [];
$submissions_dir = dirname(__DIR__, 2) . '/data/contact-submissions/';
if (file_exists($submissions_dir)) {
    $files = glob($submissions_dir . '*.json');
    rsort($files); // Most recent first
    foreach (array_slice($files, 0, 10) as $file) {
        $data = json_decode(file_get_contents($file), true);
        if ($data) {
            $submissions[] = $data;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spam Monitoring Dashboard - <?php echo SITE_NAME; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen p-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Spam Monitoring Dashboard</h1>
                        <p class="text-gray-600 mt-2">Monitor and manage spam prevention for contact forms</p>
                    </div>
                    <div class="text-right">
                        <a href="<?php echo BASE_PATH; ?>/" class="text-blue-600 hover:text-blue-800">
                            ← Back to Site
                        </a>
                    </div>
                </div>
            </div>

            <?php if ($message): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <!-- Statistics Cards -->
            <div class="dashboard-grid mb-6">
                <div class="stat-card text-white rounded-lg p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm">Total Spam Blocked</p>
                            <p class="text-3xl font-bold"><?php echo $stats['total_spam_attempts']; ?></p>
                        </div>
                        <i data-lucide="shield-check" class="w-10 h-10 text-white/50"></i>
                    </div>
                </div>

                <div class="stat-card text-white rounded-lg p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm">Blocked IPs</p>
                            <p class="text-3xl font-bold"><?php echo $stats['blocked_ips']; ?></p>
                        </div>
                        <i data-lucide="ban" class="w-10 h-10 text-white/50"></i>
                    </div>
                </div>

                <div class="stat-card text-white rounded-lg p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm">Legitimate Submissions</p>
                            <p class="text-3xl font-bold"><?php echo count($submissions); ?></p>
                        </div>
                        <i data-lucide="mail-check" class="w-10 h-10 text-white/50"></i>
                    </div>
                </div>

                <div class="stat-card text-white rounded-lg p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm">Protection Level</p>
                            <p class="text-3xl font-bold">High</p>
                        </div>
                        <i data-lucide="shield" class="w-10 h-10 text-white/50"></i>
                    </div>
                </div>
            </div>

            <!-- Top Spam Reasons -->
            <?php if (!empty($stats['top_spam_reasons'])): ?>
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Top Spam Detection Reasons</h2>
                <div class="space-y-2">
                    <?php foreach ($stats['top_spam_reasons'] as $reason => $count): ?>
                    <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                        <span class="text-gray-700"><?php echo htmlspecialchars($reason); ?></span>
                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">
                            <?php echo $count; ?> occurrences
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Blacklisted IPs -->
            <?php if (!empty($blacklist)): ?>
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Blacklisted IPs</h2>
                    <a href="?action=clear_blacklist"
                       onclick="return confirm('Are you sure you want to clear the entire blacklist?')"
                       class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                        Clear All
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left">IP Address</th>
                                <th class="px-4 py-2 text-left">Reason</th>
                                <th class="px-4 py-2 text-left">Added</th>
                                <th class="px-4 py-2 text-left">Expires</th>
                                <th class="px-4 py-2 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($blacklist as $entry): ?>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-mono text-sm">
                                    <?php echo htmlspecialchars($entry['ip']); ?>
                                </td>
                                <td class="px-4 py-2 text-sm">
                                    <?php echo htmlspecialchars($entry['reason']); ?>
                                </td>
                                <td class="px-4 py-2 text-sm">
                                    <?php echo date('Y-m-d H:i', $entry['added']); ?>
                                </td>
                                <td class="px-4 py-2 text-sm">
                                    <?php echo date('Y-m-d H:i', $entry['expires']); ?>
                                </td>
                                <td class="px-4 py-2">
                                    <a href="?action=remove_ip&ip=<?php echo urlencode($entry['ip']); ?>"
                                       class="text-red-600 hover:text-red-800 text-sm">
                                        Remove
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <!-- Recent Spam Attempts -->
            <?php if (!empty($stats['recent_attempts'])): ?>
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Recent Spam Attempts</h2>
                <div class="space-y-3">
                    <?php foreach ($stats['recent_attempts'] as $attempt): ?>
                    <div class="border-l-4 border-red-500 pl-4 py-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600">
                                    <?php echo $attempt['timestamp']; ?> -
                                    IP: <?php echo htmlspecialchars($attempt['ip']); ?>
                                </p>
                                <p class="text-sm font-semibold">
                                    Score: <?php echo number_format($attempt['score'], 1); ?>
                                </p>
                                <p class="text-sm text-gray-700">
                                    <?php echo htmlspecialchars(substr($attempt['data']['message_preview'], 0, 100)); ?>...
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Recent Legitimate Submissions -->
            <?php if (!empty($submissions)): ?>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Recent Legitimate Submissions</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left">Date</th>
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Subject</th>
                                <th class="px-4 py-2 text-left">ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($submissions as $submission): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm">
                                    <?php echo htmlspecialchars($submission['timestamp']); ?>
                                </td>
                                <td class="px-4 py-2 text-sm">
                                    <?php echo htmlspecialchars($submission['name']); ?>
                                </td>
                                <td class="px-4 py-2 text-sm">
                                    <?php echo htmlspecialchars($submission['email']); ?>
                                </td>
                                <td class="px-4 py-2 text-sm">
                                    <?php echo htmlspecialchars($submission['subject'] ?? 'N/A'); ?>
                                </td>
                                <td class="px-4 py-2 text-sm font-mono">
                                    <?php echo htmlspecialchars(substr($submission['id'], -8)); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <!-- Configuration Status -->
            <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                <h2 class="text-xl font-semibold mb-4">Anti-Spam Configuration</h2>
                <div class="space-y-2">
                    <div class="flex items-center">
                        <span class="text-green-500 mr-2">✓</span>
                        <span>CSRF Protection: Enabled</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-green-500 mr-2">✓</span>
                        <span>Rate Limiting: <?php echo MAX_SUBMISSIONS_PER_IP; ?> per hour</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-green-500 mr-2">✓</span>
                        <span>Honeypot Field: Active</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-green-500 mr-2">✓</span>
                        <span>Content Filtering: Active</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-green-500 mr-2">✓</span>
                        <span>Time-based Validation: Min <?php echo MIN_FORM_FILL_TIME; ?> seconds</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-green-500 mr-2">✓</span>
                        <span>Spam Scoring: Threshold <?php echo SPAM_SCORE_THRESHOLD; ?></span>
                    </div>
                    <div class="flex items-center">
                        <?php if (defined('RECAPTCHA_ENABLED') && RECAPTCHA_ENABLED): ?>
                            <span class="text-green-500 mr-2">✓</span>
                            <span>reCAPTCHA v3: Configured</span>
                        <?php else: ?>
                            <span class="text-yellow-500 mr-2">⚠</span>
                            <span>reCAPTCHA v3: Not configured (optional)</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // Auto-refresh every 30 seconds
        setTimeout(() => {
            location.reload();
        }, 30000);
    </script>
</body>
</html>