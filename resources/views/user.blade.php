<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">User Management</h1>

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal">Tambah Pengguna</button>

    <!-- Tabel untuk menampilkan daftar pengguna -->
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <!-- Daftar pengguna ditampilkan di sini -->
            @foreach($data as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal untuk menambahkan pengguna -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Tambah Pengguna Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambah pengguna -->
                <form id="addUserForm" action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" id="name" name="name" class="form-control">
                        <div class="invalid-feedback" id="name_error"></div>
                    </div>

                    <div class="form-group">
                        <label for="name">Username:</label>
                        <input type="text" id="username" name="username" class="form-control">
                        <div class="invalid-feedback" id="username_error"></div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control">
                        <div class="invalid-feedback" id="email_error"></div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control">
                        <div class="invalid-feedback" id="password_error"></div>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk menggunakan modal dan AJAX -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function(){
        $('#addUserForm').submit(function(event) {
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    // Tutup modal
                    $('#addUserModal').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'User berhasil ditambahkan.',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Refresh halaman atau lakukan tindakan lainnya
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    // Tangkap error response
                    var errors = xhr.responseJSON.errors;

                    // Hapus pesan error sebelumnya
                    $('.invalid-feedback').text('');
                    $('.is-invalid').removeClass('is-invalid');

                    // Tampilkan pesan error dalam modal
                    $.each(errors, function(key, value) {
                        $('#' + key).addClass('is-invalid'); // Tambahkan class is-invalid ke input
                        $('#' + key + '_error').text(value); // Tampilkan pesan error di bawah input
                    });
                }
            });
        });
    });
</script>

</body>
</html>
