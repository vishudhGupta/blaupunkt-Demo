<?php
/**
 * Quick locale seeder for shared hosting.
 * DELETE THIS FILE after running it once!
 *
 * Access: https://yourdomain.com/seed.php?secret=CHANGE_THIS
 */
define('SEED_SECRET', 'Vishudh123');

if (($_GET['secret'] ?? '') !== SEED_SECRET || SEED_SECRET === 'CHANGE_THIS') {
    http_response_code(403);
    die('<h2 style="font-family:sans-serif;color:red">Access denied. Set SEED_SECRET in this file first.</h2>');
}

$appPath = __DIR__ . '/_laravel';

define('LARAVEL_START', microtime(true));
require $appPath . '/vendor/autoload.php';
$app = require_once $appPath . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo '<html><head><title>Seed</title>
<style>body{font-family:monospace;background:#111;color:#0f0;padding:30px;}
.err{color:#f55;} .ok{color:#0f0;} .box{background:#222;padding:15px;border-radius:4px;white-space:pre-wrap;}
</style></head><body><h2 style="color:#fff">Seeding database…</h2><div class="box">';

try {
    $output = new \Symfony\Component\Console\Output\BufferedOutput();
    $kernel->call('db:seed', ['--class' => 'DatabaseSeeder', '--force' => true], $output);
    echo htmlspecialchars($output->fetch());
    echo "\n\n<span class='ok'>✔  Done! Delete seed.php from your server now.</span>";
} catch (\Exception $e) {
    echo '<span class="err">Error: ' . htmlspecialchars($e->getMessage()) . '</span>';
}

echo '</div></body></html>';
