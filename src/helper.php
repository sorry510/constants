<?php

if (!function_exists('getConstMessage')) {
    function getConstMessage($code)
    {
        /**
         * @var \Sorry510\Constants\Constants
         */
        $constants = app(\Sorry510\Constants\Constants::class);
        return $constants->getMessage($code);
    }
}
