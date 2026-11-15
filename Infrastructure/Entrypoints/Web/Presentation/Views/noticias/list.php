<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Lista de noticias</h1>

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

<p><a class="btn" href="?route=noticias.create">+ Registrar nueva noticia</a></p>

<?php if (empty($noticias)): ?>
    <p>No hay noticias registradas todavía.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Categoría</th>
                <th>Fecha</th>
                <th>Ubicación</th>
                <th>Periodista</th>
                <th>Programa</th>
                <th>Público</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($noticias as $noticia): ?>
                <tr>
                    <td class="col-id"><?= htmlspecialchars($noticia->id(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($noticia->categoria(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($noticia->fechaEmision(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($noticia->ciudad() . ', ' . $noticia->pais(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($noticia->periodista(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($noticia->programaEmite(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($noticia->nivelPublico(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-actions">
                        <a class="btn btn-sm" href="?route=noticias.show&amp;id=<?= urlencode($noticia->id()) ?>">Ver</a>
                        <a class="btn btn-warning btn-sm" href="?route=noticias.edit&amp;id=<?= urlencode($noticia->id()) ?>">Editar</a>
                        <form method="POST" action="?route=noticias.delete" style="display:inline;"
                            onsubmit="return confirmDelete(this);"
                            data-name="<?= htmlspecialchars($noticia->categoria() . ' - ' . $noticia->periodista(), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($noticia->id(), ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>