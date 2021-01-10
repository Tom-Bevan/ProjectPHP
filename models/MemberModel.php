<?php
namespace mvcCore\Models;
class MemberModel extends Model {
    // Debug mode
    public const DEBUG = false;
    
    // Model name
    public static $_model_name = 'profile';
    
    // SQL table name
    public static $_model_table = 'public.orders';
    
    // Forms fields
    protected $lastname = null;
    protected $firstname = null;
    protected $email = null;
    protected $password = null;
    
    protected $birthday = null;

    
    // @Column( default='now()')
    protected  $date = null;
    
    // Get all properties
    public function getProperties( $empty = true, $default = true) {
        // Get all properties
        $properties =  parent::getProperties( $empty, $default);
        // Unset modelName and modelTable property
        unset( $properties['_model_name'], $properties['_model_table'],);
        if ( $default) { // Remove properties  with a default value
            unset( $properties['date']);
        }
        return $properties;
    }
    
    public function encrypt($data = [])
    {}
    
    public function decrypt()
    {}
    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }



    
}
?>