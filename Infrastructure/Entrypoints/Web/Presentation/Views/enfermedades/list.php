<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Lista de enfermedades</h1>

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

<p>
    <a class="btn btn-primary" href="?route=enfermedades.create">+ Registrar enfermedad</a>
</p>

<?php if (empty($enfermedades)): ?>
    <p>No hay enfermedades registradas todavía.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Nombre Científico</th>
                <th>Nivel de Gravedad</th>
                <th>Contagiosa</th>
                <th>Cubierta por POS</th>
                <th>Requiere Incapacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enfermedades as $enfermedad): ?>
                <tr>
                    <td class="col-id"><?= htmlspecialchars($enfermedad->getId(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($enfermedad->getNombre(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><em><?= htmlspecialchars($enfermedad->getNombreCientifico(), ENT_QUOTES, 'UTF-8') ?></em></td>
                    <td><?= htmlspecialchars($enfermedad->getNivelGravedad(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= $enfermedad->getEsContagiosa() ? 'Sí' : 'No' ?></td>
                    <td><?= $enfermedad->getEsCubiertaPorPos() ? 'Sí' : 'No' ?></td>
                    <td><?= $enfermedad->getRequiereIncapacidad() ? 'Sí' : 'No' ?></td>
                    <td class="col-actions">
                        <a class="btn btn-sm" href="?route=enfermedades.show&id=<?= urlencode($enfermedad->getId()) ?>">Ver</a>
                        <a class="btn btn-warning btn-sm" href="?route=enfermedades.edit&id=<?= urlencode($enfermedad->getId()) ?>">Editar</a>
                        <form method="POST" action="?route=enfermedades.delete" style="display:inline;"
                            onsubmit="return confirmDelete(this);"
                            data-name="<?= htmlspecialchars($enfermedad->getNombre(), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($enfermedad->getId(), ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
