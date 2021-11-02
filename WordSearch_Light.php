<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet'>
        <link href='https://images.vexels.com/media/users/3/132068/isolated/preview/f9bb81e576c1a361c61a8c08945b2c48-search-icon-by-vexels.png' rel='icon'>
        <title>
            WordSearch
        </title>
        <style>
            ::selection{
                background-color: #111;
                color:#eee;
            }
            body{
                margin:200px 50px 0px 50px;
            }
            .header{
                position: fixed;
                top:0;
                left:0;
                width:100%;
                height:180px;
                background-color: #b5f;
                background-color: #eee;
                box-shadow: 0px 2px 5px #aaa;
                font-family: fantasy;
                font-size:40px;
            }
            input{
                box-sizing: border-box;
                position: relative;
                font-size: 25px;
                outline: none;
                border:none;
                padding:10px 50px 10px 20px;
                background-color: #eee;
                width:calc(100% - 70px);
                margin:20px;
                margin-left: calc(35px - 50% );
                left:50%;
                background-color: #fff;
                border-radius: 50px;
                border:1px solid #ddd;
                font-family: 'ABeeZee';

            }
            input::-webkit-search-cancel-button{
                position:relative;
                right:0px;
                -webkit-appearance: none;
                height: 20px;
                width: 20px;
                border-radius:10px;
                background: url(https://pro.fontawesome.com/releases/v5.10.0/svgs/solid/times-circle.svg) no-repeat 50% 50%;
                opacity:.5;
                background-size: contain;
            }
            button{
                position: relative;
                box-sizing: border-box;
                font-size: 30px;
                outline: none;
                border:none;
                padding:5px;
                background-color: transparent;
                z-index: 2;
                margin:25px;
                margin-right:45px;
                float:right;
                border-radius: 50px;
            }
            .comp{
                position: relative;
                width:calc(100% - 50px);
                height: 60px;
                overflow: hidden;
                margin-left: 20px;
                margin-top: 20px;
                font-family: 'Andika';
                padding: none;
            }
            
            .tablewrap{
                width: 100%;
            }
            table{
                box-sizing: border-box;
                width: 100%;
                border: 0px solid #111;
                font-family: 'ABeeZee';
                font-size: 20px;
            }
            .wordName{
                width: inherit;
                font-family: 'Andika';
                font-size: 30px;
                padding:10px;
                border-bottom: 2px dotted #444;
            }
            tr{
                box-sizing: border-box;
                margin:0px;
                
            }
            
            th,td{
                box-sizing: border-box;
                text-align: left;
                padding:10px;
            }
            td[colspan='2']{
                font-family: 'Andika';
                font-size: 25px;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            .fa-search{
                color:#999;
            }
            
        </style>
        <script>
            function checkInput(i){
                var input=i.value;
                var btn=document.getElementById('btn');
                if(input == ""){
                    btn.disabled=true;
                }else{
                    btn.disabled=false;
                }
            }
        </script>
    </head>
    <body>
        <?php
        $servername = "localhost";
        $username = "Admin";
        $password = "";
        $dbname = "test";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        
        
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
        
        //html
        echo "<div class='header'>
            <div class='comp'>
                <b>AC's WordSearch</b>: Get your words find!</div>
            <div class='search'>
                <form method='POST' action='WordSearch_Light.php'>
                    <input type='search' name='searchedWord' autofocus placeholder='Search Words...' onchange='checkInput(this)'>
                    <button type='submit' id='btn' disabled>
                        <i class='fa fa-search'></i>
                    </button>
                </form>
            </div>
        </div>
        <div class='tablewrap'>
        <table>";
        //html
        
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $word = test_input($_POST['searchedWord']);
          search_word($word);
        }

        
        function search_word($word){
            global $conn;
            $sql = "SELECT word, wordtype, definition FROM entries WHERE word='".$word."'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              echo "<div class='wordName'>".$word."</div>";
              echo "<tr><th width='20%'>Part Of Speech</th><th >Definitions</th></tr>";
              while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["wordtype"]. "</td><td>" . $row["definition"]. "</td></tr>";
              }
            } else {
              echo "<tr><td width='20%' colspan='2'>Oops! '".$word."' not found.</td></tr>";
            }
        }
        //html
        echo "</table></div>";
        //html
            
        $conn->close();
    
        ?>
        
         
        
    </body>
</html>