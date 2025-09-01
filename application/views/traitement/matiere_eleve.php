<div class="content p-4" id="main-content">
    <div class="card-body table_custom_1" style="margin:0;padding:0;">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead class="table_head">
                <tr>
                    <th><i class="fas fa-user me-1"></i>Nom_matiere</th>
                    <th><i class="fas fa-user me-1"></i>Code_matiere</td>
                    <th><i class="fas fa-user me-1"></i>Volume_horaire</td>
            </thead>
            <tbody id="body_table_content">
                <?php foreach ($matiere as $row) { ?>
                    <td></i><?= $row['nom_matiere'] ?></td>
                    <td></i><?= $row['code_matiere'] ?></td>
                    <td></i><?= $row['volume_horaire'] ?></td>
                    <td>
                        <a href="<?= base_url('rediriger_note_eleve/' . $row['code_matiere'] . '/' . $row['code_filier']) ?>"
                            class="btn btn-outline-primary btn-sm">note_eleve</a>
                            <!-- ici les resultat obtenue par le code_filier reste le  meme pour tout les ligne -->
                             <!-- reste a recuperer le code matiere -->
                    </td>

                </tbody>
            <?php } ?>

        </table>
    </div>
</div>
<script src="<?= base_url('asset/allScript/template/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?= base_url('asset/allScript/traitement/sweetalert.js') ?>"></script>