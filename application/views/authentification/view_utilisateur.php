<!-- Modal NOTE-->
<div class="modal fade" id="modal_utili" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalmodifLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_ajout_utilisateur"> Ajout_utilisateur</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="forme_note">
                <div class="modal-body">
                    <!-- <input type="hidden" name="id_utilisateur" id="id_utilisateur" class="form-control"> -->
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Nom_utilisateur</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="nomUtilisateur" id="nomUtilisateur" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">prenom</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="prenom" id="prenom" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="role" class="col-sm-4">Rôle</label>
                        <div class="col-sm-8">
                            <select name="role" id="role" class="form-control" required>
                                <option value="">Sélectionnez un rôle</option>
                                <option value="admin">Admin</option>
                                <option value="enseignant">Enseignant</option>
                                <option value="superadmin">Superadmin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">mot_de_passe</label>
                        <div class="col-sm-8">
                            <input type="password" name="pass" id="pass" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="fermetBouton">Fermer</button>
                    <button class="btn btn-primary" id="submitButonUtilisateur">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin Modal -->



<div class="content p-4" id="main-content">
    <div>
        <button type="button" class="btn btn-primary " id="open" data-bs-toggle="modal"
            data-bs-target="#modal_utili">Ajout_utilisateur</button>
    </div>
    <div class="card-body table_custom_1" style="margin:0;padding:0;">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead class="table_head">
                <tr>
                    <th><i class="fas fa-user me-1"></i>Nom_utilisateur</th>
                    <th><i class="fas fa-user me-1"></i>Type_utilisateur</th>
                    <th><i class="fas fa-user me-1"></i>Action</th>
                </tr>
            </thead>
            <tbody id="body_table_content">

            </tbody>
        </table>
    </div>
</div>
<script src="<?= base_url('asset/allScript/template/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?= base_url('asset/allScript/traitement/sweetalert.js') ?>"></script>
<script>
    const base_url="<?=base_url()?>";
</script>
<script src="<?= base_url('asset/allScript/traitement/ajout_utilisateur.js'); ?>"></script>