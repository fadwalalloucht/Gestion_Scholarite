<?php
	/**
	 * Role Based Access Control
	 * @category  RBAC Helper
	 */
	defined('ROOT') OR exit('No direct script access allowed');
	class PageAccessManager{
		/**
	     * Array of user roles and page access 
	     * Use "*" to grant all access right to particular user role
	     * @return Html View
	     */
		public static $usersRolePermissions=array(
			'admin' =>
						array(
							'absences' => array('list','view','edit','delete'),
							'administrations' => array('list','view','add','edit','delete'),
							'admins' => array('list','view','add','edit','delete'),
							'classes' => array('list','view','add','edit','delete'),
							'cours' => array('list','view'),
							'etudiants' => array('list','view','add','edit','delete'),
							'examens' => array('list','view'),
							'exercices' => array('list','view'),
							'filieres' => array('list','view','add','edit','delete'),
							'matieres' => array('list','view','add','edit','delete'),
							'messages' => array('list','view','add','edit','delete'),
							'modules' => array('list','view','add','edit','delete'),
							'note' => array('list','view'),
							'paiement' => array('list','view','add','edit','delete'),
							'professeurs' => array('list','view','add','edit','delete'),
							'salles' => array('list','view','add','edit','delete'),
							'seances' => array('list','view','add','edit','delete'),
							'tuteurs' => array('list','view','add','edit','delete'),
							'users' => array('list','view','add','edit','delete')
						),
		
			'profeseur' =>
						
							array(
								'absences' => array('list','view','add','edit','delete'),
								'classes' => array('list','view'),
								'cours' => array('list','view','add','edit','delete'),
								'etudiants' => array('list','view'),
								'examens' => array('list','view','add','edit','delete'),
								'exercices' => array('list','view','add','edit','delete'),
								'filieres' => array('list','view'),
								'matieres' => array('list','view'),
								'messages' => array('list','view','add','edit','delete'),
								'modules' => array('list','view'),
								'note' => array('list','view','add','edit','delete'),
								'salles' => array('list','view'),
								'seances' => array('list','view'),
								'tuteurs' => array('list','view'),
								'users' => array('list','view')
							),
						
		
			'etudiant' =>
							array(
								'absences' => array('list','view','add','edit','delete'),
								'administrations' => array('list','view','add','edit','delete'),
								'admins' => array('list','view','add','edit','delete'),
								'classes' => array('list','view','add','edit','delete'),
								'cours' => array('list','view','add','edit','delete'),
								'etudiants' => array('list','view','add','edit','delete'),
								'examens' => array('list','view','add','edit','delete'),
								'exercices' => array('list','view','add','edit','delete'),
								'filieres' => array('list','view','add','edit','delete'),
								'matieres' => array('list','view','add','edit','delete'),
								'messages' => array('list','view','add','edit','delete'),
								'modules' => array('list','view','add','edit','delete'),
								'note' => array('list','view','add','edit','delete'),
								'paiement' => array('list','view','add','edit','delete'),
								'professeurs' => array('list','view','add','edit','delete'),
								'salles' => array('list','view','add','edit','delete'),
								'seances' => array('list','view','add','edit','delete'),
								'tuteurs' => array('list','view','add','edit','delete'),
								'users' => array('list','view','add','edit','delete')
							),	
						
		
			'tuteur' =>
						
							array(
								'absences' => array('list','view','add','edit','delete'),
								'administrations' => array('list','view','add','edit','delete'),
								'admins' => array('list','view','add','edit','delete'),
								'classes' => array('list','view','add','edit','delete'),
								'cours' => array('list','view','add','edit','delete'),
								'etudiants' => array('list','view','add','edit','delete'),
								'examens' => array('list','view','add','edit','delete'),
								'exercices' => array('list','view','add','edit','delete'),
								'filieres' => array('list','view','add','edit','delete'),
								'matieres' => array('list','view','add','edit','delete'),
								'messages' => array('list','view','add','edit','delete'),
								'modules' => array('list','view','add','edit','delete'),
								'note' => array('list','view','add','edit','delete'),
								'paiement' => array('list','view','add','edit','delete'),
								'professeurs' => array('list','view','add','edit','delete'),
								'salles' => array('list','view','add','edit','delete'),
								'seances' => array('list','view','add','edit','delete'),
								'tuteurs' => array('list','view','add','edit','delete'),
								'users' => array('list','view','add','edit','delete')
							),
						
		);
		
		/**
	     * pages to exclude from access validation check
	     * @var $excludePageCheck array()
	     */
		public static $excludePageCheck=array("","index","home","account","info","report");
		
		/**
	     * Display About us page
	     * @return string
	     */
		public static function GetPageAccess($path){
			$rp=self::$usersRolePermissions;
			if($rp=="*"){
				return "AUTHORIZED"; // grant access to any user
			}
			else{
				$path = strtolower(trim($path,'/')); 

				$arrPath=explode("/", $path);
				$page=strtolower($arrPath[0]);
				
				//if user is accessing exclude access check page
				if(in_array($page , self:: $excludePageCheck)){
					return "AUTHORIZED";
				}
					
				$userRole=strtolower(USER_ROLE); // get user defined role from session value
				if(array_key_exists($userRole,$rp)){
					$action=(!empty($arrPath[1]) ? $arrPath[1] : null);
					if($action=="index" || $action==""){
						$action="list";
					}

					//check if user have access to all pages or user have access to all page actions
					if($rp[$userRole]=="*" || (!empty($rp[$userRole][$page]) && $rp[$userRole][$page]=="*")){
						return "AUTHORIZED";
					}
					else{
						if(!empty($rp[$userRole][$page]) && in_array($action,$rp[$userRole][$page])){
							return "AUTHORIZED";
						}
					}
					return "NOT_AUTHORIZED";
				}
				else{
					//user does not have any role.
					return "NO_ROLE_PERMISSION";
				}
			}
		}
		public static function is_allowed($path){
			$access = self::GetPageAccess($path);
			return ($access == 'AUTHORIZED');
		}
	}
?>