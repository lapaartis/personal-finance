<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountType extends Model
{
    use HasFactory;

    public $timestamps = false;

    public const CASH = 'Cash account';
    public const CREDIT_CARD = 'Credit card';
    public const DEFAULT = 'Default account';
    public const EXPENSE = 'Expense account';

    protected $fillable = ['type'];

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
