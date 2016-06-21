<?php

/**
 * This class contains information over Comments by the selected File
 */
class Comment
{
    private $id;
    private $user_id;
    private $text;

    function __construct($id, $user_id, $text) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->text = $text;
    }

}