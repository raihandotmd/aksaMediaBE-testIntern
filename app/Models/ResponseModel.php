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
    public $data;
    public $pagination;

    public function __construct(string $status, string $message, $data, $pagination = null)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
        $this->pagination = $pagination;
    }

    public function jsonSerialize()
    {
        $response = [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
        ];

        if ($this->pagination !== null) {
            $response['pagination'] = $this->pagination;
        }

        return $response;
    }
}
