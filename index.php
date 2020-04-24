<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<!-- css -->
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/58da37be9c.js" crossorigin="anonymous"></script>

    <!-- data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

<!-- js -->
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- datatable -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <style>
        .modal-body{
            background-color: white;
        }
    </style>

</head>
<body>
    <div class="container">
    <h3 align="center">Menampilkan Data Database dengan Data Table</h3>
        <div class="table-responsive">
            <table id="data" class="table table-hover table-striped table-bordered text-center" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include 'koneksi.php';
                        $no = 1;
                        $query = "SELECT * FROM tbl_siswa ORDER BY id DESC";
                        $dewan1 = $db1->prepare($query);
                        $dewan1->execute();
                        $res1 = $dewan1->get_result();
                        while ($row = $res1->fetch_assoc()){
                            $id = $row['id'];
                            $nama_mahasiswa = $row['nama_siswa'];
                            $alamat = $row['alamat'];
                            $jurusan = $row['jurusan'];
                            $jenis_kelamin = $row['jenis_kelamin'];
                            $tgl_masuk = $row['tgl_masuk'];
                    ?>
                    <tr>
                        <th><?php echo $no++ ?></th>
                        <td><?php echo $nama_mahasiswa; ?></td>
                        <td><?php echo $alamat; ?></td>
                        <td><?php echo $jurusan; ?></td>
                        <td><?php echo $jenis_kelamin; ?></td>
                        <td><?php echo $tgl_masuk; ?></td>
                        <td>
                            <button style="font-size: 11px;" class="btn btn-primary" id="detail" name="detail" title="Lihat Detail"><i class="fa fa-search"></i></button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- action detail -->
            <div id="viewModal" class="modal fade mr-tp-100" role="dialog">
                <div class="modal-dialog modal-lg flipInX animated">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">View Data</h4>
                            <button type="button" class="close" data-dismiss="modal"></button>
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" id="id" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Mahasiswa</label>
                            <input type="text" id="nama_siswa" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" id="alamat" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="">Jurusan</label>
                            <input type="text" id="jurusan" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="">jenis Kelamin</label>
                            <input type="text" id="jenis_kelamin" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="">tanggal Masuk</label>
                            <input type="text" id="tgl_masuk" class="form-control" readonly="">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    <script type="text/javascript">
        $(document).ready(function(){
            let table = $('#data').DataTable();
    
            $('#data tbody').on('click', '#detail', function(){
                var current_row = $(this).parents('tr');
                if(current_row.hasClass('child')){
                    current_row = current_row.prev();
                }
                var data = table.row(current_row).data();
                console.log(data)
    
                document.getElementById("id").value = data[0];
                document.getElementById("nama_siswa").value = data[1];
                document.getElementById("alamat").value = data[2];
                document.getElementById("jurusan").value = data[3];
                document.getElementById("jenis_kelamin").value = data[4];
                document.getElementById("tgl_masuk").value = data[5];
    
                $('#viewModal').modal("show");
            });
        });
    </script>
    </div>


</body>
</html>