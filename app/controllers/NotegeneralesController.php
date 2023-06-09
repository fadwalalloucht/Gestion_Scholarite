<?php 
/**
 * Notegenerales Page Controller
 * @category  Controller
 */
class NotegeneralesController extends SecureController{
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
		$fields = array('examens.libelle_examen', 	'filieres.libelle_filiere', 	'modules.Libelle_module', 	'matieres.Libelle_matiere', 	'notegenerales.id', 	'notegenerales.note', 	'filieres.id_filiere', 	'matieres.id_matiere');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('examens.libelle_examen',"%$text%",'LIKE');
			$db->orWhere('filieres.libelle_filiere',"%$text%",'LIKE');
			$db->orWhere('modules.Libelle_module',"%$text%",'LIKE');
			$db->orWhere('matieres.Libelle_matiere',"%$text%",'LIKE');
			$db->orWhere('notegenerales.id',"%$text%",'LIKE');
			$db->orWhere('notegenerales.note',"%$text%",'LIKE');
			$db->orWhere('notegenerales.id_examen',"%$text%",'LIKE');
			$db->orWhere('notegenerales.id_etudiant',"%$text%",'LIKE');
			$db->orWhere('notegenerales.created_at',"%$text%",'LIKE');
			$db->orWhere('notegenerales.update_at',"%$text%",'LIKE');
			$db->orWhere('notegenerales.deleted_at',"%$text%",'LIKE');
			$db->orWhere('filieres.id_filiere',"%$text%",'LIKE');
			$db->orWhere('matieres.id_matiere',"%$text%",'LIKE');
			$db->orWhere('matieres.id_module',"%$text%",'LIKE');
			$db->orWhere('modules.id_classe',"%$text%",'LIKE');
			$db->orWhere('examens.heur_debut',"%$text%",'LIKE');
			$db->orWhere('examens.heur_fin',"%$text%",'LIKE');
			$db->orWhere('examens.date',"%$text%",'LIKE');
		}
		$db->join("filieres","notegenerales.id = filieres.id_filiere","INNER");
		$db->join("matieres","notegenerales.id = matieres.id_matiere","INNER");
		$db->join("modules","notegenerales.id = modules.id_module","INNER");
		$db->join("examens","notegenerales.id = examens.id_examen","LEFT");
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('id', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('notegenerales', $limit, $fields);
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
		$fields = array( 'examens.libelle_examen', 	'filieres.libelle_filiere', 	'modules.Libelle_module', 	'matieres.Libelle_matiere', 	'notegenerales.id', 	'notegenerales.note', 	'filieres.id_filiere', 	'matieres.id_matiere' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('notegenerales.id' , $rec_id);
		}
		$db->join("filieres","notegenerales.id = filieres.id_filiere","INNER ");
		$db->join("matieres","notegenerales.id = matieres.id_matiere","INNER ");
		$db->join("modules","notegenerales.id = modules.id_module","INNER ");
		$db->join("examens","notegenerales.id = examens.id_examen","LEFT ");  
		$record = $db->getOne( 'notegenerales', $fields );
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
				'note' => 'required',
				'id_examen' => 'required|numeric',
				'id_etudiant' => 'required|numeric',
				'created_at' => 'required',
				'update_at' => 'required',
				'deleted_at' => 'required',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('notegenerales',$modeldata);
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
			$db->where('id' , $rec_id);
			$bool = $db->update('notegenerales',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id','note','id_examen','id_etudiant','created_at','update_at','deleted_at');
			$db->where('id' , $rec_id);
			$data = $db->getOne('notegenerales',$fields);
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
			$db->where('id' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'notegenerales' );
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
