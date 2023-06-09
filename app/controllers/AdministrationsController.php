<?php 
/**
 * Administrations Page Controller
 * @category  Controller
 */
class AdministrationsController extends SecureController{
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
		$fields = array('logo', 	'nom_ecole', 	'address', 	'capital', 	'ville', 	'code_postal', 	'telephone', 	'cnss', 	'ice', 	'num_patente', 	'site_web', 	'email', 	'rs');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('logo',"%$text%",'LIKE');
			$db->orWhere('nom_ecole',"%$text%",'LIKE');
			$db->orWhere('address',"%$text%",'LIKE');
			$db->orWhere('capital',"%$text%",'LIKE');
			$db->orWhere('ville',"%$text%",'LIKE');
			$db->orWhere('code_postal',"%$text%",'LIKE');
			$db->orWhere('telephone',"%$text%",'LIKE');
			$db->orWhere('created_at',"%$text%",'LIKE');
			$db->orWhere('update_at',"%$text%",'LIKE');
			$db->orWhere('cnss',"%$text%",'LIKE');
			$db->orWhere('ice',"%$text%",'LIKE');
			$db->orWhere('num_patente',"%$text%",'LIKE');
			$db->orWhere('site_web',"%$text%",'LIKE');
			$db->orWhere('email',"%$text%",'LIKE');
			$db->orWhere('rs',"%$text%",'LIKE');
		}
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('nom_ecole', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('administrations', $limit, $fields);
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
					$options = array('table' => 'administrations', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'administrations' , false );
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
		$fields = array( 'nom_ecole', 	'address', 	'capital', 	'ville', 	'code_postal', 	'telephone', 	'created_at', 	'update_at', 	'cnss', 	'ice', 	'num_patente', 	'site_web', 	'email', 	'rs' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('nom_ecole' , $rec_id);
		}
		$record = $db->getOne( 'administrations', $fields );
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
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */
	function edit($rec_id=null){
		$db = $this->GetModel();
		if(is_post_request()){
			$modeldata=transform_request_data($_POST);
			$db->where('nom_ecole' , $rec_id);
			$bool = $db->update('administrations',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('logo','nom_ecole','address','capital','ville','code_postal','telephone','created_at','update_at','cnss','ice','num_patente','site_web','email','rs');
			$db->where('nom_ecole' , $rec_id);
			$data = $db->getOne('administrations',$fields);
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
			$db->where('nom_ecole' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'administrations' );
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
