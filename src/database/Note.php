<?php
// src/model/Note.php

class Note {
    public $id;
    public $name;
    public $description;
    public $date;
    public $time;
    public $status;

    public function __construct($id, $name, $description, $date, $time, $status) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->date = $date;
        $this->time = $time;
        $this->status = $status;
    }
}
?>
