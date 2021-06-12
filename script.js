function display(){
    var checkboxLength = document.getElementsByClassName("check-box").length;
    var value = document.getElementById("type").value;
    if (value === "1" || value === "5" || value === "6"){
        for (var i=0 ; i<checkboxLength ; i++){
            document.getElementsByClassName("check-box")[i].style="display: block";
        }
    } else{
        for (var i=0 ; i<checkboxLength ; i++){
            document.getElementsByClassName("check-box")[i].style="display: none";
        }
    }
}

function rating(){
    let rating = parseFloat(document.getElementById('avg').value);
    let decimal = rating % 1;
    if (decimal > 0.5){
        rating = Math.ceil(parseFloat(document.getElementById('avg').value));
    } else{
        rating = Math.floor(parseFloat(document.getElementById('avg').value));
    }
    for (let i = rating-1 ; i >= 0 ; i--){
        document.getElementsByClassName('far fa-star info-icon')[i].style.fontWeight = 'bold';
    }
}
