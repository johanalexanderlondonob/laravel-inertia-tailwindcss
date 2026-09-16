<?php


namespace App\Arketops\Worksheet;


class WorksheetRepository extends \App\Arketops\Base\BaseRepository
{

    /**
     * @inheritDoc
     */
    protected function model()
    {
        return new Worksheet();
    }

    public function find($id)
    {
        return $this->model()::where('id_worksheet', '=', $id)->with('worksheetProcesses')->get();
    }

    public function findByCustomerPeriod(int $customer, string $period)
    {
        return $period === '*' ? $this->model()::where('id_customer', $customer)->firstOrFail() : $this->model()::where('id_customer', $customer)->where('period', $period)
            ->firstOrFail();
    }

    public function getOpenedWorksheets()
    {
        return $this->model()->all()->where('opened', '=', 'S');
    }

    public function getWithWorksheetProcesses()
    {
        return $this->model()::with('worksheetProcesses')->get();
    }
}
