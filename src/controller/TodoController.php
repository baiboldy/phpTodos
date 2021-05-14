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

    public function getAll(ServerRequestInterface $request, array $args) : array {
        $pageNumber = 0;
        if (isset($args['pageNumber'])) {
            $pageNumber = $args['pageNumber'];
        }
        if (isset($args['value']) && isset($args['key'])) {
            $filterKey = $args['value'];
            $filterValue = $args['key'];
//            print_r($filterKey);
//            print_r($filterValue)
        }
        return $this->todoRepository->getAll($pageNumber);
    }

    public function getAllFilter(ServerRequestInterface $request, array $args) : array {
        $pageNumber = 0;
        if (isset($args['pageNumber'])) {
            $pageNumber = $args['pageNumber'];
        }
//        if (isset($args['value']) && isset($args['key'])) {
//            $filterKey = $args['value'];
//            $filterValue = $args['key'];
//            print_r($filterKey);
//            print_r($filterValue)
//        }
        return $this->todoRepository->getAll($pageNumber);
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