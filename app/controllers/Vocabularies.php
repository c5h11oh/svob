<?php 
class Vocabularies extends Controller{
    private $ordModel;
    public function __construct()
    {
        $this->ordModel = $this->model('Ord');
    }

    public function index(){
        redirect('vocabularies/search');
    }

    public function search(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = $this->ordModel->wordLookup($_POST['word'], $_POST['search_mode']);
            if($result)
                $this->view('vocabularies/result', $result);
            else{
                flash('word-message', 'Oops! There is no vocabulary found. Try add a new one, or use \'pattern search\'?', 'alert alert-warning');
                $this->view('vocabularies/search');
            }
        }
        else{ // HTML GET
            $this->view('vocabularies/search');
        }
    }

    public function list(){
        redirect('vocabularies/add');
    }

    public function exist($word = null){
        $data = [
            'input' => true,
            'exist' => false,
        ];
        
        if($word){
            $data['exist'] = $this->ordModel->wordExist($word);
        }
        else{
            $data['input'] = false;
        }
        $this->view('vocabularies/exist', $data);
    }

    public function add($data = []){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'word' => trim($_POST['word']),
                'user_id' => trim($_POST['user_id']),
                'meaning' => trim($_POST['meaning']),
                'example' => trim($_POST['example']),
                'link' => trim($_POST['link']),
                'visited_times' => 1,
                'add_date' => '',
                'error' => [
                    'word_err' => '',
                    'user_id_err' => '',
                    'meaning_err' => '',    
                ],
            ];
            // Check word existence
            if( $this->ordModel->wordExist($data['word']) ){
                $data['error']['word_err'] = 'The word has already existed in the database.';
            }
            //check validity
            else{
                if(!is_numeric($data['user_id']) || $data['user_id'] < 0){
                    $data['error']['user_id_err'] = 'The user id is not valid.';
                }
                if(empty($data['meaning'])){
                    $data['error']['meaning_err'] = 'Meaning should be filled';
                }
            } 

            // Write DB if no error
            $valid = true;
            foreach($data['error'] as &$error){
                $valid &= empty($error);
            }
            if($valid){
                $this->success = $this->ordModel->add($data);
                if($this->success){
                    flash('word-message', 'New word added!');
                    redirect('vocabularies/show/');
                }
                else{
                    die('Unexpected error encountered. 1. Exiting...');
                }
            }
            // otherwise return with error-data
            else{
                $this->view('vocabularies/add', $data);
            }

        }
        else{
            $data = [
                'word' => '',
                'user_id' => 1,
                'meaning' => null,
                'example' => null,
                'link' => null,
                'visited_times' => null,
                'add_date' => null,
            ];
        }
        $this->view('vocabularies/add', $data);
    }

   
}
?>