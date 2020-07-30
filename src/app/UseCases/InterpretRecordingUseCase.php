<?php
namespace App\UseCases;

use App\Utils\CloudSpeech\GoogleCloudSpeechUtil;

class InterpretRecordingUseCase
{
    /**
     * @var GoogleCloudSpeechUtil
     */
    private $speechUtil;

    public function __construct()
    {
        $this->speechUtil = new GoogleCloudSpeechUtil();
    }

    public function execute()
    {
        // get recent recording
        // download recording
        // convert audio to text recording
        $audioFile = TMP . '/REffbf0ff5e7c14586113624d25131620a.wav';
        $transcript = $this->speechUtil->transcribe($audioFile);
        // transcribe text
        if (strpos($transcript, 'la plage urbaine de Verdun est présentement ouverte')) {
            echo 'The beach is open!';
        }
        else {
            echo 'Please call city';
        }
        // save to firebase
    }
}
