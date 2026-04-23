<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'qty',
        'start_date',
        'end_date',
        'actual_return_date',
        'status',
        'note',
        'approved_by',
        'returned_at',
        'return_condition',
        'return_note',
        'late_days',
        'daily_late_fee',
        'late_fine',
        'damage_fine',
        'total_fine',
        'fine_status',
        'fine_paid_at',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'actual_return_date' => 'date',
        'returned_at' => 'datetime',
        'fine_paid_at' => 'datetime',
        'late_days' => 'integer',
        'daily_late_fee' => 'integer',
        'late_fine' => 'integer',
        'damage_fine' => 'integer',
        'total_fine' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)
                    ->withDefault(['name' => 'User Dihapus']); // ✅ jaring pengaman
    }

    public function book()
    {
        return $this->belongsTo(Book::class)
                    ->withDefault(['name' => 'Buku Dihapus']); // ✅ jaring pengaman
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by')
                    ->withDefault(['name' => '-']); // ✅ jaring pengaman
    }
}