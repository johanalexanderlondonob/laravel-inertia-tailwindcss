<?php


namespace App\Arketops\NatureType;


use App\Arketops\Base\BaseRepository;

class NatureTypeRepository extends BaseRepository
{

    protected function model(): NatureType
    {
        return new NatureType();
    }
}
