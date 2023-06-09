<?php 

/**
 * Component Model
 * @category  Model
 */
class ComponentsController extends BaseController{
	
	/**
     * getcount_absences Model Action
     * @return Value
     */
		
	/**
     * getcount_etudiants Model Action
     * @return Value
     */
	function getcount_etudiants(){
		$db = $this->GetModel();
		$sqltext="SELECT COUNT(*) AS num FROM etudiants";
		$arr=$db->rawQueryValue($sqltext);
		
		render_json($arr[0]) ;
	}

	/**
     * getcount_professeurs Model Action
     * @return Value
     */
	function getcount_professeurs(){
		$db = $this->GetModel();
		$sqltext="SELECT COUNT(*) AS num FROM professeurs";
		$arr=$db->rawQueryValue($sqltext);
		
		render_json($arr[0]) ;
	}

	/**
     * getcount_tuteurs Model Action
     * @return Value
     */
	function getcount_tuteurs(){
		$db = $this->GetModel();
		$sqltext="SELECT COUNT(*) AS num FROM tuteurs";
		$arr=$db->rawQueryValue($sqltext);
		
		render_json($arr[0]) ;
	}

	/**
     * getcount_classes Model Action
     * @return Value
     */
	function getcount_classes(){
		$db = $this->GetModel();
		$sqltext="SELECT COUNT(*) AS num FROM classes";
		$arr=$db->rawQueryValue($sqltext);
		
		render_json($arr[0]) ;
	}
	function classes_libelle_classe_option_list(){
		$db = $this->GetModel();
		$sqltext="SELECT  DISTINCT id_filiere AS value,libelle_filiere AS label FROM filieres";
		$arr=$db->rawQuery($sqltext);
		
		render_json($arr);
	}

	/**
     * matieres_id_module_option_list Model Action
     * @return array
     */
	function matieres_id_module_option_list(){
		$db = $this->GetModel();
		$sqltext="SELECT  DISTINCT id_module AS value,libelle_module AS label FROM modules";
		$arr=$db->rawQuery($sqltext);
		
		render_json($arr);
	}
		/**
	* barchart_nombredestudiantsdansunefiire() Model Action
	* @return array
	*/
	function barchart_nombredestudiantsdansunefiire(){
		$db = $this->GetModel();
		
		$arr = array();
		
		$dataset1 = $db->rawQuery("SELECT  f.libelle_filiere, c.id_classe, COUNT(c.nb_etudiants) AS count_of_nb_etudiants FROM filieres AS f,  classes AS c GROUP BY c.nb_etudiants");
		
		$arr['labels']=array_map(function($var){ return $var['libelle_filiere']; }, $dataset1);
		
		$arr['datasets'][]=array_map(function($var){ return $var['id_classe']; }, $dataset1);

		render_json($arr) ;
	}

	/**
	* barchart_lenombredestudiantsparlanne() Model Action
	* @return array
	*/
	function barchart_lenombredestudiantsparlanne(){
		$db = $this->GetModel();
		
		$arr = array();
		
		$dataset1 = $db->rawQuery("SELECT  COUNT(c.nb_etudiants) AS count_of_nb_etudiants, c.annee_scolaire FROM classes AS c GROUP BY c.nb_etudiants"
);
		
		$arr['labels']=array_map(function($var){ return $var['count_of_nb_etudiants']; }, $dataset1);
		
		$arr['datasets'][]=array_map(function($var){ return $var['annee_scolaire']; }, $dataset1);

		render_json($arr) ;
	}
	function etudiants_id_classe_option_list()
    {
        $db = $this->GetModel();
        $sqltext = "SELECT  DISTINCT id_classe AS value,libelle_classe AS label FROM classes";
        $arr = $db->rawQuery($sqltext);
        render_json($arr);
    }
	function modules_id_filiere_option_list(){
		$db = $this->GetModel();
		$sqltext="SELECT  DISTINCT id_classe AS value,libelle_classe AS label FROM classes";
		$arr=$db->rawQuery($sqltext);
		
		render_json($arr);
	}

	
}
