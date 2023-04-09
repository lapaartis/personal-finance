<?php

namespace App\Services\Accounts;

use App\Models\Accounts\Account;

class StoreAccount
{
    private $user;
    private $name;
    private $iban;
    private $balance;
    private $accountTypeID;
    private $description;

    public function __construct($user, $data)
    {
        $this->user = $user;
        $this->hydrateLocal($data);
    }

    public function store(): bool
    {
        switch ($this->accountTypeID) {
            case 'any':
                return $this->storeAccount();
                break;
            default:
                return $this->storeAccount();
        }
    }

    private function storeAccount(): bool
    {
        $account = new Account();

        $account->user_id = $this->user->id;
        $account->name = $this->name;
        $account->iban = $this->iban;
        $account->account_type_id = $this->accountTypeID;
        $account->description = $this->description;
        $account->balance = $this->balance;

        return $account->save();
    }

    private function hydrateLocal($data): void
    {
        $this->name = $data['name'];
        $this->iban = $data['iban'];
        $this->accountTypeID = $data['account_type_id'];
        $this->description = $data['description'];
        $this->balance = $data['balance'];
    }
}
