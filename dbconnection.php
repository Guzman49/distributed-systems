
<?php
// Database settings: use environment variables online,
// or these default settings when running locally in XAMPP.

$host = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '';
$dbname = getenv('DB_NAME') ?: 'phpcrud';
$port = (int)(getenv('DB_PORT') ?: 3306);

$useSSL = strtolower(getenv('DB_SSL') ?: 'false') === 'true';

// Initialize MySQLi
$con = mysqli_init();

if (!$con) {
    die("Could not initialize database connection.");
}

// Connect using SSL when DB_SSL=true (Render/TiDB Cloud).
if ($useSSL) {
    $caPath = getenv('DB_SSL_CA') ?: '/etc/ssl/certs/ca-certificates.crt';

    if (defined('MYSQLI_OPT_SSL_VERIFY_SERVER_CERT')) {
        mysqli_options($con, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
    }

    mysqli_ssl_set($con, null, null, $caPath, null, null);

    $connected = mysqli_real_connect(
        $con,
        $host,
        $username,
        $password,
        $dbname,
        $port,
        null,
        MYSQLI_CLIENT_SSL
    );
} else {
    // Local XAMPP connection
    $connected = mysqli_real_connect(
        $con,
        $host,
        $username,
        $password,
        $dbname,
        $port
    );
}

// Check connection
if (!$connected) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Set character encoding
mysqli_set_charset($con, "utf8mb4");
?>
