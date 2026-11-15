<?php

declare(strict_types=1);

// Guardia de seguridad: bloquear acceso directo a archivos/carpetas 
// El .htaccess redirige internamente cualquier URL que no sea public/ hacia aquí.
// Detectamos ese caso comparando la URL solicitada con la ruta pública esperada.

(function (): void {
    $requestPath = rtrim(
        (string) parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH),
        '/'
    );
    // dirname de /crud-usuarios/public/index.php  →  /crud-usuarios/public
    $publicBase = rtrim(dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/index.php')), '/');

    // Si la URL pedida no comienza con /…/public/, fue un acceso directo indebido.
    if ($requestPath !==$publicBase && !str_starts_with($requestPath,$publicBase . '/')) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $dest = isset($_SESSION['auth']['id']) ? 'home' : 'auth.login';
        header('Location: ' . $publicBase . '/index.php?route=' . $dest);
        exit;
    }
})();

require_once __DIR__ . '/../Common/ClassLoader.php';
require_once __DIR__ . '/../Common/DependencyInjection.php';
require_once __DIR__ . '/../Infrastructure/Entrypoints/Web/Presentation/View.php';
require_once __DIR__ . '/../Infrastructure/Entrypoints/Web/Presentation/Flash.php';

DependencyInjection::boot();
Flash::start();

// ──────────────────────────────────────────────────────────────
// Auth helpers
// ──────────────────────────────────────────────────────────────

function isLoggedIn(): bool
{
    return isset($_SESSION['auth']['id']);
}

function requireAuth(): void
{
    if (!isLoggedIn()) {
        Flash::setMessage('Debes iniciar sesión para acceder a esta sección.');
        View::redirect('auth.login');
    }
}

function getLoggedUser(): array
{
    return is_array($_SESSION['auth'] ?? null) ? $_SESSION['auth'] : array();
}

// ──────────────────────────────────────────────────────────────
// Routing
// ──────────────────────────────────────────────────────────────

$route = isset($_GET['route']) ? trim((string) $_GET['route']) : 'home';$routes = WebRoutes::routes();

if (!isset($routes[$route])) {
    http_response_code(404);
    View::render('home', buildHomeViewData('Ruta no encontrada.'));
    exit;
}

$definition = $routes[$route];
$httpMethod = strtoupper((string)$_SERVER['REQUEST_METHOD']);

if ($httpMethod !==$definition['method']) {
    http_response_code(405);
    View::render('home', buildHomeViewData('Método HTTP no permitido.'));
    exit;
}

// Protect all user & noticias management routes behind authentication.
$publicActions = array('home', 'login', 'authenticate', 'logout', 'forgot', 'forgot.send', 'create', 'store');
if (!in_array($definition['action'],$publicActions, true) && !isLoggedIn()) {
    Flash::setMessage('Debes iniciar sesión para acceder a esta sección.');
    View::redirect('auth.login');
}

