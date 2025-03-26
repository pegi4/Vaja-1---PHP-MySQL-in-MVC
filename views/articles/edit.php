<?php
// views/articles/edit.php
if (!isset($_SESSION['USER_ID'])) {
    header("Location: /auth/login");
    exit();
}
if (!isset($article)) {
    header("Location: /articles/list");
    exit();
}
?>
<div class="container">
    <h3>Uredi novico</h3>
    <form action="/articles/update" method="POST">
        <input type="hidden" name="id" value="<?php echo $article->id; ?>">
        <div class="form-group">
            <label for="title">Naslov</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($article->title); ?>" required>
        </div>
        <div class="form-group">
            <label for="abstract">Povzetek</label>
            <textarea class="form-control" id="abstract" name="abstract" rows="2" required><?php echo htmlspecialchars($article->abstract); ?></textarea>
        </div>
        <div class="form-group">
            <label for="text">Besedilo</label>
            <textarea class="form-control" id="text" name="text" rows="5" required><?php echo htmlspecialchars($article->text); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Shrani spremembe</button>
        <a href="/articles/list" class="btn btn-secondary">Prekliči</a>
    </form>
</div>