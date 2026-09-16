<?php


namespace App\Arketops\ThirdRegimeType;


class ThirdRegimeTypeRepository extends \App\Arketops\Base\BaseRepository
{

    /**
     * @inheritDoc
     */
    protected function model(): ThirdRegimeType
    {
        return new ThirdRegimeType();
    }
}
