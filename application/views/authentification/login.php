
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="<?= base_url('asset/css/login/login.css'); ?>">
    <link href="<?= base_url('asset/css/template/bootstrap.min.css'); ?>" rel="stylesheet">
</head>

<body>

    <div class="header">
        Bienvenue sur SchoolManagement
    </div>

    <div class="container d-flex justify-content-center">
        <div class="login-box login-box-custom text-center">
            <h3>Connexion</h3>
            <form action="<?= site_url('controlle_de_connexion'); ?>" method="post">
                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Nom d'utilisateur</label>
                    <input type="text" class="form-control form-control-sm" id="username" name="username" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-75 btn-sm">Se connecter</button>
            </form>
            <div class="mt-3">
                <a href="<?= base_url('Accueil'); ?>" class="btn btn-outline-secondary w-10 btn-sm">
                    Retour à l'accueil
                </a>
            </div>
            
             <?php if ($this->session->flashdata('error')): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        </div>
    </div>


    <!-- Pied de page -->
    <div class="footer">
        &copy; 2025 - SchoolManager
    </div>

    <script src="<?= base_url('asset/allScript/template/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('asset/allScript/template/jquery-3.4.1.min'); ?>"></script>

</body>

</html>