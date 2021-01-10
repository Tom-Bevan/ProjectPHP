<?php
namespace mvcCore\Views;

use mvcCore\Etc\Config;
class OrderCreateView extends View {
    protected $login = null;
    protected $password =null;
    
   //recupere les infos de modele pour les mettres dans les variables 
    public function setProperties()
    {
        if ( ! is_null( $this->__model-> getLogin())) {
            $this->login = $this->__model->getLogin();
        }
        
    }

    
    
}