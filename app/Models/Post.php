<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeTitle($query, $title): Builder
    {
        if (empty($title)) {
            return $query;
        }

        return $query->where('title', 'LIKE', "%$title%");
    }

    public function scopeStatus($query, $status): Builder
    {
        if ($status == "approved") {
            return $query->whereNotNull('approved_by');
        }
        if ($status == "pending") {
            return $query->whereNull('approved_by');
        }
        return $query;
    }

    public function scopeAuthor($query, $author): Builder
    {
        if ($author == 0)
            return $query;

        return $query->where('created_by', '=', $author);
    }

    public function scopeDateRange($query, $dateFrom, $dateTo): Builder
    {
        if (empty($dateFrom) && empty($dateTo)) {
            return $query;
        }
        if (isset($dateFrom) && isset($dateTo)) {
            return $query->whereBetween('created_at', [$dateFrom, $dateTo]);
        }
        if (isset($dateFrom) && !isset($dateTo)) {
            return $query->whereDate('created_at', '>=', $dateFrom);
        }
        if (!isset($dateFrom) && isset($dateTo)) {
            return $query->whereDate('created_at', '<=', $dateTo);
        }
    }
}
