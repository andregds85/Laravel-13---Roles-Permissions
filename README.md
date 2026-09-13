# Sistema de Cadastro de Contatos

Sistema simples em PHP + MySQL para gerenciamento de contatos com autenticação.

## Funcionalidades

- ✅ Login/Registro de usuários
- ✅ Cadastro de contatos (nome obrigatório, email e WhatsApp opcionais)
- ✅ Listagem de contatos
- ✅ Sessão protegida (apenas usuários logados)
- ✅ Interface com Bootstrap 5

## Requisitos

- PHP 8.0+
- MySQL/MariaDB
- XAMPP/WAMP/LAMP

## Instalação

1. Clone o repositório:
```bash
git clone <url-do-repositorio>
cd abc
```

2. Configure o banco de dados:
```sql
CREATE DATABASE agenda;
USE agenda;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    whatsapp VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

3. Configure a conexão em `config.php`:
```php
$host = 'localhost';
$db = 'agenda';
$user = 'root';
$pass = '';
```

4. Inicie o servidor (XAMPP) e acesse:
```
http://localhost/abc/login.php
```

## Credenciais Padrão

- **Usuário:** admin
- **Senha:** senha123

## Estrutura

```
abc/
├── config.php          # Conexão PDO
├── index.php           # Formulário de contato
├── process.php         # Processa cadastro
├── list.php            # Lista contatos
├── login.php           # Login
├── login_process.php   # Autenticação
├── register.php        # Registro
├── register_process.php# Processa registro
├── logout.php          # Logout
├── .gitignore
└── README.md
```

## Tecnologias

- PHP 8 (PDO)
- MySQL
- Bootstrap 5 (CDN)
- HTML5/CSS3