<?php
    namespace App\Controllers;
    use App\Core\Form;
    use App\Models\UsersModel;

class UsersController extends Controller
    {
        /**
         * Connexion des utilisateurs
         *
         * @return void
         */
        public function login(){

            //On verifie si le formulaire est complet
            
            if(Form::validate($_POST, ["email","password"])){
                //Le formulaire est complet
                //On va chercher dans la base de donées l'utilisateur avec l'email entré

                $usersModel = new UsersModel;
                $userArray = $usersModel->findOneByEmail(strip_tags($_POST["email"]));

                //Si l'utilisateur n'existe pas
                if(!$userArray){
                    //On envoi un message de session
                    $_SESSION["erreur"] = "L'adresse email et ou le mot de passe est incorrect";
                    header ("Location: /users/login");
                    exit;
                }

                //L'utilisateur existe
                $user = $usersModel->hydrate($userArray);
                
                
                //On vérifie si le mot de passe est correct
                if(password_verify($_POST['password'], $user->getPassword())){
                    //Le mot de passe est correct
                    //On créer la session
                    $user->setSession();
                    header("Location: ../main");
                }else{
                    //Mauvais mot de passe
                    $_SESSION["erreur"] = "L'adresse email et ou le mot de passe est incorrect";
                    header ("Location: login");
                    exit;
                }
            }
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

        /**
         * Inscription des utilisateurs
         *
         * @return void
         */
        public function register()
        {
            //On vérifie si le formulaire est valide
            if(Form::validate($_POST, ['email','password'])){
                //le formulaire est valide
                //On nettoie l'adresse Email
                $email = strip_tags(($_POST["email"]));

                //On chiffre le mot de passe

                $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

                //On hydrate l'utilisateur en BDD
                $user = new UsersModel;

                $user->setEmail($email)
                ->setPassword($pass);

                //On stock dans la BDD
                $user->create();

            }
            $form = new Form;

            $form->debutForm()
            ->ajoutLabelFor('email','E-mail :')
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->ajoutLabelFor('pass','mot de passe')
            ->ajoutInput('password', 'password', ['id' => 'pass', 'class' => 'form-control'])
            ->ajoutBouton('M\'inscrire', ['class' => 'btn btn-primary'])
            ->finForm();

            $this->render('users/register',['registerForm' =>$form->create()]);

        }

        /**
         * Deconnexion de l'utilisateur
         *
         * @return void
         */
        public function logout(){
            unset($_SESSION["user"]);
            header("Location: ../main");
            exit;
        }
    }
?>