<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Editar noticia</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form method="POST" action="?route=noticias.update">
    <input type="hidden" name="id" value="<?= htmlspecialchars($noticia->id(), ENT_QUOTES, 'UTF-8') ?>">

    <div>
        <label for="categoria">Categoría:</label><br>
        <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($old['categoria'] ?? $noticia->categoria(), ENT_QUOTES, 'UTF-8') ?>" required>
    </div><br>

    <div>
        <label for="fecha">Fecha del suceso:</label><br>
        <input type="date" id="fecha" name="fecha" value="<?= htmlspecialchars($old['fecha'] ?? $noticia->fecha(), ENT_QUOTES, 'UTF-8') ?>" required>
    </div><br>

    <div>
        <label for="pais">País:</label><br>
        <input type="text" id="pais" name="pais" value="<?= htmlspecialchars($old['pais'] ?? $noticia->pais(), ENT_QUOTES, 'UTF-8') ?>" required>
    </div><br>

    <div>
        <label for="departamento">Departamento:</label><br>
        <input type="text" id="departamento" name="departamento" value="<?= htmlspecialchars($old['departamento'] ?? $noticia->departamento(), ENT_QUOTES, 'UTF-8') ?>" required>
    </div><br>

    <div>
        <label for="ciudad">Ciudad:</label><br>
        <input type="text" id="ciudad" name="ciudad" value="<?= htmlspecialchars($old['ciudad'] ?? $noticia->ciudad(), ENT_QUOTES, 'UTF-8') ?>" required>
    </div><br>

    <div>
        <label for="periodista">Periodista:</label><br>
        <input type="text" id="periodista" name="periodista" value="<?= htmlspecialchars($old['periodista'] ?? $noticia->periodista(), ENT_QUOTES, 'UTF-8') ?>" required>
    </div><br>

    <div>
        <label for="programaEmite">Programa que emite:</label><br>
        <input type="text" id="programaEmite" name="programaEmite" value="<?= htmlspecialchars($old['programaEmite'] ?? $noticia->programaEmite(), ENT_QUOTES, 'UTF-8') ?>" required>
    </div><br>

    <div>
        <label for="fechaEmision">Fecha de emisión:</label><br>
        <input type="date" id="fechaEmision" name="fechaEmision" value="<?= htmlspecialchars($old['fechaEmision'] ?? $noticia->fechaEmision(), ENT_QUOTES, 'UTF-8') ?>" required>
    </div><br>

    <div>
        <label for="nivelPublico">Nivel de público:</label><br>
        <select id="nivelPublico" name="nivelPublico" required>
            <?php $selectedNivel = $old['nivelPublico'] ?? $noticia->nivelPublico(); ?>
            <?php foreach ($nivelOptions as $option): ?>
                <option value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>" <?= ($selectedNivel === $option) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div><br>

    <div>
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50" required><?= htmlspecialchars($old['descripcion'] ?? $noticia->descripcion(), ENT_QUOTES, 'UTF-8') ?></textarea>
    </div><br>

    <button type="submit" class="btn">Actualizar noticia</button>
    <a class="btn btn-warning" href="?route=noticias.index">Cancelar</a>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>