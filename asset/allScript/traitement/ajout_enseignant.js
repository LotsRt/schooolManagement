const body_table_content = $('#body_table_content');


// -------------------------------------------------------------------//
$('#form_enseignant').on('submit', function (e) {
    e.preventDefault();
    enseignant();
});

function enseignant() {
    const id_enseignant = $('#id_enseignant').val();
    const Matricule = $('#Matricule').val();
    const Nom = $('#Nom').val();
    const Prénom = $('#Prénom').val();
    const code_matiere = $('#code_matiere').val();
    const code_enseignant = $('#code_enseignant').val();
    const code_filiere = $('#code_filiere').val();
    const Sexe = $('#Sexe').val();
    const recrutement = $('#recrutement').val();
    const telephone = $('#telephone').val();
    const adresse = $('#adresse').val();
    const email = $('#email').val();
    const status = $('#status').val();
    const grade = $('#grade').val();
    const date_naissance = $('#date_naissance').val();
    let Swal;

    let url = "";
    if (id_enseignant === "") {
        url = base_url + "enseignant_ajout";
    }
    else {
        url = base_url + "upgrader_enseignant";
    }

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id_enseignant: id_enseignant,
            Matricule: Matricule,
            Nom: Nom,
            Prénom: Prénom,
            code_matiere: code_matiere,
            code_enseignant: code_enseignant,
            code_filiere: code_filiere,
            Sexe: Sexe,
            recrutement: recrutement,
            telephone: telephone,
            adresse: adresse,
            email: email,
            status: status,
            grade: grade,
            date_naissance: date_naissance
        },
        dataType: 'json',
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
            $('#modal_enseignant').modal('hide');
            console.log('');
        },
        error: function () {
            alert('erreur lors de l envoye de donne');
            $('#modal_enseignant').modal('hide');
        }
    });
}



// -------------------------------------------------------------------//

function get_enseignant() {
    $.ajax({
        url: base_url + 'recup_donne_enseign',
        type: 'GET',
        dataType: 'json',
        success: function (reponse) {
            affiche_enseignant(reponse.data);
        },
        error: function (xhr, status, error) {
            console.error("Erreur AJAX :", error);
        }
    });
}

