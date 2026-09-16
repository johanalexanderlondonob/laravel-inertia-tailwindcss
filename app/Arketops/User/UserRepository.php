<?php


namespace App\Arketops\User;

use App\Models\User;

class UserRepository extends \App\Arketops\Base\BaseRepository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return new User();
    }

    public function select()
    {
        $this->model()::all('*');
    }
}
