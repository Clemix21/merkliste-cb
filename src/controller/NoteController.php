<?php
// src/controller/NoteController.php

require_once(__DIR__.'/../model/Database.php');
require_once(__DIR__.'/../database/Note.php');

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
        header('Location: ../index.php'); // Weiterleitung zur Main Seite
        exit;
    }


    public function updateNoteStatus($id, $status) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('UPDATE notes SET status = ? WHERE id = ?');
        $stmt->execute([$status, $id]);

        header('Location: index.php');
        exit;
    }

    public function updateNoteDetails($id, $name, $description, $date, $time) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('UPDATE notes SET name = ?, description = ?, date = ?, time = ? WHERE id = ?');
        $stmt->execute([$name, $description, $date, $time, $id]);

        // Weiterleitung zur Main Seite
        header('Location: index.php');
        exit;
    }

    public function deleteNote($id) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('DELETE FROM notes WHERE id = ?');
        $stmt->execute([$id]);

        // Weiterleitung zur Main Seite
        header('Location: index.php');
        exit;
    }
}




