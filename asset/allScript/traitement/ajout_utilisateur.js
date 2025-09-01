const forme_table=$('#body_table_content');

$('#forme_note').on('submit', function (x) {
    x.preventDefault();
    ajout_utilisateur();
});


function ajout_utilisateur(){
const nomUtilisateur=$('#nomUtilisateur').val();
const prenom=$('#prenom').val();
const role=$('#role').val();
const pass=$('#pass').val();

$.ajax({
    url:base_url + "ajout_utilisateur",
    type:'POST',
    data:{
        nomUtilisateur:nomUtilisateur,
        prenom:prenom,
        role:role,
        pass:pass
},
dataType:"json",
success: function (reponse){
    if (reponse.status === "success") {
                Swal.fire(
                    "Succès",
                    reponse.message,
                    "success");
            } else if (reponse.status === "error") {
                Swal.fire(
                    "Erreur",
                    reponse.message,
                    "error");
            }
            $('#modal_utili').modal('hide');
            console.log(prenom, nomUtilisateur);
        },
        error: function () {
            alert('erreur lors de l envoye de donne');
            $('#modal_utili').modal('hide');
        }  
});
}




function fetch() {
    $.ajax({
        url: base_url + "get_utilisateur",
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
    forme_table.html('');
    if (data.length >= 1) {
        data.forEach(row => {
            let tr = `
                <tr>
                <td>${row['nomUtilisateur']}</td>
                <td>${row['prenom']}</td>        
                <td>${row['role']}</td> 
                <td class="text-center" colspan="2">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modal_test"
                            onclick="recuperId(${row['id_utilisateur']})">
                            modifier
                        </button>
                        
                         <a href="${base_url}DetailE/${row['id_eleve']}" 
                        class="btn btn-outline-primary btn-sm">détail</a>
                 </td>      
                
                </tr>
            `;
            forme_table.append(tr);
        });
    } else {
        let tr = ` <tr><td class="text-muted h6" colspan="5" style="text-align:center;color: #0f3659;">Aucun Résultat</td></tr>`;
        body_table_content.append(tr);
    }
}

$(document).ready(function () {
    fetch();
});