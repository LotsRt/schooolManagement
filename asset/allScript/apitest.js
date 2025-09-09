function test(){
fetch('http://localhost/school_management/api/v1/eleves', {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json'
    }
})
.then(response => response.json())
.then(data => {
    console.log(data); // ici tu as le tableau des élèves
})
.catch(error => console.error('Erreur:', error));
}

