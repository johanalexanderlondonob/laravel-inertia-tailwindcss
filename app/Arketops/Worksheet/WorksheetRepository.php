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
        // `find` must return a single model, not a collection: callers (e.g.
        // WorksheetController::show) pass the result straight to the view as one record.
        return $this->model()::where('id_worksheet', '=', $id)
            ->with(['customer.third', 'worksheetProcesses.process'])
            ->firstOrFail();
    }

    public function findByCustomerPeriod(int $customer, string $period)
    {
        return $period === '*' ? $this->model()::where('id_customer', $customer)->firstOrFail() : $this->model()::where('id_customer', $customer)->where('period', $period)
            ->firstOrFail();
    }

    public function getOpenedWorksheets()
    {
        // Filter at the database level instead of loading every worksheet into memory
        // and filtering in PHP.
        return $this->model()::where('opened', '=', 'S')->get();
    }

    public function getWithWorksheetProcesses()
    {
        return $this->model()::with('worksheetProcesses')->get();
    }
}
