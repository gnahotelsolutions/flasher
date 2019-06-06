<?php

namespace Flasher;

class Message
{

    /** @var string */
    private $type;

    /** @var string */
    private $message;

    /** @var int */
    private $duration;

    /** @var string */
    private $id;

    /**
     * Message constructor.
     *
     * @param string $type
     * @param string $message
     * @param int $duration
     */
    public function __construct($type, $message, $duration)
    {
        $this->id = uniqid();
        $this->type = $type;
        $this->message = $message;
        $this->duration = $duration;
    }

    public function getType(): string  { return $this->type; }

    public function getMessage(): string { return $this->message; }

    public function getDuration(): int { return $this->duration; }

    public function getId(): string { return $this->id; }

    /**
     * Transform the current notification type to Bootstrap classes.
     *
     * @return string
     */
    public function getBootstrapClass(): string
    {
        return $this->type == 'error' ? 'danger' : $this->type;
    }
}