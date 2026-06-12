<?php
/**
 * BLAUPUNKT – One-time Setup Script for Shared Hosting
 * =====================================================
 * This script runs your database migrations via the browser.
 * DELETE THIS FILE after setup is complete!
 *
 * Access: https://yourdomain.com/setup.php?secret=CHANGE_THIS_SECRET
 */

// ─── CHANGE THIS to a secret password before uploading ───────────────────────
define('SETUP_SECRET', 'CHANGE_THIS_SECRET');
// ─────────────────────────────────────────────────────────────────────────────

$secret = $_GET['secret'] ?? '';
if ($secret !== SETUP_SECRET || empty(SETUP_SECRET) || SETUP_SECRET === 'CHANGE_THIS_SECRET') {
    http_response_code(403);
    die('<h2 style="font-family:sans-serif;color:red">Access denied.<br>Open setup.php?secret=YOUR_SECRET after setting SETUP_SECRET in this file.</h2>');
}

$appPath = __DIR__ . '/_laravel';

// Bootstrap Laravel
define('LARAVEL_START', microtime(true));
require $appPath . '/vendor/autoload.php';

$app = require_once $appPath . '/bootstrap/app.php';

// We need the kernel to boot the app
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo '<html><head><title>Blaupunkt Setup</title>
<style>body{font-family:monospace;background:#111;color:#0f0;padding:20px;}
h1,h2{color:#fff;} .ok{color:#0f0;} .err{color:#f55;} .box{background:#222;padding:10px;margin:10px 0;border-radius:4px;white-space:pre-wrap;}
</style></head><body>';
echo '<h1>Blaupunkt – Shared Hosting Setup</h1>';

$steps = [];

// Step 1: Check .env exists
echo '<h2>1. Checking .env file …</h2><div class="box">';
$envFile = $appPath . '/.env';
if (file_exists($envFile)) {
    echo '<span class="ok">✔  .env found</span>';
    $steps['env'] = true;
} else {
    echo '<span class="err">✘  .env NOT found at _laravel/.env — please create it from .env.example</span>';
    $steps['env'] = false;
}
echo '</div>';

// Step 2: Check DB connection
echo '<h2>2. Testing database connection …</h2><div class="box">';
try {
    \Illuminate\Support\Facades\DB::connection()->getPdo();
    $db = \Illuminate\Support\Facades\DB::connection()->getDatabaseName();
    echo '<span class="ok">✔  Connected to database: ' . htmlspecialchars($db) . '</span>';
    $steps['db'] = true;
} catch (\Exception $e) {
    echo '<span class="err">✘  DB Error: ' . htmlspecialchars($e->getMessage()) . '</span>';
    $steps['db'] = false;
}
echo '</div>';

// Step 3: Run migrations
echo '<h2>3. Running migrations …</h2><div class="box">';
if ($steps['db']) {
    try {
        $output = new \Symfony\Component\Console\Output\BufferedOutput();
        $kernel->call('migrate', ['--force' => true], $output);
        echo htmlspecialchars($output->fetch());
        echo "\n" . '<span class="ok">✔  Migrations complete</span>';
        $steps['migrate'] = true;
    } catch (\Exception $e) {
        echo '<span class="err">✘  Migration error: ' . htmlspecialchars($e->getMessage()) . '</span>';
        $steps['migrate'] = false;
    }
} else {
    echo '<span class="err">Skipped (DB not connected)</span>';
    $steps['migrate'] = false;
}
echo '</div>';

// Step 4: Seed locales if needed
if (isset($_GET['seed'])) {
    echo '<h2>4. Seeding locales &amp; initial data …</h2><div class="box">';
    if ($steps['migrate']) {
        try {
            $output = new \Symfony\Component\Console\Output\BufferedOutput();
            $kernel->call('db:seed', ['--class' => 'DatabaseSeeder', '--force' => true], $output);
            echo htmlspecialchars($output->fetch());
            echo "\n" . '<span class="ok">✔  Seeding complete</span>';
        } catch (\Exception $e) {
            echo '<span class="err">✘  Seed error: ' . htmlspecialchars($e->getMessage()) . '</span>';
        }
    } else {
        echo '<span class="err">Skipped (migrations not done)</span>';
    }
    echo '</div>';
}

// Step 5: Fix storage permissions (create needed dirs)
echo '<h2>5. Checking storage folders …</h2><div class="box">';
$dirs = [
    $appPath . '/storage/framework/cache/data',
    $appPath . '/storage/framework/sessions',
    $appPath . '/storage/framework/views',
    $appPath . '/storage/logs',
    $appPath . '/storage/app/public',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
        echo 'Created: ' . str_replace($appPath, '_laravel', $dir) . "\n";
    } else {
        echo '<span class="ok">✔  ' . str_replace($appPath, '_laravel', $dir) . '</span>' . "\n";
    }
}
echo '</div>';

// Step 6: Cache config
echo '<h2>6. Caching config for performance …</h2><div class="box">';
try {
    $output = new \Symfony\Component\Console\Output\BufferedOutput();
    $kernel->call('config:cache', [], $output);
    $kernel->call('route:cache', [], $output);
    $kernel->call('view:cache', [], $output);
    echo htmlspecialchars($output->fetch());
    echo '<span class="ok">✔  Caches warmed</span>';
} catch (\Exception $e) {
    echo '<span class="err">Note: ' . htmlspecialchars($e->getMessage()) . '</span>';
}
echo '</div>';

// Summary
echo '<h2>Summary</h2><div class="box">';
$allOk = $steps['env'] && $steps['db'] && $steps['migrate'];
if ($allOk) {
    echo '<span class="ok">✔  Setup complete! Your site should be working.</span>' . "\n\n";
    echo '<span style="color:yellow">⚠  DELETE setup.php from your server now (security risk)!</span>' . "\n\n";
    echo 'To also seed initial data (locales, sample products), visit:' . "\n";
    echo '  setup.php?secret=' . htmlspecialchars(SETUP_SECRET) . '&seed=1';
} else {
    echo '<span class="err">✘  Setup incomplete. Fix the errors above and reload this page.</span>';
}
echo '</div>';

echo '</body></html>';
