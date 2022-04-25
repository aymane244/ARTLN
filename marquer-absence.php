<?php include_once "session.php";?>
<?php
    if(!isset($_SESSION['username']) && !isset($_SESSION['pwrd'])){
        echo "<script>window.location.href='login-admin'</script>";
    }
    $etudiants = $data->getFormationMatiereEtudiant();
    $promos = $data->getPromotion();
    $seances = $data->getFormationMatiere();
    $formations = $data->getformation();
    $total_etudiants = $data->etudiantTotal();
    if(!isset($_GET['id'])){
        echo "<script>window.location.href='formations'</script>";
    }
    $id = $_GET['id'];
    foreach($seances as $seance){
        if($seance['mat_id'] == $id){
            $matiere_nom =  $seance['mat_nom'];
            $matiere_id =  $seance['mat_id'];
            $formation_nom =  $seance['for_nom'];
            $for_id =  $seance['for_id'];
       }
    }
    foreach($total_etudiants as $total_etudiant){
        if($total_etudiant['mat_id'] == $id){
            $total = $total_etudiant['total_etudiant'];
        }
    }
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
        <title>Absence</title>
    </head>
    <body>
        <?php include_once "navbar-admin.php";?>
            <div class="container" id="div-push">
                <div class="text-center py-3">
                    <h3><i class="fas fa-user-check"></i> Absence</h3>
                </div>
                <?php
                    if(isset($_SESSION['status'])){
                ?>
                <div class='alert alert-success text-center mt-2' role='alert'><?php echo $_SESSION['status']?></div>
                <?php
                        unset($_SESSION['status']);
                    }
                ?>
                <div class="text-center py-3">
                    <h2><?php echo $formation_nom ?></h2>
                </div>
                <div class="mt-4">
                    <form action="" method="POST">
                        <div class="row pt-3 justify-content-center">
                            <div class="col-md-6">
                                <div class="d-flex jutify-content-center">
                                    <i class="fas fa-folder-open position-awesome"></i>
                                    <select class="custom-select px-5" name="promotion">
                                        <option selected value="">--Choisir promotion--</option>
                                        <?php
                                            foreach($promos as $promo){
                                        ?>
                                        <option value="<?php echo $promo['pro_id'] ?>"><?php echo $promo['pro_année'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary ml-3" name="promotion_submit">Valider</button>
                                </div>         
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                    if(isset($_SESSION['status_error'])){
                ?>
                <div class='alert alert-danger text-center mt-2' role='alert'><?php echo $_SESSION['status_error']?></div>
                <?php
                        unset($_SESSION['status_error']);
                    }
                ?>
                <form action="" method="POST">
                    <div class="text-center py-3">
                        <input type="hidden" value="<?php echo $for_id?>" name="absence_formation">
                    </div>
                    <div class="d-flex justify-content-around mt-3">
                        <h2><?php echo $matiere_nom?></h2>
                        <input type="hidden" value="<?php echo $matiere_id?>" name="absence_matiere">
                        <div class="d-flex">
                            <i class="fas fa-calendar position-awesome"></i>
                            <input id="absence_date" type="date" class="form-control pl-5" name="absence_date" autofocus>
                        </div>
                    </div>
                    <table class="table table-bordered mt-5 bg-white">
                        <thead class="text-center">
                            <tr>
                                <th scope="col" colspan="5">ARTL Nord</th>
                            </tr>
                            <tr>
                                <th scope="col">Etudiants</th>
                                <th scope="col">Actions</th>
                            </tr>
                            <tr>
                                <?php
                                    if(isset($_POST['promotion_submit'])){
                                        if($_POST['promotion'] == ''){
                                ?>
                                <th scope="col" colspan="5">
                                    Total etudiants: 0
                                    <input type="hidden" value="<?php echo $total?>" name="number_etudiant">
                                </th>
                                <?php
                                        }else{
                                            foreach($total_etudiants as $total_etudiant){
                                                if($total_etudiant['mat_id'] == $id){
                                                    if($total_etudiant['etud_promos'] != $_POST['promotion']){
                                ?>
                                <th scope="col" colspan="5">
                                    Total etudiants: 0
                                    <input type="hidden" value="<?php echo $total?>" name="number_etudiant">
                                </th>
                                <?php
                                                    }else{
                                ?>
                                <th scope="col" colspan="5">
                                    Total etudiants: <?php echo $total?>
                                    <input type="hidden" value="<?php echo $total_etudiant['total_etudiant']?>" name="number_etudiant">
                                </th>
                                <?php
                                                    }
                                                }
                                            }
                                        }
                                    }else{
                                ?>
                                <th scope="col" colspan="5">
                                    Total etudiants: 0
                                    <input type="hidden" value="<?php echo $total?>" name="number_etudiant">
                                </th>
                                <?php
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                                if(isset($_POST['promotion_submit'])){
                                    if(is_array($etudiants) || is_object($etudiants)){
                                        foreach($etudiants as $etudiant){
                                            if($etudiant['mat_id'] == $id){
                            ?>
                            <tr>      
                                <td>
                                    <?php echo $etudiant['etud_nom']." ".$etudiant['etud_prenom'] ?> 
                                    <input type="hidden" value="<?php echo $etudiant['etud_id']?>" name="absence_etudiant[]">
                                </td>
                                <td>
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="d-flex">
                                                <i class="fas fa-user-check position-awesome"></i>
                                                <select class="custom-select pl-5" name="absence[]" id="absence">
                                                    <option selected value="Présent">Présent</option>
                                                    <option value="Absent">Absent</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            <?php
                                            }
                                        }
                                    }
                            ?>
                            <tr>
                                <td colspan="5">
                                    <div class="text-center py-3">
                                        <button class="btn btn-primary" type="submit" name="absence_submit">Valider</button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                }else{
                            ?>
                            <tr>
                                <th scope="col" colspan="5"><h1> Veuillez choisir une promotion</h1></th>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>    
                    </table>
                </form>
            </div>
    </body>
</html>
<?php
    if(isset($_POST['absence_submit'])){
        $data->insertAbsence();
    }
?>