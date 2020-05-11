/**
 * This is my original work and it shall not be used anywhere else without my written permission.
 * When the app first loads, it should retrieve the list of accounts with an Ajax request and display it. 
 * When the user inserts a new customer by clicking the button , 
 * it launches an Ajax request to insert the new customer id. When it gets the response from this first request, 
 * it should launch another Ajax request to retrieve the entire list and display it again on the page.
 */
window.addEventListener("load", function() {

    /**
     * This function should be called when the AJAX call is complete
     * and the text has been extracted from the response.
     * @param {String} text 
     */
    
    function success(text) {
        for(let x=0;x<text.length;x++){
        let span = document.getElementById("target");
        span.innerHTML += "\t"+text[x].firstname+"&nbsp"+"--"+text[x].lastname +"--"+"&nbsp"+text[x].customerid +"--"+"&nbsp"+text[x].addres +"--"+"&nbsp"+text[x].phone +"--"+"&nbsp"+"$"+text[x].balance + "<br>";
        console.log(text);
 
        }
    }

    let button = document.getElementById("addcustomerbutton");
    
  
    // if button addcustomerbutton is selected by user
    button.addEventListener("click", function() {
        let firstname = document.getElementById("firstname").value;
        let lastname = document.getElementById("lastname").value;
        let addres = document.getElementById("addres").value;
        let phone = document.getElementById("phone").value;
        let balance = document.getElementById("balance").value;
    

        // construct the parameter string
        // we're using the same style as GET params
        let params = "firstname=" + firstname + "&lastname=" + lastname+ "&addres=" + addres+ "&phone=" + phone+ "&balance=" + balance;
        console.log(params); // debug

        // do the fetch
        fetch("additem.php", {
                method: 'POST',
                credentials: 'include',
                headers: { "Content-Type": "application/x-www-form-urlencoded" }, // parameter format
                body: params // POST params are sent in the body
            })
            .then(response => response.json())
            .then(success)

    });

    
});