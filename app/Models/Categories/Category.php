<?php

namespace App\Models\Categories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id'
    ];

    protected $visible = ['id', 'name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
