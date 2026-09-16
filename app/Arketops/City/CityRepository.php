<?php


namespace App\Arketops\City;



class CityRepository extends \App\Arketops\Base\BaseRepository
{

    /**
     * @inheritDoc
     */
    protected function model()
    {
        return new City();
    }
}