try {
    switch ($definition['action']) {

        case 'home':
            View::render('home', buildHomeViewData());
            break;

        // ── Usuarios ──────────────────────────────────────────

        case 'create':
            View::render('users/create', buildCreateUserViewData());
            break;

        case 'store':
            $controller = DependencyInjection::getUserController();
            $form = getCreateUserFormData();$form['id'] = generateUuid4();
            $errors = validateCreateUserForm($form);

            if (!empty($errors)) {
                Flash::setOld($form);
                Flash::setErrors($errors);
                Flash::setMessage('Corrige los errores del formulario.');
                View::redirect('users.create');
            }

            $request = new CreateUserWebRequest($form['id'],
                $form['name'],$form['email'],
                $form['password'],$form['role']
            );

            $controller->store($request);

            Flash::setSuccess('Usuario registrado correctamente.');
            View::redirect('users.index');
            break;

        case 'index':
            $controller = DependencyInjection::getUserController();
            $users =$controller->index();
            View::render('users/list', buildListUsersViewData($users));
            break;

        case 'show':
            $controller = DependencyInjection::getUserController();
            $id = isset($_GET['id']) ? trim((string) $_GET['id']) : '';$user = $controller->show($id);
            View::render('users/show', array(
                'pageTitle' => 'Detalle de usuario',
                'user' => $user,
                'message' => Flash::message(),
            ));
            break;

        case 'edit':
            $controller = DependencyInjection::getUserController();
            $id = isset($_GET['id']) ? trim((string) $_GET['id']) : '';$user = $controller->show($id);
            View::render('users/edit', buildEditUserViewData($user));
            break;

        case 'update':
            $controller = DependencyInjection::getUserController();$form = getUpdateUserFormData();
            $errors = validateUpdateUserForm($form);

            if (!empty($errors)) {
                Flash::setOld($form);
                Flash::setErrors($errors);
                Flash::setMessage('Corrige los errores del formulario.');
                header('Location: ?route=users.edit&id=' . urlencode($form['id']));
                exit;
            }

            $request = new UpdateUserWebRequest(
                $form['id'],$form['name'],
                $form['email'],$form['password'],
                $form['role'],$form['status']
            );

            $controller->update($request);

            Flash::setSuccess('Usuario actualizado correctamente.');
            View::redirect('users.index');
            break;

        case 'delete':
            $controller = DependencyInjection::getUserController();$id = isset($_POST['id']) ? trim((string) $_POST['id']) : '';
            $controller->delete($id);
            Flash::setSuccess('Usuario eliminado correctamente.');
            View::redirect('users.index');
            break;

        // ── Noticias (Ejercicio 29) ───────────────────────────

        case 'noticias.create':
            View::render('noticias/create', buildCreateNoticiaViewData());
            break;

        case 'noticias.store':
            $controller = DependencyInjection::getNoticiaController();
            $form = getNoticiaFormData();$form['id'] = generateUuid4();
            $errors = validateNoticiaForm($form);

            if (!empty($errors)) {
                Flash::setOld($form);
                Flash::setErrors($errors);
                Flash::setMessage('Corrige los errores del formulario de noticia.');
                View::redirect('noticias.create');
            }

            $request = new CreateNoticiaWebRequest($form['id'],
                $form['categoria'],$form['fecha'],
                $form['pais'],$form['departamento'],
                $form['ciudad'],$form['periodista'],
                $form['programaEmite'],$form['fechaEmision'],
                $form['descripcion'],$form['nivelPublico']
            );

            $controller->store($request);
            Flash::setSuccess('Noticia registrada correctamente.');
            View::redirect('noticias.index');
            break;

        case 'noticias.index':
            $controller = DependencyInjection::getNoticiaController();
            $noticias = $controller->index();
            View::render('noticias/list', buildListNoticiasViewData($noticias));
            break;

        case 'noticias.show':
            $controller = DependencyInjection::getNoticiaController();$id = isset($_GET['id']) ? trim((string) $_GET['id']) : '';
            $noticia = $controller->show($id);
            View::render('noticias/show', array(
                'pageTitle' => 'Detalle de noticia',
                'noticia' => $noticia,
                'message' => Flash::message(),
            ));
            break;

        case 'noticias.edit':
            $controller = DependencyInjection::getNoticiaController();$id = isset($_GET['id']) ? trim((string) $_GET['id']) : '';
            $noticia = $controller->show($id);
            View::render('noticias/edit', buildEditNoticiaViewData($noticia));
            break;

        case 'noticias.update':
            $controller = DependencyInjection::getNoticiaController();
            $form = getNoticiaFormData();$form['id'] = isset($_POST['id']) ? trim((string) $_POST['id']) : '';
            $errors = validateNoticiaForm($form);

            if (!empty($errors)) {
                Flash::setOld($form);
                Flash::setErrors($errors);
                Flash::setMessage('Corrige los errores del formulario de noticia.');
                header('Location: ?route=noticias.edit&id=' . urlencode($form['id']));
                exit;
            }

            $request = new UpdateNoticiaWebRequest($form['id'],
                $form['categoria'],$form['fecha'],
                $form['pais'],$form['departamento'],
                $form['ciudad'],$form['periodista'],
                $form['programaEmite'],$form['fechaEmision'],
                $form['descripcion'],$form['nivelPublico']
            );

            $controller->update($request);
            Flash::setSuccess('Noticia actualizada correctamente.');
            View::redirect('noticias.index');
            break;

        case 'noticias.delete':
            $controller = DependencyInjection::getNoticiaController();$id = isset($_POST['id']) ? trim((string) $_POST['id']) : '';
            $controller->delete($id);
            Flash::setSuccess('Noticia eliminada correctamente.');
            View::redirect('noticias.index');
            break;

        // ── Autenticación ─────────────────────────────────────

        case 'login':
            if (isLoggedIn()) {
                View::redirect('home');
            }
            View::render('auth/login', array(
                'pageTitle' => 'Iniciar sesión',
                'message' => Flash::message(),
                'errors' => Flash::errors(),
                'old' => Flash::old(),
            ));
            break;

        case 'authenticate':
            $email = trim(strtolower((string) ($_POST['email'] ?? '')));$password = (string) ($_POST['password'] ?? '');$authErrors = array();

            if ($email === '') {$authErrors['email'] = 'El correo es obligatorio.';
            }
            if ($password === '') {$authErrors['password'] = 'La contraseña es obligatoria.';
            }

            if (!empty($authErrors)) {
                Flash::setErrors($authErrors);
                Flash::setOld(array('email' => $email));
                View::redirect('auth.login');
            }

            $loginUseCase = DependencyInjection::getLoginUseCase();
            $command = new LoginCommand($email, $password);$user = $loginUseCase->execute($command);

            $_SESSION['auth'] = array(
                'id' => $user->id()->value(),
                'name' => $user->name()->value(),
                'email' => $user->email()->value(),
                'role' => $user->role(),
            );

            Flash::setSuccess('Bienvenido/a, ' . $user->name()->value() . '.');
            View::redirect('home');
            break;

        case 'logout':
            session_destroy();
            header('Location: ?route=auth.login');
            exit;

        case 'forgot':
            View::render('auth/forgot-password', array(
                'pageTitle' => 'Recuperar contraseña',
                'message' => Flash::message(),
                'success' => Flash::success(),
                'errors' => Flash::errors(),
                'old' => Flash::old(),
            ));
            break;

        case 'forgot.send':
            $forgotEmail = trim(strtolower((string) ($_POST['email'] ?? '')));

            if ($forgotEmail === '' \vert{}\vert{} !filter_var($forgotEmail, FILTER_VALIDATE_EMAIL)) {
                Flash::setErrors(array('email' => 'Introduce un correo electrónico válido.'));
                Flash::setOld(array('email' => $forgotEmail));
                View::redirect('auth.forgot');
            }

            $repository = DependencyInjection::getUserRepository();$foundUser = $repository->getByEmail(new UserEmail($forgotEmail));

            // Always show generic success to avoid user enumeration.
            if ($foundUser !== null &&$foundUser->status() === UserStatusEnum::ACTIVE) {
                $tempPassword = bin2hex(random_bytes(5));$newPassword = UserPassword::fromPlainText($tempPassword);$updatedUser = $foundUser->changePassword($newPassword);
                $repository->update($updatedUser);

                sendPasswordRecoveryEmail(
                    $foundUser->email()->value(),
                    $foundUser->name()->value(),$tempPassword
                );
            }

            Flash::setSuccess(
                'Si el correo está registrado y la cuenta está activa, ' .
                'recibirás un mensaje con tu contraseña temporal.'
            );
            View::redirect('auth.forgot');
            break;

        default:
            throw new RuntimeException('Acción no soportada.');
    }
} catch (Throwable $exception) {
    $msg =$exception->getMessage();
    Flash::setMessage($msg);

    switch ($route) {
        case 'users.store':
            Flash::setOld(getCreateUserFormData());
            View::redirect('users.create');
            break;

        case 'users.update':
            $updateId = trim((string) ($_POST['id'] ?? ''));
            Flash::setOld(getUpdateUserFormData());
            header('Location: ?route=users.edit&id=' . urlencode($updateId));
            exit;

        case 'noticias.store':
            Flash::setOld(getNoticiaFormData());
            View::redirect('noticias.create');
            break;

        case 'noticias.update':
            $updateId = trim((string) ($_POST['id'] ?? ''));
            Flash::setOld(getNoticiaFormData());
            header('Location: ?route=noticias.edit&id=' . urlencode($updateId));
            exit;

        case 'noticias.show':
        case 'noticias.edit':
        case 'noticias.delete':
            View::redirect('noticias.index');
            break;

        case 'auth.authenticate':
            Flash::setOld(array('email' => trim(strtolower((string) ($_POST['email'] ?? '')))));
            View::redirect('auth.login');
            break;

        case 'auth.forgot.send':
            Flash::setOld(array('email' => trim((string) ($_POST['email'] ?? ''))));
            View::redirect('auth.forgot');
            break;

        case 'users.show':
        case 'users.edit':
            View::redirect('users.index');
            break;

        case 'users.delete':
            Flash::setMessage($msg);
            View::redirect('users.index');
            break;

        default:
            View::render('home', buildHomeViewData($msg));
            break;
    }
}

function sendPasswordRecoveryEmail(string $email, string $name, string$tempPassword): void
{
    $templateFile = __DIR__ . '/../Infrastructure/Entrypoints/Web/Presentation/Views/emails/forgot-password.php';

    ob_start();
    extract(array('email' => $email, 'name' => $name, 'tempPassword' =>$tempPassword), EXTR_SKIP);
    require $templateFile;
    $htmlBody = (string) ob_get_clean();

    ClassLoader::loadClass('EmailDestinationModel');

    $destination = new EmailDestinationModel(
        $email,$name,
        'Recuperación de contraseña',
        $htmlBody
    );

    DependencyInjection::getEmailSenderService()->send($destination);
}

/**
 * @param UserResponse[] $users
 * @return array<string, mixed>
 */
function buildListUsersViewData(array $users): array
{
    return array(
        'pageTitle' => 'Lista de usuarios',
        'users' => $users,
        '