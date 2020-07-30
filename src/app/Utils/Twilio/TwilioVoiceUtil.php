<?php
namespace App\Utils\Twilio;

use Twilio\Rest\Client;

class TwilioVoiceUtil
{
    private $account_sid;
    private $auth_token;
    private $twilio_number;
    private $timeout_in_seconds;

    public function __construct()
    {
        // Your Account SID and Auth Token from twilio.com/console
        $this->account_sid = $_ENV[TWILIO_ACCOUNT_SID];
        $this->auth_token = $_ENV[TWILIO_AUTH_TOKEN];
        $this->twilio_number = $_ENV[TWILIO_FROM_NUMBER];

        $this->timeout_in_seconds = 10;
    }

    /**
     * @param string $toNumber
     * @param bool $waitToEnd
     * @return string|null
     */
    public function call(string $toNumber, $waitToEnd = true): ?string
    {
        $response = TwilioResponseBuilder::factory()
            ->addTag(TagNode::factory('Record')
                ->setAttribute('timeout', $this->timeout_in_seconds)
                ->setAttribute('transcribe', 'true'))
            ->build();

        try {
            $client = $this->getClient();
            $call = $client->account->calls->create(
                $toNumber,
                $this->twilio_number,
                array(
                    "url" => "https://twimlets.com/echo?Twiml=$response"
                )
            );

            if ($waitToEnd) {
                sleep($this->timeout_in_seconds);
            }

            return $call->sid;
        }
        catch (\Twilio\Exceptions\ConfigurationException $e) {
            return null;
        }
    }

    /**
     * @param string $sid
     * @return \Twilio\Rest\Api\V2010\Account\RecordingInstance
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function getRecording(string $sid): \Twilio\Rest\Api\V2010\Account\RecordingInstance
    {
        return $this->getClient()
            ->recordings($sid)
            ->fetch();
    }

    /**
     * @param string $sid
     * @return \Twilio\Rest\Api\V2010\Account\RecordingInstance
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function getFirstRecordingFromCall(string $call_id): \Twilio\Rest\Api\V2010\Account\RecordingInstance
    {
        $call = $this->getClient()
            ->calls($call_id)
            ->fetch();

        return $call->recordings->read()[0];
    }

    /**
     * @param string $sid
     * @return \Twilio\Rest\Api\V2010\Account\RecordingInstance
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function getCall(string $sid): \Twilio\Rest\Api\V2010\Account\CallInstance
    {
        return $this->getClient()
            ->calls($sid)
            ->fetch();
    }

    private function getClient(): Client
    {
        return new Client($this->account_sid, $this->auth_token);
    }
}
