<?php
// Functie: classdefinitie User 
// Auteur: Jayden Sadhoe

class User {

    // ====== Eigenschappen ======
    public string $username = "";
    private string $password = "";

    // ====== Setters & Getters ======
    public function setPassword(string $password, bool $hash = true) {
        // Wachtwoord hashen alleen bij registratie
        if ($hash) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $this->password = $password;
        }
    }

    public function getPassword(): string {
        return $this->password;
    }

    // ====== Gebruiker tonen ======
    public function showUser() {
        echo "<br>Username: $this->username <br>";
    }

    // ====== Gebruikersvalidatie ======
    public function validateUser(): array {
        $errors = [];

        // Check of username leeg is
        if (empty($this->username)) {
            $errors[] = "Gebruikersnaam mag niet leeg zijn.";
        } 
        // Controleer lengte van de username
        else if (strlen($this->username) < 3 || strlen($this->username) > 50) {
            $errors[] = "Gebruikersnaam moet tussen 3 en 50 tekens lang zijn.";
        }

        // Check of password leeg is
        if (empty($this->password)) {
            $errors[] = "Wachtwoord mag niet leeg zijn.";
        }

        // Controleer minimale lengte wachtwoord
        else if (strlen($this->password) < 5) {
            $errors[] = "Wachtwoord moet minstens 5 tekens bevatten.";
        }

        return $errors;
    }

    // ====== Gebruiker registreren ======
    public function registerUser(): array {
        $errors = [];
        $db = $this->dbConnect();

        if ($db === null) {
            $errors[] = "Databaseverbinding mislukt.";
            return $errors;
        }

        // Valideer gebruikersinvoer
        $validationErrors = $this->validateUser();
        if (!empty($validationErrors)) {
            return $validationErrors;
        }

        // Controleer of de gebruikersnaam al bestaat
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $errors[] = "Gebruikersnaam bestaat al.";
        }

        // Indien geen fouten → registreer gebruiker
        if (count($errors) === 0) {
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);

            if ($stmt->execute()) {
                return []; // Geen fouten = succes
            } else {
                $errors[] = "Registratie mislukt.";
            }
        }

        return $errors;
    }

    // ====== Inloggen ======
    public function loginUser(): bool {
        session_start();
        $db = $this->dbConnect();

        if ($db === null) {
            return false;
        }

        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['loggedin'] = true;
            return true;
        } else {
            return false;
        }
    }

    // ====== Ingelogd controleren ======
    public function isLoggedin(): bool {
        
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }

    // ====== Gebruiker ophalen uit DB ======
    public function getUser(string $username): bool {
        $db = $this->dbConnect();
        if ($db === null) {
            return false;
        }

        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $this->username = $user['username'];
            $this->password = $user['password'];
            return true;
        } else {
            return false;
        }
    }

    // ====== Uitloggen ======
    public function logout() {
    
        $_SESSION = [];
        session_destroy();
    }

    // ====== Database connectie ======
    public function dbConnect() {
        $server = "localhost"; 
        $username = "root";
        $password = ""; 
        $db = "inlog";

        try {
            $dbConnection = new PDO("mysql:host=$server;dbname=$db", $username, $password);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        } catch (PDOException $e) {
            echo "Verbinding mislukt: " . $e->getMessage();
            return null;
        }
    }
}
?>
