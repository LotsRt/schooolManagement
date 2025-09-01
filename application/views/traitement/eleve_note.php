<div class="content p-4" id="main-content">
    <div class="card-body table_custom_1" style="margin:0;padding:0;">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead class="table_head">
                <tr>
                    <th><i class="fas fa-user me-1"></i>Matricule</th>
                    <th><i class="fas fa-user me-1"></i>Nom</td>
                    <th><i class="fas fa-user me-1"></i>Prenom</td>
                    <th><i class="fas fa-user me-1"></i>Moyenne</td>
                     <th><i class="fas fa-user me-1"></i>Total</td>
                    
            </thead>
            <tbody id="body_table_content">
                <?php foreach ($note_eleve as $row) { ?>
                    <td></i><?= $row['matricule'] ?></td>
                    <td></i><?= $row['nom'] ?></td>
                    <td></i><?= $row['prenom'] ?></td>
                    <td></i><?= $row['moyenne'] ?></td>
                    <td></i><?= $row['total_note'] ?></td>
                    <!-- les notes obtenue ici  est issue de matiere d'un filiere  a l aide de code_matiere 
                     dun code_filier  toujour le meme-->
                </tbody>
            <?php } ?>

        </table>
    </div>
</div>
<script src="<?= base_url('asset/allScript/template/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?= base_url('asset/allScript/traitement/sweetalert.js') ?>"></script>