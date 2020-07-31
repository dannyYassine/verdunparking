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
        $call_sid = $this->voiceUtility->call($this->toNumber);

        $call = $this->voiceUtility->getCall($call_sid);

        $recording = $this->voiceUtility->getFirstRecordingFromCall($call->sid);

        $file = $this->voiceUtility->getRecordingFile($recording->sid);

        try{
            $this->validateAudioFile($file);
        } catch (\Exception $e) {

        }

        // create entry to firebase
        // timestamp, recording_id, call_id
    }

    private function validateAudioFile($file)
    {

    }
}
