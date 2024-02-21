<?php
// src/controller/NoteController.php

require_once(__DIR__.'/../model/Database.php');
require_once(__DIR__.'/../database/Note.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $noteController = new NoteController();
    // Nehmen Sie an, dass ein 'action'-Feld im Formular bestimmt, welche Aktion ausgeführt werden soll
    if (isset($_POST['action']) && $_POST['action'] == 'create') {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $time = isset($_POST['time']) ? $_POST['time'] : '';
        $noteController->createNote($name, $description, $date, $time);
        header('Location: ../index.php'); // Stellen Sie sicher, dass dies der korrekte Pfad ist
        exit;
    }
}

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

        // Weiterleitung zur Main Seite
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




