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
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'password_confirm' => $_POST['password_confirm'],
                'error' => [
                    'name' => [],
                    'email' => [],
                    'password' => [],
                ],
            ];

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Check name is not blank
            if(empty($data['name'])) $data['error']['name'][] = 'Name cannot be empty';

            // Check email validity
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $data['error']['email'][] = 'Invalid email address';
            else if( $this->usrModel->hasRegistered($data['email']) ) $data['error']['email'][] = 'This email has been registered. Try log in?';

            // Check password length and same
            if(strlen($data['password']) < 6) $data['error']['password'][] = 'Password is too short';
            else if(strcmp($data['password'], $data['password_confirm'])) $data['error']['password'][] = 'Passwords are not equivalent';
            
            // Register
            $error_free = true;
            foreach($data['error'] as $item){
                if($item && count($item)) {
                    $error_free = false;
                    break;
                }
            }
            if($error_free){
                // Password hash
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $regUser = $this->usrModel->register($data);
                if($regUser){
                    flash('register-success', 'You have successfully registered');
                    redirect('users/login');
                }else{
                    $data['error']['name'][] = 'Unexpected error occured (1)';
                    $this->view('users/register', $data);    
                }
            }else{
                $this->view('users/register', $data);
            }
        }
        else{
            if($_SESSION['user_id']) redirect('pages/index');

            $data = [
                'name' => null,
                'email' => null,
                'password' => null,
                'password_confirm' => null,
                'error' => [
                    'name' => [],
                    'email' => [],
                    'password' => [],
                ],
            ];
            $this->view('users/register', $data);
        }
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'error' => [
                    'email' => [],
                    'password' => [],
                ],
            ];
            // Check email validity
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $data['error']['email'][] = 'Invalid email address';

            // Check password length
            if(strlen($data['password']) < 6) {
                $data['error']['password'][] = 'Password too short'; // $data[] = "string" 則可以在array中加入新的element
            }

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