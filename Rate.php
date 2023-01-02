<?php
require_once "DBController.php";

class Rate extends DBController
{

    function getAllPost($userid)
    {
        $query = "SELECT * FROM skills where user_id=$userid";
        
        $postResult = $this->getDBResult($query);
        return $postResult;
    }

    // function getMemberCartItem($member_id)
    // {
    //     $query = "SELECT tbl_product.*, tbl_cart.id as cart_id,tbl_cart.quantity FROM tbl_product, tbl_cart WHERE 
    //         tbl_product.id = tbl_cart.product_id AND tbl_cart.member_id = ?";
        
    //     $params = array(
    //         array(
    //             "param_type" => "i",
    //             "param_value" => $member_id
    //         )
    //     );
        
    //     $cartResult = $this->getDBResult($query, $params);
    //     return $cartResult;
    // }

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
