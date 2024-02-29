<?php
require_once(__DIR__.'/controller/NoteController.php');

$noteController = new NoteController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : ''; // Sicherstellen, dass 'action' gesetzt ist.

    if ($action == 'create') {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $time = isset($_POST['time']) ? $_POST['time'] : '';
        $noteController->createNote($name, $description, $date, $time);
    } elseif ($action == 'delete') {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        if ($id) {
            $noteController->deleteNote($id);
        }
    }

    header('Location: index.php');
    exit;
}

$notes = $noteController->getAllNotes();
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Merkliste</title>
    <link rel="stylesheet" href="styles/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Merkliste</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Beschreibung</th>
                    <th scope="col">Datum</th>
                    <th scope="col">Uhrzeit</th>
                    <th scope="col">Erledigt</th>
                    <th scope="col">Aktion</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($notes as $note): ?>
                    <tr>
                        <td><?= htmlspecialchars($note['name']) ?></td>
                        <td><?= htmlspecialchars($note['description']) ?></td>
                        <td><?= htmlspecialchars($note['date']) ?></td>
                        <td><?= htmlspecialchars($note['time']) ?></td>
                        <td>
                            <input type="hidden" name="action" value="updateStatus">
                            <input type="hidden" name="id" value="<?= $note['id'] ?>">
                            <label for="note_completed_<?= $note['id']?>"></label><input id="note_completed_<?= $note['id']?>" type="checkbox" name="status" value="erledigt" <?= $note['status'] == 'erledigt' ? 'checked' : '' ?> onchange="this.form.submit()">
                        </td>
                        <td>
                            <!-- bearbeiten -->
                            <span class="fas fa-pencil-alt mr-1"></span>
                            <!-- löschen -->
                            <form action="controller/NoteController.php" method="post" style="display:inline">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $note['id'] ?>">
                                <button type="submit" class="btn btn-link p-0" style="color:inherit; text-decoration:none; border:none; background:none;">
                                    <span class="fas fa-trash"></span>
                                </button>
                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <hr>
            <h2>Neue Notiz anlegen</h2>
            <form action="controller/NoteController.php" method="post">
                <input type="hidden" name="action" value="create">
                <div class="row">
                    <div class="col-12">
                        <label for="new_note_name">Name</label>
                        <input id="new_note_name" name="name" class="form-control" type="text" required>
                    </div>
                    <div class="col-12">
                        <label for="new_note_description">Beschreibung</label>
                        <textarea id="new_note_description" name="description" class="form-control" required></textarea>
                    </div>
                    <div class="col-6">
                        <label for="new_note_date">Datum</label>
                        <input id="new_note_date" name="date" class="form-control" type="date" required>
                    </div>
                    <div class="col-6">
                        <label for="new_note_time">Uhrzeit</label>
                        <input id="new_note_time" name="time" class="form-control" type="time" required>
                    </div>
                    <div class="col-12">
                        <br>
                        <button type="submit" class="btn btn-success">Anlegen</button>
                        <button type="reset" class="btn btn-danger">Zurücksetzen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
