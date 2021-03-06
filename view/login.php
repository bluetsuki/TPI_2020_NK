<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Collège d'Experts Informatique de Genève</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4"><img src="./img/LogoExpertsDev.svg" width="60" height="60" class="d-inline-block align-middle mr-5" alt="" loading="lazy">CdEIG - Identification</h3></div>
                                <div class="card-body">
                                    <form action="?action=login" method="POST">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control py-4" id="inputEmailAddress" name="inputEmailAddress" type="email" placeholder="Saisissez votre email" value="<?= empty($email) ? '' : $email  ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Mot de passe</label>
                                            <input class="form-control py-4" id="inputPassword" name="inputPassword" type="password" placeholder="Saisissez votre mot de passe" />
                                            <?php
                                                if ($error) {
                                                    echo '<small class="form-text text-danger">Vos identifiants sont incorrects</small>';
                                                }
                                            ?>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><button class="btn btn-primary" name="send" type="submit" value="send">Login</button></div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <?php require_once 'footer.php'; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
