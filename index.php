<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Cadastro de Contato</h3>
                    </div>
                    <div class="card-body">
                        <form action="process.php" method="POST" id="contactForm" novalidate>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">Nome é obrigatório</div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <div class="invalid-feedback">Email inválido</div>
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">WhatsApp</label>
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="(11) 99999-9999">
                                <div class="invalid-feedback">WhatsApp inválido. Use: (11) 99999-9999</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a href="list.php" class="btn btn-secondary">Voltar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const whatsapp = document.getElementById('whatsapp').value.trim();
            let isValid = true;

            // Reset validation
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

            // Name validation (required)
            if (!name) {
                document.getElementById('name').classList.add('is-invalid');
                isValid = false;
            }

            // Email validation (if provided)
            if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                document.getElementById('email').classList.add('is-invalid');
                isValid = false;
            }

            // WhatsApp validation (if provided) - Brazilian format
            if (whatsapp) {
                const whatsappRegex = /^\(\d{2}\)\s?\d{4,5}-?\d{4}$/;
                if (!whatsappRegex.test(whatsapp)) {
                    document.getElementById('whatsapp').classList.add('is-invalid');
                    isValid = false;
                }
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        // WhatsApp mask
        document.getElementById('whatsapp').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.length <= 2) {
                    value = '(' + value;
                } else if (value.length <= 6) {
                    value = '(' + value.slice(0, 2) + ') ' + value.slice(2);
                } else if (value.length <= 10) {
                    value = '(' + value.slice(0, 2) + ') ' + value.slice(2, 6) + '-' + value.slice(6);
                } else {
                    value = '(' + value.slice(0, 2) + ') ' + value.slice(2, 7) + '-' + value.slice(7, 11);
                }
            }
            e.target.value = value;
        });
    </script>
</body>
</html>