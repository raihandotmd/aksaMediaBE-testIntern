<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DivisionModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'divisions';
    public $timestamps = false;

    public $incrementing = false;
    protected $keyType = 'string';


    /**
     * Get the employees for the division.
     */
    public function employees()
    {
        return $this->hasMany(EmployeeModel::class);
    }
}
