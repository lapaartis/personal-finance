<?php

namespace App\Http\Controllers\API\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccountType;

class AccountTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $accountTypes = AccountType::all();

        return response()->json( $accountTypes );
    }
}
