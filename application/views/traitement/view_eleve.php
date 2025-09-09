<link rel="stylesheet" href="<?= base_url('asset/css/traitement/sweetalert.css') ?>">

<!-- Modal NOTE-->
<div class="modal fade" id="modal_ajout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalmodifLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalAjoutNote"> Ajout_note</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="forme_note">
                <div class="modal-body">
                    <input type="hidden" name="id_note" id="id_note" class="form-control">
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Matricule</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="Matricule_eleve" id="Matricule_eleve" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Code_filier</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="code_filier" id="code_filier" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">code_matiere</label>
                        <div class="col-sm-8">
                            <input type="text" name="code_matiere" id="code_matiere" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">note</label>
                        <div class="col-sm-8">
                            <input type="text" name="note" id="note" class="form-control">
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




<!-- Modal modification-->
<div class="modal fade" id="modal_test" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalmodifLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalmodifLabel"> Ajout_eleve</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_calque">
                <div class="modal-body">
                    <input type="hidden" name="id_eleve" id="id_eleve" class="form-control">
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Matricule</label>
                        <div class="col-sm-8">
                            <input type="text" name="Matricule" id="Matricule" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Nom</label>
                        <div class="col-sm-8">
                            <input type="text" name="Nom" id="Nom" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Prénom</label>
                        <div class="col-sm-8">
                            <input type="text" name="Prenom" id="Prénom" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Age</label>
                        <div class="col-sm-8">
                            <input type="text" name="Age" id="Age" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Sexe</label>
                        <div class="col-sm-8">
                            <input type="text" name="Sexe" id="Sexe" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Date de naissance</label>
                        <div class="col-sm-8">
                            <input type="date" name="naissance" id="naissance" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Nom du père</label>
                        <div class="col-sm-8">
                            <input type="text" name="père" id="père" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Nom du mère</label>
                        <div class="col-sm-8">
                            <input type="text" name="mère" id="mère" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Adresse</label>
                        <div class="col-sm-8">
                            <input type="text" name="Adresse" id="Adresse" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">code (Filiere/classe)</label>
                        <div class="col-sm-8">
                            <input type="text" name="classe" id="classe" class="form-control" required>
                        </div>
                    </div>
                    <!-- <div class="form-group row mt-2">
                        <label class="col-sm-4">date_inscription</label>
                        <div class="col-sm-8">
                            <input type="date" name="date_inscription" id="date_inscription" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">anne</label>
                        <div class="col-sm-8">
                            <input type="text" name="anne" placeholder="2024-2025" pattern="[0-9]{4}-[0-9]{4}" required>
                        </div>
                    </div> -->
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
        <button type="button" class="btn btn-primary " id="open" data-bs-toggle="modal"
            data-bs-target="#modal_ajout">Ajout_note</button>
             <button type="button" class="btn btn-primary" id="openmodal" onclick="openAddModal()">Ajout_eleve</button>
              <button type="button" class="btn btn-primary" id="test" onclick="affiche_getapi()">Test</button>
    </div>
    <div class="d-flex justify-content-end">
        
    </div>



    <div class="card-body table_custom_1" style="margin:0;padding:0;">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead class="table_head">
                <tr>
                    <th><i class="fas fa-user me-1"></i>Matricule</th>
                    <th><i class="fas fa-user me-1"></i>Nom</td>
                    <th><i class="fas fa-user me-1"></i>Prenom</td>
                    <th><i class="fas fa-user me-1"></i>Classe/filièr</th>
                    <th><i class="fas fa-user me-1"></i>Action</th>
                </tr>
            </thead>
            <tbody id="body_table_content">

            </tbody>
        </table>
    </div>

</div>

<!-- on doit pas oblier de initialiser le base url -->
<script>
    var base_url = "<?= base_url(); ?>"; 
</script>

<script>
    let role = "<?= $this->session->userdata('role') ?>";
</script>

<script src="<?= base_url('asset/allScript/template/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?= base_url('asset/allScript/traitement/sweetalert.js') ?>"></script>
<script src="<?= base_url('asset/allScript/traitement/ajout_eleve.js'); ?>"></script>
<script src="<?= base_url('asset/allScript/testapi.js'); ?>"></script>