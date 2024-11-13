<?php
    include '../../../util/conexion.php';

    $id_rent = $_POST['rent_id'];
    $sql = "DELETE FROM alquileres WHERE id=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("i",$id_rent);

    if($stmt->execute()){
        if($stmt->affected_rows>0){echo "exitoso";}else{echo "no se encontro el usuario con este id";}
    }else{
        echo "Error".$stmt->error;
    }

    $stmt->close();
    $conn->close();
?>