<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'config.php';

if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch();

if (!$contact) {
    header('Location: list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'] ?? null;
    $whatsapp = $_POST['whatsapp'] ?? null;

    $stmt = $pdo->prepare("UPDATE contacts SET name = ?, email = ?, whatsapp = ? WHERE id = ?");
    $stmt->execute([$name, $email, $whatsapp, $id]);

    header('Location: list.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Editar Contato</h3>
                    </div>
                    <div class="card-body">
                        <form action="edit.php?id=<?= $contact['id'] ?>" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome *</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($contact['name']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($contact['email'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">WhatsApp</label>
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= htmlspecialchars($contact['whatsapp'] ?? '') ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                            <a href="list.php" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>