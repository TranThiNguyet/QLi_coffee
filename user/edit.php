﻿<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section_heading">SỬA NGƯỜi DÙNG</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $id = $_GET['id'];
                                $messagePass = "";
                                $query2 = "SELECT * FROM users WHERE id = {$id}";
                                $result2 = $mysqli->query($query2);
                                $arUser = mysqli_fetch_assoc($result2) ;
                                //ki?m tra ng??i dùng b?m submit
                                    if (isset($_POST['submit'])) {
                                       $username = $_POST['username'];
                                       $password = $_POST['password'];
                                       $cnfPassword = $_POST['cnfPassword'];
                                       $fullname = $_POST['fullname'];

                                       if ($password == '' &&  $cnfPassword == '') {
	                                            $query = "UPDATE users SET fullname = '{$fullname}' WHERE id = {$id}";
                                           $result = $mysqli->query($query);
                                           if ($result) {
                                              HEADER("LOCATION:index.php?msg=Sửa thành công");
                                              die();
                                           }else{
                                                 echo "Có lổi khi sửa người dùng";
                                                 die();
                                           }
                                        }else {
                                                    $password = md5($password);
                                                    $cnfPassword = md5($_POST['cnfPassword']);
                                                    if($cnfPassword == $password){
                                                        $query3 = "UPDATE users SET fullname = '{$fullname}', password = '{$password}' WHERE id = {$id}";
                                                        $result3 = $mysqli->query($query3);
                                                        if ($result3) {
                                                           HEADER("LOCATION:index.php?msg=Sửa thành công");
                                                           die();
                                                        }else{
                                                              echo "Có lổi khi sửa người dùng";
                                                              die();
                                                        }
                                                    } else {
                                                        $messagePass = "Incorrect Password";
                                                    }
                                                }
                                        }
                                ?>
                                <form  action = "" method= "post" role="form">
                                <div class="col-6 col-sm-4" id=col-6>
                                    <div class="form-group">
                                        <label>Fullname: </label>
                                        <input type="text" name="fullname"  value ="<?php echo $arUser['fullname'];?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password: </label>
                                        <input type="password" name="password" class="form-control" />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
                                    <a class="btn btn-danger" href="index.php" role="button">Trở về</a>
                                </div>
                                <div class="col-6 col-sm-4" id=col-6>
                                <div class="form-group">
                                        <label>Username: </label>
                                        <input type="text" name="username"  value ="<?php echo $arUser['username'];?>" readonly  class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password: </label>
                                        <input type="password" name="cnfPassword" class="form-control" />
                                    </div>
                                    <?php if($messagePass) echo "<p style='color: red'>$messagePass</p>"?>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>