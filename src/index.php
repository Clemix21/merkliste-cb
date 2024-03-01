<?php
require_once(__DIR__.'/controller/NoteController.php');

$noteController = new NoteController();



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
            <form id="noteForm" action="controller/NoteController.php" method="post">
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('noteForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            fetch('controller/NoteController.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if(data.success) {
                        // später vielleicht dynamischer Listen reload
                    }
                })
            });

        });
    })
</script>

</body>
</html>
