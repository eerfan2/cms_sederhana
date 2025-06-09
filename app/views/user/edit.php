<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - CMS Sederhana</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form action="<?= BASEURL; ?>/user/edit/<?= $data['user']['id']; ?>" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= $data['user']['username']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $data['user']['email']; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= BASEURL; ?>/user" class="btn btn-danger">Kembali</a>
        </form>
    </div>
</body>
</html> 