<?php
require_once "config/bootstrap.php";

$router->get('/todo', [\controller\TodoController::class, 'getAll'] );
$router->get('/todo/id={id}', [\controller\TodoController::class, 'getById'] );
$router->post('/todo', [\controller\TodoController::class, 'create'] );
$router->put('/todo/id={id}&name={name}', [\controller\TodoController::class, 'update'] );
$router->delete('/todo/id={id}', [\controller\TodoController::class, 'delete'] );

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
