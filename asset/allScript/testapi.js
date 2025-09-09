
function affiche_getapi(){
    $.ajax({
        url:base_url +'api/v1/eleves',
        type:"GET",
        contentType:"application/json",
        dataType:"json",
        success: function (reponse) {
            if (reponse.status === "success") {
                swal.fire(
                    "Succès",
                    reponse.message,
                    "success");
                     console.log(reponse.data);
            } else if (reponse.status === "error") {
                swal.fire(
                    "Erreur",
                    reponse.message,
                    "error");
            }
        },
        error: function () {
            alert('erreur lors de l envoye de donne');
        }
    });

}


// // Exemple avec fetch pour récupérer tous les élèves
// function chargerEleve(){
// fetch('http://localhost/school_management/api/v1/eleves', {
//     method: 'GET',
//     headers: {
//         'Content-Type': 'application/json'
//     }
// })
// .then(response => response.json())
// .then(data => {
//     console.log(data); // data contient tous les élèves
// })
// .catch(error => console.error('Erreur:', error));
// }

