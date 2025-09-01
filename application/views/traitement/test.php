<!-- Modal modification-->
<div class="modal fade" id="modal_test" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalmodifLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalmodifLabel">MODIFICATION CALQUE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_calque">
                <div class="modal-body">

                    <div class="form-group row">
                        <label class="col-sm-4">Nom</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="nom" id="nom" class="form-control" required>
                            <div class="invalid-feedback" id="invalid-feedback1">
                                Pas de caractère spéciaux
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="col-sm-4">prenom</label>
                        <div class="col-sm-8" class="form-control is-invalid">
                            <input type="text" name="prenom" id="prenom" class="form-control" required>
                            <div class="invalid-feedback" id="invalid-feedback2">
                                Pas de caractère spéciaux
                            </div>
                        </div>

                    </div>

                    <div class="form-group row mt-2">
                        <label class="col-sm-4">message</label>
                        <div class="col-sm-8">
                            <input type="text" name="message" id="message" class="form-control" required>
                            <div class="invalid-feedback" id="invalid-feedback3">
                                Pas de caractère spéciaux
                            </div>
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
        <button type="button" class="btn btn-primary " id="open modal" data-bs-toggle="modal"
            data-bs-target="#modal_test">Test</button>
    </div>
</div>

<!-- on doit pas oblier de initialiser le base url -->
<script>
    var base_url = "<?= base_url(); ?>"; 
</script>
<script src="<?=base_url('asset/allScript/template/jquery-3.4.1.min.js');?>"></script>
