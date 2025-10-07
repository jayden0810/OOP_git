<?php
    // Functie: classdefinitie User 
    // Auteur: Studentnaam

    class User{

        // Eigenschappen 
        public string $username = "";
        public string $email = "";
        private string $password = "";
        
        function setPassword($password){
            $this->password = $password;
        }
        function getPassword(){
            return $this->password;
        }

        public function showUser() {
            echo "<br>Username: $this->username<br>";
            echo "<br>Password: $this->password<br>";
            echo "<br>Email: $this->email<br>";
            
        }

        public function registerUser() : array {
            $status = false;
            $errors=[];
            if($this->username != ""){

                // Check user exist in database
                
                if(true){
                    array_push($errors, "Username bestaat al.");
                } else {
                    // username opslaan in tabel login
                    // INSERT INTO `user` (`username`, `password`, `role`) VALUES ('kjhasdasdkjhsak', 'asdasdasdasdas', '');
                    // Manier 1
                    
                    $status = true;
                } 
            }
            return $errors;
        }
function validateLogin() {
    $errors = [];

    // Check of username leeg is
    if (empty($this->username)) {
        array_push($errors, "Invalid username");
    } 
    // Check of password leeg is
    else if (empty($this->password)) {
        array_push($errors, "Invalid password");
    }

    // Check lengte username (tussen 3 en 50 tekens)
    if (!empty($this->username)) {
        $length = strlen($this->username);
        if ($length < 3 || $length > 50) {
            array_push($errors, "Username must be between 3 and 50 characters long");
        }
    }

    return $errors;
}
        public function loginUser(): bool {

            // Connect database
            $db = $this->dbConnect();
            if ($db === null) {
                return false; // Database connection failed
            }

            // Zoek user in de table user met username = $this->username
           $username = $this->username;
           $password = $this->password;


            // Doe SELECT * from user WHERE username = $this->username
            $sql = "SELECT * FROM user WHERE username = :username";
            $stmt = $db->prepare($sql);
            if ($stmt === false) {
                return false; // SQL preparation failed
            }


            // Indien gevonden EN password klopt dan sessie vullen
            $_SESSION['username'] = $this->username;
            $_SESSION['loggedin'] = true;

            // Return true indien gelukt anders false
            return true;
        }

        // Check if the user is already logged in
        public function isLoggedin(): bool {
            // Check if user session has been set
            
            return false;
        }

        public function getUser(string $username): bool {
            // Connect database

		    // Doe SELECT * from user WHERE username = $username

            if (false){
                //Indien gevonden eigenschappen vullen met waarden uit de SELECT
                $this->username = 'Waarde uit de database';
                return true;
            } else {
                return false;
            }   
        }

        public function logout(){
            session_start();
            // remove all session variables
           

            // destroy the session
            

        }
        public function dbConnect(){
            $server = "localhost"; 
            $username = "root";
            $password = ""; 
            $db = "inlog";
            try {
              $dbConnection = new PDO("mysql:host=$server; dbname=$db", $username, $password);
              $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              return $dbConnection;
            } catch (PDOException $e) {
              echo "Verbinding mislukt" . $e->getMessage();
              return null;
            }
        }

    }

?>