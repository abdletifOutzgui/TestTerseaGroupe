<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\SoftDeletes;

class Appel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'agent_id',
        'client_id',
        'comment',
        'call_time',
        'duration',
        'subject'
    ];

    public function agent(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function tickets(): HasMany 
    {
        return $this->hasMany(Ticket::class);
    }
}
