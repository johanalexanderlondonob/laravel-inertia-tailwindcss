<?php


namespace App\Arketops\WorksheetProcess;

use App\Arketops\Subprocess\Subprocess;
use App\Arketops\WorksheetDetail\WorksheetDetail;

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

    /**
     * Creates a worksheet/process link and, for each active subprocess of that process,
     * a pending worksheet detail row. This mirrors what the original database trigger
     * `trigger_generate_worksheet_detail` (database/00-general.sql) did on MySQL; it is
     * done here in PHP instead so it works regardless of database engine and is testable.
     */
    public function create($data)
    {
        $worksheetProcess = $this->model()->firstOrCreate($data);

        if ($worksheetProcess->wasRecentlyCreated) {
            $subprocessIds = Subprocess::where('id_process', $data['id_process'])
                ->where('active', 'S')
                ->pluck('id_subprocess');

            foreach ($subprocessIds as $idSubprocess) {
                WorksheetDetail::create([
                    'id_worksheet' => $data['id_worksheet'],
                    'id_subprocess' => $idSubprocess,
                ]);
            }
        }

        return $worksheetProcess;
    }
}
