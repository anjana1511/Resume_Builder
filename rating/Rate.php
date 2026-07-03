<?php
require_once ("../config/DBController.php");

class Rate extends DBController
{

    function getAllPost($userid)
    {
        $query = "SELECT * FROM skills where user_id=$userid";
        
        $postResult = $this->getDBResult($query);
        return $postResult;
    }

    function updateRatingCount($rate, $id)
    {
        $query = "UPDATE skills SET  rate = ? WHERE id= ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $rate
            ),
            array(
                "param_type" => "i",
                "param_value" => $id
            )
        );
        
        $this->updateDB($query, $params);
    }


}
