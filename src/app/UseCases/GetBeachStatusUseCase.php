<?php
namespace App\UseCases;

use App\Responses\BeachStatusResponse;

class GetBeachStatusUseCase
{
    public function __construct()
    {
    }

    public function execute(): BeachStatusResponse
    {
        // retrieve most recent entry from firebase
        // check rule that is has to be less than 12 hours
        // if less than 12 hours, use response
        // if more than 12 hours, return 'call city' response
        return new BeachStatusResponse('Allowed');
    }
}
