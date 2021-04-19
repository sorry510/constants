<?php

declare (strict_types = 1);

namespace Sorry510\Constants;

class Constants
{
    protected $messages = [];

    public function setMessage($key, $value)
    {
        $this->messages[$key] = $value;
    }

    public function getMessage($key)
    {
        if (isset($this->messages[$key])) {
            return $this->messages[$key];
        }
        return 'undefined';
    }
}
