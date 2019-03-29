<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 03-03-2019
 * Time: 02:44 PM
 */
require_once ("Database.class.php");

class Employee
{
    private $collection;
    private $collectionName="Employee";
    private $emp_id;
    private $emp_name;
    private $emp_dob;
    private $emp_gender;
    private $emp_role;
    private $emp_address;
    private $emp_uid;
    private $emp_contact;
    private $emp_email;
    private $emp_image;
    private $emp_documents;
	private $emp_password;
	private $branch_id;


    public function __construct($db_name)
    {
        $this->collection = (new Database($db_name))->getRequiredCollection($this->collectionName);
    }

    public function registerEmployee($array){
        extract($array);

		if($emp_password == $emp_confirm_password){
			if(($this->collection->countDocuments(["emp_email"=>$emp_email]))>0){
				return false;
			}

			$emp_id = $branch . "_EMP_".($this->getEmployeeCount()+1);

			$this->collection->insertOne(["emp_id"=>$emp_id,"emp_email"=>$emp_email,"emp_password"=>$emp_password,"branch_id"=>$branch]);

			$this->sendRegistrationMail($emp_email, $branch);
		}
        else{
			echo "Please Enter Same Password";
		}
    }

    public function insertEmployee($emp_email,$formdata){
        $this->updateEmployee($emp_email,$formdata);
    }
   
   public function checkEmployee($emp_email,$emp_password){
      $rs = $this->collection->find(array("emp_email"=>$emp_email,"emp_password"=>$emp_password));
      return $rs;
   }

    public function getEmployeeCount(){
        return $this->collection->countDocuments();
    }

    public function getAllEmployees(){
        $rs =  $this->collection->find();

        if($rs == null){
            return false;
        }
        return $rs;
    }

    public function getEmployeeById($emp_id){
        $rs = $this->collection->find(["emp_id"=>$emp_id]);

        if($rs == null){
            return false;
        }
        return $rs;
    }

	public function sendRegistrationMail($email, $branch){
//		$ciphertext_email= $this->encryption->encrypt($email);
		require_once('Mailer.php');
		$mailer = new Mailer();
		$user_email = "$email";
		$username = explode("@", $email)[0];
		$subject = "Sahaya Account Confirmation";

		$base_url_link = "http://localhost/Sahaya/views/admin/pages/registration-page.php?email=$email&branch={$branch}";
		$button = "Activate your account";
		$desc = ">This email was sent to you because you are subscribed / Requested to join Sahaya Foundation";
        
		$body = $mailer->getMailBody($username, $base_url_link, $button, $desc);

		$boolean=$mailer->send_mail($user_email, $body, $subject);
		if($boolean){
			$_SESSION['status']="SUCCESSMAIL";			
			header("Location: ../pages/login2.php");
		}
		else{
			$_SESSION['status']="FAILUREMAIL";
//			header("Location: ../pages/login2.php");
			echo "failed to send mail";
		}
			

	}
	
    public function updateEmployee($emp_email,$formdata){
        extract($formdata);
       	$emp_role = 2;
		$newdata=array('$set'=>array("emp_name"=>$emp_name,"emp_dob"=>$emp_dob,"emp_gender"=>$emp_dob,"emp_role"=>$emp_role,"emp_address"=>$emp_address,"emp_uid"=>$emp_uid,"emp_contact"=>$emp_contact,"emp_email"=>$emp_email,"emp_image"=>["image"=>$image_blob,"image_extension"=>$image_extension],"emp_document_details"=>["emp_documents"=>$document_blob,"document_extension"=>$document_extension]));
        $this->collection->updateOne(array("emp_email" => $emp_email), $newdata);
    }

}
