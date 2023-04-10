<?php

namespace App\Models\Categories;

use App\Models\Transactions\Transaction;
use App\Models\Transactions\TransactionJournal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Table: categories
 *
 * === Columns ===
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $user_id
 * @property string $name
 *
 * === Relationships ===
 * @property-read User|null $user
 */
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'user_id'
    ];

    protected $visible = ['id', 'name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

//    public function transactionJournals(): BelongsToMany
//    {
//        return $this->belongsToMany(TransactionJournal::class, 'category_transaction_journal', 'category_id');
//    }
//
//    public function transactions(): BelongsToMany
//    {
//        return $this->belongsToMany(Transaction::class, 'category_transaction', 'category_id');
//    }
}
