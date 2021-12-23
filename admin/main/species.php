<?php
require_once '../../connect/session_ckeck.php';
require '../../connect/functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin|Dashboard</title>
    <?php
    include '../../build/script.php';
    ?>
</head>

</script>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <?php
        // Navbar Admin
        require '../sub/navbar.php';
        // Aside Admin
        require '../sub/aside.php';
        // Manage Pages Admin
        require '../sub/side_manage.php';
        // Reports Admin   
        require '../sub/side_reports.php';
        ?>

        </ul>

        <!-- /.sidebar-menu -->
        <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>ManagePages สายพันธุ์</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./admin_index">Home</a></li>
                                <li class="breadcrumb-item active">Specise</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">เพิ่มข้อมูลสายพันธุ์</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="card-body">
                                                <div class="form-group ">
                                                    <label for="Picturespecise">ภาพ</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="form-control" id="file" name="file" onchange="readURL(this)" required>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="Namespecise">ชื่อสายพันธุ์</label>
                                                    <input type="text" class="form-control" id="specname" name="specname" placeholder="ชื่อสายพันธุ์" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Specisedetail">รายละเอียด</label>
                                                    <textarea type="text" class="form-control" id="specdetail" name="specdetail"></textarea>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer text-right">
                                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning">Reset</button>
                                            </div>
                                        </form>
                                        <!-- /.form end -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Preview</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form method="post">
                                            <div class="card-body">
                                                <div id="imgControl" class="d-none">
                                                    <img id="imgUpload" class="rounded mx-auto d-block h-50 w-50">

                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                        </form>
                                        <!-- /.form end -->
                                    </div>
                                    <!-- /.card -->
                                </div>


                                <div class="card">
                                    <div class="card-header card-outline card-blue">
                                        <h3 class="text-center">สายพันธุ์</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <!-- table -->
                                        <table id="example1" class="table table-bordered table-striped table-hover">
                                            <!-- head table -->
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>สายพันธุ์</th>
                                                    <th>รายละเอียด</th>
                                                    <th>Edit&Delete</th>
                                                </tr>
                                            </thead>
                                            <!-- /.head table -->
                                            <!-- body table -->
                                            <tbody>
                                                <?php
                                                $sel_data = new specise();
                                                $result = $sel_data->selspec();
                                                while ($row = mysqli_fetch_object($result)) {
                                                ?>
                                                    <tr>
                                                        <td style="width: 15%;" align="center">
                                                            <?php
                                                            if ($row->spec_pic != NULL) {
                                                            ?>
                                                                <img src="<?php echo "../../dist/img/spec_upload/$row->spec_pic"; ?>" class="rounded w-100">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="../../dist/img/image-01.jpg" class="rounded w-100" alt="image">
                                                            <?php
                                                            }
                                                            ?>

                                                        </td>
                                                        <td style="width: 15%;"><?php echo $row->spec_name; ?></td>
                                                        <td><?php echo $row->spec_detail; ?>
                                                        </td>
                                                        <td style="width: 15%;">
                                                            <center>
                                                                <a class="btn btn-info view_data" data-toggle="modal" data-target="#md-spec" id="<?php echo $row->id; ?> ">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                                <?php require '../modal/md_spec.php'; ?>
                                                                <a class="btn btn-danger" onclick="del(<?php echo $row->id; ?>)">
                                                                    <i class=" fas fa-trash-alt"></i>
                                                                    <!-- href="../delete/delete_species?del=<?php echo $row->id; ?> -->
                                                                </a>
                                                            </center>

                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <!-- /.body table -->
                                            <!-- foot table -->
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>สายพันธุ์</th>
                                                    <th>รายละเอียด</th>
                                                    <th>Edit&Delete</th>
                                                </tr>
                                            </tfoot>
                                            <!-- /.foot table -->
                                        </table>
                                        <!-- /.table -->
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php require '../sub/fooster.php'; ?>

    </div>
    <!-- ./wrapper -->

</body>
<script src="../../dist/js/imgshow.js"></script>
<script>
 
        // update
        $('.update_data').click(function() { //เมื่อมีการกดปุ่ม view_data
            var uid = $(this).attr("id"); //รับค่า id จากปุ่มวิวมาใส่ไว้ใน uid
            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    id: uid
                },
                dataType: "json",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#specname').val(data.spec_name);
                    $('#specdetail').val(data.spec_detail);
                    // $('#addModal').modal('show');
                }
            });
        });
        //View
        $('.view_data').click(function() { //เมื่อมีการกดปุ่ม view_data
            var uid = $(this).attr("id"); //รับค่า id จากปุ่มวิวมาใส่ไว้ใน uid
            $.ajax({
                url: "select_spec.php", //ส่งข้อมูลไปทีไฟล์ select.php
                method: "post", //ด้วย method post
                data: {
                    id: uid
                }, //ส่งข้อมูลไปในรูปแบบ JSON
                success: function(data) { // หากส้งข้อมูลสำเร็จ
                    $('#detail').html(data); //นำข้อมูลไปแสดงที่ Modal body ตรง id detail ในไฟล์ viewModal.php
                    $('#md-spec').modal('show'); //เรียก Modal มาแสดง
                }
            });
        });

        // data table
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        function del(id) {
            Swal.fire({
                title: 'คุณแน่ใจ ?',
                text: "ต้องการลบข้อมูลนี้ใช่หรือไม่ ",
                icon: 'warning',
                showCancelButton: true,
                CancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "../delete/delete_species?del=" + id;
                }
            })
        };
    
