<?php

namespace App\Utils\Twilio;

class TagNode
{
    private $tag;
    private $keyValues;
    private $tags = [];

    private $tagString;

    public function __construct(string $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @param string $tag
     * @return static
     */
    public static function factory(string $tag): self
    {
        return new TagNode($tag);
    }

    /**
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setAttribute(string $key, string $value): self
    {
        $this->keyValues[$key] = $value;
        return $this;
    }

    /**
     * @param TagNode $tag
     * @return $this
     */
    public function addTag(TagNode $tag): self
    {
        array_push($this->tags, $tag);
        return $this;
    }

    /**
     * @return string
     */
    public function build(): string
    {
        $this->tagString = "<$this->tag>";

        $this->addAttributes();
        $this->addChildTagNodes();

        $this->tagString .= "</$this->tag>";

        $tagString = json_decode(json_encode($this->tagString));
        $this->tagString = null;
        return $tagString;
    }

    /**
     * Adds attributes to the tag element
     */
    private function addAttributes()
    {
        foreach ($this->keyValues as $key => $value) {
            $this->tagString .= " $key=$value";
        }
    }

    /**
     * Adds children tag elements if any
     */
    private function addChildTagNodes()
    {
        foreach ($this->tags as $tag) {
            $this->tagString .= $tag->build();
        }
    }
}
