<?php include_once "session.php";?>
<?php
    if(!isset($_SESSION['username']) && !isset($_SESSION['pwrd'])){
        echo "<script>window.location.href='login-admin'</script>";
    }
    $formations = $data->getFormation();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            include_once "header.php";  
            include_once "style.php";
            include_once "scripts.php";
        ?>
        <title>Formations</title>
    </head>
    <body>
        <?php include_once "navbar-admin.php";?>
        <div class="container" id="div-push">
            <div class="text-center py-3">
                <h2><i class="fas fa-school"></i> Page Formations</h2>
            </div>
            <?php
                if(isset($_SESSION['status'])){
            ?>
            <div class='alert alert-success text-center mt-2' role='alert'><?php echo $_SESSION['status']?></div>
            <?php
                    unset($_SESSION['status']);
                }
            ?>
            <div class="mt-4 align-items-center text-center">
                <a href="ajouter-formation" target="_blank" class="btn btn-primary">
                    <i class="fas fa-plus-square"></i> Ajouter une formation
                </a>
            </div>
            <div class="mt-4 align-items-center d-flex justify-content-center">
                <input type="button" value="Français" class="btn btn-primary" onclick="frensh()">
                <input type="button" value="Arabe" class="btn btn-primary ml-3" onclick="arabe()">
            </div>
            <div id="frensh">
                <table class="table table-bordered mt-5 bg-white">
                    <thead class="text-center">
                        <tr>
                            <th scope="col" colspan="7">ARTL Nord</th>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Formation</th>
                            <th scope="col">Présentation</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Gestion</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                            if(empty($formations)){
                        ?>
                        <tr>
                            <th scope="row" colspan="7"><h2>Aucune formation n'est enregistrée veuillez ajouter une formation</h2></th>
                        </tr>
                        <?php
                            }else{
                                $i=1;
                                foreach($formations as $formation){
                        ?>
                        <tr>
                            <td class="row-style"><?php echo $i ?></td>          
                            <td class="row-style"><?php echo $formation['for_nom'] ?></td>
                            <td class="w-25  row-style"><?php echo $formation['for_pres']?></td>
                            <td class="row-style text-length2"><?php echo $formation['for_descr']?></td>
                            <td class="row-style"><img src="<?php echo $formation['for_image'] ?>" style='max-width: 5rem'></td>
                            <td class="row-style">
                                <a href="gestion-formation?id=<?php echo $formation['for_id'] ?>" target="_blank"> 
                                    Gérer la formation
                                </a>
                            </td>
                            <td class="row-style"> 
                                <div class="row">
                                    <div class="col-md-5">
                                        <a href="modifier-formation?id=<?php echo $formation['for_id'] ?>" target="_blank"> 
                                            <i class="fas fa-edit text-success awesome-size"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-5">
                                        <form action="" method="POST">
                                            <input type="hidden" name="formation_id" value="<?php echo $formation['for_id'] ?>">
                                            <button type="submit" class="btn-style" name="submit_formation" onclick='return confirm("Voulez-vous supprimer cette formation \nATTENTION!! tous les étudiants seront supprimés")'>
                                                <i class="fas fa-trash-alt text-danger awesome-size"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                                $i++;
                                }
                            }
                        ?>
                    </tbody>    
                </table>
                <br>
            </div>
            <div id="arabe" style="display:none;">
                <table class="table table-bordered bg-white mt-5">
                    <thead class="text-center">
                        <tr>
                            <th scope="col" colspan="10">الأكاديمية الجهوية للنقل واللوجستيك بجهة طنجة</th>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">التكوين</th>
                            <th scope="col">عرض التكوين</th>
                            <th scope="col">وصف التكوين</th>
                            <th scope="col">صورة</th>
                            <th scope="col">المتدربون</th>
                            <th scope="col">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                            if(empty($formations)){
                        ?>
                        <tr>
                            <th scope="row" colspan="7"><h2>لم يتم تسجيل أي تكوين يرجى إضافة تكوين جديد</h2></th>
                        </tr>
                        <?php
                            }else{
                                $i=1;
                                foreach($formations as $formation){
                        ?>
                        <tr>
                            <td class="row-style"><?php echo $i ?></td>          
                            <td class="row-style"><?php echo $formation['for_nom_arab'] ?></td>
                            <td class="w-25  row-style"><?php echo $formation['for_pres_arab']?></td>
                            <td class="row-style text-length2"><?php echo $formation['for_desc_arab']?></td>
                            <td class="row-style"><img src="<?php echo $formation['for_image'] ?>" style='max-width: 5rem'></td>
                            <td class="row-style">
                                <a href="les-etudiants?id=<?php echo $formation['for_id'] ?>" target="_blank"> 
                                    إدارة التدريب
                                </a>
                            </td>
                            <td class="row-style"> 
                                <div class="row">
                                    <div class="col-md-5">
                                        <a href="modifier-formation?id=<?php echo $formation['for_id'] ?>" target="_blank"> 
                                            <i class="fas fa-edit text-success awesome-size"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-5">
                                        <form action="" method="POST">
                                            <input type="hidden" name="formation_id" value="<?php echo $formation['for_id'] ?>">
                                            <button type="submit" class="btn-style" name="submit_formation" onclick='return confirm("Voulez-vous supprimer cette formation \nATTENTION!! tous les étudiants seront supprimés")'>
                                                <i class="fas fa-trash-alt text-danger awesome-size"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                                $i++;
                                }
                            }
                        ?>
                    </tbody>    
                </table>
            </div>
        </div>
    </body>
</html>
<?php
    if(isset($_POST['submit_formation'])){
        $data->deleteFormation($_POST['formation_id']);
    }
?>