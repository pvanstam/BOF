<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'home.html');
})->setName('home');

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    return $this->view->render($response, 'hello.html', [
        'name' => $args['name']
    ]);

})->setName('hello');

?>
