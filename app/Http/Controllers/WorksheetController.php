<?php

namespace App\Http\Controllers;

use App\Arketops\Customer\CustomerRepository;
use App\Arketops\Process\ProcessRepository;
use App\Arketops\Worksheet\Worksheet;
use App\Arketops\Worksheet\WorksheetRepository;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\WorksheetProcessResource;
use App\Http\Resources\WorksheetResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class WorksheetController extends Controller
{
    protected CustomerRepository $customerRepo;
    protected ProcessRepository $processRepo;
    protected WorksheetRepository $worksheetRepo;

    public function __construct(
        CustomerRepository $customerRepository,
        ProcessRepository $processRepository,
        WorksheetRepository $worksheetRepository)
    {
        $this->customerRepo = $customerRepository;
        $this->processRepo = $processRepository;
        $this->worksheetRepo = $worksheetRepository;
    }

    public function index(): Response
    {
        return Inertia::render('Worksheet/Index', [
            'customers' => CustomerResource::collection($this->customerRepo->getWorksheets())
        ]);
    }

    public function show(int $idWorksheet, Request $request): Response
    {
        return Inertia::render('Worksheet/Show', ['worksheet' => $this->worksheetRepo->find($idWorksheet)]);
    }

    public function create(Request $request)
    {
        // For fill the form
        if ($request->isMethod('get')) {
            // To create a new worksheet, a customer must be selected. Therefore, a form will be rendered with the list of available clients
            return Inertia::render('Worksheet/Create', [
                'customers' => CustomerResource::collection($this->customerRepo->getAll()),
            ]);
        } elseif ($request->isMethod('post')) { // For save the records on database
            Validator::make($request->all(), [
                'id_customer' => 'required|exists:customers,id_third',
                'period' => ['required', 'string', Rule::unique('worksheets', 'period')->where('id_customer', $request->get('id_customer'))],
            ])->validateWithBag('createWorksheet');

            // Collecting the info of worksheet just created. Only the whitelisted fields are
            // sent to the repository (not the raw request body) to avoid mass-assigning
            // anything beyond what was validated above.
            $worksheet = $this->worksheetRepo->create($request->only(['id_customer', 'period']));

            if ($worksheet) {
                // Getting info of the customer of the worksheet just created
                $customer = $this->customerRepo->find($worksheet->id_customer);
                // For continue the creation of the worksheet with your respectives processes...
                return redirect()->action(
                    [WorksheetProcessController::class, 'create'],
                    [
                        'id' => $worksheet->id_worksheet,
                        'customer' => ['id' => $customer->id_third, 'name' => $customer->third->third_name],
                        'pd' => $worksheet->period,
                    ]
                );
            } else {
                $request->session()->flash('flash.banner', '¡Diantres! Algo salió mal');
                $request->session()->flash('flash.bannerStyle', 'danger');
                return redirect()->route('welcome');
            }
        }
    }

    public function search(int $customer, string $period): JsonResponse
    {
        return (WorksheetResource::make($this->worksheetRepo->findByCustomerPeriod($customer, $period)))->response();
    }

    public function getOpenedWorksheets(Request $request): JsonResponse
    {
//        if ($request->wantsJson()) {
//            $this->worksheetRepo->getOpenedWorksheets();
        return (WorksheetResource::collection($this->worksheetRepo->getOpenedWorksheets()))->response();
//        }
    }

    public function getWorksheetWithProcesses(Request $request)
    {
        if ($request->wantsJson()) {
            $worksheetWithProcesses = $this->worksheetRepo->getWithWorksheetProcesses();
//            dd($worksheetWithProcesses);
            return response()->json($worksheetWithProcesses);
        }
    }

}
