<?php 

/**
 * Index Page Controller
 * @category  Controller
 */
class IndexController extends BaseController{
	/**
     * Index Action 
     * @return View
     */
	function index(){
		$this->view->render(null ,null,"main_layout.php");
	}
	
	private function login_user($username , $password_text, $rememberme = false){
		$db = $this->GetModel();
		
		$db->where("nom", $username)->orWhere("email", $username);
		$user = $db->getOne('users');
		if(!empty($user)){
			
			//Verify User Password Text With DB Password Hash Value.
			//Uses PHP password_verify() function with default options
			$password_hash = $user['mot_passe'];
			if(password_verify($password_text,$password_hash)){

				
				unset($user['mot_passe']); //Remove user password as it's not needed.
				set_session('user_data',$user); // Set Active User Data in A Sessions
				//if Remeber Me, Set Cookie
				if($rememberme==true){
					$sessionkey=time().random_str(20);// Generate a Session Key for the User
					//Update User Detail in Database with the session key
					$db->where('id_user' , $user['id_user']);
					$res = $db -> update(array("login_session_key"=>hash_value($sessionkey)));
					if(!empty($res)){
						set_cookie("login_session_key",$sessionkey);// save user login_session_key in a Cookie
					}
				}
				else{
					clear_cookie("login_session_key");// Clear any Previous Set Cookie
				}
				render_json('');
			}
			else{
				render_error("Nom d'utilisateur ou mot de passe incorrect!" , 401);
			}
		}
		else{
			render_error("Nom d'utilisateur ou mot de passe incorrect!" , 401);
		}
	}
	
	
	/**
     * Login Action
     * If Not $_POST Request, Display Login Form View
     * @return View
     */
	function login(){
		if(is_post_request()){
			
			$form_collection=$_POST;
			$username=trim($form_collection['username']);
			$password=$form_collection['password'];
			$rememberme=(!empty($form_collection['rememberme']) ? $form_collection['rememberme'] : false);
			
			$this->login_user($username , $password, $rememberme = false);
			
		}
		else{
			render_error("Requête invalide");
		}
	}
	
	
	/**
     * Register User Action 
     * If Not $_POST Request, Display Register Form View
     * @return View
     */
	function register(){
		if(is_post_request()){
			
			

			$modeldata=transform_request_data($_POST);

			$rules_array = array(
				
				'nom' => 'required',
				'Prenom' => 'required',
				'email' => 'required|valid_email',
				'mot_passe' => 'required',
				'type' => 'required',
				'adresse' => 'required',
			);
			
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			
			
			$cpassword = $modeldata['confirm_password'];
			$password = $modeldata['mot_passe'];
			if($cpassword != $password){
				render_error('Your Password Does not Conform to be Unique');
			}
			unset($modeldata['confirm_password']);
			
			$password_text = $modeldata['mot_passe'];
			$modeldata['mot_passe'] = password_hash($password_text , PASSWORD_DEFAULT);
			
			
			
			
			$db = $this->GetModel();
			
			
			
			
			//Check if Duplicate Record Already Exit In The Database
			$db->where('nom',$modeldata['nom']);
			if($db->has('users')){
				render_error($modeldata['nom']."Existe déjà!");
			}
			//Check if Duplicate Record Already Exit In The Database
			$db->where('email',$modeldata['email']);
			if($db->has('users')){
				render_error($modeldata['email']."Existe déjà!");
			}
			
			$rec_id = $db->insert('users',$modeldata);
			
			if(!empty($rec_id)){
				
				
			$user=$this->login_user($modeldata['email'] , $password_text);
			
				
				$user = $result['user'];
				set_session('user_data',$user);

				//page to redirect to after register
				render_json('');

			}
			else{
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_error("Erreur lors de l'enregistrement de l'utilisateur");
				}
			}
		}
		else{
			render_error("Requête invalide");
		}
	}

	
	/**
     * Logout Action
     * Destroy All Sessions And Cookies
     * @return View
     */
	function logout($arg=null){
		
		session_destroy();
		clear_cookie("login_session_key");
		redirect_to_page("");
	}
	
	
	
}
