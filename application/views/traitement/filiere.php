<link rel="stylesheet" href="<?= base_url('asset/css/traitement/sweetalert.css') ?>">
<!-- Modal FILIER-->
<div class="modal fade" id="modal_ajoutFi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalmodifLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_filiere"> Ajout filière</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="forme_Fi">
                <div class="modal-body">
                    <input type="hidden" name="id_filier" id="id_filier" class="form-control">
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">code_filière</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="code_filier" id="code_filier" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">nom filière</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="nom_filier" id="nom_filier" class="form-control" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="fermerButtonModif">Fermer</button>
                    <button class="btn btn-primary" id="buttonSav">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin Modal -->

<!-- Modal matiere-->
<div class="modal fade" id="modal_ajoutMat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalmodifLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_filiere"> Ajout Matiere</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="forme_Mat">
                <div class="modal-body">
                    <input type="hidden" name="id_matiere" id="id_matiere" class="form-control">
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">code_matiere</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="code_matiere" id="code_matiere" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">nom matiere</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="nom_matiere" id="nom_matiere" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Volume horaire</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="volume" id="volume" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">Coefficient</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="Coefficient" id="Coefficient" class="form-control" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="fermerButtonModif">Fermer</button>
                    <button class="btn btn-primary" id="buttonSav">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin Modal -->

<!-- Modal matiere_filiere-->
<div class="modal fade" id="modal_ajoutMatFi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalmodifLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_filiere">Matière filière</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="forme_MatFi">
                <div class="modal-body">
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">code_filière</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="code_filiere" id="code_filiere" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">code_matiere</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="cod_matiere" id="cod_matiere" class="form-control" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="fermerButtonModif">Fermer</button>
                    <button class="btn btn-primary" id="buttonMatFi">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin Modal -->





<div class="content p-4" id="main-content">
    <div>
         <button type="button" class="btn btn-primary " id="open" data-bs-toggle="modal"
            data-bs-target="#modal_ajoutFi">Ajout filière</button>
              <button type="button" class="btn btn-primary " id="open" data-bs-toggle="modal"
            data-bs-target="#modal_ajoutMat">Ajout Matiere</button>
            <button type="button" class="btn btn-primary " id="open" data-bs-toggle="modal"
            data-bs-target="#modal_ajoutMatFi">Ajout Matiere par filière</button>
    </div>
    <div class="card-body table_custom_1" style="margin:0;padding:0;">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead class="table_head">
                <tr>
                    <th><i class="fas fa-user me-1"></i>Intitulée</th>
                    <th><i class="fas fa-user me-1"></i>code</td>
                    <th><i class="fas fa- me-1"></i>Action</th>
                </tr>
            </thead>
            <tbody id="body_table_content"></tbody>
            <?php foreach ($filiere as $row) { ?>
                <td></i><?= $row['nom_filier'] ?></td>
                <td></i><?= $row['code_filier'] ?></td>
                <td>
                    <a href="<?= base_url('EleveFiliere/' . $row['code_filier']) ?>"
                        class="btn btn-outline-primary btn-sm">éleve
                    </a>

                    <a href="<?= base_url('MatriereF/' . $row['code_filier']) ?>"
                        class="btn btn-outline-primary btn-sm">matiere
                    </a>
                </td>
                </tbody>
            <?php } ?>
        </table>
    </div>
</div>
<script>
    var base_url = "<?= base_url(); ?>"; 
</script>

<script src="<?= base_url('asset/allScript/template/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?= base_url('asset/allScript/traitement/sweetalert.js') ?>"></script>
<script src="<?= base_url('asset/allScript/traitement/ajout_matFilier.js'); ?>"></script>
