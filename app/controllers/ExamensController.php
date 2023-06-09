<?php 
/**
 * Examens Page Controller
 * @category  Controller
 */
class ExamensController extends BaseController{
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
		$fields = array('id_examen', 	'libelle_examen', 	'date', 	'heur_debut', 	'heur_fin' , 'id_matiere');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('id_examen',"%$text%",'LIKE');
			$db->orWhere('libelle_examen',"%$text%",'LIKE');
			$db->orWhere('date',"%$text%",'LIKE');
			$db->orWhere('heur_debut',"%$text%",'LIKE');
			$db->orWhere('heur_fin',"%$text%",'LIKE');
			$db->orWhere('created_at',"%$text%",'LIKE');
			$db->orWhere('update_at',"%$text%",'LIKE');
			$db->orWhere('deleted_at',"%$text%",'LIKE');
			$db->orWhere('id_matiere',"%$text%",'LIKE');
		}
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('id_examen', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('examens', $limit, $fields);
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
					$options = array('table' => 'examens', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'examens' , false );
				}
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_json($data);
				}
			}
			else{
				render_error("html-lang-0047");
			}
		}
	}
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$fields = array( 'id_examen' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('id_examen' , $rec_id);
		}
		$record = $db->getOne( 'examens', $fields );
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
				'libelle_examen' => 'required',
				'date' => 'required',
				'heur_debut' => 'required',
				'heur_fin' => 'required',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('examens',$modeldata);
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
		$choix = explode('-',$rec_id);
		$db = $this->GetModel();
		if(is_post_request()){
			$modeldata=transform_request_data($_POST);
			if(count($choix)>1)
			{
				$examen=array(
					'id_matiere'=>$choix[0],
					'libelle_examen'=>$modeldata['libelle_examen'],
					'heur_debut'=>$modeldata['heur_debut'],
					'heur_fin'=>$modeldata['heur_fin'],
					'date'=>$modeldata['date'],
				);
				$rec_id = $db->insert('examens',$examen);
				render_json($rec_id);
			}
			$db->where('id_examen' , $rec_id);
			$bool = $db->update('examens',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
			else{
				if(count($choix)>1)
				{
					$data=array(
						'id'=>$choix[0]."-Ex",
						'libelle_examen'=>'',
						'heur_debut'=>'',
						'heur_fin'=>'',
						'date'=>'',
					);
					render_json($data);
				}
		
	
			$fields=array('id_examen','libelle_examen','date','heur_debut','heur_fin');
			$db->where('id_examen' , $rec_id);
			$data = $db->getOne('examens',$fields);
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
			$db->where('id_examen' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'examens' );
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
