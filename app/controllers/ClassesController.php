<?php 
/**
 * Classes Page Controller
 * @category  Controller
 */
class ClassesController extends BaseController{
	/**
     * Load Record Action 
     * $arg1 Field Name
     * $arg2 Field Value 
     * $param $arg1 string
     * $param $arg1 string
     * @return View
     */
	function index($fieldname = null, $fieldvalue = null)
	{
		$db = $this->GetModel();
		$fields = array('id_classe', 	'annee_scolaire', 	'libelle_classe', 	'niveau', 	'nb_etudiants', 'id_filiere');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if (!empty($this->search)) {
			$text = $this->search;
			$db->orWhere('id_classe', "%$text%", 'LIKE');
			$db->orWhere('annee_scolaire', "%$text%", 'LIKE');
			$db->orWhere('libelle_classe', "%$text%", 'LIKE');
			$db->orWhere('niveau', "%$text%", 'LIKE');
			$db->orWhere('nb_etudiants', "%$text%", 'LIKE');
			$db->orWhere('created_at', "%$text%", 'LIKE');
			$db->orWhere('update_at', "%$text%", 'LIKE');
			$db->orWhere('deleted_at', "%$text%", 'LIKE');
			$db->orWhere('id_filiere', "%$text%", 'LIKE');
		}
		if (!empty($this->orderby)) {
			$db->orderBy($this->orderby, $this->ordertype);
		} else {
			$db->orderBy('id_classe', ORDER_TYPE);
		}
		if (!empty($fieldname)) {
			$db->where($fieldname, urldecode($fieldvalue));
		}

		$tc = $db->withTotalCount();
		$records = $db->get('classes', $limit, $fields);

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
					$options = array('table' => 'classes', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'classes' , false );
				}
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_json($data);
				}
			}
			
		}
	}
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$fields = array( 'id_classe', 	'libelle_classe' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('id_classe' , $rec_id);
		}
		$record = $db->getOne( 'classes', $fields );
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
				'libelle_classe' => 'required',
				'niveau' => 'required|numeric',
				'nb_etudiants' => 'required|numeric',
				'annee_scolaire' => 'required',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('classes',$modeldata);
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
			$db->where('id_classe' , $rec_id);
			$bool = $db->update('classes',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id_classe','libelle_classe','niveau','nb_etudiants','annee_scolaire');
			$db->where('id_classe' , $rec_id);
			$data = $db->getOne('classes',$fields);
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
			$db->where('id_classe' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'classes' );
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
