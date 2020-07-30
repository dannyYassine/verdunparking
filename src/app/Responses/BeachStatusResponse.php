<?php
namespace App\Responses;

class BeachStatusResponse extends BaseResponse
{
    use ResponseSerializable;

    /**
     * @var string
     */
    private $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

}
