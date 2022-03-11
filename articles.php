<?php
    include_once "header.php";
    include_once "navbar_admin.php";
    $data = new Etudiant($db);
    if(!isset($_SESSION['username']) && !isset($_SESSION['pwrd'])){
        echo "<script>window.location.href='login_admin'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<?php
    $articles = $data->getArticle();
?>
<body>
    <div class="container" id="div-push">
        <?php
            if(isset($_SESSION['status'])){
        ?>
        <div class='alert alert-success text-center mt-2' role='alert'><?php echo $_SESSION['status']?></div>
        <?php
                unset($_SESSION['status']);
            }
        ?>
        <div class="text-center my-3">
            <h2><i class="fas fa-newspaper"></i> Page Articles</h2>
        </div>
        <div class="mt-4 text-center">
            <a href="ajouter-article" target="_blank" class="btn btn-primary"><i class="fas fa-plus-square"></i> Ajouter un article</a>
        </div>
        <table class="table table-hover table-bordered mt-5">
            <thead class="text-center">
                <tr>
                    <th scope="col" colspan="9">ARTL Nord</th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Texte</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=1;
                    foreach($articles as $article){
                ?>
                <tr>
                    <th scope="row"><?php echo $i++ ?></th>
                    <td><?php echo $article['art_titre'];?></td>
                    <td class="w-50 text-length2"><?php echo $article['art_texte'];?></td>
                    <td class="row-style"> <img src="<?php echo $article['art_image']?>" alt="" class="img-fluid" style="max-width:200px"> </td>
                    <td class="row-style">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="modifier_articles?id=<?php echo $article['art_id'] ?>" target="_blank">
                                    <i class="fas fa-edit text-success awesome-size pr-lg-2"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="" method="POST">
                                    <input type="hidden" name="article_id" value="<?php echo $article['art_id']?>">
                                    <button type="submit" class="btn-style" name="submit" onclick='return confirm("Voulez-vous supprimer ce message")'>
                                        <i class="fas fa-trash-alt text-danger awesome-size"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
    if(isset($_POST['submit'])){
        $data->deleteArticle($_POST['article_id']);
    }
?>