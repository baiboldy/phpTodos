<?php
namespace repository;

use config\Config;
use Doctrine\ORM\EntityRepository;
use interfaces\IBaseRepository;

class TodoRepository extends EntityRepository implements IBaseRepository
{
    private $entityManager;
    private $entityRepository;
    public function __construct()
    {
        $this->entityManager = Config::getEntityManager();
        $this->entityRepository = $this->entityManager->getRepository('Todo');
    }

    public function getAll(int $pageNumber): array
    {
        $resultCount = 2;
        $result = $this->entityManager
            ->createQueryBuilder()
            ->select('d')
            ->from('Todo', 'd')
            ->setFirstResult($pageNumber)
            ->setMaxResults($resultCount)
            ->getQuery()
            ->getResult();
//        $result = $this->entityRepository->findAll();
        return $result;
    }
    public function getById(int $id) : object
    {
        $result = $this->entityRepository->find($id);
        if (!isset($result)){
            return (object) [
                'success' => false,
                'message' => 'Запись не была найдена'
            ];
        }
        return $result;
    }
    public function create(string $name) : object
    {
        if (!isset($name)) {
            return (object) [
                'message' => 'Обязательно заполните поле name',
                'success' => false
            ];
        }
        $todo = new \Todo();
        $todo->setName($name);
        $this->entityManager->persist($todo);
        $this->entityManager->flush();
        return (object) [
            'result' => $todo,
            'success' => true
        ];
    }
    public function update(int $id, string $name) : object
    {
        if (!isset($name) or !isset($id)) {
            return (object) [
                'message' => 'Обязательно заполните поле name или id',
                'success' => false
            ];
        }
        $result = $this->entityRepository->find($id);

        if (!isset($result)) {
            return (object) [
                'message' => 'Не найдена запись с таким id',
                'success' => false
            ];
        }
        $result->setName($name);
        $this->entityManager->persist($result);
        $this->entityManager->flush();

        return (object) [
            'result' => $result,
            'success' => true
        ];
    }
    public function delete(int $id) : object
    {
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