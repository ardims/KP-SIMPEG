<?php
    session_start();
    if (@$_SESSION['login'] == true){
        header("location:pemesanan");
    }
?>
<html>
    <head>
        <title>Login</title>

        <!-- css bootstrap -->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

        <!-- jquery -->
        <script type="text/javascript" src="../js/jquery.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal" action="aksi/login.php" method="POST">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <h3>Login</h3>
                                <div class="form-group">
                                    <label for="username" class="col-sm-4 control-label">Username</label>
                                    <div class="col-sm-8">
                                        <input name="username" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-4 control-label">Password</label>
                                    <div class="col-sm-8">
                                        <input name="password" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">LOGIN</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    </body>
</html>