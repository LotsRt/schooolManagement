<link rel="stylesheet" href="<?= base_url('asset/css/traitement/dashbord.css'); ?>">
<div class="content p-4" id="main-content">
    <div class="dashboard">
        <!-- Ligne 1 : 3 boîtes -->

        <div class="row">
            <div class="box">
                <h4>Elève inscrite:</h4>
                <h3 class="text-center"><?= $total_nombre ?></h3>
            </div>

            <div class="box">
                <h4>Nombre d'enseignent:</h4>
                <h3 class="text-center"><?= $total_enseignant ?></h3>

            </div>

            <div class="box small">
                <h4>Moyenne</h4>
                <form id="moyenne" method="POST" action="moyenne">
                    <select name="option">
                        <?php foreach ($classe as $rows) { ?>
                            <option value="<?= $rows['nom_filier'];?>"><?= $rows['nom_filier']; ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit">Moyenne</button>
                </form>
                <h5>moyenne<?=$result;?>:<?=$moyenne->moyenne?></h5>
            </div>
        </div>

        <!-- Ligne 3 : 1 rectangle + 1 cercle -->
        <div class="row">
            <div class="box large">
                <h4 class="text-center">Classe</h4>
                <table class="table table-striped table-bordered text-center align-middle">
                    <thead class="table_head">
                        <tr>
                            <th>classe</th>
                            <th>designation</th>
                        </tr>
                    </thead>
                    <tbody class="table_body">
                        <?php foreach ($classe as $rows) { ?>
                            <tr>

                                <td>filière</td>
                                <td><?= $rows['nom_filier']; ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>

            </div>
            <!-- <div class="circle"></div> -->
        </div>

    </div>

</div>

<script>
    var base_url = "<?= base_url(); ?>"; 
</script>

<script src="<?= base_url('asset/allScript/template/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?= base_url('asset/allScript/traitement/sweetalert.js') ?>"></script>