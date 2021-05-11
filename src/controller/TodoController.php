<?php
namespace controller;

use config\Config;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use repository\TodoRepository;

class TodoController
{
    private $entityManager;
    private $todoRepository;
    public function __construct()
    {
        $this->todoRepository = new TodoRepository();
    }

    public function getAll(ServerRequestInterface $request) : array {
        return $this->todoRepository->getAll();
    }

    public function getById(ServerRequestInterface $request, array $args) : object {
        $id = $args['id'];
        return $this->todoRepository->getById($id);
    }

    public function create(ServerRequestInterface $request) : object {
        $body = $request->getParsedBody();
        $name = $body['name'];
        return $this->todoRepository->create($name);
    }

    public function update(ServerRequestInterface $request, array $args) {
        $id = $args['id'];
        $name = $args['name'];
        return $this->todoRepository->update($id, $name);
    }

    public function delete(ServerRequestInterface $request, array $args) : object {
        $id = $args['id'];
        return $this->todoRepository->delete($id);
    }

}