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
                            <h1>ManagePages โคเนื้อ</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./admin_index">Home</a></li>
                                <li class="breadcrumb-item active">Cow</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content-header -->

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header card-outline card-blue">
                                    <h3 class="text-center">โคเนื้อ</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- table -->
                                    <table id="example1" class="table table-bordered table-striped table-hover">
                                        <!-- head table -->
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>#</th>
                                                <th>ชื่อโค</th>
                                                <th>ส่วนสูง</th>
                                                <th>น้ำหนัก</th>
                                                <th>เพศ</th>
                                                <th>โรงเรือน</th>
                                                <th>ฝูง</th>
                                                <th>ฟาร์ม</th>

                                                <th>แก้ไข/ลบ</th>
                                            </tr>
                                        </thead>
                                        <!-- /.head table -->
                                        <!-- body table -->
                                        <tbody>
                                            <?php
                                            $datahouse = new cow();
                                            $row = $datahouse->selectdatacowbyfarmer('');
                                            while ($rs = $row->fetch_object()) {
                                                if ($rs->cow_pic != NULL) {
                                                    $img =   "src='../../dist/img/cow_upload/" . $rs->cow_pic . "'";
                                                } else {
                                                    $img =   "src='../../dist/img/icon/sacred-cow.png'";
                                                }

                                            ?>
                                                <tr>
                                                    <td><?php echo $rs->id; ?></td>
                                                    <td style="width:10%" class="text-center"><img <?php echo $img; ?> class="rounded w-100"></td>
                                                    <td><?php echo $rs->cow_name; ?></td>
                                                    <td><?php echo $rs->high; ?></td>
                                                    <td><?php echo $rs->weight; ?></td>
                                                    <td><?php echo $rs->gender; ?></td>
                                                    <td><?php echo $rs->house_name; ?></td>
                                                    <td><?php echo $rs->herd_name; ?></td>
                                                    <td><?php echo $rs->farmname; ?></td>

                                                    <td class="text-center">
                                                        <a class="btn btn-info btnEdit" id="<?php echo $rs->id; ?>">
                                                            <i class="fa fa-pen-alt"></i>
                                                        </a>
                                                        <a class="btn btn-danger btnDels" id="<?php echo $rs->id; ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
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
        </div>
        <!-- /.content-wrapper -->
        <?php
        require '../modalcow.php';
        require '../sub/fooster.php';
        ?>

    </div>
    <!-- ./wrapper -->

</body>
<script src="../../dist/js/datatable.js"></script>
<script>
    $(document).ready(function() {

        $(document).on('click', '.btnEdit', function(e) {
            e.preventDefault();
            var cowid = $(this).attr('id');
            $('#modalEdit').modal('show');
            $('#modaltextcenter').html('แก้ไขข้อมูลโคเนื้อ');
        })

        var farm_id = '<?php echo $_SESSION['farm_id']; ?>';


        $.ajax({
            type: 'get',
            dataType: 'json',
            url: '../process/_cow.php',
            data: {
                id: '',
                function: "getdataspecies",
            },
            success: function(result) {
                var data = '<option value="" selected disabled>--เลือกสายพันธุ์--</option>';
                for (i in result) {
                    data += '<option value="' + result[i].spec_id + '" > ' + result[i].spec_name + '</option>';
                }
                $('#species_id').html(data);
            }
        });

        $.ajax({
            type: 'get',
            dataType: 'json',
            url: '../process/_cow.php',
            data: {
                id: farm_id,
                function: "getdatahouse",
            },
            success: function(result) {
                var data = '<option value="" selected disabled>--เลือกโรงเรือน--</option>';
                for (i in result) {
                    data += '<option value="' + result[i].house_id + '" > ' + result[i].housename + '</option>';
                }
                $('#house_id').html(data);

                $('#house_id').change(function() {
                    var house_id = $('#house_id').val();
                    $.ajax({
                        type: 'get',
                        dataType: 'json',
                        url: '../process/_cow.php',
                        data: {
                            id: house_id,
                            function: "getdataherd",
                        },
                        success: function(result) {
                            var data = '<option value="" selected disabled>--เลือกโรงเรือน--</option>';
                            for (i in result) {
                                data += '<option value="' + result[i].herd_id + '" > ' + result[i].herdname + '</option>';
                            }
                            $('#herd_id').html(data);

                        }
                    });

                });
            }
        });


        $(document).on('click', '.btnDels', function(e) {
            e.preventDefault();
            var cowid = $(this).attr('id');
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
                        url: "../process/_cow.php",
                        data: {
                            id: id,
                            function: 'del',
                        },
                        success: function(result) {
                            if (result.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: result.message,
                                }).then((result) => {
                                    location.reload();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: result.message,
                                }).then((result) => {
                                    location.reload();
                                })
                            }

                        },
                    });
                }
            })
        })

    });
</script>

</html>