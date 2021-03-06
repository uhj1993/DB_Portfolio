<meta charset="UTF-8" />
<?php
    $design_update_num=$_GET['num'];
    $design_title = nl2br($_REQUEST['design_title']);
    $design_title = addslashes($design_title);
    
    $design_serial = $_REQUEST['design_serial'];
    $design_client = $_REQUEST['design_client'];
    
    $design_desc = nl2br($_REQUEST['design_desc']);
    $design_desc = addslashes($design_desc);
  
    $regist_day = date("Y-m-d");
  
  
    $img_upload_dir=$_SERVER['DOCUMENT_ROOT'].'/db-portfolio/data/design_page/';
    $thumb_upload_dir=$_SERVER['DOCUMENT_ROOT'].'/db-portfolio/data/design_page/thumb/';
  
      //main image
  $main_name = $_FILES['main']['name'];
  $main_tmp_name=$_FILES['main']['tmp_name'];
  $main_error=$_FILES['main']['error'];

  //sub image
  $sub_name = $_FILES['sub']['name'];
  $sub_tmp_name=$_FILES['sub']['tmp_name'];
  $sub_error=$_FILES['sub']['error'];

  //thumb image
  $thumbnail_name = $_FILES['thumbnail']['name'];
  $thumbnail_tmp_name=$_FILES['thumbnail']['tmp_name'];
  $thumbnail_error=$_FILES['thumbnail']['error'];

  //main image upload
  if($main_name && !$main_error) {
    $uploaded_main_file = $img_upload_dir.$main_name;

    if(!move_uploaded_file($main_tmp_name, $uploaded_main_file)){
      echo "
        <script>
          alert('메인사진이 업로드되지 않았습니다.');
        </script>
      ";
      exit;
    }
  } else {
    $main_name="";
  }

  //sub image upload
  if($sub_name && !$sub_error) {
    $uploaded_sub_file=$img_upload_dir.$sub_name;
    if(!move_uploaded_file($sub_tmp_name, $uploaded_sub_file)){
      echo "
        <script>
          alert('서브사진이 업로드되지 않았습니다.');
        </script>
      ";
      exit;
    }
  } else {
    $sub_name="";

  }

    //thumbnail image upload
    if($thumbnail_name && !$thumbnail_error) {
      $uploaded_thumbnail_file=$thumb_upload_dir.$thumbnail_name;
      if(!move_uploaded_file($thumbnail_tmp_name, $uploaded_thumbnail_file)){
        echo "
          <script>
            alert('썸네일사진이 업로드되지 않았습니다.');
          </script>
        ";
        exit;
      }
    } else {
      $thumbnail_name="";
  
    }

    //database connect
    include $_SERVER['DOCUMENT_ROOT'].'/db-portfolio/php_process/connect/db_connect.php';
    $sql="update portfolio_de set PORTFOLIO_DE_tit='$design_title', PORTFOLIO_DE_ser='$design_serial', PORTFOLIO_DE_des='$design_desc', PORTFOLIO_DE_img1='$main_name', PORTFOLIO_DE_img2='$sub_name', PORTFOLIO_DE_thumb='$thumbnail_name', PORTFOLIO_DE_cli='$design_client', PORTFOLIO_DE_reg='$regist_day' where PORTFOLIO_DE_num='$design_update_num'";

    // $sql="insert into portfolio_de(
    //   PORTFOLIO_DE_tit, 
    //   PORTFOLIO_DE_ser, 
    //   PORTFOLIO_DE_des, 
    //   PORTFOLIO_DE_img1, 
    //   PORTFOLIO_DE_img2, 
    //   PORTFOLIO_DE_thumb, 
    //   PORTFOLIO_DE_cli, 
    //   PORTFOLIO_DE_reg) values(
    //     '$design_title',
    //     '$design_serial',
    //     '$design_desc',
    //     '$main_name',
    //     '$sub_name',
    //     '$thumbnail_name',
    //     '$design_client',
    //     '$regist_day')";
  
    mysqli_query($dbConn, $sql);
    echo "
    <script>
      alert('수정이 완료되었습니다.');
      location.href='/db-portfolio/pages/design/design.php';
    </script>
  ";
?>