<?php

/**
 * TODO : Full PHPDOCS Comment Class
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

    /**
     * Creates a comment at current file
     * TODO : Full PHPDOCS
     *
     * @param $user_id
     * @param $file_id
     * @param $text
     */
    public function createComment($user_id, $file_id, $text)
    {
        // TODO : createComment implementation
    }

    /**
     * Edit selected comment
     * TODO : Full PHPDOCS
     *
     * @param $id
     * @param $user_id
     */
    public function editComment($id, $user_id)
    {
        // TODO : editComment implementation
    }

    /**
     * Delete selected comment
     * TODO : Full PHPDOCS
     *
     * @param $id
     * @param $user_id
     */
    public function deleteComment($id, $user_id)
    {
        // TODO : deleteComment implementation
    }

}