<?php
    
    require __DIR__ . '/vendor/autoload.php';

    use \App\Http\Router;
    use \App\Http\Response;
    use \App\Controller\Pages\Home;
    use \App\Utils\View;
    use \WilliamCosta\DotEnv\Environment;
    use \WilliamCosta\DatabaseManager\Database;
    use \App\Http\Middleware\Queue;

    Environment::load(__DIR__);

    Database::config(
        getenv('DB_HOST'),
        getenv('DB_NAME'),
        getenv('DB_USER'),
        getenv('DB_PASS'),
        getenv('DB_PORT')
    );

    define('URL', getenv('URL'));

    View::init([
        'URL' => URL
    ]);

    Queue::setMap([
        'maintenance' => \App\Http\Middleware\Maintenance::class,
        'require-admin-logout' => \App\Http\Middleware\RequireAdminLogout::class,
        'require-admin-login' => \App\Http\Middleware\RequireAdminLogin::class
    ]);

    Queue::setDefault([
        'maintenance'
    ]);

    $obRouter = new Router(URL);

    include __DIR__ . '/routes/pages.php';
    include __DIR__ . '/routes/admin.php';

    $obRouter->run()->sendResponse();

?>