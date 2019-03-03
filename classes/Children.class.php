<?php
/**
 * Created by PhpStorm.
 * User: Nikhil Ghind
 * Date: 02-03-2019
 * Time: 06:43 PM
 */

require_once ("Database.class.php");

class Children
{
    private $child_name;
    private $child_id;
    private $gender;
    private $dob;
    private $birthmark;
    private $disability;
    private $date_of_admission;
    private $source_of_admission;
    private $child_image;
    private $current_standard;
    private $personal_documents;
    private $is_adopted = "NO";
    private $collection;
    private $collectionName = "Children";

    public function __construct()
    {
        $this->collection = (new Database("testing"))->getRequiredCollection($this->collectionName);
    }


    public function insertChild($array){
        extract($array);

        $child_id = "DADAR_CHD_" .($this->getChildrenCount()+1);

        $this->collection->insertOne(["child_id"=>$child_id,"child_name"=>$child_name,"gender"=>$gender,"dob"=>$dob,"birthmark"=>$birthmark,"disabiliy"=>$disability,"date_of_admission"=>$date_of_admission,"source_of_admission"=>$source_of_admission,"child_image"=>["image"=>$child_image,"image_extension"=>$image_extension],"qualification_details"=>["current_standard"=>$current_standard],"personal_documents"=>["personal_documents"=>$personal_documents,"image_extension"=>$image_extension_doc],"is_adopted"=>$this->is_adopted]);
    }


    public function getChildrenCount(){
        return $this->collection->countDocuments();
    }

    public function getChildren(){
        $rs =  $this->collection->find();

        if($rs == null){
            return false;
        }
        return $rs;
    }

    public function getChild($child_id){
        $rs = $this->collection->find(["child_id"=>$child_id]);

        if($rs == null){
            return false;
        }
        return $rs;
    }

    public function updateChild($child_id,$formdata){
        extract($formdata);
        $newdata=array('$set'=>array("child_name"=>$child_name,"gender"=>$gender,"dob"=>$dob,"birthmark"=>$birthmark,"disabiliy"=>$disability,"date_of_admission"=>$date_of_admission,"source_of_admission"=>$source_of_admission,"child_image"=>["image"=>$child_image,"image_extension"=>$image_extension],"qualification_details"=>["current_standard"=>$current_standard],"personal_documents"=>["personal_documents"=>$personal_documents,"image_extension"=>$document_extension],"is_adopted"=>$is_adopted));
        $this->collection->updateOne(array("child_id" => $child_id), $newdata);
    }



    public function calculateChildAge($child_id){
        $rs = $this->getChild($child_id);

        $array = iterator_to_array($rs);

        $dob = $array[0]["dob"];

        $year =  explode("-",$dob)[0];

       $current_year = date("Y");

       $age =  $current_year - $year;

       return $age;

    }

    public function getChildrenByGender($gender){
        $rs = null;

        if($gender == "MALE"){
            $rs = $this->collection->find(["gender"=>$gender]);
        }else{
            $rs = $this->collection->find();
        }

        return $rs;
    }

    //function to retrieve children for a particular age group.

}
?>