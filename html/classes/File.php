<?php

/**
 * This class contains information over Files in current application
 */
class File
{
    private $id;
    private $file_owner_id;
    private $name;
    private $description;
    private $path_to_file;

    function __construct($id, $file_owner_id, $name, $description, $path_to_file) {
        $this->id = $id;
        $this->file_owner_id = $file_owner_id;
        $this->name = $name;
        $this->description = $description;
        $this->path_to_file = $path_to_file;
    }

}