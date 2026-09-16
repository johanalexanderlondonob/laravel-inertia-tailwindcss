<?php


namespace App\Arketops\IdentificationType;


class IdentificationTypeRepository extends \App\Arketops\Base\BaseRepository
{

    /**
     * @inheritDoc
     */
    protected function model()
    {
        return new IdentificationType();
    }
}
