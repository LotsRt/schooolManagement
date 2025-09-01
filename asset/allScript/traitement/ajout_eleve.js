const body_table_content = $('#body_table_content');

$('#form_calque').on('submit', function (x) {
    x.preventDefault();
    ajout_eleve();
});

function ajout_eleve() {
    const id_eleve = $('#id_eleve').val();
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
    // const date_inscription = $('#date_inscription').val();
    // const anne = $('#anne').val();


    let Swal;

    let url = "";
    if (id_eleve === "") {
        url = base_url + "Ajout";
    }
    else {
        url = base_url + "upgrader_eleve";
    }
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id_eleve: id_eleve,
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
            // anne:anne,
            // date_inscription:date_inscription

        },
        dataType: "json",
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
            $('#modal_test').modal('hide');
            console.log(Matricule, Nom, adresse);
        },
        error: function () {
            alert('erreur lors de l envoye de donne');
            $('#modal_test').modal('hide');
        }
    });

}

// -----------------------------------------------------------------------------------

function fetch() {
    $.ajax({
        url: base_url + 'get_eleve_matiere',
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
    body_table_content.html('');
    if (data.length >= 1) {
        data.forEach(row => {
            let button=''
            if(role=='admin' || role=='superadmin'){
                button=`<td class="text-center" colspan="2">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modal_test"
                            onclick="recuperId(${row['id_eleve']})">
                            modifier
                        </button>
                        
                         <a href="${base_url}DetailE/${row['id_eleve']}" 
                        class="btn btn-outline-primary btn-sm">détail</a>
                 </td>      `
            }
            let tr = `
                <tr>
                <td>${row['matricule']}</td>
                <td>${row['nom']}</td>
                <td>${row['prenom']}</td>        
                <td>${row['nom_filier']}</td> 
                ${button}               
                </tr>
            `;
            body_table_content.append(tr);
        });
    } else {
        let tr = ` <tr><td class="text-muted h6" colspan="5" style="text-align:center;color: #0f3659;">Aucun Résultat</td></tr>`;
        body_table_content.append(tr);
    }
}

$(document).ready(function () {
    fetch();
});



function recuperId(id) {
    $.ajax({
        url: base_url + 'recupere_avecID_eleve',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success:
            function (data) {
                // console.log(data);
                if (data) {
                    $('#modalmodifLabel').text("MODIFICATION ELEVE");
                    $('#id_eleve').val(data.id_eleve);
                    $('#Matricule').val(data.matricule);
                    $('#Nom').val(data.nom);
                    $('#Prénom').val(data.prenom);
                    $('#Age').val(data.age);
                    $('#naissance').val(data.date_naissance);
                    $('#Sexe').val(data.sexe);
                    $('#père').val(data.pere);
                    $('#mère').val(data.mere);
                    $('#Adresse').val(data.adresse);
                    $('#classe').val(data.code_filier);
                    $('#Sexe,#Age,#Adresse,#naissance,#recrutement,#grade,#père,#mère').prop('disabled', true);
                    $('#modal_test').modal('show');
                } else {
                    alert("Aucune donnée trouvée.");
                }
            },
        error: function () {
            alert("Erreur lors de la récupération.");
        }
    });
}

function openAddModal() {
    $('#modalmodifLabel').text("AJOUT ELEVE");
    const id_eleve = $('#id_eleve').val('');
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
    $('#modal_test').modal('show');
}


//-------------------------------------------------------

$('#forme_note').on('submit', function (x) {
    x.preventDefault();
    ajout_note();
});

function ajout_note() {
    const Matricule = $('#Matricule_eleve').val();
    const code_filier = $('#code_filier').val();
    const code_matiere = $('#code_matiere').val();
    const note = $('#note').val();
    let Swal;
    $.ajax({
        url: base_url + "add_note",
        type: 'POST',
        data: {
            Matricule: Matricule,
            code_filier: code_filier,
            code_matiere: code_matiere,
            note: note
        },
        dataType: "json",
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
            $('#modal_ajout').modal('hide');
            console.log(Matricule);
        },
        error: function () {
            alert('erreur lors de l envoye de donne');
            $('#modal_ajout').modal('hide');
        }
    });

}


// -----------------------------------------------------------------------------