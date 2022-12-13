<?php

class User
{   
    private $error = "";
    private $signup_message = "";
    public function signup($POST)
    {
        $data = array();
        $db = Database::getInstance();
        $data['name'] = trim($POST['name']);
        $data['email'] = trim($POST['email']);
        $data['password'] = trim($POST['password']);
        $password2 = trim($POST['password2']);
        
        //check all fields are filled in
        if (empty($data['name']) || empty($data['email']) || empty($data['password']) || empty($password2)) 
        {
            $this->error .= "Veuillez remplir tous les champs <br>";
        }
        
        //check email is valid
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
       {
            $this->error .= "Veuillez entrer une adresse mail valide <br>";
       }

       //check name is valid
       if (!preg_match("/^[a-zA-Z-' ]*$/",$data['name'])) 
       {
        $this->error .= "Veuillez entrer un nom valide <br>";
       }


      //check the two passwords are the same
      if ($data['password'] !== $password2) 
      {
        $this->error .= "Les deux mots de passes ne coresspondent pas <br>";
      }

      //check password is strong
      $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/"; 
      if(!preg_match($password_regex, $data['password']))
      {
        $this->error .= "Le mot de passe doit comporter au moins 8 caractères dont une minuscule, une majuscule, un chiffre et un caractère spécial <br>";
      }

      
      //check if email already exists
      $sql = "select * from users where email = :email limit 1";
      $arr['email'] = $data['email'];
      $check = $db->read($sql,$arr);

      if(!empty($check))
      {
        $this->error .= "Cette adresse mail existe déja <br>";
      }

      $data['url_adresse'] = $this->get_random_string(60);

      //check if url adress already exists
      $sql = "select * from users where url_adresse = :url_adresse limit 1";
      $check = $db->read($sql,['url_adresse' => $data['url_adresse']]);
      if(is_array($check))
      {
        $data['url_adresse'] = $this->get_random_string(60);
      }

      //register in the database
      if($this->error == "")
      {
        $data['rank'] = "customer";
        $data['date'] = date("Y-m-d H:i:s");
        $data['password'] = hash('sha1',$data['password']);;
         
        $query = "insert into users (url_adresse,name,email,password,rank,date) values (:url_adresse,:name,:email,:password,:rank,:date)";
        $result = $db->write($query,$data);

        if($result)
        {
          $_SESSION['signup_message'] = "Votre compte a été créé avec succès";
          header("Location:".ROOT."login");
          die;
        }
          
      }

      $_SESSION['error'] = $this->error;
  
    }

    public function login($POST)
    {
        $data = array();
        $db = Database::getInstance();

        $data['email'] = trim($POST['email']);
        $data['password'] = trim($POST['password']);
        
        //check all fields are filled in
        if (empty($data['email']) || empty($data['password'])) 
        {
            $this->error .= "Veuillez remplir tous les champs <br>";
        }
        
        //check email is valid
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
       {
            $this->error .= "Veuillez entrer une adresse mail valide <br>";
       }


      //confirm
      if($this->error == "")
      {
        $data['password'] = hash('sha1',$data['password']);

        //check if email already exists
      $sql = "select * from users where email = :email and password = :password";
      $result = $db->read($sql,$data);

      if(count($result) > 0)
      {
        $_SESSION['user_url'] = $result[0]->url_adresse;
        $_SESSION['name'] = $result[0]->name;
        $_SESSION['rank'] = $result[0]->rank;
        header("Location:".ROOT."home");
        die;
      }else{
        $this->error .= "Mail ou mot de passe incorrect <br>";
      }
    }

      $_SESSION['error'] = $this->error;
    }

    public function get_user($url)
    {
        
    }

    function get_random_string($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $length = rand(4,$length);
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // a virer ?? 
    public function check_login()
    {
      if(isset($_SESSION['user_url']))
      {
        $arr['url'] = $_SESSION['user_url'];
        $query = "select * from users where url_adresse = :url limit 1";
        $db = Database::getInstance();

        $result = $db->read($query,$arr);

        if(is_array($result))
        {
          return $result[0];
        }


      }

      return false;
    }

    public function logout()
    {
      if(isset($_SESSION['user_url']))
      {
        unset($_SESSION['user_url']);
        header("Location:".ROOT."home");
        die;
      }
    }


}