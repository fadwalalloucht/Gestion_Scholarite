<?php 
/**
 * Paiement Page Controller
 * @category  Controller
 */
class PaiementController extends SecureController{
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
		$fields = array('paiement.id_paiement', 	'paiement.Date_Paiement', 	'paiement.Montant', 	'paiement.Type_paiement', 	'users.nom', 	'etudiants.CNE');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('paiement.id_paiement',"%$text%",'LIKE');
			$db->orWhere('paiement.Date_Paiement',"%$text%",'LIKE');
			$db->orWhere('paiement.id_etudiant',"%$text%",'LIKE');
			$db->orWhere('paiement.Montant',"%$text%",'LIKE');
			$db->orWhere('paiement.Type_paiement',"%$text%",'LIKE');
			$db->orWhere('etudiants.pere',"%$text%",'LIKE');
			$db->orWhere('users.nom',"%$text%",'LIKE');
			$db->orWhere('etudiants.CNE',"%$text%",'LIKE');
			$db->orWhere('etudiants.classe',"%$text%",'LIKE');
			$db->orWhere('etudiants.id_user',"%$text%",'LIKE');
			$db->orWhere('etudiants.created_at',"%$text%",'LIKE');
			$db->orWhere('etudiants.update_at',"%$text%",'LIKE');
			$db->orWhere('etudiants.deleted_at',"%$text%",'LIKE');
			$db->orWhere('users.Prenom',"%$text%",'LIKE');
			$db->orWhere('users.email',"%$text%",'LIKE');
			$db->orWhere('users.telephone',"%$text%",'LIKE');
			$db->orWhere('users.mot_passe',"%$text%",'LIKE');
			$db->orWhere('users.type',"%$text%",'LIKE');
			$db->orWhere('users.lieu_naissance',"%$text%",'LIKE');
			$db->orWhere('users.date_naissance',"%$text%",'LIKE');
			$db->orWhere('users.genre',"%$text%",'LIKE');
			$db->orWhere('users.cin',"%$text%",'LIKE');
			$db->orWhere('users.adresse',"%$text%",'LIKE');
			$db->orWhere('users.photo',"%$text%",'LIKE');
		}
		$db->join("etudiants","paiement.id_etudiant = etudiants.id_etudiant","INNER");
		$db->join("users","paiement.id_etudiant = users.id_user","LEFT");
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('id_paiement', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('paiement', $limit, $fields);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = count($records);
		$data->total_records = intval($tc->totalCount);
		render_json($data);
	}
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$fields = array( 'paiement.id_paiement', 	'paiement.Date_Paiement', 	'paiement.Montant', 	'paiement.Type_paiement', 	'users.nom', 	'etudiants.CNE' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('paiement.id_paiement' , $rec_id);
		}
		$db->join("etudiants","paiement.id_etudiant = etudiants.id_etudiant","INNER ");
		$db->join("users","paiement.id_etudiant = users.id_user","LEFT ");  
		$record = $db->getOne( 'paiement', $fields );
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
				'Date_Paiement' => 'required',
				'Montant' => 'required|numeric',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('paiement',$modeldata);
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
			$db->where('id_paiement' , $rec_id);
			$bool = $db->update('paiement',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id_paiement','Date_Paiement','Montant','Type_paiement');
			$db->where('id_paiement' , $rec_id);
			$data = $db->getOne('paiement',$fields);
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
			$db->where('id_paiement' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'paiement' );
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
