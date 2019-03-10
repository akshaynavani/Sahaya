<?php
//session_start();
require_once ('../../includes/bootstrap.php');
require_once('../includes/header-bp.php');
$_SESSION['current_page'] = "Approvals View";
require_once('../includes/navigation.php');
require_once('../includes/sidebar.php');
require_once('../includes/breadcrumbs.php');

$pending_approvals_obj = new Pending_Approvals($_SESSION['branch']);
$parent_obj = new Parents($_SESSION['branch']);
$child_obj = new Children($_SESSION['branch']);
extract($_POST);
$array = iterator_to_array($pending_approvals_obj->getPendingApprovalById($pending_approvals_id));
$parent = iterator_to_array($parent_obj->getParent($array[0]['parent_id']));
$array = iterator_to_array($child_obj->getChild($array[0]['child_id']));



file_put_contents("../../../assets/images/uploads/".$array[0]['child_id'].".".$array[0]['child_image']["image_extension"],$array[0]['child_image']['image']);
file_put_contents("../../../assets/documents/".$array[0]['child_id'].".".$array[0]['personal_documents']["document_extension"],$array[0]['personal_documents']['personal_documents']);

file_put_contents("../../../assets/documents/".$parent[0]['parent_id']."_perspective_parent_1.".$parent[0]['perspective_parent_1']["parent_document"]["document_extension"],$parent[0]['perspective_parent_1']["parent_document"]["parent_document"]);
if($parent[0]['is_single_parent']!='0'){
    file_put_contents("../../../assets/documents/".$parent[0]['parent_id']."_perspective_parent_2.".$parent[0]['perspective_parent_2']["parent_document"]["document_extension"],$parent[0]['perspective_parent_2']["parent_document"]["parent_document"]);

}

?>
    <div class="row">
        <div class="panel panel-info <?php if($parent[0]['is_single_parent']=='0'){ echo "";}else { echo "row";}?>">
