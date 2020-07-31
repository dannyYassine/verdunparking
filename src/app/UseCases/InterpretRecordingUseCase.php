<?php
namespace App\UseCases;

use App\Utils\CloudSpeech\GoogleCloudSpeechUtil;
use App\Utils\FileUtil;
use App\Utils\Twilio\TwilioVoiceUtil;

class InterpretRecordingUseCase
{
    /**
     * @var TwilioVoiceUtil
     */
    private $voiceUtility;

    /**
     * @var FileUtil
     */
    private $fileUtil;

    /**
     * @var GoogleCloudSpeechUtil
     */
    private $speechUtil;

    public function __construct($voiceUtility, $fileUtil)
    {
        $this->speechUtil = new GoogleCloudSpeechUtil();
        $this->voiceUtility = $voiceUtility;
        $this->fileUtil = $fileUtil;
    }

    public function execute()
    {
        // get recent recording
        // download recording
        $recording_sid = 'REffbf0ff5e7c14586113624d25131620a';

        $file = $this->voiceUtility->getRecordingFile($recording_sid);

        $file_path = $this->fileUtil->saveAudio(uniqid(), $file);

        // convert audio to text recording
        $transcript = $this->speechUtil->transcribe($file_path);
        // transcribe text
        if (strpos($transcript, 'la plage urbaine de Verdun est présentement ouverte')) {
            echo 'The beach is open!';
        }
        else {
            echo 'Please call city';
        }
        // save status firebase
    }
}
