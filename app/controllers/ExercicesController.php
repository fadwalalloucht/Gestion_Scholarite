<?php
/**
 * Exercices Page Controller
 * @category  Controller
 */
class ExercicesController extends SecureController
{
    /**
     * Load Record Action
     * $arg1 Field Name
     * $arg2 Field Value
     * $param $arg1 string
     * $param $arg1 string
     * @return View
     */
    public function index($fieldname = null, $fieldvalue = null)
    {
        $db = $this->GetModel();
        $fields = array('id_Exercice', 'photo', 'description_Exercice');
        $limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
        if (!empty($this->search)) {
            $text = $this->search;
            $db->orWhere('id_Exercice', "%$text%", 'LIKE');
            $db->orWhere('libelle_Exercice', "%$text%", 'LIKE');
            $db->orWhere('description_Exercice', "%$text%", 'LIKE');
            $db->orWhere('piece_jointe', "%$text%", 'LIKE');
            $db->orWhere('Libelle_matiere', "%$text%", 'LIKE');
            $db->orWhere('created_at', "%$text%", 'LIKE');
            $db->orWhere('id_module', "%$text%", 'LIKE');
        }
        if (!empty($this->orderby)) {
            $db->orderBy($this->orderby, $this->ordertype);
        } else {
            $db->orderBy('id_Exercice', ORDER_TYPE);
        }
        if (!empty($fieldname)) {
            $db->where($fieldname, urldecode($fieldvalue));
        }
        //page filter command
        $tc = $db->withTotalCount();
        $records = $db->get('exercices', $limit, $fields);
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
    public function import_data()
    {
        if (!empty($_FILES['file'])) {
            $finfo = pathinfo($_FILES['file']['name']);
            $ext = strtolower($finfo['extension']);
            if (!in_array($ext, array('json'))) {
                render_error("Format de fichier non pris en charge");
            }
            $file_path = $_FILES['file']['tmp_name'];
            if (!empty($file_path)) {
                $db = $this->GetModel();
                $data = $db->loadJsonData($file_path, 'exercices', false);
                if ($db->getLastError()) {
                    render_error($db->getLastError());
                } else {
                    render_json($data);
                }
            } else {
                render_error("Erreur lors du téléchargement du fichier");
            }
        }
    }
    /**
     * View Record Action
     * @return View
     */
    public function view($rec_id = null, $value = null)
    {
        $db = $this->GetModel();
        $fields = array('exercices.id_Exercice', 'exercices.libelle_Exercice', 'exercices.description_Exercice', 'matieres.Libelle_matiere');
        if (!empty($value)) {
            $db->where($rec_id, urldecode($value));
        } else {
            $db->where('exercices.id_Exercice', $rec_id);
        }
        $db->join("matieres", "exercices.id_Exercice = matieres.id_matiere", "LEFT ");
        $record = $db->getOne('exercices', $fields);
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
    public function add()
    {
        if (is_post_request()) {
            $modeldata = transform_request_data($_POST);
            $rules_array = array(
                'libelle_Exercice' => 'required',
                'description_Exercice' => 'required',
                'piece_jointe' => 'required',
                'id_professeur' => 'required|numeric',
                'id_classe' => 'required|numeric',
                'id_matiere' => 'required|numeric',
                'update_at' => 'required',
                'deleted_at' => 'required',
            );
            $is_valid = GUMP::is_valid($modeldata, $rules_array);
            if ($is_valid != true) {
                render_error($is_valid);
            }
            $db = $this->GetModel();
            $rec_id = $db->insert('exercices', $modeldata);
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
    public function edit($rec_id = null)
    {
		
        $db = $this->GetModel();
        $choix = explode('-', $rec_id);
        if (is_post_request()) {
            if (count($choix) > 1) {
                $modeldata = transform_request_data($_POST);

                $exercice = array(
                    'id_matiere' => $choix[0],
                    'description_Exercice' => $modeldata['description_Exercice'],
                    'photo' => $modeldata['photo'],
                );
                $rec_id = $db->insert('exercices', $exercice);
                render_json($rec_id);
            }

            $db->where('id_Exercice', $rec_id);
            $bool = $db->update('exercices', $modeldata);
            if ($bool) {
                render_json($rec_id);
            } else {
                render_error($db->getLastError());
            }
            return null;
        } else {
            if (count($choix) > 1) {
                $data = array(
                    'id' => $choix[0] . "-AE",
                    'description_Exercice' => '',
                    'photo' => '',
                );
                render_json($data);
            }
        }

        $fields = array('id_Exercice', 'libelle_Exercice', 'description_Exercice', 'piece_jointe', 'id_professeur', 'id_classe', 'id_matiere', 'update_at', 'deleted_at');
        $db->where('id_Exercice', $rec_id);
        $data = $db->getOne('exercices', $fields);
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
    /**
     * Delete Record Action
     * @return View
     */
    public function delete($rec_ids = null)
    {
        $db = $this->GetModel();
        $arr_id = explode(',', $rec_ids);
        foreach ($arr_id as $rec_id) {
            $db->where('id_Exercice', $rec_id, "=", 'OR');
        }
        $bool = $db->delete('exercices');
        if ($bool) {
            render_json($bool);
        } else {
            if ($db->getLastError()) {
                render_error($db->getLastError());
            } else {
                render_error("Erreur lors de la suppression d'un enregistrement. s'il vous plaît assurez-vous que la sortie de l'enregistrement");
            }
        }
    }}
