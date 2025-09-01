
<link rel="stylesheet" href="<?= base_url('asset/css/traitement/sweetalert.css') ?>">

<!-- Modal enseignant-->
<div class="modal fade" id="modal_enseignant" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalmodifLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalmodifLabel"> Ajout_eleve</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_enseignant">
                <div class="modal-body">

                    <input type="hidden" name="id_enseignant" id="id_enseignant" class="form-control">

                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Matricule</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="Matricule" id="Matricule" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Nom</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="Nom" id="Nom" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Prénom</label>
                        <div class="col-sm-8">
                            <input type="text" name="Prénom" id="Prénom" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">code_matiere</label>
                        <div class="col-sm-8">
                            <input type="text" name="code_matiere" id="code_matiere" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">code_enseignant</label>
                        <div class="col-sm-8">
                            <input type="text" name="code_enseignant" id="code_enseignant" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">code_filiere</label>
                        <div class="col-sm-8">
                            <input type="text" name="code_filiere" id="code_filiere" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Sexe</label>
                        <div class="col-sm-8">
                            <input type="text" name="Sexe" id="Sexe" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Date de_recrutement</label>
                        <div class="col-sm-8">
                            <input type="date" name="recrutement" id="recrutement" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">telephone</label>
                        <div class="col-sm-8">
                            <input type="text" name="telephone" id="telephone" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">adresse</label>
                        <div class="col-sm-8">
                            <input type="text" name="adresse" id="adresse" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">email</label>
                        <div class="col-sm-8">
                            <input type="text" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Statut</label>
                        <div class="col-sm-8">
                            <select name="status" id="status" class="form-control" required>
                                <option value="vacataire">Vacataire</option>
                                <option value="titulaire">Titulaire</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mt-2">
                        <label class="col-sm-4">grade</label>
                        <div class="col-sm-8">
                            <input type="text" name="grade" id="grade" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">date_naissance</label>
                        <div class="col-sm-8">
                            <input type="date" name="date_naissance" id="date_naissance" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="fermerButtonModif">Fermer</button>
                    <button class="btn btn-primary" id="submitButtonmodif">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin Modal -->




<div class="content p-4" id="main-content">
    <div>
        <button type="button" class="btn btn-primary " id="open modal" onclick="openAddModal()">Enseignant</button>
    </div>
    <div class="card-body table_custom_1" style="margin:0;padding:0;">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead class="table_head">
                <tr>
                    <th><i class="fas fa-user me-1"></i>Matricule</th>
                    <th><i class="fas fa-user me-1"></i>Nom</td>
                    <th><i class="fas fa-user me-1"></i>Prenom</td>
                    <th><i class="fas fa-user me-1"></i>Code Enseignant</th>
                    <th><i class="fas fa-user me-1"></i>Matière</th>
                    <th><i class="fas fa-user me-1"></i>Classe encadrée</th>
                    <th><i class="fas fa-user me-1"></i>Téléphone</th>
                    <th><i class="fas fa-user me-1"></i>Email</th>
                    <th><i class="fas fa-user me-1"></i>Statut</th>
                    <th><i class="fas fa- me-1"></i>Action</th>
                </tr>
            </thead>
            <tbody id="body_table_content">

            </tbody>
        </table>
    </div>
</div>

<script>
    let base_url="<?=base_url('');?>";
</script>
<script>
    let role = "<?= $this->session->userdata('role') ?>";
</script>
<script src="<?= base_url('asset/allScript/template/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?= base_url('asset/allScript/traitement/sweetalert.js') ?>"></script>
<script src="<?= base_url('asset/allScript/traitement/ajout_enseignant.js'); ?>"></script>