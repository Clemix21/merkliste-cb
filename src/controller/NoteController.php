<?php
// src/controller/NoteController.php

require_once('../model/Note.php');
require_once('../database/Database.php');

class NoteController {
    public function getAllNotes() {
        $db = new Database();
        $conn = $db->getConnection();
        $notes = $conn->query('SELECT * FROM notes')->fetchAll(PDO::FETCH_ASSOC);
        return $notes;
    }

    public function createNote($name, $description, $date, $time) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('INSERT INTO notes (name, description, date, time, status) VALUES (?, ?, ?, ?, "not_done")');
        $stmt->execute([$name, $description, $date, $time]);
        return $conn->lastInsertId();
    }

    public function updateNoteStatus($id, $status) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('UPDATE notes SET status = ? WHERE id = ?');
        $stmt->execute([$status, $id]);
    }

    public function updateNoteDetails($id, $name, $description, $date, $time) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('UPDATE notes SET name = ?, description = ?, date = ?, time = ? WHERE id = ?');
        $stmt->execute([$name, $description, $date, $time, $id]);
    }

    public function deleteNote($id) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('DELETE FROM notes WHERE id = ?');
        $stmt->execute([$id]);
    }
}
?>
