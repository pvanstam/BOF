<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__.'/../classes/Result.php';

$app->get('/admin', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'admin.html', [
        'loggedin' => true
    ]);
})->setName('admin');

$app->get('/calculate_results', 'ICCM\BOF\Result:calculate_results')->setName('calculate_results');

?>
