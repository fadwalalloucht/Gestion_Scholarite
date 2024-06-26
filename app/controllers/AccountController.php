<?php 

/**
 * Account Page Controller
 * @category  Controller
 */
class AccountController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index(){
		$db = $this->GetModel();
		$db->where ("id_user", USER_ID);
		$user = $db->getOne('users' , '*');
		render_json($user);
	}
	
	
	/**
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */
	function edit(){
		$db = $this->GetModel();
		if(is_post_request()){
			
			
			$modeldata=transform_request_data($_POST);
			 
			
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['nom'])){
				$db->where('nom',$modeldata['nom'])->where('id_user',USER_ID,'!=');
				if($db->has('users')){
					render_error($modeldata['nom']."Existe déjà!");
				}
			} 
			
			$db->where('id_user' , USER_ID);
			$bool = $db->update('users',$modeldata);
			if($bool){
				$db->where ('id_user', USER_ID);
				$user = $db->getOne('users' , '*');
				set_session('user_data',$user);

				
				
				render_json(USER_ID);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id_user','nom','Prenom','telephone','type','lieu_naissance','date_naissance','genre','cin','adresse','photo');
			$db->where('id_user' , USER_ID);
			$data = $db->getOne('users',$fields);
			
			if(!empty($data)){
				render_json($data);
			}
			else{
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_error("Enregistrement non trouvé",404);
				}
			}
		}
	}

	
	/**
     * Change Email Action
     * @return View
     */
	function change_email(){
		if(is_post_request()){
			
			$form_collection = $_POST;
			$email=trim($form_collection['email']);
			
			
			$db = $this->GetModel();
			
			$db->where ("id_user", USER_ID);
			$result = $db->update('users', array('email' => $email ));
			if($result){
				
				set_flash_msg("Adresse e-mail modifiée avec succès",'success');
				redirect_to_page("#/account");
			}
			else{
				$this->view->form_error="Email Not Changed ";
				$this->view->render("account/change_email.php" ,null,"default_layout.php");
			}
		}
		else{
			$this->view->render("account/change_email.php" ,null,"default_layout.php");
		}
	}
}
