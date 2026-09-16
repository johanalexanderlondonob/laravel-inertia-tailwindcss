<?php


namespace App\Arketops\WorksheetProcess;


class WorksheetProcessRepository extends \App\Arketops\Base\BaseRepository
{

    /**
     * @inheritDoc
     */
    protected function model()
    {
        return new WorksheetProcess();
    }

    public function get()
    {
        return 0;
    }

    public function create($data)
    {
        return $this->model()->firstOrCreate($data);
    }
}
