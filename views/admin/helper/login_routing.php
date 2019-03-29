<?php
   session_start();
   	require_once('../../includes/bootstrap.php');
//	require_once("../../../classes/Employee.class.php");
	
	if(isset($_POST["emp_login"])){

		$emp_email = $_POST["emp_email"];
		$emp_password = $_POST['emp_password'];
		$branch = $_POST["branch"];
		$employee = new Employee($branch);
		$_SESSION["db_name"] = $branch;
		$rs=$employee->checkEmployee($emp_email,$emp_password);
		$array = iterator_to_array($rs);
		$basepage = BASEPAGES;
		if(count($array) != 1){
		    $_SESSION["login_status"]=LOGINFAILURE;
            $basepage = BASEPAGES;
		    header("Location: {$basepage}login2.php");
		}
		else{
			$_SESSION['emp_id'] = $array[0]['emp_id'];
			$_SESSION['emp_role'] = $array[0]['emp_role'];
			$_SESSION['emp_name'] = $array[0]['emp_name'];
			$_SESSION['branch'] = $branch;
			header("Location: {$basepage}dashboard.php");
		}

	}else if(isset($_POST['registerSignUp'])){
		$branch = $_POST["branch"];
		$employee = new Employee($branch);
		$employee->registerEmployee($_POST);
	}else if(isset($_POST['completeSignUp'])){
		$branch = $_REQUEST['branch'];
		echo $branch;
		$employee = new Employee($branch);
		
		if(isset($_FILES['emp_image'])){
            $image_blob = new MongoDB\BSON\Binary(file_get_contents($_FILES['emp_image']['tmp_name']), MongoDB\BSON\Binary::TYPE_GENERIC);
			$temp = explode("/", $_FILES['emp_image']['type']);
            $img_ext = $temp[1];
        }

        if(isset($_FILES['emp_documents'])){
            $document_blob = new MongoDB\BSON\Binary(file_get_contents($_FILES['emp_documents']['tmp_name']), MongoDB\BSON\Binary::TYPE_GENERIC);
			$temp = explode("/", $_FILES['emp_documents']['type']);
            $document_ext = $temp[1];
        }
		$_POST['image_blob'] = $image_blob;
		$_POST['image_extension'] = $img_ext;
		$_POST['document_blob'] = $document_blob;
		$_POST['document_extension'] = $document_ext;
		$employee->insertEmployee($_REQUEST['email'], $_POST);	
		$baseurl = BASEPAGES;
		header("Location: {$baseurl}login2.php");
	}else if(isset($_REQUEST['parent_sign_up'])){
		$branch = $_REQUEST['branch'];
		$parent = new Parents($branch);
		$parent->updateCurrent($_POST);
		$rs = $parent->getParent($_REQUEST['parent_id'], $_REQUEST['branch']);
		$rs = iterator_to_array($rs);
		$_SESSION['emp_id'] = $_REQUEST['parent_id'];
		$_SESSION['emp_role'] = 3;
		$_SESSION['emp_name'] = $_REQUEST['parent_username'];
		$_SESSION['branch'] = $_REQUEST['branch'];
		$_SESSION['parent_status'] = $rs[0]['is_single_parent'];
		$baseurl = BASEPAGES;
		header("Location: {$baseurl}dashboard.php");
	}else if(isset($_REQUEST['logout']) && $_REQUEST['logout'] == 1){
		if(explode("_", $_SESSION['emp_id'])[1] == "PRT"){
			$page = "parent-login.php";
		}else{
			$page = "login2.php";
		}
		session_destroy();
		
		$baseurl = BASEPAGES;
		header("Location: {$baseurl}{$page}");
	}else if(isset($_REQUEST['parent_login'])){
		$branch = $_REQUEST['branch'];
		$parent = new Parents($branch);
		$array = $parent->getParentByEmail($_REQUEST['parent_username'], $_REQUEST['parent_password']);
		$rs = iterator_to_array($array);
		if(count($rs)!=1){
            $basepage = BASEPAGES;
            $_SESSION["login_status"]=LOGINFAILURE;
            header("Location: {$basepage}parent-login.php");
		}else{
			$_SESSION['emp_id'] = $rs[0]['parent_id'];
			$_SESSION['emp_role'] = 3;
			$_SESSION['emp_name'] = $rs[0]['parent_user_name'];
			$_SESSION['branch'] = $_REQUEST['branch'];
			$_SESSION['parent_status'] = $rs[0]['is_single_parent'];
			$baseurl = BASEPAGES;
			header("Location: {$baseurl}dashboard.php");
		}
	}
