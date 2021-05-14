<?php


namespace interfaces;


use Psr\Http\Message\ServerRequestInterface;

interface IBaseRepository
{
    public function getAll(array $filter = [],int $page = 0) : array;
    public function getById(int $id) : object ;
    public function create(string $name) : object;
    public function update(int $id, string $name);
    public function delete(int $id);
}