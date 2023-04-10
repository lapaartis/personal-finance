<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Table: transaction_types
*
* === Columns ===
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property string $type
*
* === Relationships ===
 * @property-read TransactionJournal[]|Collection $transactionJournals
*
* === Builder ===
 * @method static static create(array $attributes = [])
*/
class TransactionType extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const DEPOSIT = 'Deposit';
    public const INVALID = 'Invalid';
    public const LIABILITY_CREDIT = 'Liability credit';
    public const OPENING_BALANCE = 'Opening balance';
    public const RECONCILIATION = 'Reconciliation';
    public const TRANSFER = 'Transfer';
    public const WITHDRAWAL = 'Withdrawal';
    protected $casts
        = [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];

    protected $fillable = ['type'];

    public function isDeposit(): bool
    {
        return self::DEPOSIT === $this->type;
    }

    public function isOpeningBalance(): bool
    {
        return self::OPENING_BALANCE === $this->type;
    }

    public function isTransfer(): bool
    {
        return self::TRANSFER === $this->type;
    }

    public function isWithdrawal(): bool
    {
        return self::WITHDRAWAL === $this->type;
    }

    public function transactionJournals(): HasMany
    {
        return $this->hasMany(TransactionJournal::class);
    }
}
