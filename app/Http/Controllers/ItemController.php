<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Services\AccountService;
use App\Rules\FiveCharacters;

class ItemController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    //public $layout = 'admin.layouts.default';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AccountService $service)
    {
        $this->service = $service;
    }
    public function index()
    {       
        return view('contact');
    }
    public function create()
    {       
        return view('contact');
    }
    public function store(ItemRequest $request)
    {
        $items = $request->all();
        $formsData = $this->service->addFormData($request);
        return back();
    }
}
