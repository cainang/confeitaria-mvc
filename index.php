<?php
    
    require __DIR__ . '/vendor/autoload.php';

    use \App\Http\Router;
    use \App\Http\Response;
    use \App\Controller\Pages\Home;
    use \App\Utils\View;
    use \WilliamCosta\DotEnv\Environment;
    use \WilliamCosta\DatabaseManager\Database;

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

    $obRouter = new Router(URL);

    include __DIR__ . '/routes/pages.php';

    $obRouter->run()->sendResponse();

?>