<?php require __DIR__ . '/layouts/header.php'; ?>
<?php require __DIR__ . '/layouts/menu.php'; ?>

<h1>Menú principal del CRUDL de usuarios</h1>

<p>Desde aquí podrás acceder a las operaciones del sistema.</p>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<ul>
    <li><strong>C:</strong> <a href="?route=users.create">Registrar usuario</a></li>
    <li><strong>R:</strong> <a href="?route=users.index">Consultar usuario</a></li>
    <li><strong>U:</strong> <a href="?route=users.index">Actualizar usuario</a></li>
    <li><strong>D:</strong> <a href="?route=users.index">Eliminar usuario</a></li>
    <li><strong>L:</strong> <a href="?route=users.index">Listar usuarios</a></li>
</ul>

<?php require __DIR__ . '/layouts/footer.php'; ?>