function affiche_enseignant(data) {
    body_table_content.html('');
    if (data.length >= 1) {
        data.forEach(row => {
            let boutons = '';
            if (role === 'admin' || role === 'superadmin') {
                boutons = `
                    <td class="text-center" colspan="2">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modal_enseignant"
                            onclick="recuperId(${row['id_enseignant']})">
                            modifier
                        </button>
                    </td>
                    <td class="text-center">
                        <a href="${base_url}Detail/${row['id_enseignant']}" 
                        class="btn btn-outline-primary btn-sm">détail</a>
                    </td>
                `;
            }
            let tr = `
                <tr>
                <td>${row['matricule']}</td>
                <td>${row['nom']}</td>
                <td>${row['prenom']}</td>        
                <td>${row['code_enseignant']}</td>      
                <td>${row['nom_matiere']}</td> 
                <td>${row['nom_filier']}</td>
                <td>${row['telephone']}</td> 
                <td>${row['email']}</td>  
                <td>${row['statut']}</td>
                ${boutons}
                
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
    get_enseignant();
});

// -------------------------------------------------------------------//


function recuperId(id) {
    $.ajax({
        url: base_url + 'recupere_avecID',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success:
            function (data) {
                console.log(data);
                if (data) {
                    $('#modalmodifLabel').text("MODIFICATION ENSEIGNANT");
                    $('#id_enseignant').val(data.id_enseignant);
                    $('#Matricule').val(data.matricule);
                    $('#Nom').val(data.nom);
                    $('#Prénom').val(data.prenom);
                    $('#code_matiere').val(data.code_matiere);
                    $('#code_enseignant').val(data.code_enseignant);
                    $('#code_filiere').val(data.code_filiere);
                    $('#Sexe').val(data.sexe);
                    $('#recrutement').val(data.date_recrutement);
                    $('#telephone').val(data.telephone);
                    $('#adresse').val(data.adresse);
                    $('#email').val(data.email);
                    $('#status').val(data.statut);
                    $('#grade').val(data.grade);
                    $('#date_naissance').val(data.date_naissance);
                    $('#Sexe,#adresse,#date_naissance,#recrutement,#grade').prop('hidden', true);
                    $('#modal_enseignant').modal('show');
                } else {
                    alert("Aucune donnée trouvée.");
                }
            },
        error: function () {
            alert("Erreur lors de la récupération.");
        }
    });
}

// -------------------------------------------------------------------//

function openAddModal() {
    $('#modalmodifLabel').text("AJOUT ENSEIGNANT");
    $('#id_enseignant').val('');
    $('#Matricule').val('');
    $('#Nom').val('');
    $('#Prénom').val('');
    $('#code_matiere').val('');
    $('#code_enseignant').val('');
    $('#code_filiere').val('');
    $('#Sexe').val('');
    $('#recrutement').val('');
    $('#telephone').val('');
    $('#adresse').val('');
    $('#email').val('');
    $('#status').val('');
    $('#grade').val('');
    $('#date_naissance').val('');
    $('#modal_enseignant').modal('show');
}




/*
$(document).ready(function () {
    $('#recherche').keyup(function () {
        var query = $(this).val().trim();
        if (query !== '') {
            $.ajax({
                url: base_url + "api/v1/find",
                method: "POST",
                data: { query: query },
                dataType: "json",
                success: function (data) {
                    affiche_enseignant(data);
                    let suggestionBox = $("#suggestions");
                    suggestionBox.html('');
                    if (data.length > 0) {
                        data.forEach(item => {
                            suggestionBox.append(`<a href="#" class="list-group-item list-group-item-action suggestion">${item.nom} ${item.prenom}</a>`);
                        });

                        // Si on clique sur une suggestion
                        $(".suggestion").click(function (e) {
                            e.preventDefault();
                            $("#recherche").val($(this).text());
                            suggestionBox.html('');
                        });
                    }
                }
            });
        } else {
            $("#suggestions").html('');
        }
    });
});
*/
//methode fetch
document.addEventListener("DOMContentLoaded", function () {
    const rechercheInput = document.getElementById("recherche");
    const suggestionBox = document.getElementById("suggestions");
    let tableBody = document.getElementById('body_table_content');

    rechercheInput.addEventListener("keyup", function () {
        const query = rechercheInput.value.trim();

        if (query !== '') {
            fetch('http://localhost/school_management/api/v1/find', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ query: query })
            })
                .then(response => response.json())
                .then(data => {
                    // Afficher les suggestions
                    suggestionBox.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(item => {
                            const a = document.createElement("a");
                            a.href = "#";
                            a.className = "list-group-item list-group-item-action suggestion";
                            a.textContent = `${item.nom} ${item.prenom} ${item.email} ${item.matricule}`;

                            a.addEventListener("click", function (e) {
                                e.preventDefault();
                                tableBody.innerHTML = '';
                                const tr = document.createElement('tr');
                                const tdMatricule = document.createElement('td');
                                tdMatricule.textContent = item.matricule;

                                const tdNom = document.createElement('td');
                                tdNom.textContent = item.nom
                                const tdPrenom = document.createElement('td');
                                tdPrenom.textContent = item.prenom

                                const tdEmail = document.createElement('td');
                                tdEmail.textContent = item.email

                                tr.appendChild(tdMatricule);
                                tr.appendChild(tdNom);
                                tr.appendChild(tdPrenom);
                                tr.appendChild(tdEmail);
                                tableBody.appendChild(tr);
                                rechercheInput.value = `${item.nom} ${item.prenom} ${item.email} ${item.matricule}`;
                                suggestionBox.innerHTML = ''; // vider les suggestions
                            });
                            suggestionBox.appendChild(a);
                        });
                    } else {
                        const noResult = document.createElement("div");
                        noResult.className = "list-group-item text-muted";
                        noResult.textContent = "Aucun résultat trouvé";
                        suggestionBox.appendChild(noResult);
                    }
                })
                .catch(error => console.error('Erreur:', error));
        } else {
            suggestionBox.innerHTML = '';
            $(document).ready(function () {
                get_enseignant();
            });

        }
    });
});
