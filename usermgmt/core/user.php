<?php

class User {
 
    private $conn;
    private $table = 'users';

    //user properties

    public $id;
    public $first_name;
    public $last_name;
    public $username;
    public $darkmode;
    public $created_at;


    public function __construct($db) 
    {
        $this->conn = $db;
    }


    public function read() {

        $query = 'SELECT * FROM ' .$this->table ;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    public function read_user() {
                     
        $query = "SELECT * FROM  users WHERE id = ?  LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->first_name = $row['first_name'];
        $this->last_name  = $row['last_name'];
        $this->username   = $row['username'];
        $this->darkmode   = $row['darkmode'];
    }

    public function create() 
    {
        $query = "INSERT INTO users SET first_name = :first_name, 
                                        last_name = :last_name,
                                        username = :username,
                                        darkmode = :darkmode";

        $stmt = $this->conn->prepare($query); 

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name  = htmlspecialchars(strip_tags($this->last_name));
        $this->username   = htmlspecialchars(strip_tags($this->username));
        $this->darkmode   = htmlspecialchars(strip_tags($this->darkmode));

        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':darkmode', $this->darkmode);

        if($stmt->execute())
        {
            return true;
        }
        else
        {
            printf("Error %s. \n", $stmt->error);
            return false;
        }                         
                                                    
    }

    public function update() 
    {
        $query = "UPDATE users SET first_name = :first_name, 
                                   last_name = :last_name,
                                   username = :username,
                                   darkmode = :darkmode WHERE id= :id";
                                        
        $stmt = $this->conn->prepare($query); 

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name  = htmlspecialchars(strip_tags($this->last_name));
        $this->username   = htmlspecialchars(strip_tags($this->username));
        $this->darkmode   = htmlspecialchars(strip_tags($this->darkmode));
        $this->id         = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':darkmode', $this->darkmode);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute())
        {
            return true;
        }
        else
        {
            printf("Error %s. \n", $stmt->error);
            return false;
        }                         
                                                    
    }

    public function delete() 
    {
        
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        if($stmt->execute())
        {
            return true;
        }
        else
        {
            printf("Error %s. \n", $stmt->error);
            return false;
        } 
    }

    public function search() 
    {
        $query = "SELECT * FROM users WHERE first_name = :first_name ";
        $stmt = $this->conn->prepare($query);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->username = $row['username'];
        $this->darkmode = $row['darkmode'];
    }

    public function toggle()
    {
        $query = "UPDATE users SET darkmode =
                    CASE
                        WHEN darkmode = 0 THEN 1
                        WHEN darkmode = 1 THEN 0
                        ELSE 'NOT TOGGLED'
                    END       
        WHERE id = :id ";

        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);       
       
        if($stmt->execute())
        {
            return true;
        }
        else
        {
            printf("Error %s. \n", $stmt->error);
            return false;
        }    
        
    }

}

