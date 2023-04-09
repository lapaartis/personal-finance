<?php

namespace Database\Seeders;

use App\Models\Accounts\AccountType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            AccountType::DEFAULT,
            AccountType::CASH,
            AccountType::CREDIT_CARD,
            AccountType::EXPENSE,
        ];
        foreach ($types as $type) {
            try {
                AccountType::create(['type' => $type]);
            } catch (PDOException $e) {
                // @ignoreException
            }
        }
    }
}
