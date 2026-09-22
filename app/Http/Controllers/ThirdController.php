<?php


namespace App\Http\Controllers;

use App\Arketops\City\CityRepository;
use App\Arketops\Customer\CustomerRepository;
use App\Arketops\IdentificationType\IdentificationTypeRepository;
use App\Arketops\NatureType\NatureTypeRepository;
use App\Arketops\Third\ThirdRepository;
use App\Arketops\ThirdRegimeType\ThirdRegimeTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ThirdController extends Controller
{
    protected CityRepository $cityRepo;
    protected NatureTypeRepository $natureTypeRepo;
    protected IdentificationTypeRepository $identificationTypeRepo;
    protected ThirdRegimeTypeRepository $thirdRegimeTypeRepo;
    protected ThirdRepository $thirdRepo;
    protected CustomerRepository $customerRepo;

    public function __construct(
        CityRepository $cityRepository,
        NatureTypeRepository $natureTypeRepository,
        IdentificationTypeRepository $identificationTypeRepository,
        ThirdRegimeTypeRepository $thirdRegimeTypeRepository,
        ThirdRepository $thirdRepository,
        CustomerRepository $customerRepository)
    {
        $this->cityRepo = $cityRepository;
        $this->natureTypeRepo = $natureTypeRepository;
        $this->identificationTypeRepo = $identificationTypeRepository;
        $this->thirdRegimeTypeRepo = $thirdRegimeTypeRepository;
        $this->thirdRepo = $thirdRepository;
        $this->customerRepo = $customerRepository;
    }

    public function create(Request $request)
    {
        if ($request->method() == 'GET') {

//            $request->session()->flash('flash.banner', 'Yay it works!');
//            $request->session()->flash('flash.bannerStyle', 'danger');
            return inertia('Third/CreateThirdForm', [
                'cities' => $this->cityRepo->getAll(),
                'natureTypes' => $this->natureTypeRepo->getAll(),
                'identificationTypes' => $this->identificationTypeRepo->getAll(),
                'regimeTypes' => $this->thirdRegimeTypeRepo->getAll(),
            ]);

        } elseif ($request->method() == 'POST') {
            $createAs = $request->get('thirdAs');

            Validator::make($request->all(), [
                'id_city' => ['required', 'numeric', 'exists:cities'],
                'id_nature_type' => ['required', 'numeric', 'exists:nature_types'],
                'id_identification_type' => ['required', 'numeric', 'exists:identification_types'],
                'id_regime_type' => ['required', 'numeric', 'exists:third_regime_types'],
                'nit' => ['required', 'digits_between:7,10', 'unique:thirds,nit'],
                'third_name' => ['required', 'string', 'max:100'],
                'name1' => [Rule::requiredIf(function () use ($request) {
                    return $request->get('id_identification_type') == 2;
                }), 'nullable', 'string', 'max:30'],
                'name2' => ['nullable', 'string', 'max:30'],
                'lastname1' => [Rule::requiredIf(function () use ($request) {
                    return $request->get('id_identification_type') == 2;
                }), 'nullable', 'string', 'max:30'],
                'lastname2' => ['nullable', 'string', 'max:30'],
                'address' => ['required', 'string', 'max:50'],
                'phone1' => ['required', 'numeric', 'digits:10'],
                'phone2' => ['nullable', 'numeric', 'digits:10'],
                'email' => ['required', 'email', 'max:50'],
                'thirdAs' => ['required', Rule::in(['user', 'customer'])]
            ], [
                'id_city.required' => 'The city is required',
                'id_city.exists' => 'The city does not exists in the database',
                'id_nature_type.required' => 'The nature type is required',
                'id_nature_type.exists' => 'The nature type does not exists in the database',
                'id_identification_type.required' => 'The identification type is required',
                'id_identification_type.exists' => 'The identification type does not exists in the database',
                'id_regime_type.required' => 'The regime type is required',
                'id_regime_type.exists' => 'The regime type does not exists in the database',
                'nit.required' => 'The identification number is required',
                'nit.digits_between' => 'The identification number must not contain letters and must have between 7 and 10 digits',
                'nit.unique' => 'The identification number already exists in our system',
                'third_name.required' => 'The third name is required',
                'third_name.max' => 'The third name should not contain more than 100 characters',
                'name1.required' => 'The first name is required',
                'name1.max' => 'The first name should not contain more than 30 characters',
                'name2.max' => 'The second name should not contain more than 30 characters',
                'lastname1.required' => 'The first lastname is required',
                'lastname1.max' => 'The first lastname should not contain more than 30 characters',
                'lastname2.max' => 'The second name should not contain more than 30 characters',
                'address.required' => 'The address is required',
                'address.max' => 'The address should not contain more than 50 characters',
                'phone1.required' => 'This field is required',
                'phone1.numeric' => 'This field should not contain letters',
                'phone1.max' => 'This field should not contain more than 10 characters',
                'phone2.numeric' => 'This field should not contain letters',
                'phone2.max' => 'This field should not contain more than 10 characters',
                'email.required' => 'The email is required',
                'email.email' => 'Not is a valid email',
                'email.max' => 'The email should not contain more than 50 characters',
                'thirdAs.required' => 'You must specify how you want to create the third',
                'thirdAs.in' => 'You must specify how you want to create the third: as "user" or as "customer"',
            ])->validateWithBag('createThird');

            $validated = $request->only([
                'id_city', 'id_nature_type', 'id_identification_type', 'id_regime_type',
                'nit', 'third_name', 'name1', 'name2', 'lastname1', 'lastname2',
                'address', 'phone1', 'phone2', 'email',
            ]);

            // Only the validated fields are persisted, never the raw request body, so an
            // extra/unexpected field in the payload can't be mass-assigned onto the model.
            $third = $this->thirdRepo->create($validated);

            if (! $third) {
                return redirect()->route('register');
            }

            // `thirdAs` was previously validated but never actually used: every third was
            // sent to the "create user" screen regardless of which option was picked, and
            // choosing "customer" never created the matching customers row, so a third
            // created that way could never appear in the Worksheet module's customer list.
            if ($createAs === 'customer') {
                $this->customerRepo->create([
                    'id_third' => $third->id_third,
                    'active' => 'S',
                ]);

                return redirect()->route('worksheet.index');
            }

            return redirect()->action(
                [UserController::class, 'create'],
                [
                    'id' => $third->id_third,
                    'nit' => $third->nit,
                    'name' => $third->third_name,
                    'email' => $third->email
                ]
            );
        }
    }

    public function findNit(string $nit)
    {
        $third = $this->thirdRepo->findBy('nit', $nit, ['id_third', 'third_name', 'email']);
        return response()->json($third);
    }
}
