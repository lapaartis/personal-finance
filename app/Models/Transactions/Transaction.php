<?php

namespace App\Models\Transactions;

use App\Models\Accounts\Account;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Table: transactions
*
* === Columns ===
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $account_id
 * @property int $transaction_journal_id
 * @property float $amount
 * @property string $description
*
* === Relationships ===
 * @property-read Account|null $account
 * @property-read TransactionJournal|null $transactionJournal
*/
class Transaction extends Model
{
    use SoftDeletes, HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $fillable = [
        'account_id',
        'transaction_journal_id',
        'description',
        'amount',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function transactionJournal(): BelongsTo
    {
        return $this->belongsTo(TransactionJournal::class);
    }
}
