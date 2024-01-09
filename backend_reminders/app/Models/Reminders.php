<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reminders extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = [
        'User_Id',
        'Title',
        'Description',
        'Reminder_date',
        'Recurrence'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'User_Id');
    }
}
