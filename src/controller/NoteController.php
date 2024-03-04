<?php

require_once(__DIR__.'/../model/Database.php');
require_once(__DIR__.'/../database/Note.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $noteController = new NoteController();

    switch ($action) {
        case 'create':
            if (isset($_POST['name'], $_POST['description'], $_POST['date'], $_POST['time'])) {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $date = $_POST['date'];
                $time = $_POST['time'];
                $noteController->createNote($name, $description, $date, $time);
                echo json_encode(["success" => true, "message" => "Note created successfully"]);
                exit;
            }
            break;

        case 'delete':
            if (isset($_POST['id'])) {
                $noteController->deleteNote($_POST['id']);
                echo json_encode(["success" => true, "message" => "Note deleted successfully"]);
                exit;
            }
            break;

        case 'updateStatus':
            if (isset($_POST['id'], $_POST['status'])) {
                $id = $_POST['id'];
                $status = $_POST['status'] === 'erledigt' ? 'erledigt' : 'nicht erledigt';
                $noteController->updateNoteStatus($id, $status);
                echo json_encode(["success" => true, "message" => "Status updated successfully"]);
                exit;
            }
            break;

        //weitere Cases für andere Funktionen
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
        $stmt = $conn->prepare('INSERT INTO notes (name, description, date, time, status) VALUES (?, ?, ?, ?, "nicht erledigt")');
        if($stmt->execute([$name, $description, $date, $time])) {
            echo json_encode(['success' => true, 'message' => 'Note created successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'An error occurred']);
        }
        exit;
    }

    public function updateNoteStatus($id, $status) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('UPDATE notes SET status = ? WHERE id = ?');
        if($stmt->execute([$status, $id])) {
            echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update status']);
        }
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
        if($stmt->execute([$id])) {
            echo json_encode(['success' => true, 'message' => 'Note successfully deleted']);
        } else {
            echo json_encode(['success' => false, 'message' => 'An error occurred while deleting the note']);
        }
        exit;
    }

}