</script>

</html>
<?php

function imageResize($imageResourceId, $width, $height)
{
    $targetWidth = $width < 1280 ? $width : 1280;
    $targetHeight = ($height / $width) * $targetWidth;
    $targetLayer = imagecreatetruecolor($targetWidth, $targetHeight);
    imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
    return $targetLayer;
}

require '../../connect/alert.php';

$specdata = new specise();
if (isset($_POST['submit'])) {

    date_default_timezone_set('Asia/Bangkok');
    $time = date('Ymdhis');

    $specname = $_POST['specname'];
    $specdetail = $_POST['specdetail'];

    $specpic = $_FILES['file']['tmp_name'];
    $sourceProperties = getimagesize($specpic);
    $fileNewName = $time;
    $folderPath = "../../dist/img/spec_img/";
    // $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);  เก็บแค่ path
    $ext = $_FILES['file']['name'];
    $imageType = $sourceProperties[2];

    switch ($imageType) {

        case IMAGETYPE_PNG:
            $imageResourceId = imagecreatefrompng($specpic);
            $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
            imagepng($targetLayer, $folderPath . $fileNewName . "_upload" . $ext);
            break;

        case IMAGETYPE_GIF:
            $imageResourceId = imagecreatefromgif($specpic);
            $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
            imagegif($targetLayer, $folderPath . $fileNewName . "_upload" . $ext);
            break;

        case IMAGETYPE_JPEG:
            $imageResourceId = imagecreatefromjpeg($specpic);
            $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
            imagejpeg($targetLayer, $folderPath . $fileNewName . "_upload" . $ext);
            break;

        default:
            echo "Invalid Image type.";
            exit;
            break;
    }


    if (!empty($specpic)) {
        copy($specpic, "../../dist/img/spec_upload/" . $ext);
        $sql = $specdata->addspec_pic($specname, $specdetail, $ext);
        echo success_1("เพิ่มข้อมูลสำเร็จ", "./species"); // "แสดงอะไร","ส่งไปหน้าไหน"
    } else {
        $sql = $specdata->addspec($specname, $specdetail);
        echo success_1("เพิ่มข้อมูลสำเร็จ", "./species"); // "แสดงอะไร","ส่งไปหน้าไหน"
    }
}


?>