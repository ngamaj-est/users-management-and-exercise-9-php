<?php require __DIR__ . '/layouts/header.php'; ?>
<?php require __DIR__ . '/layouts/menu.php'; ?>

<h1>Menú principal del sistema</h1>

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
    <li><a class="btn" href="?route=users.index">Listar usuarios</a></li>
    <br>
    <li><a class="btn" href="?route=enfermedades.index">Listar enfermedades</a></li>
</ul>

<?php require __DIR__ . '/layouts/footer.php'; ?>
