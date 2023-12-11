document.addEventListener('DOMContentLoaded', () =>{
    var LgIn = document.getElementById('loginbtn');

    LgIn.addEventListener('click', (e) => {

        e.preventDefault();
        var email = document.getElementById('email');
        var pword = document.getElementById('password');

        fetch("main.php?querytypes="+encodeURIComponent("userlogin")+"&email="+encodeURIComponent("email")+"&password="+encodeURIComponent("pword"),  {method: 'GET'})
            .then(response=>{
                if (response.ok) {
                    return response.text()
                } else {
                    return Promise.reject('something went wrong!')
                }
            })
            .then(data=>{
                window.location = "home.html";
            })
            .catch(error => console.log('There was an error: ' + error));
            
    });//end login event listener

});//end on DOM load listener