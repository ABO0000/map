<?php 


if( $_SERVER['REQUEST_METHOD'] == "POST" ){
 
    if( $_POST['name'] == "getDistance") {
        $res = file_get_contents($_POST['link']);
        print $res;
    }
    

} 




// dynamic divs section
// let tex = document.getElementById('detalis')
// let div = document.createElement("div");
// div.classList.add('asd' )
// let div1 = document.createElement("div");
// div1.classList.add('d-flex','border-top' )
// // div1.borderTopStyle = '2px solid red';
// // div1.borderTopWidth= 'thin';
// let h4 = document.createElement("h4");
// h4.innerHTML=origin_addresses[i].location
// let h3 = document.createElement("h3");
// h3.innerHTML='-'
// let h41 = document.createElement("h4");
// h41.innerHTML= destination_addresses[i].location

// let div2 = document.createElement("div");
// div2.classList.add('d-flex' , 'justify-content-between')
// let h6 = document.createElement("h6");
// h6.innerHTML= $stop[i].duration.text 
// let h61 = document.createElement("h6");
// h61.innerHTML= $stop[i].distance.text

// div1.appendChild(h4)
// div1.appendChild(h3)
// div1.appendChild(h41)
// div.appendChild(div1)
// div2.appendChild(h6)
// div2.appendChild(h61)
// div.appendChild(div2)
// tex.appendChild(div)
            



?>