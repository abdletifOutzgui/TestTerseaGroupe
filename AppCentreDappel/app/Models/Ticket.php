<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\TicketStatus;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'agent_id',
        'appel_id',
        'commentaire',
        'status'
    ];

    /**
     * Casts attributes to specific types.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'status' => TicketStatus::class
        ];
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function appel(): BelongsTo
    {
        return $this->belongsTo(Appel::class);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

}
