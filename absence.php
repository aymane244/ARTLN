<?php
    include_once "header.php";
    include_once "navbar_admin.php";
    $data = new Etudiant($db);
    if(!isset($_SESSION['username']) && !isset($_SESSION['pwrd'])){
        echo "<script>window.location.href='login_admin'</script>";
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absence</title>
</head>
<?php
    $etudiants = $data->getEtudiantFormationID();
    $seances = $data->getFormationMatiere();
    $formations = $data->getformation();
    $states = $data->getabsence();
    $id = $_GET['id'];
    foreach($formations as $formations){
        if($formations['for_id'] == $id){
           $formation_nom =  $formations['for_nom'];
           $formation_id =  $formations['for_id'];
        }
    }


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
            <h2><i class="fas fa-user-check"></i> Page Absence</h2>
        </div>
        <div class="d-flex justify-content-center my-3">
            <?php
                foreach($seances as $seance){
                    if($seance['for_id'] == $id){
            ?>
            <a class="btn btn-primary btn-id mx-3" href="gerer-absence?id=<?php echo $seance['mat_id'] ?>" target="_blank"><?php echo $seance['mat_nom'] ?></a>
            <?php
                }
            }
            ?>
        </div>
        <div class="text-center">
            <h2 class=" pt-3"><i class="fas fa-user-check"></i> Etat d'absence</h2>
        </div>
        <form action="" method="POST">
            <div class="row pt-3">
                <div class="col-md-6">
                    <div class="d-flex">
                        <i class="fas fa-folder-open position-awesome"></i>
                        <select class="custom-select px-5" name="get_matiere">
                            <option selected value="">--Choisir votre matiere--</option>
                            <?php
                                foreach($seances as $seance){
                                    if($seance['for_id'] == $id){
                            ?>
                            <option value="<?php echo $seance['mat_id'] ?>"><?php echo $seance['mat_nom'] ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex">
                        <i class="fas fa-calendar position-awesome"></i>
                        <input id="absence_date" type="date" class="form-control pl-5" name="absence_date" autofocus required>
                        <button type="submit" class="btn btn-primary ml-3" name="absence_submit">Filtrer</button>
                    </div>
                </div>
            </div>
        </form>
        <hr style="background-color: #DEE2E6;">
        <table class="table table-bordered mt-3">
            <thead class="text-center">
                <tr>
                    <th scope="col" colspan="5">ARTL Nord</th>
                </tr>
                <tr>
                    <th scope="col">Etudiants</th>
                    <th scope="col">Etat d'absence</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                    if(isset($_POST['absence_submit'])){
                        foreach($states as $state){
                ?>
                <tr>      
                    <td><?php echo $state['etud_nom']." ".$state['etud_prenom'] ?> </td>
                    <td><?php echo $state['abs_absence'] ?></td>
                    <td><?php echo $state['abs_date'] ?></td>
                </tr>
                <?php
                        }
                    }else{
                        echo 'no data';
                    }
                ?>
            </tbody>    
        </table>
    </div>
</body>
</html>