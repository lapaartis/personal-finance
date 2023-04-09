<?php

namespace App\Services\Accounts;

use App\Models\Accounts\Account;

class UpdateAccount
{
    private $user;
    private $id;
    private $name;
    private $iban;
    private $balance;
    private $description;

    private $account;

    public function __construct($user, Account $account, $data)
    {
        $this->user = $user;
        $this->account = $account;
        $this->hydrateLocal($data);
    }

    public function update(): bool
    {
        return $this->updateAccount();
    }

    private function updateAccount(): bool
    {
        $account = $this->account;

        $account->name = $this->name;
        $account->iban = $this->iban;
        $account->description = $this->description;
        $account->balance = $this->balance;

        return $account->save();
    }

    private function hydrateLocal($data): void
    {
        $this->name = $data['name'];
        $this->iban = $data['iban'];
        $this->description = $data['description'];
        $this->balance = $data['balance'];
    }
}
