<?php require_once('header.php'); ?>
<?php require_once('MyClass/Expe.php'); ?>

<?php
$error=null;
try {
$pdo = new PDO('sqlite:data.db');
//update
if(isset($_POST['name'],$_POST['content'])) {
    $query = $pdo->prepare('UPDATE expe SET name= :name, content= :content WHERE id= :id');
    $query->bindValue('name',$_POST['name'], PDO::PARAM_STR);
    $query->bindValue('content',$_POST['content'], PDO::PARAM_STR);
    $query->bindValue('id',$_GET['id'],PDO::PARAM_INT);
    $query->execute();
    
    //$query->execute(['name'=> $_POST['name'], 'content'=> $_POST['content'], 'id'=>$_GET['id']]);
}

//Select
$id = $pdo->quote($_GET['id']);
$query = $pdo->query('SELECT * FROM expe WHERE id=' . $id . '');
if ($query === false) {
    var_dump($pdo->errorInfo());
    die();
}
$query->setFetchMode(PDO::FETCH_CLASS, 'Expe');
$expe = $query->fetch();
}
catch(PDOException $e) {
$error = $e->getMessage();
}
?>
<?php if($error) : ?>
    <?php echo "Ma capture d'erreur : ".$error; ?>
<?php else : ?>
<form action="" method="post">
    <input type="text" name="name" id="name" value="<?php echo htmlentities($expe->name); ?>">
    <br><br>
    <textarea name="content" id="content" cols="30" rows="10"><?php echo htmlentities($expe->content); ?>
</textarea>
    <br><br>
    <button type="submit">Modifier</button>
</form>
<?php endif; ?>
<?php require_once('footer.php'); ?>