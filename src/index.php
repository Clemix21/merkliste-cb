<?php
require_once(__DIR__.'/controller/NoteController.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : ''; // Sicherstellen, dass 'action' gesetzt ist.
    $noteController = new NoteController();

    if ($action == 'create') {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $time = isset($_POST['time']) ? $_POST['time'] : '';
        $noteController->createNote($name, $description, $date, $time);
    }

    // Weiterleitung, um Doppelübermittlungen des Formulars zu verhindern.
    header('Location: index.php');
    exit;
}

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Merkliste</title>
    <link rel="stylesheet" href="styles/bootstrap.css">
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
                <tr>
                    <td><label for="note1_name">Entwicklungsumgebung aufsetzen</label></td>
                    <td><label for="note1_description">Was dem Handwerker der Hammer, das ist dem Programmierer die Entwicklungsumgebung. Darum: PHPStorm und XAMPP installieren.</label></td>
                    <td><label for="note1_date">11.03.19</label></td>
                    <td><label for="note1_time">10:00</label></td>
                    <td><label for="note1_completed"></label><input id="note1_completed" type="checkbox"></td>
                    <td><span class="fa fa-edit mr-1"></span><span class="fa fa-times"></span></td>
                </tr>
                <tr>
                    <td><label for="note2_name">Merkliste</label></td>
                    <td><label for="note2_description">Zum Einstieg bauen wir eine Merkliste.</label></td>
                    <td><label for="note2_date">11.03.19</label></td>
                    <td><label for="note2_time">11:00</label></td>
                    <td><label for="note2_completed"></label><input id="note2_completed" type="checkbox"></td>
                    <td><span class="fa fa-edit mr-1"></span><span class="fa fa-times"></span></td>
                </tr>
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
