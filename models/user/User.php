<?php

namespace models\user;

use models\model\Model;

class User extends Model
{
    public function getTableName(): string
    {
        return 'users';
    }
}