<?php if($parent[0]['is_single_parent']=='0'){?>
            <div class="panel-heading">
                <h1 class="panel-title" style="font-size: 22px;">
                    <?php echo $parent[0]['perspective_parent_1']['parent_name']?>
                </h1>
            </div>
    <?php }else{ ?>
    <div class="panel-heading col-md-5">
        <h1 class="panel-title" style="font-size: 22px;">
            <?php echo $parent[0]['perspective_parent_1']['parent_name']?>
        </h1>
    </div>
    <div class="panel-heading col-md-5 col-md-offset-1">
        <h1 class="panel-title" style="font-size: 22px;">
            <?php echo $parent[0]['perspective_parent_2']['parent_name']?>
        </h1>
    </div>
<?php } ?>
            <div class="panel-body">
                <?if($parent[0]['is_single_parent']=='0'){?>
                <div class="row">
                    <div class=" col-md-12 col-lg-12 ">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <td>Marritial Status</td>
                                <td>
                                    <?php if($parent[0]['is_single_parent']=='0'){ echo "Single Parent";}else { echo "Married";}?>
                                </td>
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td>
                                    <?php echo $parent[0]['perspective_parent_1']['parent_age']?>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Gender</td>
                                <td>
                                    <?php echo $parent[0]['perspective_parent_1']['gender']?>
                                </td>
                            </tr>
                            <tr>
                                <td>View Documents</td>
                                <td><a class="btn btn-md btn-info" type="button" href="../../../assets/documents/<?php echo $parent[0]['parent_id']."_perspective_parent_1.".$parent[0]['perspective_parent_1']['parent_document']['document_extension'];?>">Click Me</a> </td> </tr> <tr>
                                <td>
                                    Verified
                                </td>
                                <td>
                                    <?php echo ($parent[0]['is_verified']==true)?"Verified":"Not Verified";?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
    <?php }else{?>
            <div class="row">
        <div class=" col-md-5 col-lg-5 ">
            <table class="table table-user-information">
                <tbody>
                <tr>
                    <td>Marritial Status</td>
                    <td>
                        <?php if($parent[0]['is_single_parent']=='0'){ echo "Single Parent";}else { echo "Married";}?>
                    </td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td>
                        <?php echo $parent[0]['perspective_parent_2']['parent_age']?>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <?php echo $parent[0]['perspective_parent_2']['gender']?>
                    </td>
                </tr>
                <tr>
                    <td>View Documents</td>
                    <td><a class="btn btn-md btn-info" type="button" href="../../../assets/documents/<?php echo $parent[0]['parent_id']."_perspective_parent_1.".$parent[0]['perspective_parent_1']['parent_document']['document_extension'];?>">Click Me</a> </td> </tr> <tr>
                    <td>
                        Verified
                    </td>
                    <td>
                        <?php echo ($parent[0]['is_verified']==true)?"Verified":"Not Verified";?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class=" col-md-5 col-md-offset-1 col-lg-5 ">
            <table class="table table-user-information">
                <tbody>
                <tr>
                    <td>Marritial Status</td>
                    <td>
                        <?php if($parent[0]['is_single_parent']=='0'){ echo "Single Parent";}else { echo "Married";}?>
                    </td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td>
                        <?php echo $parent[0]['perspective_parent_1']['parent_age']?>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <?php echo $parent[0]['perspective_parent_1']['gender']?>
                    </td>
                </tr>
                <tr>
                    <td>View Documents</td>
                    <td><a class="btn btn-md btn-info" type="button" href="../../../assets/documents/<?php echo $parent[0]['parent_id']."_perspective_parent_2.".$parent[0]['perspective_parent_2']['parent_document']['document_extension'];?>">Click Me</a> </td> </tr> <tr>
                    <td>
                        Verified
                    </td>
                    <td>
                        <?php echo ($parent[0]['is_verified']==true)?"Verified":"Not Verified";?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php }?>
            </div>
            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h1 class="panel-title" style="font-size: 22px;">
                            <?php echo $array[0]['child_name'];?>
                        </h1>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div id="demo" class="carousel slide col-md-3 col-lg-3" data-ride="carousel" align="center">
                                <!-- The slideshow -->
                                <div class="carousel-inner">

                                    <div class="carousel-item">
                                        <img src="../../../assets/images/uploads/<?php echo $array[0]['child_id'].".".$array[0]['child_image']["image_extension"] ?>" class="img-responsive" alt="">
                                    </div>

                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </a>
                            </div>
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Date of Birth</td>
                                        <td>
                                            <?php echo $array[0]['dob'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Age</td>
                                        <td>
                                            <?php echo $child_obj->calculateChildAge($array[0]['child_id']);?>
                                        </td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>
                                            <?php echo $array[0]['gender'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Disability</td>
                                        <td>
                                            <?php echo $array[0]['disability'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>View Documents</td>
                                        <td><a class="btn btn-md btn-info" type="button" href="../../../assets/documents/<? echo $array[0]['child_id'].'.'.$array[0]['personal_documents']['document_extension'];?>">Click Me</a> </td> </tr> <tr>
                                        <td>
                                            Adoption
                                        </td>
                                        <td>
                                            <?php  if($array[0]['is_adopted']=="NO"){echo "NOT ADOPTED";}
                                            else{
                                                echo "ADOPTED";
                                            }?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-footer row">
				<form action="<?php echo BASEURL."views/admin/helper/adoptChild_routing.php";?>" method="post" enctype="multipart/form-data">
					<input name="pending_approvals_id" value="<?php echo $pending_approvals_id;?>" hidden>
                    <div class="col-md-12 ">
                        <label  class="pull-left">Child Consent Documents</label>
                        <input type="file" class="pull-right" required name="child_consent_document">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" name="approveAdoption">Approve Adoption</button>
                     <button type="submit" class="btn btn-danger " name="rejectApprove">Reject Adoption</button>
                    </div>
                </form>
                    <form action="<?php echo BASEURL."views/admin/helper/adoptChild_routing.php";?>" method="post" enctype="multipart/form-data">
					<input name="pending_approvals_id" value="<?php echo $pending_approvals_id;?>" hidden>

				</form>
            </div>
        </div>
    </div>
<?php
require_once('../includes/footer-bp.php');
?>