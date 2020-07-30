<?php
namespace App\UseCases;

use App\Requests\CallBeachRequest;
use App\Utils\Twilio\TwilioVoiceUtil;

class CallCityUseCase
{
    /**
     * @var TwilioVoiceUtil
     */
    private $voiceUtility;

    /**
     * @var string
     */
    private $toNumber;

    public function __construct($voiceUtility)
    {
        $this->voiceUtility = $voiceUtility;
        $this->toNumber = '+15142800789';
    }

    /**
     * @param CallBeachRequest $callBeachRequest
     */
    public function execute(CallBeachRequest $callBeachRequest)
    {
        // Call city
//        $call_sid = $this->voiceUtility->call($this->toNumber);
        // validate recording
        $call = $this->voiceUtility->getCall('CA5600c932dcb4df5f1ac63c2e9a4cb857');
        echo json_encode($call->recordings->read()[0]->callSid);
        $recording = $this->voiceUtility->getFirstRecordingFromCall($call->sid);
        echo json_encode($recording->status);

        echo file_get_contents('https://api.twilio.com'.$call->subresourceUris->recordings);
        // save to
    }
}
