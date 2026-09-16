<?php


namespace App\Http\Controllers;


use App\Arketops\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    protected UserRepository $userRepo;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function create(Request $request)
    {
        if ($request->method() == 'GET') {
            $third = [];
            if ($request->has('id')) {
                $third = [
                    'id' => $request->get('id'),
                    'nit' => $request->get('nit'),
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                ];
            }
            return inertia('User/CreateUserForm', ['third' => $third]);
        } elseif ($request->method() == 'POST') {
            Validator::make($request->all(), [
                'id' => ['required', 'int', 'exists:thirds,id_third', 'unique:users,id'],
                'name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', new Password(), 'string'],
                'password_confirmation' => ['required', 'same:password']
            ], [
                'id.required' => 'You must espcify a third to create it as user',
                'id.exists' => 'There is no third with the identification number provided',
                'id.unique' => 'Already exists an user with the identification number given',
                'name.required' => 'You must fill this field',
                'email.unique' => 'Already exists an user with the email given',
                'password.required' => 'You must create a password for your account'
            ])->validateWithBag('createUser');

            $user = $this->userRepo->create([
                'id' => $request->get('id'),
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password'))
            ]);

            if ($user) {
                $request->session()->flash('flash.banner', 'Good job. The user has been created successfully');
                $request->session()->flash('flash.bannerStyle', 'success');
                return redirect()->route('welcome');
            } else {
                $request->session()->flash('flash.banner', 'Oh, no! Something went wrong');
                $request->session()->flash('flash.bannerStyle', 'danger');
                return redirect()->route('welcome');
            }
        }
    }

}
