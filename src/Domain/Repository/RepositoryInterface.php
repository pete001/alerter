<?php namespace Pete001\Alerter\Domain\Repository;

/**
 * Core interface for repository methods
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface RepositoryInterface
{
    public function getById($id);
    public function getAll();
    public function firstOrCreate(Array $attributes);
    public function where($column, $comparison, $value);
    public function firstOrFail();
    public function begin();
    public function persist($entity);
    public function commit();
}
