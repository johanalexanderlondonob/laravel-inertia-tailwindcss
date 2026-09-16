<?php


namespace App\Arketops\Customer;


class CustomerRepository extends \App\Arketops\Base\BaseRepository
{

    /**
     * @inheritDoc
     */
    protected function model()
    {
        return new Customer();
    }

    public function getAll()
    {
        return parent::getAll()->where('active', '=', 'S');
    }

    public function getInfoCustomers()
    {
        return $this->model()->with('third')->get(['id_third', 'active']);
    }

    public function getWorksheets()
    {
        return $this->model()->with('worksheets')->where('active','=','S')->get();
    }

}
