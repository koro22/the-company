<?php

require_once "Database.php";

class User extends Database{

    public function store($request){
        $first_name =$request['first_name'];
        $last_name =$request['last_name'];
        $username =$request['username'];
        $password =$request['password'];        
        $password =password_hash($password,PASSWORD_DEFAULT);        

        $sql = "INSERT INTO users(`first_name`, `last_name`,`username`,`password`) VALUES ('$first_name','$last_name','$username','$password')";

        if($this->conn->query($sql)){
            header('location: ../views');
            exit();
        }else{
            die('Error creating the user: '.$this->conn->error);
        }
    }

    public function login($request){
        $username = $request['username'];
        $password = $request['password'];

        $sql ="SELECT * FROM users WHERE username ='$username'";
        $result = $this->conn->query($sql);

        if($result->num_rows==1){
            //check if the password is correct

            $user = $result->fetch_assoc();

            if(password_verify($password,$user['password'])){
                session_start();
                $_SESSION['id']= $user['id'];
                $_SESSION['username']=$user['username'];
                $_SESSION['full_name']=$user['first_name']." ".$user['last_name'];

                header('location: ../views/dashboard.php');
                exit;
            }else{
                die("Password is incorrect");

            }
        }else{
            die("Username not found.");
        }

    }

    public function getAllUsers(){
        $sql = "SELECT * FROM users";

        if($result = $this->conn->query($sql)){
            return $result;

        }else{
            die("Error retrieving users: ".$this->conn->error);
        }
    }

    public function logout(){
        //initialize the session
        session_start();
        //free/remove all the session data
        session_unset();
        //destroy the session
        session_destroy();
        //by default index.php will be viewed
        header('location:../views');
        exit;

    }
    //get the currently logged in user
    public function getUser(){

        $id = $_SESSION['id'];
        $sql = "SELECT first_name, last_name, username, photo FROM users WHERE id = $id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die('Error retrieving the user: '.$this->conn->error);
        }
    }

    public function update($request,$files){
        session_start();
        $id = $_SESSION['id'];
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $username = $request['username'];
        $photo = $files['photo']['name'];
        $tmp_photo =$files['photo']['tmp_name'];

        $sql ="UPDATE users SET first_name = '$first_name',last_name ='$last_name', username ='$username' WHERE id ='$id' ";

        if($this->conn->query($sql)){
            $_session['username']=$username;
            $_session['full_name']="$first_name $last_name";

            #If there is an uploaded photo, save it to the db and save the file to images folder.
            if($photo){
                $sql = "UPDATE users SET photo = '$photo' WHERE id = $id";
                $destination ="../assets/images/$photo";

                //Save the image name to db
                if($this->conn->query($sql)){
                    //Save the file to image folder
                    if(move_uploaded_file($tmp_photo,$destination)){
                        header("location: ../views/dashboard.php");
                        exit;
                    }else{
                        die('Error moving the photo.');
                    }
                }else{
                    die('Error uploading photo: '.$this->conn->error);
                }
            }

            header('location: ../views/dashboard.php');
            exit;

        }else{
            die('Error uploading the user: '.$this ->conn->error);
        }
    }

    public function delete(){
        session_start();
        $id = $_SESSION['id'];

        $sql = "DELETE FROM users WHERE id = $id";

        if($this->conn->query($sql)){
            $this->logout();
        }else{
            die('Error delete your account: '.$this->conn->error);
        }
    }
}
?>