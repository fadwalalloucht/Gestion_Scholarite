<?php 
/**
 * Seances Page Controller
 * @category  Controller
 */
class SeancesController extends SecureController{
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
		$fields = array('seances.id_seance', 	'seances.date_seance', 	'seances.heurDebut_seance', 	'seances.heurFin_seance', 	'salles.libelle');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('seances.id_seance',"%$text%",'LIKE');
			$db->orWhere('seances.date_seance',"%$text%",'LIKE');
			$db->orWhere('seances.heurDebut_seance',"%$text%",'LIKE');
			$db->orWhere('seances.heurFin_seance',"%$text%",'LIKE');
			$db->orWhere('seances.Libelle_seance',"%$text%",'LIKE');
			$db->orWhere('salles.libelle',"%$text%",'LIKE');
			$db->orWhere('seances.id_professeur',"%$text%",'LIKE');
			$db->orWhere('seances.id_salle',"%$text%",'LIKE');
			$db->orWhere('seances.id_examen',"%$text%",'LIKE');
			$db->orWhere('seances.created_at',"%$text%",'LIKE');
			$db->orWhere('seances.update_at',"%$text%",'LIKE');
			$db->orWhere('seances.deleted_at',"%$text%",'LIKE');
			$db->orWhere('seances.id_matiere',"%$text%",'LIKE');
			$db->orWhere('matieres.Libelle_matiere',"%$text%",'LIKE');
			$db->orWhere('matieres.id_module',"%$text%",'LIKE');
		}
		$db->join("salles","seances.id_salle = salles.id_salle","INNER");
		$db->join("matieres","seances.id_seance = matieres.id_matiere","INNER");
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('id_seance', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('seances', $limit, $fields);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = count($records);
		$data->total_records = intval($tc->totalCount);
		render_json($data);
	}
	/**
     * Load json data
     * @return data
     */
	function import_data(){
		if(!empty($_FILES['file'])){
			$finfo = pathinfo($_FILES['file']['name']);
			$ext = strtolower($finfo['extension']);
			if(!in_array($ext , array('json'))){
				render_error("Format de fichier non pris en charge");
			}
			$file_path = $_FILES['file']['tmp_name'];
			if(!empty($file_path)){
				$db = $this->GetModel();
				$data = $db->loadJsonData( $file_path, 'seances' , false );
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_json($data);
				}
			}
			else{
				render_error("Erreur lors du téléchargement du fichier");
			}
		}
	}
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$fields = array( 'seances.id_seance', 	'seances.date_seance', 	'seances.heurDebut_seance', 	'seances.heurFin_seance', 	'salles.libelle', 	'matieres.Libelle_matiere' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('seances.id_seance' , $rec_id);
		}
		$db->join("salles","seances.id_salle = salles.id_salle","INNER ");
		$db->join("matieres","seances.id_seance = matieres.id_matiere","INNER ");  
		$record = $db->getOne( 'seances', $fields );
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
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('seances',$modeldata);
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
			$db->where('id_seance' , $rec_id);
			$bool = $db->update('seances',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id_seance','Libelle_seance','heurDebut_seance','heurFin_seance','date_seance');
			$db->where('id_seance' , $rec_id);
			$data = $db->getOne('seances',$fields);
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
			$db->where('id_seance' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'seances' );
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
