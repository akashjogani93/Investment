<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloodcell Kart Events</title>
    <style>
        .mainLog{
            width: 100vw;
            height: 100vh;
          flex-direction:column;
          
          display:flex;
          justify-content:center;
          align-items:center;
          background-image: linear-gradient(to right, #33001b, #ff0084); 
        }
        .logContainer{
            background-color:#fff;
            width: 30%;
           
            padding: 10px;
          border-radius:10px;
        }
      body, html{
        padding:0;
        margin:0;
      }
       .input-field label{
            display: block;
            margin-bottom:4px;
         font-family:"sans-serif";
         color:#fff;
         font-weight:600;
        }
       .input-field{
            margin-top: 20px;
         width:90%;
        }
       .input-field input{
            background-color: #f0f0f0;
            border: none;
         	height:40px;
            width:100%;
         border-radius: 7px;
         font-family:"sans-serif"
        }
      form{
           background-image: linear-gradient(to right, #33001b, #ff0084); 
      
         border-radius:5px;
        display:flex;
        padding-bottom:20px;
          align-items:center;
        flex-direction:column;
      }
      .formContainer{
      
      }
      #submitbtn{
        cursor: pointer;
	    background-image: linear-gradient(to right, #33001b, #ff0084); 
	    text-shadow: 1px 1px 2px rgba(100, 48, 22, 1);
        -webkit-border-radius: 7px;
        -moz-border-radius: 7px;
         border-radius: 7px;
        color:#fff;
        font-weight:600;
        font-family:"sans-serif";
        border:2px solid #fff;
      }
      @media screen and (max-width:998px){
        .logContainer{
            background-color:#fff;
            width: 85%;
           
            padding: 10px;
          border-radius:10px;
        }
        .input-field{
            margin-top: 20px;
         width:90%;
        }
      }
    </style>
</head>
<body>
    <div class="mainLog" >
     
        <div class="logContainer">
          <div class="formContainer">
          </div>
           <form method="post" action="login_check.php" >
              <div class="input-field"  style="display:flex; justify-content:center;
          align-items:center;">
               <div  style="width:100px;height:50px;background-color: #ffff;display:flex; justify-content:center;
          align-items:center;border-radius: 7px;margin-bottom:10px;">
                 <img style="width:100px;height:40px;object-fit:contain;" src="./images/BloodCell.png" />
               </div>
             </div>
                <div class="input-field">
                    <label>User</label>
                    <input type="text" name="user" placeholder="Enter Username"  />
                </div>
                <div class="input-field">
                    <label>Password</label>
                    <input type="password" name="pass" placeholder="Enter Password" />
                </div>
                <div class="input-field" >
                    
                    <input type="submit" id="submitbtn" value="LOGIN" />
                </div>
            </form>
        </div>
    </div>    
</body>
</html>