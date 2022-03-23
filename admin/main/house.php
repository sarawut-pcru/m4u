<?php
require_once '../../connect/session_ckeck.php';
require '../../connect/functions.php';
$sql = new house();
$query = $sql->selecthouse('');
$row = $query->fetch_object();
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
                            <h1>ManagePages โรงเรือน</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./admin_index">Home</a></li>
                                <li class="breadcrumb-item active">House</li>
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
                            <div class="card">
                                <div class="card-header card-outline card-blue">
                                    <h3 class="text-center">โรงเรือน</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- table -->
                                    <table id="example1" class="table table-bordered table-striped table-hover">
                                        <!-- head table -->
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>โรงเรือน</th>
                                                <th>Edit&Delete</th>
                                            </tr>
                                        </thead>
                                        <!-- /.head table -->
                                        <!-- body table -->
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row->id ;?></td>
                                                <td><?php echo $row->house_name ;?></td>
                                                <td style="width: 20%;">
                                                    <center>
                                                        <a class="btn btn-info btnEdits " title="แก้ไขข้อมูล" id="<?php echo $row->id ;?>">
                                                            <i class="fas fa-pencil-alt"></i>

                                                        </a>
                                                        <a class="btn btn-danger btnDels" title="ลบข้อมูล" id="<?php echo $row->id ;?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!-- /.body table -->
                                       
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
            <?php require_once '../modalEdit.php'; ?>

        </div>
        <!-- /.content-wrapper -->
        <?php require '../sub/fooster.php'; ?>

    </div>
    <!-- ./wrapper -->

</body>
<script src="../../dist/js/datatable.js"></script>
<script>
    //edit
    // . = class
    // # = id 
    $(document).on('click', '.btnEdits', function(e) {
        // $(document).on('click', '.btnEdits', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var txt_head = 'Edit House'

        $.ajax({
            type: 'get', //post put get delete
            dataType: "json",
            url: '../process/_house.php', //ทำงานที่ไฟล์อะไร
            data: { // ส่งค่าอะไรไปบ้าง
                id: id,
                function: 'edithouse',
            },
            success: function(rs) {

                $("#modalEdithouse").modal("show");
                $("#modalhouse").html(txt_head)
                $("#housename").val(rs.house_name);
            }
        })

    });
    // delete
    $(document).on('click', '.btnDels', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');

        Swal.fire({
            title: 'คุณต้องการลบข้อมูลใช่หรือไม่ ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "ยืนยัน",
            cancelButtonText: "ยกเลิก",
        }).then((btn) => {
            if (btn.isConfirmed) {
                $.ajax({
                    dataType: 'JSON',
                    type: "get",
                    url: "../process/_house.php",
                    data: {
                        id: id,
                        function: 'delshouse',
                    },
                    success: function(result) {
                        Swal.fire({
                            icon: 'success',
                            title: result.message,
                        }).then((result) => {
                            location.reload();
                        })
                    },
                });
            }
        })
    });
</script>

</html>