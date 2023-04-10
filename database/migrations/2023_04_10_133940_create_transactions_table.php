<?php

use App\Models\Accounts\Account;
use App\Models\Transactions\TransactionJournal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor(Account::class)->constrained((new Account)->getTable());
            $table->foreignIdFor(TransactionJournal::class)->constrained((new TransactionJournal)->getTable());
            $table->decimal('amount', 10, 2);
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
