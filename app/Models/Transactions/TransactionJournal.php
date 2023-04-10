<?php

namespace App\Models\Transactions;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Table: transaction_journals
*
* === Columns ===
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $user_id
 * @property int $transaction_type_id
 * @property string $description
 * @property Carbon $date
*
* === Relationships ===
 * @property-read TransactionType|null $transactionType
 * @property-read Transaction[]|Collection $transactions
 * @property-read User|null $user
*/
class TransactionJournal extends Model
{
    use SoftDeletes, HasFactory;

    protected $casts = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
        'date'          => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'transaction_type_id',
        'description',
        'date',
    ];

    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
