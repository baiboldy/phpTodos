<?php
namespace controller;

use config\Config;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use repository\TodoRepository;

class TodoController
{
    private $entityManager;
    public function __construct()
    {
        $this->entityManager = Config::getEntityManager();
    }

    public function getAll(ServerRequestInterface $request) : array {
        $result = $this->entityManager->getRepository('Todo')->findAll();
        return $result;
    }

    public function getById(ServerRequestInterface $request, array $args) : object {
        $result = $this->entityManager->getRepository('Todo')->find($args['id']);
        return $result;
    }

    public function create(ServerRequestInterface $request) : object {
        $body = $request->getParsedBody();
        if (!isset($body['name'])) {
            return (object) [
                'message' => 'Обязательно заполните поле name',
                'success' => false
            ];
        }
        $todo = new \Todo();
        $todo->setName($body['name']);
        $this->entityManager->persist($todo);
        $this->entityManager->flush();
        return $todo;
    }

    public function update(ServerRequestInterface $request, array $args) {
        $id = $args['id'];
        $name = $args['name'];

        if (!isset($name) or !isset($id)) {
            return (object) [
                'message' => 'Обязательно заполните поле name или id',
                'success' => false
            ];
        }
        $result = $this->entityManager->getRepository('Todo')->find($id);

        if (!isset($result)) {
            return (object) [
                'message' => 'Не найдена запись с таким id',
                'success' => false
            ];
        }

        $result->setName($name);
        $this->entityManager->persist($result);
        $this->entityManager->flush();
        return $result;
    }

    public function delete(ServerRequestInterface $request, array $args) : object {
        $id = $args['id'];
        if (!isset($id)) {
            return (object) [
                'message' => 'Обязательно заполните поле id',
                'success' => false
            ];
        }
        $entity = $this->entityManager->getRepository('Todo')->find($id);
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
        return (object) [
            'message' => 'Успешно удалено',
            'success' => true
        ];
    }

}