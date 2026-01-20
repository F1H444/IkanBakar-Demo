<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

$email = 'admin@ikanbakar.com';
$password = 'password';

$user = User::where('email', $email)->first();

if (!$user) {
    echo "User NOT FOUND\n";
    exit;
}

echo "User Found: " . $user->email . "\n";
echo "Hash: " . $user->password . "\n";
echo "Hash Length: " . strlen($user->password) . "\n";
echo "Starts with \$2y\$: " . (str_starts_with($user->password, '$2y$') ? 'YES' : 'NO') . "\n";

$check = Hash::check($password, $user->password);
echo "Hash Check: " . ($check ? 'PASSED' : 'FAILED') . "\n";

$attempt = Auth::attempt(['email' => $email, 'password' => $password]);
echo "Auth Attempt: " . ($attempt ? 'SUCCESS' : 'FAILURE') . "\n";
