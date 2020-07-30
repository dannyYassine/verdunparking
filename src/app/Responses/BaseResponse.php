<?php
namespace App\Responses;

abstract class BaseResponse implements \JsonSerializable
{
    use ResponseSerializable;
}
