

all_button = document.getElementById("all");
support_button = document.getElementById("support");
assign_button = document.getElementById("assign");
sales_button = document.getElementById("sales");
tbody = document.getElementById("tbody");

let type = 'all';
let select = 'all';


function fetcher(){
        console.log("main.php?querytypes=dashboard&select=${type}&type=${select}")
        fetch("main.php?querytypes=dashboard&select=" + type + "&type=" + select )
        .then(response => response.text())
        .then(data => {

            tbody.innerHTML = data;

            linkadder();

            console.log(data);




        }
        ) 
        .catch(error => console.error("Error", error));

}

all_button.addEventListener('click', function() {
    type = 'all';
    select = 'all';
    fetcher();

})


sales_button.addEventListener('click', function() {
    type = 'type';
    select = 'Sales Lead';
    fetcher();
})

assign_button.addEventListener('click', function() {
    type = 'assigned';
    select = 'assigned';
    fetcher();
})


support_button.addEventListener('click', function() {
    type = 'type';
    select = 'support';
    fetcher();
})







function start(){
    type = 'all';
    select = 'all';
    fetcher();
}

start();




function linkadder(){


    const view = document.querySelectorAll('.view');

    view.forEach(function (a) {
        let inputData = a.getAttribute('data-value');
        a.href = `Contact-Details.html?data=${inputData}`;
        
    
    });

}



function fetcher3(){
    console.log("main.php?querytypes=dashboard&select=${type}&type=${select}")
    fetch("main.php?querytypes=getCUsr")
    .then(response => response.text())
    .then(data => {
        

        console.log(data);




    }
    ) 
    .catch(error => console.error("Error", error));

}


fetcher3()