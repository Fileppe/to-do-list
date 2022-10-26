<tr>
    <td class="number"><?= $id; ?></td>
    <td class="task"><?= $row['nome_elemento']; ?></td>
    <td class="task"><?= $row['descrizione']; ?></td>
    <td class="task"><?= $row['data_completamento']; ?></td>
    <td class="task"><?= $row['username']; ?></td>
    <td class="delete"><a href="index.php?del_task=<?= $row['id']; ?>">Elimina</a>&nbsp; &nbsp; &nbsp;<a href="index.php?complete=<?= $row['id']; ?>" class="completa bg-success">Completa</a></td>
</tr>