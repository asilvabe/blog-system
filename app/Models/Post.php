<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $dates = ['approved_at'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getApproverName(): string
    {
        return $this->approver->name ?? 'Pending';
    }

    public function isApproved(): bool
    {
        return !is_null($this->approved_at);
    }

    public function scopeTitle($query, $title)
    {
        if ($title)
            return $query->where('title', 'LIKE', "%$title%");
    }

    public function scopeStatus($query, $status)
    {
        if ($status) {
            if ($status == 1)
                return $query->whereNotNull('approved_by');
            if ($status == 2)
                return $query->whereNull('approved_by');
        }
    }

    public function scopeAuthor($query, $author)
    {
        if ($author != 0)
            return $query->where('created_by', '=', $author);
    }

    public function scopeDateRange($query, $dateFrom, $dateTo)
    {
        if(isset($dateFrom) && isset($dateTo))
            return $query->whereBetween('created_at', [$dateFrom, $dateTo]);
        if(isset($dateFrom) && !isset($dateTo))
            return $query->whereDate('created_at', '>=' ,$dateFrom);
        if(!isset($dateFrom) && isset($dateTo))
            return $query->whereDate('created_at', '<=' ,$dateTo);
    }
}
