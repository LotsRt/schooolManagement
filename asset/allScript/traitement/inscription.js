const body_table_inscription = $('#body_table_inscription');
let Swal;
let url = "";
$('#form_inscription').on('submit',function(x){
    x.preventDefault();
    inscription();00
});

function inscription(){
    const id_inscription = $('#id_inscription').val();
    const Matricule = $('#Matricule').val();
    const Nom = $('#Nom').val();
    const Prénom = $('#Prénom').val();
    const Age = $('#Age').val();
    const Sexe = $('#Sexe').val();
    const naissance = $('#naissance').val();
    const père = $('#père').val();
    const mère = $('#mère').val();
    const adresse = $('#Adresse').val();
    const classe = $('#classe').val();
    const date_inscription = $('#date_inscription').val();
    const anne = $('#anne').val();

    if(id_inscription === ""){
        url=base_url+"add_inscription";
    }else{
        url=base_url+"modification_inscription";
    }
    $.ajax({
        url:url,
        type:'POST',
        data:{
            id_inscription:id_inscription,
            Matricule: Matricule,
            Nom: Nom,
            Prénom: Prénom,
            Age: Age,
            Sexe: Sexe,
            naissance: naissance,
            père: père,
            mère: mère,
            adresse: adresse,
            classe: classe,
            date_inscription:date_inscription,
            anne:anne
        },
         dataType:'json',
         success: function (reponse) {
            if (reponse.status === "success") {
                swal.fire(
                    "Succès",
                    reponse.message,
                    "success");
            } else if (reponse.status === "error") {
                swal.fire(
                    "Erreur",
                    reponse.message,
                    "error");
            }
            $('#modal_inscription').modal('hide');
            console.log(Matricule, Nom, anne);
        },
        error: function () {
            alert('erreur lors de l envoye de donne');
            $('#modal_inscription').modal('hide');
            
        }

    });
}

// function d affichage 

function fetch() {
    $.ajax({
        url: base_url + 'get_inscription',
        type: 'GET',
        dataType: 'json',
        success: function (reponse) {
            affiche_table(reponse.data);
        },
        error: function (xhr, status, error) {
            console.error("Erreur AJAX :", error);
        }
    });
}
function affiche_table(data) {
    body_table_inscription.html('');
    if (data.length >= 1) {
        data.forEach(row => {
            let button=''
            if(role=='admin' || role=='superadmin'){
                button=`<td class="text-center" colspan="2">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modal_test"
                            onclick="recup_inscription(${row['id_inscription']})">
                            modifier
                        </button>
                 </td>      `
            }
            let tr = `
                <tr>
                <td>${row['matricule']}</td>
                <td>${row['nom']}</td>
                <td>${row['prenom']}</td>        
                <td>${row['anne']}</td> 
                ${button}               
                </tr>
            `;
            body_table_inscription.append(tr);
        });
    } else {
        let tr = ` <tr><td class="text-muted h6" colspan="5" style="text-align:center;color: #0f3659;">Aucun Résultat</td></tr>`;
        body_table_inscription.append(tr);
    }
}

function modalInscription(){
    $('#modalmodifLabel').text("INSCRIPTION")
    const id_inscription = $('#id_inscription').val('');
    const Matricule = $('#Matricule').val('');
    const Nom = $('#Nom').val('');
    const Prénom = $('#Prénom').val('');
    const Age = $('#Age').val('');
    const Sexe = $('#Sexe').val('');
    const naissance = $('#naissance').val('');
    const père = $('#père').val('');
    const mère = $('#mère').val('');
    const adresse = $('#Adresse').val('');
    const classe = $('#classe').val('');
    const date_inscription = $('#date_inscription').val('');
    const anne = $('#anne').val('');
    $('#modal_inscription').modal('show');
}

$(document).ready(function () {
    fetch();
});





function recup_inscription(id) {
    $.ajax({
        url: base_url + 'recupere_avecID_inscription',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success:
            function (data) {
                // console.log(data);
                if (data) {
                    $('#modalmodifLabel').text("MODIFICATION INSCRITE");
                    $('#id_inscription').val(data.id_inscription);
                    $('#Matricule').val(data.matricule);
                    $('#Nom').val(data.nom);
                    $('#Prénom').val(data.prenom);
                    $('#date_inscription').val(data.date_inscription);
                    $('#anne').val(data.anne);
                    $('#Adresse').val(data.adresse);
                    $('#classe').val(data.code_filier);
                    $('#Sexe,#Age,#Adresse,#naissance,#recrutement,#grade,#père,#mère,#classe').prop('disabled', true);
                    $('#modal_inscription').modal('show');
                } else {
                    alert("Aucune donnée trouvée.");
                }
            },
        error: function () {
            alert("Erreur lors de la récupération.");
        }
    });
}
