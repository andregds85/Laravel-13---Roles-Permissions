<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'config.php';

$stmt = $pdo->prepare("SELECT * FROM contacts ORDER BY created_at DESC");
$stmt->execute();
$contacts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Lista de Contatos</h2>
            <div>
                <a href="index.php" class="btn btn-success me-2">Novo Contato</a>
                <a href="logout.php" class="btn btn-outline-danger">Sair</a>
            </div>
        </div>
        
        <?php if(count($contacts) > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>WhatsApp</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($contacts as $contact): ?>
                    <tr>
                        <td><?= $contact['id'] ?></td>
                        <td><?= htmlspecialchars($contact['name']) ?></td>
                        <td><?= htmlspecialchars($contact['email'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($contact['whatsapp'] ?? '-') ?></td>
                        <td>
                            <a href="edit.php?id=<?= $contact['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a href="delete.php?id=<?= $contact['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="alert alert-info">Nenhum contato encontrado.</div>
        <?php endif; ?>
    </div>
</body>
</html>