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
    {
        // Get input id from $GLOBALS['request']
        $id = $GLOBALS['request']['id'];
        // Model Class
        $class = get_class(  $this->__model);
        // Get the model(s)
        $models = $this->__dao->read( $class::$_model_table, $class, $id);
        // View instance ( model object, "read")
        if ( count( $models) == 1) { // Just one object
            $this->__model = $models[0];
            // Decrypt some fields
            $this->__model->decrypt();
        } elseif ( count( $models) > 1) { // More than one object ( i.e. use a template with a list layout)
            $this->__model = $models;
            // Decrypt some fields
            for ($n = 0; $n < count( $models); $n++) {
                $this->__model[$n]->decrypt();
            }
        }
        // Check for a update submit
        $update = filter_input( $method, 'update', FILTER_SANITIZE_STRING);
        // Check for a delete submit
        $delete = filter_input( $method, 'delete', FILTER_SANITIZE_STRING);
        
        if ( is_null( $update) && is_null( $delete)) {
            // View instance ( model object, "create")
            $view = View::factory( $this->__model, __FUNCTION__);
            // Display the view
            $view->display();
        } else {
            if ( is_null( $delete)) {
                // Update action (default redirection)
                $this->redirect( [ 'action' => $redirect]);
            } else {
                // Delete action
                $this->redirect( [ 'action' => 'delete']);
            }
        }
    }

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
    {
        // Get input id from $GLOBALS['request']
        $id = $GLOBALS['request']['id'];
        if ( ! empty( $id)) {
            // Model Class
            $class = get_class(  $this->__model);
            // Get the object from the database
            $models = $this->__dao->read( $class::$_model_table, $class, $id);
            if ( count( $models) == 1) { // Just one object
                $this->__model = $models[0];
                // Decrypt some fields
                $this->__model->decrypt();
                
                // Put POST data into the model
                $this->input( $method);
                
                // Get data (not the null and the default ones)
                $data = $this->__model->getProperties();
                // Encrypt data
                $data = $this->__model->encrypt( $data);
                // Update the database object
                $result = $this->__dao->update( $class::$_model_table, $data, $id);
                // TODO / JMB : $result error processing
                // View instance ( model object, "update")
                
                // Check for a update submit
                $update = filter_input( $method, 'update', FILTER_SANITIZE_STRING);
                
                if ( is_null( $update)) {
                    // View instance ( model object, "update")
                    $view = View::factory( $this->__model, __FUNCTION__);
                    // Display the view
                    $view->display();
                } else {
                    // Update action
                    $this->redirect( [ 'action' => $redirect]);
                }
            } else { // More than one object ( i.e. use a template with a list layout)
                throw new \UnexpectedValueException( "No Order object to update with id : $id !");
            }
        } else {
            throw new \UnexpectedValueException( "No Order object to update with an empty id !");
        }
    }

    public function delete($method = INPUT_POST, $redirect = 'create')
    {}

    
}