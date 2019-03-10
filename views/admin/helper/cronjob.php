<?php
/**
 * Created by PhpStorm.
 * User: Nikhil Ghind
 * Date: 09-03-2019
 * Time: 07:11 PM
 */

require_once ("../../includes/bootstrap.php");


$db_name = "CENTRAL";

$branch = new Branch($db_name);

$rs = $branch->getBranch();

$array = iterator_to_array($rs);

for($i = 0 ; $i < count($array) ; $i++){

    $db_name = $array[$i]['branch_id'];

    $adopted_children = new AdoptedChildrens($db_name);


    $parents = new Parents($db_name);

    $children = new Children($db_name);

    $rs2 = $adopted_children->getAllAdoptedChild();

    $array2 = iterator_to_array($rs2);

    for($j = 0 ; $j < count($array2) ; $j++){

        $parent = iterator_to_array($parents->getParent($array2[$j]['parent_id']));

        $child_age = $children->calculateChildAge($array2[$j]['child_id']);

        $date_adoption = $array2[$j]['last_updated_at'];
         $date_adoption = date_create($date_adoption);


        $interval = date_diff($date_adoption,date_create(date("Y-m-d H:i:s")));



        if($child_age < 18){

            if($interval->y == 1){
                $parents->mailImageUpload($parent[0]['parent_id']);
            }

        }






    }





}