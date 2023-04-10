<?php

namespace Database\Seeders;

use App\Models\Transactions\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            TransactionType::DEPOSIT,
            TransactionType::INVALID,
            TransactionType::LIABILITY_CREDIT,
            TransactionType::OPENING_BALANCE,
            TransactionType::RECONCILIATION,
            TransactionType::TRANSFER,
            TransactionType::WITHDRAWAL,
        ];
        foreach ($types as $type) {
            try {
                TransactionType::create(['type' => $type]);
            } catch (PDOException $e) {
                // @ignoreException
            }
        }
    }
}
