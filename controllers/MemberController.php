<?php
namespace mvcCore\Controllers;

use mvcCore\Views\View;

class MemberController extends Controller {
    
    public function __construct( $model) {
        $this->__model = $model;
        parent::__construct();
    }
    
    
    public function input($method = INPUT_POST)
    {
        $this->__model->setLastname( filter_input( $method, 'lastname', FILTER_SANITIZE_STRING));
        $this->__model->setFirstname(filter_input( $method, 'firstname', FILTER_SANITIZE_STRING));
        $this->__model->setEmail( filter_input( $method, 'email', FILTER_SANITIZE_EMAIL));
        $this->__model->setPassword( filter_input( $method, 'password', FILTER_SANITIZE_STRING));
        $this->__model->setBirthday(filter_input( $method, 'birthday', FILTER_SANITIZE_STRING));
        $this->__model->setPdp( filter_input( $method, 'pdp'));
    }

    public function read($method = INPUT_POST, $redirect = 'update')
    {}

    //create new profile
    public function create($method = INPUT_POST, $redirect = 'read')
    {
        $this->input( $method);
        $persit = filter_input( $method, 'persist', FILTER_SANITIZE_STRING);
        
        if ( is_null( $persit)) {
            // View instance ( model object, "create")
            $view = View::factory( $this->__model, __FUNCTION__);
            
            // Display the view
            $view->display();
        } else {
            // Persist action
            $this->persist( $redirect);
        }
        
    }

    public function update($method = INPUT_POST, $redirect = 'read')
    {}

    public function delete($method = INPUT_POST, $redirect = 'create')
    {}

    
}