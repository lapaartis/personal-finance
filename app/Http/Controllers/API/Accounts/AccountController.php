<?php

namespace App\Http\Controllers\API\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\StoreAccountRequest;
use App\Http\Requests\Accounts\UpdateAccountRequest;
use App\Models\Accounts\Account;
use App\Services\Accounts\StoreAccount;
use App\Services\Accounts\UpdateAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(): JsonResponse
    {
        $accounts = Auth::user()->accounts()->get();

        return response()->json( $accounts );
    }

    public function show(Request $request, Account $account): JsonResponse
    {
        return response()->json( $account );
    }

    public function store(StoreAccountRequest $request): JsonResponse
    {

        $accountEntity = new StoreAccount( $request->user(), $request->all() );
        $accountEntity->store();

        return response()->json( null, 201 );
    }

    public function update(UpdateAccountRequest $request, Account $account): JsonResponse
    {
        $accountEntity = new UpdateAccount( $request->user(), $account, $request->all() );
        $accountEntity->update();

        return response()->json('', 204);
    }
}
