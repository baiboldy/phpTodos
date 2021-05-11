<?php
namespace repository;

use Doctrine\ORM\EntityRepository;

class TodoRepository extends EntityRepository
{
    public function findAllTodos() {
        return $this->getEntityManager()->getRepository('AppBundle:Todo')->findAll();
    }

}