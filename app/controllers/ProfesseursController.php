<?php

/**
 * Professeurs Page Controller
 * @category  Controller
 */
class ProfesseursController extends BaseController
{
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
		$fields = array('professeurs.id_prof', 	'users.cin', 	'professeurs.cnp', 	'users.nom', 	'users.Prenom');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if (!empty($this->search)) {
			$text = $this->search;
			$db->orWhere('professeurs.id_prof', "%$text%", 'LIKE');
			$db->orWhere('users.cin', "%$text%", 'LIKE');
			$db->orWhere('professeurs.cnp', "%$text%", 'LIKE');
			$db->orWhere('users.nom', "%$text%", 'LIKE');
			$db->orWhere('users.Prenom', "%$text%", 'LIKE');
			$db->orWhere('professeurs.id_user', "%$text%", 'LIKE');
			$db->orWhere('professeurs.created_at', "%$text%", 'LIKE');
			$db->orWhere('professeurs.update_at', "%$text%", 'LIKE');
			$db->orWhere('professeurs.deleted_at', "%$text%", 'LIKE');
			$db->orWhere('users.email', "%$text%", 'LIKE');
			$db->orWhere('users.telephone', "%$text%", 'LIKE');
			$db->orWhere('users.mot_passe', "%$text%", 'LIKE');
			$db->orWhere('users.type', "%$text%", 'LIKE');
			$db->orWhere('users.lieu_naissance', "%$text%", 'LIKE');
			$db->orWhere('users.date_naissance', "%$text%", 'LIKE');
			$db->orWhere('users.genre', "%$text%", 'LIKE');
			$db->orWhere('users.adresse', "%$text%", 'LIKE');
			$db->orWhere('users.photo', "%$text%", 'LIKE');
		}
		$db->join("users", "professeurs.id_user = users.id_user", "LEFT");
		if (!empty($this->orderby)) {
			$db->orderBy($this->orderby, $this->ordertype);
		} else {
			$db->orderBy('id_prof', ORDER_TYPE);
		}
		if (!empty($fieldname)) {
			$db->where($fieldname, urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('professeurs', $limit, $fields);
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
	function import_data()
	{
		if (!empty($_FILES['file'])) {
			$finfo = pathinfo($_FILES['file']['name']);
			$ext = strtolower($finfo['extension']);
			if (!in_array($ext, array('csv', 'json'))) {
				render_error("Format de fichier non pris en charge");
			}
			$file_path = $_FILES['file']['tmp_name'];
			if (!empty($file_path)) {
				$db = $this->GetModel();
				if ($ext == 'csv') {
					$options = array('table' => 'professeurs', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData($file_path, $options, false);
				} else {
					$data = $db->loadJsonData($file_path, 'professeurs', false);
				}
				if ($db->getLastError()) {
					render_error($db->getLastError());
				} else {
					render_json($data);
				}
			} else {
				render_error("html-lang-0047");
			}
		}
	}
	/**
	 * View Record Action 
	 * @return View
	 */
	function view($rec_id = null, $value = null)
	{
		$db = $this->GetModel();
		$fields = array('professeurs.id_prof', 	'users.photo', 	'users.cin', 	'professeurs.cnp', 	'users.nom', 	'users.Prenom', 	'users.email', 	'users.telephone', 	'users.adresse', 	'users.genre', 	'users.date_naissance', 	'users.lieu_naissance');
		if (!empty($value)) {
			$db->where($rec_id, urldecode($value));
		} else {
			$db->where('professeurs.id_prof', $rec_id);
		}
		$db->join("users", "professeurs.id_user = users.id_user", "LEFT ");
		$record = $db->getOne('professeurs', $fields);
		if (!empty($record)) {
			render_json($record);
		} else {
			if ($db->getLastError()) {
				render_error($db->getLastError());
			} else {
				render_error("Enregistrement non trouvé", 404);
			}
		}
	}
	/**
	 * Add New Record Action 
	 * If Not $_POST Request, Display Add Record Form View
	 * @return View
	 */
	function add()
	{
		if (is_post_request()) {
			$modeldata = transform_request_data($_POST);
			//$db = $this->GetModel();

			$rules_array = array(
				'cnp' => 'required',
				'nom' => 'required',
				'Prenom' => 'required',
				'email' => 'required',
				'telephone' => 'required',
				'lieu_naissance' => 'required',
				'date_naissance' => 'required',
				'genre' => 'required',
				'adresse' => 'required',
				'CIN' => 'required',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if ($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$user = array(
				'nom'	=> $modeldata['nom'],
				'Prenom' => $modeldata['Prenom'],
				'email' => $modeldata['email'],
				'telephone' => $modeldata['telephone'],
				'type' => "Professeur",
				'lieu_naissance' => $modeldata['lieu_naissance'],
				'date_naissance' => $modeldata['date_naissance'],
				'genre' => $modeldata['genre'],
				'cin' => $modeldata['CIN'],
				'adresse' => $modeldata['adresse'],
				'photo' => $modeldata['photo'],
			);
			$us = $db->insert('users', $user);

			$prof = array(
				'cnp'	=> $modeldata['cnp'],
				'id_user' => $us,
			);
			$rec_id = $db->insert('professeurs', $prof);
			if (!empty($rec_id)) {
				render_json($rec_id);
			} else {
				if ($db->getLastError()) {
					render_error($db->getLastError());
				} else {
					render_error("Erreur lors de l'insertion d'un enregistrement");
				}
			}
		} else {
			render_error("Requête invalide");
		}
	}
	/**
	 * Edit Record Action 
	 * If Not $_POST Request, Display Edit Record Form View
	 * @return View
	 */
	function edit($rec_id = null)
	{
		$db = $this->GetModel();
		if (is_post_request()) {
			$modeldata = transform_request_data($_POST);
			$db->where('id_prof', $rec_id);

			$prof = array(
				'cnp'	=> $modeldata['cnp'],
			);
			$bool = $db->update('professeurs', $prof);
			$idUser = $db->rawQueryOne("SELECT id_user FROM `professeurs` WHERE id_prof=" . $rec_id);


			$user = array(
				'nom'	=> $modeldata['nom'],
				'Prenom' => $modeldata['Prenom'],
				'email' => $modeldata['email'],
				'telephone' => $modeldata['telephone'],
				'type' => "Professeur",
				'lieu_naissance' => $modeldata['lieu_naissance'],
				'date_naissance' => $modeldata['date_naissance'],
				'genre' => $modeldata['genre'],
				'cin' => $modeldata['CIN'],
				'adresse' => $modeldata['adresse'],
				'photo' => $modeldata['photo'],
			);
			$db = $this->GetModel();

			$db->where('id_user', $idUser['id_user']);

			$bool = $db->update('users', $user);


			if ($bool) {
				render_json($rec_id);
			} else {
				render_error($db->getLastError());
			}
			return null;
		} else {
			$SQL = "select professeurs.id_prof, users.photo,professeurs.id_user, users.cin, professeurs.cnp, users.nom, users.Prenom, users.email, users.telephone, users.adresse, users.genre, users.date_naissance, users.lieu_naissance FROM professeurs ,users WHERE professeurs.id_user=users.id_user and professeurs.id_prof= " . $rec_id;
			//render_error($SQL);
			$record = $db->rawQueryOne($SQL);

			$data = array(
				'cnp' => $record['cnp'],
				'id' => $record['id_prof'],
				'nom' => $record['nom'],
				'Prenom' => $record['Prenom'],
				'email' => $record['email'],
				'telephone' => $record['telephone'],
				'lieu_naissance' => $record['lieu_naissance'],
				'date_naissance' => $record['date_naissance'],
				'genre' => $record['genre'],
				'CIN' => $record['cin'],
				'adresse' => $record['adresse'],
				'photo' => $record['photo'],
			);
			if (!empty($data)) {
				render_json($data);
			} else {
				if ($db->getLastError()) {
					render_error($db->getLastError());
				} else {
					render_error("Enregistrement non trouvé", 404);
				}
			}
		}
	}
	/**
	 * Delete Record Action 
	 * @return View
	 */
	function delete($rec_ids = null)
	{
		$db = $this->GetModel();
		$arr_id = explode(',', $rec_ids);
		foreach ($arr_id as $rec_id) {
			$db->where('id_prof', $rec_id, "=", 'OR');
		}
		$bool = $db->delete('professeurs');
		if ($bool) {
			render_json($bool);
		} else {
			if ($db->getLastError()) {
				render_error($db->getLastError());
			} else {
				render_error("Erreur lors de la suppression d'un enregistrement. s'il vous plaît assurez-vous que la sortie de l'enregistrement");
			}
		}
	}
}
