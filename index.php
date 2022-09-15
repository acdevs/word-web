<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500&display=swap" rel="stylesheet">
        <link href='https://images.vexels.com/media/users/3/132068/isolated/preview/f9bb81e576c1a361c61a8c08945b2c48-search-icon-by-vexels.png' rel='icon'>
        <link href="styles.css" rel="stylesheet">
        <title>
            Word Web
        </title>
    </head>
    <body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "4444";
        $dbname = "entries";
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
                <b>Word <span class='highlight'> Web </span></b></div>
            <div class='search'>
                <form method='POST' action='index.php'>
                    <input type='search' name='searchedWord' placeholder='Search' autofocus onchange='checkInput(this)'>
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
              echo "<div class='wordName'>".$word."</div>
                    <tr><th width='10%'>Speech</th><th >Definitions</th></tr>";
              while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["wordtype"]. "</td><td>" . $row["definition"]. "</td></tr>";
              }
            } else {
              echo "<div class='wordName'>Uh oh!</div>
                    <tr><th width='10%'>Speech</th><th >Definitions</th></tr>
                    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
            }
        }
        //html
        echo "</table></div>";
        //html
            
        $conn->close(); 
    ?>
        
        <script src="script.js"></script>
    </body>
</html>