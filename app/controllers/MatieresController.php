<?php 
/**
 * Matieres Page Controller
 * @category  Controller
 */
class MatieresController extends BaseController{
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
		$fields = array('matieres.id_matiere', 	'matieres.Libelle_matiere');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('matieres.id_matiere',"%$text%",'LIKE');
			$db->orWhere('matieres.Libelle_matiere',"%$text%",'LIKE');
			$db->orWhere('matieres.created_at',"%$text%",'LIKE');
			$db->orWhere('matieres.update_at',"%$text%",'LIKE');
			$db->orWhere('matieres.deleted_at',"%$text%",'LIKE');
			$db->orWhere('matieres.id_module',"%$text%",'LIKE');
			$db->orWhere('modules.libelle_module',"%$text%",'LIKE');
			$db->orWhere('modules.id_filiere',"%$text%",'LIKE');
			$db->orWhere('modules.niveau',"%$text%",'LIKE');
		}
		$db->join("modules","matieres.id_module = modules.id_module","INNER");
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('id_matiere', ORDER_TYPE);
		}
		$d=0;
		if( !empty($fieldname) ){
			//render_error($fieldname ."" .$fieldvalue);
			$d=1;
			$records=$db->rawquery("select matieres.id_matiere, matieres.Libelle_matiere from matieres where ".$fieldname ."=".$fieldvalue);
			//$db->where($fieldname , $fieldvalue);
		}
		$tc = $db->withTotalCount();
		if($d==0)
		{
			$records = $db->get('matieres', $limit, $fields);
		}
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
					$options = array('table' => 'matieres', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'matieres' , false );
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
		$fields = array( 'matieres.id_matiere', 	'matieres.Libelle_matiere' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('matieres.id_matiere' , $rec_id);
		}
		$db->join("modules","matieres.id_module = modules.id_module","INNER ");  
		$record = $db->getOne( 'matieres', $fields );
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
				'Libelle_matiere' => 'required',
				'created_at' => 'required',
				'update_at' => 'required',
				'deleted_at' => 'required',
				'id_module' => 'required|numeric',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('matieres',$modeldata);
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
			$db->where('id_matiere' , $rec_id);
			$bool = $db->update('matieres',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id_matiere','Libelle_matiere','created_at','update_at','deleted_at','id_module');
			$db->where('id_matiere' , $rec_id);
			$data = $db->getOne('matieres',$fields);
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
			$db->where('id_matiere' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'matieres' );
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
