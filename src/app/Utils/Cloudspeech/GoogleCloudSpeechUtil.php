<?php
namespace App\Utils\CloudSpeech;

# Imports the Google Cloud client library
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;

class GoogleCloudSpeechUtil
{
    public function transcribe($audioFile): ?string
    {
        try {
            # get contents of a file into a string
            $content = file_get_contents($audioFile);

            # set string as audio content
            $audio = (new RecognitionAudio())
                ->setContent($content);

            # The audio file's encoding, sample rate and language
            $config = new RecognitionConfig([
                'language_code' => 'fr-CA'
            ]);

            # Instantiates a client
            $client = new SpeechClient();

            # Detects speech in the audio file
            $response = $client->recognize($config, $audio);

            # Print most likely transcription
            $text = '';
            foreach ($response->getResults() as $result) {
                $alternatives = $result->getAlternatives();
                $mostLikely = $alternatives[0];
                $transcript = $mostLikely->getTranscript();
//                printf('Transcript: %s' . PHP_EOL, $transcript);
                if (strlen($transcript) > strlen($text)) {
                    $text = $transcript;
                }
            }
            $client->close();

            return $text;
        }
        catch (\Exception $e) {
//            echo json_encode($e->getMessage());
            return null;
        }
    }
}
