<?php
require_once 'config.php';
$errore = '';
if (isset($_POST['submit'])) {
    $task = $_POST['nome_elemento'];
    if (empty($task)) {
        $errore = 'Devi scrivere qualcosa prima!';
    } else {
        $insert = query("INSERT INTO tasks (nome_elemento, data_completamento) VALUES ('$task', now())");
        conferma($insert);
        header('Location: index.php?tutte');
    }
}

if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];

    $delete = query("DELETE FROM tasks WHERE id=$id");
    conferma($delete);
    header('Location: index.php?tutte');
}

if (isset($_GET['complete'])) {
    $id = $_GET['complete'];
    $complete = query("UPDATE tasks SET id_stato_elemento = 2 WHERE id = $id");
    conferma($complete);
    header('Location: index.php?tutte');
}
?>

<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="heading">
        <h2>Lista cose da fare</h2>
    </div>
    <form action="index.php" method="POST" id="verdino">
        <?php if (isset($errore)) { ?>
            <p><?= $errore; ?></p>
        <?php } ?>
        <input type="text" name="nome_elemento" class="task_input" placeholder="Inserisci elemento" style="border-radius: 5px ;">
        &nbsp; &nbsp; &nbsp; <button type="submit" class="add_btn btn btn-outline" name="submit">Aggiungi</button>
    </form>

    <table>
        <thead class="text-center">
            <tr>
                <th>N°</th>
                <th>Task</th>
                <th>Stato elemento</th>
                <th>Data</th>
                <th>Utente</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['tutte'])) {
                $selectTutte = query("SELECT t.*, st.*, u.* FROM tasks t, stati_elementi st, utenti u WHERE t.id_stato_elemento = st.id_stato_elemento AND t.id_utente = u.id_utente");
                conferma($selectTutte);
                $i = 1;
                while ($row = mysqli_fetch_array($selectTutte)) { ?>
                    <tr>
                        <td class="number"><?= $i; ?></td>
                        <td class="task"><?= $row['nome_elemento']; ?></td>
                        <td class="task"><?= $row['descrizione']; ?></td>
                        <td class="task"><?= $row['data_completamento']; ?></td>
                        <td class="task"><?= $row['username']; ?></td>
                        <td class="delete"><a href="index.php?del_task=<?= $row['id']; ?>">Elimina</a>&nbsp; &nbsp; &nbsp;<a href="index.php?complete=<?= $row['id']; ?>" class="completa bg-success">Completa</a></td>
                    </tr>
            <?php $i++;
                }
            } ?>
            <?php
            if (isset($_GET['da-fare'])) {
                $selectDafare = query("SELECT t.*, st.*, u.* FROM tasks t, stati_elementi st, utenti u WHERE t.id_stato_elemento = 1 AND  t.id_utente = u.id_utente AND t.id_stato_elemento = st.id_stato_elemento");
                conferma($selectDafare);
                while ($row = mysqli_fetch_array($selectDafare)) {
                    $id = $row['id'];
                    $nomeElemento = $row['nome_elemento'];
                    $idStato = $row['descrizione'];
                    $data = $row['data_completamento'];
                    $idUtente = $row['username'];
            ?>
                    <?php include 'pagina.php'; ?>
            <?php
                }
            }
            ?>

            <?php
            if (isset($_GET['completate'])) {
                $selectCompletate = query("SELECT t.*, st.*, u.* FROM tasks t, stati_elementi st, utenti u WHERE t.id_stato_elemento = 2 AND t.id_utente = u.id_utente AND t.id_stato_elemento = st.id_stato_elemento");
                conferma($selectCompletate);
                while ($row = mysqli_fetch_array($selectCompletate)) {
                    $id = $row['id'];
                    $nomeElemento = $row['nome_elemento'];
                    $idStato = $row['descrizione'];
                    $data = $row['data_completamento'];
                    $idUtente = $row['username'];
            ?>
                    <?php include 'pagina.php'; ?>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <div class="container pb-2 pt-2">
        <div class="row justify-content-center">
            <div class="col-2">
                <a href="index.php?tutte" class="btn btn-outline-primary">Tutte</a>
            </div>
            <div class="col-2">
                <a href="index.php?da-fare" class="btn btn-outline-warning">Da fare</a>
            </div>
            <div class="col-2">
                <a href="index.php?completate" class="btn btn-outline-success">Completate</a>
            </div>
        </div>
    </div>
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Made By Filippo Ballotta ;)</span>
        </div>
    </footer>
</body>

</html>