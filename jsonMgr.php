<?php
/**
 * Created by PhpStorm.
 * User: Francisco
 * Date: 08-07-16
 * Time: 11:35 AM
 */
    require 'db/connection.php';

    $today = date("dmY");

    $url2 = 'http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?fecha=02022014&ticket=F8537A18-6766-4DEF-9E59-426B4FEE2844';
    $url = 'http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?fecha='.$today.'&ticket=F8537A18-6766-4DEF-9E59-426B4FEE2844';
    $url3 = 'http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?fecha=10072016&ticket=F8537A18-6766-4DEF-9E59-426B4FEE2844';

    $obj = json_decode(file_get_contents($url), true);

/*    $output = "<ul>";
    foreach($obj['Listado'] as $tender){
        $output .= "<h4>".$tender['CodigoExterno']."</h4>";
        $output .= "<li>".$tender['Nombre']."</li>";
        $output .= "<li>".$tender['CodigoEstado']."</li>";
        $output .= "<li>".$tender['FechaCierre']."</li>";
    }
    $output .= "</ul>";
    echo $output;
*/
    //connect to de db
    $db = connect();

        foreach($obj['Listado'] as $tender){

            $sqlValidate = 'SELECT externalCode FROM tenders WHERE externalCode = "'.$tender['CodigoExterno'].'"';
            $externalCodeExist = $db->query($sqlValidate)->num_rows;

            if ($externalCodeExist == 0 ){
                $sql = 'INSERT INTO tenders
                        (externalCode
                        , name
                        , stateCode
                        , closingDate
                        , registrationDate) VALUES (
                            "'.$tender['CodigoExterno'].'"
                            , "'.$tender['Nombre'].'"
                            , "'.$tender['CodigoEstado'].'"
                            , "'.$tender['FechaCierre'].'"
                            , NOW())';

                $result = $db->query($sql);
            }
        }



?>
