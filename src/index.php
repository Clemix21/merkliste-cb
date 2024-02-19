<?php
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
            <form>
                <div class="row">
                    <div class="col-12">
                        <label for="new_note_name">Name</label><input id="new_note_name" class="form-control" type="text">
                    </div>
                    <div class="col-12">
                        <label for="new_note_description">Beschreibung</label><textarea id="new_note_description" class="form-control"></textarea>
                    </div>
                    <div class="col-6">
                        <label for="new_note_date">Datum</label><input id="new_note_date" class="form-control" type="date">
                    </div>
                    <div class="col-6">
                        <label for="new_note_time">Uhrzeit</label><input id="new_note_time" class="form-control" type="time">
                    </div>
                    <div class="col-12">
                        <br>
                        <button class="btn btn-success">Anlegen</button>
                        <button class="btn btn-danger">Zurücksetzen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
