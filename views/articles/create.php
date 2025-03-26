<?php
if (!isset($_SESSION['USER_ID'])) {
    header("Location: /auth/login");
    exit();
}
?>
<div class="container">
    <h3>Objavi novico</h3>
    <form action="/articles/store" method="POST">
        <div class="form-group">
            <label for="title">Naslov</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="abstract">Povzetek</label>
            <textarea class="form-control" id="abstract" name="abstract" rows="2" required></textarea>
        </div>
        <div class="form-group">
            <label for="text">Besedilo</label>
            <textarea class="form-control" id="text" name="text" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Objavi</button>
    </form>
</div>