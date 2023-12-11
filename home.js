document.addEventListener('DOMContentLoaded', () =>{
    fetch("main.php?querytypes="+encodeURIComponent("getCUsr"))
        .then(response=>{
            if (response.ok) {
                return response.text()
            } else {
                return Promise.reject('something went wrong!')
            }
        })
        .then(data=>{
            console.log(data);
            if(data === "Admin"){
                adminOptions();
            }
        })
        .catch(error => console.log('There was an error: ' + error));

    const adminbtn = document.createElement('button');
    adminbtn.textContent = 'New User';

    function adminOptions(){
        var options = document.getElementById('admin');
        options.appendChild(adminbtn);
       /* options.innerHTML = '<button id="adminbtn">Create User</button>';*/
    };

    adminbtn.addEventListener('click', () => {
        window.location = "newUser.html";
    });

});