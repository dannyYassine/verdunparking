<?php

namespace App\Utils\Twilio;

class TwilioResponseBuilder
{
    private $tags = [];

    public function __construct()
    {
    }

    public static function factory(): self
    {
        return new TwilioResponseBuilder();
    }

    public function addTag(TagNode $tag): self
    {
        array_push($this->tags, $tag);
        return $this;
    }

    public function build(): string
    {
        $response = "<Response>";
        foreach ($this->tags as $tag) {
            $response .= $tag->build();
        }
        $response .= "</Response>";

        return urlencode($response);
    }
}
