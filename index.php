<?php

declare(strict_types=1);

require __DIR__ . '/db.php';

session_start();
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

$errors = [];
$editingUser = null;
$allowedRoles = ['Member', 'Admin', 'Editor'];

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function redirectWithMessage(string $message): never
{
    $_SESSION['message'] = $message;
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        http_response_code(403);
        exit('Invalid form token.');
    }

    $action = $_POST['action'] ?? '';
    if ($action === 'delete') {
        $statement = $database->prepare('DELETE FROM users WHERE id = :id');
        $statement->execute(['id' => (int) ($_POST['id'] ?? 0)]);
        redirectWithMessage('User deleted successfully.');
    }

    $name = trim((string) ($_POST['name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $role = (string) ($_POST['role'] ?? 'Member');
    $id = (int) ($_POST['id'] ?? 0);

    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }
    if (!in_array($role, $allowedRoles, true)) {
        $errors[] = 'Select a valid role.';
    }

    if (!$errors) {
        try {
            if ($action === 'create') {
                $statement = $database->prepare('INSERT INTO users (name, email, role) VALUES (:name, :email, :role)');
                $statement->execute(['name' => $name, 'email' => $email, 'role' => $role]);
                redirectWithMessage('User created successfully.');
            }

            if ($action === 'update') {
                $statement = $database->prepare('UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id');
                $statement->execute(['name' => $name, 'email' => $email, 'role' => $role, 'id' => $id]);
                redirectWithMessage('User updated successfully.');
            }
        } catch (PDOException $exception) {
            $errors[] = $exception->getCode() === '23000' ? 'That email is already registered.' : 'The database could not save this user.';
        }
    }

    if ($action === 'update') {
        $editingUser = ['id' => $id, 'name' => $name, 'email' => $email, 'role' => $role];
    }
}

if (isset($_GET['edit'])) {
    $statement = $database->prepare('SELECT id, name, email, role FROM users WHERE id = :id');
    $statement->execute(['id' => (int) $_GET['edit']]);
    $editingUser = $statement->fetch() ?: null;
}

$users = $database->query('SELECT id, name, email, role, created_at FROM users ORDER BY id DESC')->fetchAll();
$message = $_SESSION['message'] ?? null;
unset($_SESSION['message']);
$isEditing = is_array($editingUser);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Directory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="shell">
        <header class="page-header">
            <div>
                <p class="eyebrow">TEAM ADMINISTRATION</p>
                <h1>User directory</h1>
                <p class="subtitle">Create, update, and remove account records from one focused workspace.</p>
            </div>
            <div class="stat"><strong><?= count($users) ?></strong><span>total users</span></div>
        </header>

        <?php if ($message): ?><div class="notice success"><?= escape($message) ?></div><?php endif; ?>
        <?php foreach ($errors as $error): ?><div class="notice error"><?= escape($error) ?></div><?php endforeach; ?>

        <section class="content-grid">
            <form class="panel form-panel" method="post">
                <div class="panel-heading"><span class="step">01</span><div><h2><?= $isEditing ? 'Edit user' : 'Add a user' ?></h2><p><?= $isEditing ? 'Keep this profile current.' : 'Create a new directory profile.' ?></p></div></div>
                <input type="hidden" name="csrf" value="<?= escape($_SESSION['csrf']) ?>">
                <input type="hidden" name="action" value="<?= $isEditing ? 'update' : 'create' ?>">
                <?php if ($isEditing): ?><input type="hidden" name="id" value="<?= (int) $editingUser['id'] ?>"><?php endif; ?>
                <label>Full name<input name="name" value="<?= escape($editingUser['name'] ?? '') ?>" placeholder="e.g. Alex Morgan" required></label>
                <label>Email address<input type="email" name="email" value="<?= escape($editingUser['email'] ?? '') ?>" placeholder="alex@example.com" required></label>
                <label>Role<select name="role"><?php foreach ($allowedRoles as $role): ?><option <?= ($editingUser['role'] ?? 'Member') === $role ? 'selected' : '' ?>><?= $role ?></option><?php endforeach; ?></select></label>
                <div class="form-actions"><button class="button primary" type="submit"><?= $isEditing ? 'Save changes' : 'Create user' ?></button><?php if ($isEditing): ?><a class="button secondary" href="index.php">Cancel</a><?php endif; ?></div>
            </form>

            <section class="panel directory-panel">
                <div class="panel-heading"><span class="step">02</span><div><h2>Directory</h2><p><?= count($users) ? 'Your current user records.' : 'Your new records will appear here.' ?></p></div></div>
                <?php if (!$users): ?><div class="empty">No users yet. Add the first profile using the form.</div><?php else: ?>
                <div class="table-wrap"><table><thead><tr><th>User</th><th>Role</th><th>Joined</th><th class="actions-heading">Actions</th></tr></thead><tbody>
                <?php foreach ($users as $user): ?><tr><td><strong><?= escape($user['name']) ?></strong><small><?= escape($user['email']) ?></small></td><td><span class="badge <?= strtolower($user['role']) ?>"><?= escape($user['role']) ?></span></td><td><?= escape(date('M j, Y', strtotime($user['created_at']))) ?></td><td class="actions"><a href="?edit=<?= (int) $user['id'] ?>" aria-label="Edit <?= escape($user['name']) ?>">Edit</a><form method="post" onsubmit="return confirm('Delete this user?');"><input type="hidden" name="csrf" value="<?= escape($_SESSION['csrf']) ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int) $user['id'] ?>"><button type="submit">Delete</button></form></td></tr><?php endforeach; ?></tbody></table></div>
                <?php endif; ?>
            </section>
        </section>
        <footer>PDO SQLite is enabled automatically. Database: <code>data/users.sqlite</code></footer>
    </main>
</body>
</html>