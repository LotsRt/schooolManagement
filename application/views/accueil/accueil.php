<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SchoolManager - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="<?= base_url('asset/css/template/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('asset/css/accueil/acceuil.css'); ?>" rel="stylesheet">
</head>

<body>

    <div class="header">
        SchoolManager
    </div>

    <div class="top-box">
        Bienvenue sur la plateforme de gestion scolaire
    </div>

    <div class="connexion_bottom">
        <a href="<?= base_url('Login'); ?>" class="btn btn-outline-secondary btn-sm px-20">
            Connexion
        </a>
    </div>

    <div class="bottom-section">
        <div class="bottom-box">
            Informations générales
        </div>
        <div class="bottom-box">
            Actualités ou annonces
        </div>
    </div>

</body>

</html>