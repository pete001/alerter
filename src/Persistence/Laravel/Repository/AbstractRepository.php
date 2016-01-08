<?php namespace Pete001\Alerter\Persistence\Laravel\Repository;

use Pete001\Alerter\Domain\Entity\AbstractEntity;
use Pete001\Alerter\Domain\Repository\RepositoryInterface;
use Pete001\Alerter\Persistence\Laravel\Model\AbstractModel;

class AbstractRepository implements RepositoryInterface
{
    protected $model;
    protected $modelClassTemplate;
    protected $entityClassName;

    public function __construct(AbstractModel $model, $entityClassName)
    {
        $this->model = $model;
        $this->modelClassTemplate = $model->newInstance();
        $this->entityClassName = $entityClassName;
    }

    public function getById($id)
    {
        $arrData = $this->model->findOrFail($id)->toArray();
        return new $this->entityClassName($arrData);
    }

    public function getAll()
    {
        return $this->hydrateCollectionToEntities($this->model->get());
    }

    public function firstOrCreate(Array $attributes)
    {
        $arrData = $this->model->firstOrCreate($attributes)->toArray();
        return new $this->entityClassName($arrData);
    }

    public function with($relation)
    {
        $this->model = $this->model->with($relation);
        return $this;
    }

    public function where($column, $comparison, $value)
    {
        $this->model = $this->model->where($column, $comparison, $value);
        return $this;
    }

    public function firstOrFail()
    {
        $arrData = $this->model->firstOrFail()->toArray();
        return new $this->entityClassName($arrData);
    }

    public function begin()
    {
        $this->model = $this->modelClassTemplate->newInstance();
        return $this;
    }

    public function persist(AbstractEntity $entity)
    {
        $entityData = $entity->asArray();

        // Work with how laravel handles updates/inserts within a model
        if ($entity->id)
        {
            try {
                $this->model = $this->model->findOrFail($entity->id);
            } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e)
            {
            }
        }
        $this->model->forceFill($entityData);
        return $this;
    }

    protected function hydrateCollectionToEntities($collection, $targetClass = null)
    {
        $className = $targetClass ? $targetClass : $this->entityClassName;

        if ($collection instanceof \Illuminate\Database\Eloquent\Collection)
        {
            $returnArray = [];
            foreach ($collection as $model) {
                $entity = new $className($model->toArray());

                // add any loaded relations into the entity if that entity has a
                // related setter method
                foreach ($model->getRelations() as $relation => $relationModel) {
                    $setter = "set" . ucfirst($relation);
                    if (method_exists($entity, $setter))
                    {
                        $relationClassName = "\Pete001\Alerter\Domain\Entity\\" . ucfirst($relation);
                        $entity->$setter( new $relationClassName($relationModel->toArray()));
                    }
                }

                $returnArray[] = $entity;
            }
            return $returnArray;
        } else {
            return new $className($collection->toArray());
        }

    }

    public function commit()
    {
        if ($this->model->save())
        {
            $arrData = $this->model->toArray();
            return new $this->entityClassName($arrData);
        } else {
            return false;
        }
    }
}
