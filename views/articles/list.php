<?php
// views/articles/list.php
if (!isset($_SESSION['USER_ID'])) {
    header("Location: /auth/login");
    exit();
}
?>
<div class="container">
    <h3>Moje novice</h3>
    <?php if (empty($articles)): ?>
        <p>Nimate še objavljenih novic.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($articles as $article): ?>
                <li class="list-group-item">
                    <h5><?php echo htmlspecialchars($article->title); ?></h5>
                    <p><?php echo htmlspecialchars($article->abstract); ?></p>
                    <small>Objavljeno: <?php echo $article->date; ?></small>
                    <br>
                    <a href="/articles/edit/<?php echo $article->id; ?>" class="btn btn-primary btn-sm mt-2">Uredi</a>
                    <a href="/articles/delete/<?php echo $article->id; ?>" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Ali res želite izbrisati to novico?');">Izbriši</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>