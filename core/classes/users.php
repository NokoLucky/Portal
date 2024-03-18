<?php

class Users
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function add_admin($username, $password)
    {
        global $bcrypt;
        $HashedPass = $bcrypt->genHash($password);

        $query  = $this->db->prepare("INSERT INTO ADMIN_USER (USERNAME, PASSWORD) VALUES (?, ?) ");

        $query->bindValue(1, $username);
        $query->bindValue(2, $HashedPass);


        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function admin_login($username, $password)
    {
        global $bcrypt;

        $query = $this->db->prepare("SELECT ID, PASSWORD FROM ADMIN_USER
									 WHERE USERNAME = ?");
        $query->bindValue(1, $username);

        try {
            $query->execute();
            $data = $query->fetch();

            //to avoid no data found when incorrect username is entered
            if ($data == null || $data == '') {
                return false;
            } else {
                $stored_password = $data['PASSWORD'];
                $id = $data['ID']; // id of the admin to be returned if the password is verified, below.
            }

            if ($bcrypt->verify($password, $stored_password)) {
                return $id; // returning the admin's id.
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function add_user($name, $surname, $language, $contact, $email, $dob, $id_no, $interests){

        $query  = $this->db->prepare("INSERT INTO USERS (NAME, SURNAME, LANGUAGE, MOBILE_NO, EMAIL, DOB, ID_NO, INTERESTS) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");

        $query->bindValue(1, $name);
        $query->bindValue(2, $surname);
        $query->bindValue(3, $language);
        $query->bindValue(4, $contact);
        $query->bindValue(5, $email);
        $query->bindValue(6, $dob);
        $query->bindValue(7, $id_no);
        $query->bindValue(8, $interests);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public function user_exists($id_no){

        $query = $this->db->prepare("SELECT COUNT(id) FROM USERS WHERE id_no = ?");
        $query->bindValue(1, $id_no);

        try {
            $query->execute();
            $rows = $query->fetchColumn();

            if ($rows == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function get_users(){

        $query = $this->db->prepare("SELECT * FROM USERS");

        try {
            $query->execute();
            return $query->fetchAll();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function delete_user($user_id){

        $query = $this->db->prepare("DELETE FROM USERS WHERE ID = ?");
        $query->bindValue(1, $user_id);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function get_user($user_id){

        $query = $this->db->prepare("SELECT * FROM USERS WHERE ID = ?");
        $query->bindValue(1, $user_id);

        try {
            $query->execute();
            return $query->fetch();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function update_user($name, $surname, $language, $contact, $email, $dob, $id_no, $interests, $user_id){

        $query  = $this->db->prepare("UPDATE USERS SET
									   NAME       = ?,
									   SURNAME    = ?,
									   LANGUAGE   = ?,
									   MOBILE_NO  = ?,
									   EMAIL      = ?,
									   DOB        = ?,
                                       ID_NO      = ?,
                                       INTERESTS  = ?
									   WHERE ID   = ? ");

        $query->bindValue(1, $name);
        $query->bindValue(2, $surname);
        $query->bindValue(3, $language);
        $query->bindValue(4, $contact);
        $query->bindValue(5, $email);
        $query->bindValue(6, $dob);
        $query->bindValue(7, $id_no);
        $query->bindValue(8, $interests);
        $query->bindValue(9, $user_id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }




    
}
