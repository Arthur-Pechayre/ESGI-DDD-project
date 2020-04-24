<?php

namespace App\Infrastructure;

use App\Common\Exception\AlreadyExistsException;
use App\Common\Exception\NotExistingException;
use App\Common\Model\BaseRepository;
use App\Common\Model\UUID;
use Faker;

abstract class BaseMockRepository implements BaseRepository
{
    protected Faker\Generator $faker;

    /**
     * @var array
     */
    protected array $collection = [];

    public function __construct()
    {
        $this->faker = Faker\Factory::create('fr_FR');
    }

    /**
     * @param UUID $id
     * @return mixed|null
     */
    function find(UUID $id)
    {
        return isset($this->collection[$id->getValue()]) ? $this->collection[$id->getValue()] : null;
    }

    /**
     * @param $object
     * @return mixed|void
     * @throws AlreadyExistsException
     */
    function create($object)
    {
        if (isset($this->collection[$object->getId()->getValue()])) {
            throw new AlreadyExistsException();
        }

        $this->collection[$object->getId()->getValue()] = $object;
    }

    /**
     * @param $object
     * @return mixed|void
     * @throws NotExistingException
     */
    function update($object)
    {
        if (!isset($this->collection[$object->id->getValue()])) {
            throw new NotExistingException();
        }

        $this->collection[$object->id->getValue()] = $object;
    }

    /**
     * @return array|mixed
     */
    function all()
    {
        return array_values($this->collection);
    }
}
