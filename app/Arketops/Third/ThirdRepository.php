<?php


namespace App\Arketops\Third;

class ThirdRepository extends \App\Arketops\Base\BaseRepository
{

    /**
     * @inheritDoc
     */
    protected function model(): Third
    {
        return new Third();
    }
}
