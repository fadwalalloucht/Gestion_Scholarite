<?php

/**
 * Etudiants Page Controller
 * @category  Controller
 */
class EtudiantsController extends BaseController
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
		$fields = array('etudiants.id_etudiant', 	'etudiants.CNE', 	'users.cin', 	'users.nom', 	'users.Prenom');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if (!empty($this->search)) {
			$text = $this->search;
			$db->orWhere('etudiants.id_etudiant', "%$text%", 'LIKE');
			$db->orWhere('etudiants.CNE', "%$text%", 'LIKE');
			$db->orWhere('users.cin', "%$text%", 'LIKE');
			$db->orWhere('users.nom', "%$text%", 'LIKE');
			$db->orWhere('users.Prenom', "%$text%", 'LIKE');
			$db->orWhere('etudiants.id_tuteur', "%$text%", 'LIKE');
			$db->orWhere('etudiants.id_user', "%$text%", 'LIKE');
			$db->orWhere('etudiants.created_at', "%$text%", 'LIKE');
			$db->orWhere('etudiants.update_at', "%$text%", 'LIKE');
			$db->orWhere('etudiants.deleted_at', "%$text%", 'LIKE');
			$db->orWhere('etudiants.id_classe', "%$text%", 'LIKE');
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
		$db->join("users", "etudiants.id_user = users.id_user", "INNER");
		if (!empty($this->orderby)) {
			$db->orderBy($this->orderby, $this->ordertype);
		} else {
			$db->orderBy('id_etudiant', ORDER_TYPE);
		}
		if (!empty($fieldname)) {
			$db->where($fieldname, urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('etudiants', $limit, $fields);
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
					$options = array('table' => 'etudiants', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData($file_path, $options, false);
				} else {
					$data = $db->loadJsonData($file_path, 'etudiants', false);
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
		$fields = array('etudiants.id_etudiant', 	'etudiants.id_tuteur', 	'etudiants.CNE', 	'etudiants.id_user', 'etudiants.id_classe',	'users.id_user AS users_id_user', 	'users.nom', 	'users.Prenom', 	'users.email', 	'users.telephone', 	'users.mot_passe', 	'users.type', 	'users.lieu_naissance', 	'users.date_naissance', 	'users.genre', 	'users.cin', 	'users.adresse', 	'users.photo', 	'users.created_at AS users_created_at', 	'users.update_at AS users_update_at', 	'users.deleted_at AS users_deleted_at');
		if (!empty($value)) {
			$db->where($rec_id, urldecode($value));
		} else {
			$db->where('etudiants.id_etudiant', $rec_id);
		}
		$db->join("users", "etudiants.id_user = users.id_user", "INNER ");
		$record = $db->getOne('etudiants', $fields);
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
		//render_error("erreur");

		if (is_post_request()) {
			$db = $this->GetModel();

			$modeldata = transform_request_data($_POST);
			$rules_array = array(
				'CNE' => 'required',
				'id_user' => 'required|numeric',
			);
			$etudiantU = array(
				'nom'	=> $modeldata['nom'],
				'Prenom' => $modeldata['Prenom'],
				'email' => $modeldata['email'],
				'telephone' => $modeldata['telephone'],
				'type' => "Etudiant",
				'lieu_naissance' => $modeldata['lieu_naissance'],
				'date_naissance' => $modeldata['date_naissance'],
				'genre' => $modeldata['genre'],
				'cin' => $modeldata['CIN'],
				'adresse' => $modeldata['adresse'],
				'photo' => $modeldata['photo'],
			);
			$EU = $db->insert('users', $etudiantU);
			$tuteurU = array(
				'nom'	=> $modeldata['nomT'],
				'Prenom' => $modeldata['PrenomT'],
				'email' => $modeldata['emailT'],
				'telephone' => $modeldata['telephoneT'],
				'type' => "Tuteur",
				'genre' => $modeldata['genreT'],
				'cin' => $modeldata['CINT'],
				'adresse' => $modeldata['adresseT'],
				'photo' => $modeldata['photoT'],
			);
			$TU = $db->insert('users', $tuteurU);
			$tuteur = array(
				'cin'	=> $modeldata['CINT'],
				'id_user' => $TU,
			);
			$T = $db->insert('tuteurs', $tuteur);

			$Etudient = array(
				'CNE'	=> $modeldata['CINT'],
				'id_user' => $EU,
				'id_tuteur' => $T,
				'id_classe' => $modeldata['id_classe'],
			);
			$E = $db->insert('etudiants', $Etudient);


			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if ($is_valid != true) {
				render_error($is_valid);
			}
			$rec_id = $db->insert('etudiants', $modeldata);
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

			$etudiantU = array(
				'nom'	=> $modeldata['nom'],
				'Prenom' => $modeldata['Prenom'],
				'email' => $modeldata['email'],
				'telephone' => $modeldata['telephone'],
				'lieu_naissance' => $modeldata['lieu_naissance'],
				'date_naissance' => $modeldata['date_naissance'],
				'genre' => $modeldata['genre'],
				'cin' => $modeldata['cin'],
				'adresse' => $modeldata['adresse'],
				'photo' => $modeldata['photo'],
			);
			$tuteurU = array(
				'nom'	=> $modeldata['nomT'],
				'Prenom' => $modeldata['PrenomT'],
				'email' => $modeldata['emailT'],
				'telephone' => $modeldata['telephoneT'],
				'genre' => $modeldata['genreT'],
				'cin' => $modeldata['cinT'],
				'adresse' => $modeldata['adresseT'],
				'photo' => $modeldata['photoT'],
			);
			$tuteur = array(
				'cin'	=> $modeldata['cinT'],
			);

			$Etudient = array(
				'CNE'	=> $modeldata['CNE'],
				'id_classe' => $modeldata['id_classe'],
			);
			$db->where('id_etudiant', $rec_id);
			$bool = $db->update('etudiants', $Etudient);

			$db = $this->GetModel();
			$fields = array('id_etudiant', 'id_tuteur', 'id_user');
			$db->where('id_etudiant', $rec_id);
			$ET = $db->getOne('etudiants', $fields);

			$db = $this->GetModel();
			$db->where('id_user', $ET['id_user']);
			$bool = $db->update('users', $etudiantU);

			$db = $this->GetModel();
			$db->where('id_tuteur', $ET['id_tuteur']);
			$bool = $db->update('tuteurs', $tuteur);

			$db = $this->GetModel();
			$fields = array('id_user');
			$db->where('id_tuteur', $ET['id_tuteur']);
			$TU = $db->getOne('tuteurs', $fields);

			$db = $this->GetModel();
			$db->where('id_user', $TU['id_user']);
			$bool = $db->update('users', $tuteurU);












			if ($bool) {
				render_json($rec_id);
			} else {
				render_error($db->getLastError());
			}
			return null;
		} else {
			$db = $this->GetModel();
			$fields = array('id_etudiant', 'CNE', 'id_user', 'id_classe', 'id_tuteur');
			$db->where('id_etudiant', $rec_id);
			$Etudient = $db->getOne('etudiants', $fields);

			$db = $this->GetModel();
			$fieldsEU = array('nom', 'id_user', 'Prenom', 'telephone', 'email', 'genre', 'cin', 'adresse', 'photo', 'lieu_naissance', 'date_naissance');
			$db->where('id_user', $Etudient['id_user']);
			$EtudientU = $db->getOne('users', $fieldsEU);

			$db = $this->GetModel();
			$fieldsT = array('id_tuteur', 'cin', 'id_user');
			$db->where('id_tuteur', $Etudient['id_tuteur']);
			$tuteur = $db->getOne('tuteurs', $fieldsT);

			$db = $this->GetModel();
			$fieldsTU = array('nom', 'id_user', 'Prenom', 'telephone', 'email', 'genre', 'cin', 'adresse', 'photo');
			$db->where('id_user', $tuteur['id_user']);
			$tuteurU = $db->getOne('users', $fieldsTU);



			$data = array(
				'nom' => $EtudientU['nom'],
				'Prenom' => $EtudientU['Prenom'],
				'email' => $EtudientU['email'],
				'telephone' => $EtudientU['telephone'],
				'lieu_naissance' => $EtudientU['lieu_naissance'],
				'date_naissance' => $EtudientU['date_naissance'],
				'genre' => $EtudientU['genre'],
				'cin' => $EtudientU['cin'],
				'adresse' => $EtudientU['adresse'],
				'photo' => $EtudientU['photo'],
				'CNE' => $Etudient['CNE'],
				'id_classe' => $Etudient['id_classe'],
				//------------------
				'nomT' => $tuteurU['nom'],
				'PrenomT' => $tuteurU['Prenom'],
				'emailT' => $tuteurU['email'],
				'telephoneT' => $tuteurU['telephone'],
				'genreT' => $tuteurU['genre'],
				'cinT' => $tuteurU['cin'],
				'adresseT' => $tuteurU['adresse'],
				'photoT' => $tuteurU['photo'],
				//-----
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
			$db->where('id_etudiant', $rec_id, "=", 'OR');
		}
		$bool = $db->delete('etudiants');
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
