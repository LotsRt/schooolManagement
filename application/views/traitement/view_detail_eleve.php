

<link rel="stylesheet" href="<?= base_url('asset/css/traitement/sweetalert.css') ?>">
<link rel="stylesheet" href="<?= base_url('asset/css/traitement/detail_enseignant.css') ?>">

<div class="content p-4" id="main-content">
    <div class="carte-enseignant">
        <div class="haut">
            <div class="titre"><?=$eleve['matricule']?></div>
            <div class="photo">
                <img src="photo.jpg" alt="Photo" />
            </div>
        </div>
        <div class="contenu">
            <div class="ligne">
                <p><strong>Nom :</strong> <?=$eleve['nom']?></p>
                <p><strong>Prénom :</strong> <?=$eleve['prenom']?></p>
                <p><strong>Sexe :</strong> <?=$eleve['sexe']?></p><br>
                <p><strong>Age:</strong> <?=$eleve['age']?></p>
                <p><strong>Date de naissance :</strong> <?=$eleve['date_naissance']?></p>
                <p><strong>Nom du père :</strong> <?=$eleve['pere']?></p>
                <p><strong>Nom du mère :</strong> <?=$eleve['mere']?></p>
                <p><strong>Adresse :</strong> <?=$eleve['adresse']?></p>
                <p><strong>Classe:</strong> <?=$eleve['nom_filier']?></p>
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
<script src="<?= base_url('asset/allScript/traitement/ajout_eleve.js'); ?>"></script>