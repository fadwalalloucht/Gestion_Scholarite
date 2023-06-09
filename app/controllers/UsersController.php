<?php 
/**
 * Users Page Controller
 * @category  Controller
 */
class UsersController extends SecureController{
	/**
     * Load Record Action 
     * $arg1 Field Name
     * $arg2 Field Value 
     * $param $arg1 string
     * $param $arg1 string
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
		$db = $this->GetModel();
		$fields = array('users.id_user', 	'users.nom', 	'users.Prenom', 	'users.email', 	'users.telephone', 	'users.type' , 'users.lieu_naissance ' , 'users.date_naissance' , 'users.genre' , 'users.adresse' , 'users.cin' , 'users.adresse' , 'users.photo');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('users.id_user',"%$text%",'LIKE');
			$db->orWhere('users.nom',"%$text%",'LIKE');
			$db->orWhere('users.Prenom',"%$text%",'LIKE');
			$db->orWhere('users.email',"%$text%",'LIKE');
			$db->orWhere('users.telephone',"%$text%",'LIKE');
			$db->orWhere('users.mot_passe',"%$text%",'LIKE');
			$db->orWhere('users.type',"%$text%",'LIKE');
			$db->orWhere('users.lieu_naissance',"%$text%",'LIKE');
			$db->orWhere('users;date_naissance',"%$text%",'LIKE');
			$db->orWhere('users.genre',"%$text%",'LIKE');
			$db->orWhere('users.cin',"%$text%",'LIKE');
			$db->orWhere('users.adresse',"%$text%",'LIKE');
			$db->orWhere('users.photo',"%$text%",'LIKE');
		}
		$db->where('users.deleted_at', 'NO');
		$db->join("etudiants", "users.id_user = etudiants.id_user", "LEFT");
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('id_user', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('users', $limit, $fields);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = count($records);
		$data->total_records = intval($tc->totalCount);
		render_json($data);
	}
	/**
     * Load csv|json data
     * @return data
     */
	function import_data(){
		if(!empty($_FILES['file'])){
			$finfo = pathinfo($_FILES['file']['name']);
			$ext = strtolower($finfo['extension']);
			if(!in_array($ext , array('csv','json'))){
				render_error("Format de fichier non pris en charge");
			}
			$file_path = $_FILES['file']['tmp_name'];
			if(!empty($file_path)){
				$db = $this->GetModel();
				if($ext == 'csv'){
					$options = array('table' => 'users', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'users' , false );
				}
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_json($data);
				}
			}
			else{
				render_error(html-lang-0047);
			}
		}
	}
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$fields = array( 'id_user', 	'nom', 	'Prenom', 	'email', 	'telephone', 	'type', 	'lieu_naissance', 	'date_naissance', 	'genre', 	'cin', 	'adresse' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('id_user' , $rec_id);
		}
		$record = $db->getOne( 'users', $fields );
		if(!empty($record)){
			render_json($record);
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
	/**
     * Add New Record Action 
     * If Not $_POST Request, Display Add Record Form View
     * @return View
     */
	function add(){
		if(is_post_request()){
			$modeldata=transform_request_data($_POST);
			$rules_array = array(
				'nom' => 'required',
				'Prenom' => 'required',
				'email' => 'required|valid_email',
				'telephone' => 'required',
				'mot_passe' => 'required',
				'type' => 'required',
				'lieu_naissance' => 'required',
				'date_naissance' => 'required',
				'genre' => 'required',
				'cin' => 'required',
				'adresse' => 'required',
				'photo' => 'required',
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
			$rec_id = $db->insert('users',$modeldata);
			if(!empty($rec_id)){
				render_json($rec_id);
			}
			else{
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_error("Erreur lors de l'insertion d'un enregistrement");
				}
			}
		}
		else{
			render_error("Requête invalide");
		}
	}
	/**
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */
	function edit($rec_id=null){
		$db = $this->GetModel();
		if(is_post_request()){
			$modeldata=transform_request_data($_POST);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['nom'])){
				$db->where('nom',$modeldata['nom'])->where('id_user',$rec_id,'!=');
				if($db->has('users')){
					render_error($modeldata['nom']."Existe déjà!");
				}
			} 
			$db->where('id_user' , $rec_id);
			$bool = $db->update('users',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id_user','nom','Prenom','telephone','type','lieu_naissance','date_naissance','genre','cin','adresse','photo');
			$db->where('id_user' , $rec_id);
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
     * Delete Record Action 
     * @return View
     */
	function delete( $rec_ids = null ){
		$db = $this->GetModel();
		$arr_id = explode( ',', $rec_ids );
		foreach( $arr_id as $rec_id ){
			$db->where('id_user' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'users' );
		if($bool){
			render_json( $bool );
		}
		else{
			if($db->getLastError()){
				render_error($db->getLastError());
			}
			else{
				render_error("Erreur lors de la suppression d'un enregistrement. s'il vous plaît assurez-vous que la sortie de l'enregistrement");
			}
		}
	}
}
