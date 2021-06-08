<?php
    namespace App\Controllers;
    use App\Core\Form;

    class UsersController extends Controller
    {
        public function login(){
            $form = new Form;

            $form->debutForm()
                    ->ajoutLabelFor('email', 'E-mail :')
                    ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
                    ->ajoutLabelFor('pass','mot de passe')
                    ->ajoutInput('password', 'password', ['id' => 'pass', 'class' => 'form-control'])
                    ->ajoutBouton('Me Connecter', ['class' => 'btn btn-primary'])
                    ->finForm();
            
                    $this->render('users/login', ['loginForm' => $form->create()]);
            
        }
    }
?>