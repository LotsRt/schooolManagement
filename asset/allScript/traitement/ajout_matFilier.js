$('#forme_Fi').on('submit',function(x){
     x.preventDefault();
    ajout_filiere();
}
);

$('#forme_Mat').on('submit',function(x){
     x.preventDefault();
    ajout_matiere();
}
);

$('#forme_MatFi').on('submit',function(x){
    x.preventDefault();
    ajout_MatiereFiliere()

});

function ajout_filiere(){
    const code_filier=$('#code_filier').val();
    const nom_filier=$('#nom_filier').val();
    $.ajax({
        url:base_url + "ajout_filier",
        type:'POST',
        data:{
            code_filier:code_filier,
            nom_filier:nom_filier
        },
        dataType:"json",
         success: function (reponse) {
            if (reponse.status === "success") {
                swal.fire("Succès", reponse.message,"success");
            } else if (reponse.status === "error") {
                swal.fire("Erreur",reponse.message,"error");
            }
            $('#modal_ajoutFi').modal('hide');
            console.log(code_filier);
        },
        error: function () {
            alert('erreur lors de l envoye de donne');
            $('#modal_ajoutFi').modal('hide');
        }

    });
}

function ajout_matiere(){
    const code_matiere=$('#code_matiere').val();
    const nom_matiere =$('#nom_matiere').val();
    const volume =$('#volume').val();
    const coefficient =$('#Coefficient').val();

    $.ajax({
        url:base_url + "ajout_Matiere",
        type:'POST',
        data:{
            code_matiere:code_matiere,
            nom_matiere:nom_matiere,
            volume:volume,
            coefficient:coefficient
        },
        dataType:"json",
         success: function (reponse) {
            if (reponse.status === "success") {
                swal.fire("Succès", reponse.message,"success");
            } else if (reponse.status === "error") {
                swal.fire("Erreur",reponse.message,"error");
            }
            $('#modal_ajoutMat').modal('hide');
            console.log(code_matiere);
        },
        error: function () {
            alert('erreur lors de l envoye de donne');
            $('#modal_ajoutMat').modal('hide');
        }

    });
}

function ajout_MatiereFiliere(){
    const code_filier=$('#code_filiere').val();
    const code_matiere=$('#cod_matiere').val();
    $.ajax({
        url:base_url+"ajoutMatFi",
        type:'POST',
        data:{
            code_filier:code_filier,
            code_matiere:code_matiere
        },
        dataType:"json",
        success:function(reponse){
            if (reponse.status === "success") {
                swal.fire("Succès", reponse.message,"success");
            } else if (reponse.status === "error") {
                swal.fire("Erreur",reponse.message,"error");
            }
            $('#modal_ajoutMatFi').modal('hide');
        },
        error: function () {
            alert('erreur lors de l envoye de donne');
            $('#modal_ajoutMatFi').modal('hide');
        }
    });
}