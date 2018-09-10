<?php
/**
 * Created by PhpStorm.
 * User: Dron
 * Date: 10.09.2018
 * Time: 20:46
 */

namespace Corp\Repositories;


use Corp\Permission;

class PermissionRepository extends Repository
{
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}