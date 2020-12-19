<h1>Привет</h1>
<h2><?= $name; ?></h2>
<h2><?= $age; ?></h2>

<?php foreach ($posts as $post): ?>
    <h3><?= $post['id'] ?></h3>
    <h3><?= $post['title'] ?></h3>
<?php endforeach; ?>
