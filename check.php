<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Supply Chain DAPP</title>
      <link rel="SHORTCUT ICON" href="images/fibble.png" type="image/x-icon" />
      <link rel="ICON" href="images/fibble.png" type="image/ico" />
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/mdbmin.css" rel="stylesheet">
      <link href="css/mdb.min.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
   </head>
   <body class="area">
      <nav class="navbar navbar-expand-lg navbar-light white" style="position: fixed; width: 100%;z-index: 20;">
<a class="navbar-brand" href="checkproduct.php">
<img src="images/fibble.png" style="width: 30px;"> &nbsp &nbsp
</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" style="color: #4287f5;"></span>
  </button>

  <div class="collapse navbar-collapse" id="basicExampleNav">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item">
    <a class="nav-link" id="aboutbtn"> About </a>

    <li class="nav-item" style="margin-left: 450px; color: black;">
              <h3 style="">Check product details</h3>
    </li>
    </li>
    </ul>
  </div>
</nav>
      <div class="circles">
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
      </div>
      <center>
         <div class="customalert">
            <div class="alertcontent">
               <div id="alertText"> &nbsp </div>
               <img id="qrious">
               <div id="bottomText" style="margin-top: 10px; margin-bottom: 15px;"> &nbsp </div>
               <button id="closebutton" class="formbtn"> OK </button>
            </div>
         </div>
      </center>
      <div>
         <center>
            <div class="centered">
               <form role="form" autocomplete="off">
                  <input type="text" id="searchText" class="searchBox" placeholder="Enter Product Code" onkeypress="isInputNumber(event)" required>
                  <label class=qrcode-text-btn style="width:4%;display:none;">
                  <input type=file accept="image/*" id="selectedFile" style="display:none" capture=environment onchange="openQRCamera(this);" tabindex=-1>
                  </label>
                  <button type="submit" id="searchButton" class="searchBtn"><i class="fa fa-search"></i></button>
               </form>
               <button class="qrbutton" onclick="document.getElementById('selectedFile').click();">
               <i class='fa fa-qrcode'></i> Scan QR
               </button>
               <br><br>
               <p id="database" class="cardstyle">
                  No Data to Display
               </p>
            </div>
         </center>
      </div>
      <!--    <div class='box'>
         <div class='wave -one'></div>
         <div class='wave -two'></div>
         <div class='wave -three'></div>
         </div> -->
      <!-- JQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/mdb.min.js"></script>
      <script src="web3.min.js"></script>
      <script src="app.js"></script>
      <!-- QR Code Reader -->
      <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
      <!-- Web3 Injection -->
      <script>
         web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:8545'));
         var contractAbi = [
         {
           "anonymous": false,
           "inputs": [
             {
               "indexed": false,
               "internalType": "uint256",
               "name": "index",
               "type": "uint256"
             }
           ],
           "name": "Added",
           "type": "event"
         },
         {
           "inputs": [
             {
               "internalType": "uint256",
               "name": "_productId",
               "type": "uint256"
             },
             {
               "internalType": "string",
               "name": "info",
               "type": "string"
             }
           ],
           "name": "addState",
           "outputs": [
             {
               "internalType": "string",
               "name": "",
               "type": "string"
             }
           ],
           "stateMutability": "nonpayable",
           "type": "function"
         },
         {
           "inputs": [
             {
               "internalType": "string",
               "name": "_text",
               "type": "string"
             },
             {
               "internalType": "string",
               "name": "_date",
               "type": "string"
             }
           ],
           "name": "newItem",
           "outputs": [
             {
               "internalType": "bool",
               "name": "",
               "type": "bool"
             }
           ],
           "stateMutability": "nonpayable",
           "type": "function"
         },
         {
           "inputs": [
             {
               "internalType": "string",
               "name": "_a",
               "type": "string"
             },
             {
               "internalType": "string",
               "name": "_b",
               "type": "string"
             }
           ],
           "name": "concat",
           "outputs": [
             {
               "internalType": "string",
               "name": "",
               "type": "string"
             }
           ],
           "stateMutability": "pure",
           "type": "function"
         },
         {
           "inputs": [
             {
               "internalType": "uint256",
               "name": "_productId",
               "type": "uint256"
             }
           ],
           "name": "searchProduct",
           "outputs": [
             {
               "internalType": "string",
               "name": "",
               "type": "string"
             }
           ],
           "stateMutability": "view",
           "type": "function"
         }
         ]; // Paste Contract Here
         
         var contractAddress ='0x82f5d7B22f40706496024E6bbaa02b0b156cd118'; 
             // Set the Contract
             var contract = new web3.eth.Contract(contractAbi, contractAddress);
         
             $(".cardstyle").hide();
             // Change the Data
             $('form').on('submit', function(event) {
               event.preventDefault(); // to prevent page reload when form is submitted
               greeting = $('input').val();
               console.log(greeting)
               //$("#database").text(greeting);
         
               contract.methods.searchProduct(greeting).call(function(err, result) {
                 console.log(err, result)
                 $(".cardstyle").show("fast","linear");
                 $("#database").html(result);
               });
         
             });
         
             
           function isInputNumber(evt){
             var ch = String.fromCharCode(evt.which);
             if(!(/[0-9]/.test(ch))){
                 evt.preventDefault();
             }
           }
         
           $("#closebutton").on("click", function(){
               $(".customalert").hide("fast","linear");
           });
         
         function openQRCamera(node) {
         var reader = new FileReader();
         reader.onload = function() {
          node.value = "";
          qrcode.callback = function(res) {
          if(res instanceof Error) {
            alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
          } else {
            node.parentNode.previousElementSibling.value = res;
            document.getElementById('searchButton').click();
          }
          };
          qrcode.decode(reader.result);
         };
         reader.readAsDataURL(node.files[0]);
         }
         
           function showAlert(message){
             $("#alertText").html(message);
             $("#qrious").hide();
             $("#bottomText").hide();
             $(".customalert").show("fast","linear");
           }
         
           $("#aboutbtn").on("click", function(){
               showAlert("A Decentralised End to End Logistics Application that stores the whereabouts of product at every freight hub to the Blockchain. At consumer end, customers can easily scan product's QR CODE and get complete information about the provenance of that product hence empowering consumers to only purchase authentic and quality products.");
           });
         
           
      </script>
   </body>
</html>