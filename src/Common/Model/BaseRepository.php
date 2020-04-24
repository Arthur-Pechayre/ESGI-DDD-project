<?php

namespace App\Common\Model;

Interface BaseRepository
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
     * @return mixed
     */
    function all();
}
