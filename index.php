<?php require_once('header.php'); ?>
<?php require_once('MyClass/Expe.php'); ?>
<?php use MyClass\Expe as truc; ?>

<?php
$pdo = new PDO('sqlite:data.db');
$query = $pdo->query('SELECT * FROM expe');
if ($query === false) {
    var_dump($pdo->errorInfo());
    die();
}
$query->setFetchMode(PDO::FETCH_CLASS,truc::class);
$expe = $query->fetchAll();
foreach ($expe as $ele) : ?>
<a href="edit.php?id=<?php echo $ele->id; ?>">
    <h1><?php echo $ele->name; ?></h1></a>
    <p><?php echo $ele->getResume(); ?></p>
    <p><?php echo "Réalisé le : ".$ele->getdate(); ?></p>
<?php endforeach; ?>

<?php require_once('footer.php'); ?>