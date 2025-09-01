<link rel="stylesheet" href="<?= base_url('asset/css/traitement/sweetalert.css') ?>">
<link rel="stylesheet" href="<?= base_url('asset/css/traitement/detail_enseignant.css') ?>">

<div class="content p-4" id="main-content">
    <div class="carte-enseignant">
        <div class="haut">
            <div class="titre"><?=$enseignant['matricule']?></div>
            <div class="photo">
                <img src="photo.jpg" alt="Photo" />
            </div>
        </div>
        <div class="contenu">
            <div class="ligne">
                <p><strong>Nom :</strong> <?=$enseignant['nom']?></p>
                <p><strong>Prénom :</strong> <?=$enseignant['prenom']?></p>
                <p><strong>Sexe :</strong> <?=$enseignant['sexe']?></p><br>
                <p><strong>Matière :</strong> <?=$enseignant['nom_matiere']?></p>
                <p><strong>Code:</strong> <?=$enseignant['code_enseignant']?></p>
                <p><strong>Téléphone :</strong> <?=$enseignant['telephone']?></p>
                <p><strong>Adresse :</strong> <?=$enseignant['adresse']?></p>
                <p><strong>Grade :</strong> <?=$enseignant['grade']?></p>
                <p><strong>Statut actuel :</strong> <?=$enseignant['statut']?></p>
                <p><strong>Naissance :</strong> <?=$enseignant['date_naissance']?></p>
                <p><strong>Date de récrutement :</strong> <?=$enseignant['date_recrutement']?></p>
                <p><strong>Email :</strong> <?=$enseignant['email']?></p>
                <p><strong>Classe Suivie :</strong> <?=$enseignant['nom_filier']?></p>
            </div>
        </div>

    </div>

</div>
<script>
    const base_url = '<?= base_url() ?>';
</script>
<script>
    let role = "<?= $this->session->userdata('role') ?>";
</script>

<script src="<?= base_url('asset/allScript/template/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?= base_url('asset/allScript/traitement/sweetalert.js') ?>"></script>
<script src="<?= base_url('asset/allScript/traitement/ajout_enseignant.js'); ?>"></script>