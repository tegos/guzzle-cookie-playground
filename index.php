<?php

use App\Actions\FetchCodeFromMzvSiteAction;
use App\Client\MzvClient;
use App\Repositories\MzvCodeRepository;
use App\Support\HtmlParser;

$config = require __DIR__ . '/bootstrap.php';

$client = new MzvClient($config['client'], $config['cookieJar']);
$parser = new HtmlParser();
$repository = new MzvCodeRepository($client, $parser, $config['target_url']);

$action = new FetchCodeFromMzvSiteAction($repository);

$response = $action->handle();

header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
