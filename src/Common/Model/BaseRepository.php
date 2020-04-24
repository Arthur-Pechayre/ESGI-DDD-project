<?php

namespace App\Model\Infrastructure;

use App\model\UUID;

Interface Repository
{
    /**
     * @param UUID $id
     * @return mixed
     */
    function find(UUID $id);

    /**
     * @param $object
     * @return mixed
     */
    function create($object);

    /**
     * @param $object
     * @return mixed
     */
    function update($object);

    /**
     * @param $object
     * @return mixed
     */
    function all($object);
}
