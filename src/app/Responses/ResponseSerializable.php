<?php
namespace App\Responses;

trait ResponseSerializable {
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
