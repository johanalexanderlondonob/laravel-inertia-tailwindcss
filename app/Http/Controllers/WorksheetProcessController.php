<?php

namespace App\Http\Controllers;

use App\Arketops\Process\ProcessRepository;
use App\Arketops\WorksheetProcess\WorksheetProcessRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorksheetProcessController extends Controller
{
    protected ProcessRepository $processRepo;
    protected WorksheetProcessRepository $worksheetProcessRepo;

    public function __construct(ProcessRepository $processRepository, WorksheetProcessRepository $worksheetProcessRepo)
    {
        $this->processRepo = $processRepository;
        $this->worksheetProcessRepo = $worksheetProcessRepo;
    }

    public function create(Request $request)
    {
        // For show the form for assign the processes
        if ($request->isMethod('get')) {
            $worksheet = [
                'processes' => $this->processRepo->getAll()
            ];
            // If the request has the id of the worksheet, then add the rest of the info
            if ($request->has('id')) {
                $worksheet += [
                    'id' => $request->get('id'),
                    'customer' => $request->get('customer'),
                    'period' => $request->get('pd'),
                ];
            }
            // Finally, show the form with needed information
            return inertia('WorksheetProcess/Create', ['worksheet' => $worksheet]);
        } elseif ($request->isMethod('post')) {
            Validator::make($request->all(), [
                'id_customer' => 'required|int|exists:customers,id_third',
                'id_worksheet' => 'required|int|exists:worksheets,id_worksheet',
                'processes' => 'required|array',
                // As we receive a array with various rows with info of the ids process and dates completions, we validate each one
                'processes.*.id_process' => 'required|int|exists:processes,id_process',
                'processes.*.completion_date' => 'required|date_format:Y-m-d',
            ])->validateWithBag('createWorksheetProcess'); // In case we found errors, we return the messages of errors

            // We assign with a variable auxiliary, the info basic for the creation
            $worksheetProcess['id_worksheet'] = $request->get('id_worksheet');
            $worksheetProcess['creator_user'] = $request->get('creator_user');
            // We get all the processes that the user send us for relate with the worksheet
            $processes = $request->all('processes');
            try {
                foreach ($processes as $index) {
                    foreach ($index as $process => $value) {
                        $worksheetProcess['id_process'] = $value['id_process'];
                        $worksheetProcess['ideal_completion_date'] = $value['completion_date'];
                        $this->worksheetProcessRepo->create($worksheetProcess);
                        // As each process relates to the worksheet, the database creates the details for the subprocesses. Each subprocess depends on the process
                    }
                }
                return response('Successful', 200);
            } catch (Exception $e) {
                return response('Error', 500);
            }
        }
    }
}
