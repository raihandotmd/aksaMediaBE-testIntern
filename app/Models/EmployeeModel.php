<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DivisionModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'employees';
    protected $fillable = ['image', 'name', 'phone', 'division_id', 'position'];

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Get the division that owns the Employee
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(DivisionModel::class);
    }
}
