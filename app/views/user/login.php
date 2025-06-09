<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CMS Sederhana</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body>
    <div class="container">
        <div style="max-width: 400px; margin: 50px auto;">
            <h1>Login</h1>
            <?php if(isset($data['error'])) : ?>
                <div style="color: red; margin-bottom: 20px;">
                    <?= $data['error']; ?>
                </div>
            <?php endif; ?>
            
            <form action="<?= BASEURL; ?>/user/login" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</body>
</html> 