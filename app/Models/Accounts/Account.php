<?php

namespace App\Models\Accounts;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'account_type_id',
        'iban',
        'balance',
        'description'
    ];

    protected $visible = ['id', 'name', 'iban', 'balance', 'description', 'user_name', 'account_type_id'];
    # protected $appends = ['type'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class);
    }

    # protected function type(): Attribute
    # {
    #     return Attribute::make(
    #         get: fn () => $this->accountType()->first()->type,
    #     )->shouldCache();
    # }
}
