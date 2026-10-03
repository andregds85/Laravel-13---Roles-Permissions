Prompt para IA - Sistema de Roles e Permissions Laravel 13
Crie um sistema completo de Roles e Permissions no Laravel 13 (PHP 8.2+) baseado na estrutura abaixo:
Stack Tecnológica
•	Laravel 13.x (PHP 8.2+)
•	spatie/laravel-permission (versão mais recente compatível com Laravel 13)
•	laravel/sanctum para API tokens
•	laravel/ui + Bootstrap 5 para autenticação e UI
•	laravelcollective/html para formulários
•	Vite para assets (substituindo Laravel Mix)
Estrutura do Banco de Dados
-- Tabelas do spatie/laravel-permission (via migration do pacote)
permissions (id, name, guard_name, timestamps)
roles (id, name, guard_name, timestamps)
model_has_permissions (permission_id, model_type, model_id)
model_has_roles (role_id, model_type, model_id)
role_has_permissions (permission_id, role_id)

-- Tabelas customizadas
users (name, email, password, email_verified_at, timestamps)
products (name, detail, timestamps)
clients (name, email, whatsapp, timestamps)
Models
1.	User - Usa HasApiTokens, HasFactory, Notifiable, HasRoles (Spatie)
2.	Product - Fillable: name, detail
3.	Client - Fillable: name, email, whatsapp
Controllers (Resource Controllers com Middleware de Permissão)
RoleController - CRUD completo de roles:
•	Middleware: permission:role-list|role-create|role-edit|role-delete (index/store)
•	Middleware individuais para create, edit, destroy
•	syncPermissions() para associar permissões
UserController - CRUD completo de usuários:
•	Assign roles via $user->assignRole($request->input('roles'))
•	Hash de password com Hash::make()
•	Validação única de email exceto próprio ID
ProductController & ClientController - CRUD padrão com middleware de permissão:
•	permission:product-list|product-create|product-edit|product-delete (index/show)
•	Middleware individuais para create, edit, destroy
Permissions (Seeder)
role-list, role-create, role-edit, role-delete
product-list, product-create, product-edit, product-delete
client-list, client-create, client-edit, client-delete
Seeders
1.	PermissionTableSeeder - Cria todas as permissions acima
2.	CreateAdminUserSeeder - Cria user admin@gmail.com / 123456, role "Admin" com todas permissions
Rotas (web.php)
Route::get('/', fn() => view('welcome'));
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('clients', ClientController::class);
});
Views (Blade + Bootstrap 5)
•	Layout principal (layouts/app.blade.php) - Navbar com dropdown user, links condicionais via @can
•	Roles: index (tabela paginada + ações), create (checkbox permissions), edit, show
•	Users: index, create (select roles), edit, show
•	Products/Clients: CRUD padrão
•	Usar @can('permission-name') para mostrar/esconder botões
•	Formulários com laravelcollective/html (Form::open, Form::text, Form::checkbox, etc.)
Configurações Importantes
•	config/permission.php publicado e configurado
•	Cache de permissions: 24 horas
•	register_permission_check_method: true (integração com Gates)
•	Teams: false
Comandos de Instalação
composer create-project laravel/laravel:^13.0 projeto
composer require spatie/laravel-permission laravel/sanctum laravel/ui laravelcollective/html
php artisan ui bootstrap --auth
npm install && npm run build
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
php artisan migrate
php artisan db:seed --class=PermissionTableSeeder
php artisan db:seed --class=CreateAdminUserSeeder
Diferenças Laravel 10 → 13 a considerar:
•	PHP 8.2+ (tipos de retorno nativos, readonly, #[Attribute])
•	Bootstrap 5 (já incluso no laravel/ui)
•	Vite ao invés de Mix
•	Policies/Gates integration melhorada
•	Type hints mais estritos nos controllers
