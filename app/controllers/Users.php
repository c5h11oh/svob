<?php
class Users extends Controller{
    private $usrModel;
    public function __construct(){
        $this->usrModel = $this->model('Usr');
    }

    public function index(){
        $obj = $this->usrModel->getUsrByEmail('tony20715@gmail.com');
    }

    public function register(){
        // TODO: make a reall register()
        $email = 'tony20715@gmail.com';
        $password = password_hash('6bVATP9FGwbiWMV', PASSWORD_DEFAULT);
        echo $email . '<br>';
        echo $password;
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'error' => [
                    'email' => [],
                    'password' => [],
                ],
            ];
            // Check email validity
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $data['error']['email'][] = 'Invalid email address';

            // Check password length
            if(strlen($data['password']) < 6) $data['error']['password'][] = 'Password too short';

            // TODO: Other check may be performed, for instance forcing a strong password.

            // Logging in
            $error_free = true;
            foreach($data['error'] as $item){
                if($item && count($item)) {
                    $error_free = false;
                    break;
                }
            }
            if($error_free){
                $loginUser = $this->usrModel->login($data);
                if($loginUser){
                    $this->createUserSession($loginUser);
                    redirect('pages/index');
                }else{
                    $data['error']['email'][] = 'Wrong email or password';
                    $data['error']['password'][] = 'Wrong email or password';
                    $this->view('users/login', $data);    
                }
            }else{
                $this->view('users/login', $data);
            }
        }
        else{
            if($_SESSION['user_id']) redirect('pages/index');

            $data = [
                'email' => null,
                'password' => null,
                'error' => [
                    'email' => [],
                    'password' => [],
                ],
            ];
            $this->view('users/login', $data);
        }
    }

    public function logout(){
        session_destroy();
        redirect('users/login');
    }

    private function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_point'] = $user->point;
    }
}
?>