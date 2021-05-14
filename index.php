<?php
require_once "config/bootstrap.php";
//не опеределяет такую конструкция как filter[key]=value
//$router->get('/todos&page={pageNumber}&filter={value}', [\controller\TodoController::class, 'getAllFilter'] );
$router->get('/todos&page={pageNumber}', [\controller\TodoController::class, 'getAll'] );
$router->get('/todos/id={id}', [\controller\TodoController::class, 'getById'] );
$router->post('/todos', [\controller\TodoController::class, 'create'] );
$router->put('/todos/id={id}&name={name}', [\controller\TodoController::class, 'update'] );
$router->delete('/todos/id={id}', [\controller\TodoController::class, 'delete'] );

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
