<?php 
include_once 'etudiant.php';
include_once 'db.php';
$db = new DBController();
$data = new Etudiant($db);

if(isset($_POST['action'])){
    if ($_POST['action']=='add_comment') {
        $data->insertComment();
        $output = $data->getCommentsAjax();
        foreach ($data->getCommentsAjax() as $comment) {
            echo '<p class="pl-3 mt-3">
            <b>'.$comment['com_prenom'].' '.$comment['com_nom'].' </b> <br>
            <span style="color:#BBBBBB"> '.date("F j, Y",strtotime($comment['com_time'])).' </span> <br>
            <span class="pl-3"> '.$comment['com_comentaire'].'</span> </p>';
        }
    }
    if ($_POST['action']=='student_id') {
        $data->getEtudiantNotesAjax();
        $id = $_POST['id'];
        foreach ($data->getEtudiantNotesAjax() as $detail) {
            if($detail['etud_id'] == $id){
                $date= date("Y-m-d");
                $naissance = date("Y-m-d", strtotime($detail['etud_naissance']));
                $age = date_diff(date_create($detail['etud_naissance']), date_create($date));
                echo '<div class="container-fluid">
                        <div class="text-center">';
                            if($detail['etud_image'] === "./images/etudiants/"){
                                echo '<img src="images/etudiants/unknown_person.jpg"  class="card-image-2">';
                            }else{
                                echo '<img src="'.$detail['etud_image'].'" class="card-image-2">';
                            };
                        echo '</div>
                        <div class="text-center mt-5 mb-4 font-style">
                            <p>Formation: '.$detail['for_nom'].'</p>
                        </div>
                        <table class="table table-hover mt-5 font-style">
                            <tr>
                                <td>Nom</td>
                                <td>'.$detail['etud_nom'].'</td>
                            </tr>
                            <tr>
                                <td>Prénom</td>
                                <td>'.$detail['etud_prenom'].'</td>
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td>'.$age->format('%y').'</td>
                            </tr>
                            <tr>
                                <td>CIN</td>
                                <td>'.$detail['etud_cin'].'</td>
                            </tr>
                            <tr>
                                <td>Téléphone</td>
                                <td>0644776612</td>
                            </tr>
                            <tr>
                                <th>Note Générale</th>
                                <th>'.$detail['notegenerale'].'</th>
                            </tr>
                        </tr>
                        </table>
                        <div class="text-center font-style mt-4">
                            <a href="saisir_notes?id='.$detail['etud_id'].'" target="_blank" class="btn btn-primary">Saisir les notes</a>
                        </div>
                        <br>
                    </div>';
            }
        }
    }
    if ($_POST['action']=='add_message') {
        $data->insertContact();
        echo '<div class="alert alert-success text-center mt-2" role="alert" id="btn-fermer">Votre message a été envoyé avec succes <i class="fas fa-times font-close" onclick="fermer()"></i></div>';   
    }
    if ($_POST['action']=='add_reservation') {
        $data->insertReservation();
        echo '<div class="alert alert-success text-center mt-2" role="alert" id="btn-fermer">Votre réservation a été envoyé avec succes <i class="fas fa-times font-close2" onclick="fermer()"></i></div>';   
    }
    if ($_POST['action']=='add_reservation') {
        $data->insertReservation();
        echo '<div class="alert alert-success text-center mt-2" role="alert" id="btn-fermer">Votre réservation a été envoyé avec succes <i class="fas fa-times font-close2" onclick="fermer()"></i></div>';   
    }
    if ($_POST['action']=='search_student') {
        $data->getEtudiantNotesSearch();
        $i=1;
        foreach($data->getEtudiantNotesSearch() as $search){
            echo "<tr>
                <td>".$i++."</td>
                <td>".$search['for_nom']."</td>
                <td>".$search['etud_prenom']." ".$search['etud_nom']."</td>
                <td>
                    <a download=".$search['etud_diplome']." href=".$search['etud_diplome'].">";
                        if($search['etud_diplome'] == ''){
                        }else{
                            echo '<img src="images/PDF_file_icon.svg" style="width:30px">';
                        }
                    echo "</a>
                </td>
            </tr>";
        }
    }
}
/*if(isset($_GET['action'])){

}*/
?>