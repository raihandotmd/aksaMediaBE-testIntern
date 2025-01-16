<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ResponseModel, ensure all response have same structure
 * @package App\Models
 */
class ResponseModel
{
    public string $status;
    public string $message;
    public  $data;

    public function __construct(string $status, string $message, $data)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }
}
