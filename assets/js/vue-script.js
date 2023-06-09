var bus = new Vue({});
var routes = [
  
	{ path: '/absences', name: 'absenceslist', component: AbsencesListComponent },
	{ path: '/absences/(index|list)', name: 'absenceslist' , component: AbsencesListComponent },
	{ path: '/absences/(index|list)/:fieldname/:fieldvalue', name: 'absenceslist' , component: AbsencesListComponent , props: true },
	{ path: '/absences/view/:id', name: 'absencesview' , component: AbsencesViewComponent , props: true},
	{ path: '/absences/view/:fieldname/:fieldvalue', name: 'absencesview' , component: AbsencesViewComponent , props: true },
	{ path: '/absences/add', name: 'absencesadd' , component: AbsencesAddComponent },
	{ path: '/absences/edit/:id' , name: 'absencesedit' , component: AbsencesEditComponent , props: true},
	{ path: '/absences/edit', name: 'absencesedit' , component: AbsencesEditComponent , props: true},

	{ path: '/administrations', name: 'administrationslist', component: AdministrationsListComponent },
	{ path: '/administrations/(index|list)', name: 'administrationslist' , component: AdministrationsListComponent },
	{ path: '/administrations/(index|list)/:fieldname/:fieldvalue', name: 'administrationslist' , component: AdministrationsListComponent , props: true },
	{ path: '/administrations/view/:id', name: 'administrationsview' , component: AdministrationsViewComponent , props: true},
	{ path: '/administrations/view/:fieldname/:fieldvalue', name: 'administrationsview' , component: AdministrationsViewComponent , props: true },
	{ path: '/administrations/add', name: 'administrationsadd' , component: AdministrationsAddComponent },
	{ path: '/administrations/edit/:id' , name: 'administrationsedit' , component: AdministrationsEditComponent , props: true},
	{ path: '/administrations/edit', name: 'administrationsedit' , component: AdministrationsEditComponent , props: true},

	{ path: '/admins', name: 'adminslist', component: AdminsListComponent },
	{ path: '/admins/(index|list)', name: 'adminslist' , component: AdminsListComponent },
	{ path: '/admins/(index|list)/:fieldname/:fieldvalue', name: 'adminslist' , component: AdminsListComponent , props: true },
	{ path: '/admins/view/:id', name: 'adminsview' , component: AdminsViewComponent , props: true},
	{ path: '/admins/view/:fieldname/:fieldvalue', name: 'adminsview' , component: AdminsViewComponent , props: true },
	{ path: '/admins/add', name: 'adminsadd' , component: AdminsAddComponent },
	{ path: '/admins/edit/:id' , name: 'adminsedit' , component: AdminsEditComponent , props: true},
	{ path: '/admins/edit', name: 'adminsedit' , component: AdminsEditComponent , props: true},

	{ path: '/classes', name: 'classeslist', component: ClassesListComponent },
	{ path: '/classes/(index|list)', name: 'classeslist' , component: ClassesListComponent },
	{ path: '/classes/(index|list)/:fieldname/:fieldvalue', name: 'classeslist' , component: ClassesListComponent , props: true },
	{ path: '/classes/view/:id', name: 'classesview' , component: ClassesViewComponent , props: true},
	{ path: '/classes/view/:fieldname/:fieldvalue', name: 'classesview' , component: ClassesViewComponent , props: true },
	{ path: '/classes/add', name: 'classesadd' , component: ClassesAddComponent },
	{ path: '/classes/edit/:id' , name: 'classesedit' , component: ClassesEditComponent , props: true},
	{ path: '/classes/edit', name: 'classesedit' , component: ClassesEditComponent , props: true},

	{ path: '/cours', name: 'courslist', component: CoursListComponent },
	{ path: '/cours/(index|list)', name: 'courslist' , component: CoursListComponent },
	{ path: '/cours/(index|list)/:fieldname/:fieldvalue', name: 'courslist' , component: CoursListComponent , props: true },
	{ path: '/cours/view/:id', name: 'coursview' , component: CoursViewComponent , props: true},
	{ path: '/cours/view/:fieldname/:fieldvalue', name: 'coursview' , component: CoursViewComponent , props: true },
	{ path: '/cours/add', name: 'coursadd' , component: CoursAddComponent },
	{ path: '/cours/edit/:id' , name: 'coursedit' , component: CoursEditComponent , props: true},
	{ path: '/cours/edit', name: 'coursedit' , component: CoursEditComponent , props: true},

	{ path: '/etudiants', name: 'etudiantslist', component: EtudiantsListComponent },
	{ path: '/etudiants/(index|list)', name: 'etudiantslist' , component: EtudiantsListComponent },
	{ path: '/etudiants/(index|list)/:fieldname/:fieldvalue', name: 'etudiantslist' , component: EtudiantsListComponent , props: true },
	{ path: '/etudiants/view/:id', name: 'etudiantsview' , component: EtudiantsViewComponent , props: true},
	{ path: '/etudiants/view/:fieldname/:fieldvalue', name: 'etudiantsview' , component: EtudiantsViewComponent , props: true },
	{ path: '/etudiants/add', name: 'etudiantsadd' , component: EtudiantsAddComponent },
	{ path: '/etudiants/edit/:id' , name: 'etudiantsedit' , component: EtudiantsEditComponent , props: true},
	{ path: '/etudiants/edit', name: 'etudiantsedit' , component: EtudiantsEditComponent , props: true},

	{ path: '/examens', name: 'examenslist', component: ExamensListComponent },
	{ path: '/examens/(index|list)', name: 'examenslist' , component: ExamensListComponent },
	{ path: '/examens/(index|list)/:fieldname/:fieldvalue', name: 'examenslist' , component: ExamensListComponent , props: true },
	{ path: '/examens/view/:id', name: 'examensview' , component: ExamensViewComponent , props: true},
	{ path: '/examens/view/:fieldname/:fieldvalue', name: 'examensview' , component: ExamensViewComponent , props: true },
	{ path: '/examens/add', name: 'examensadd' , component: ExamensAddComponent },
	{ path: '/examens/edit/:id' , name: 'examensedit' , component: ExamensEditComponent , props: true},
	{ path: '/examens/edit', name: 'examensedit' , component: ExamensEditComponent , props: true},

	{ path: '/exercices', name: 'exerciceslist', component: ExercicesListComponent },
	{ path: '/exercices/(index|list)', name: 'exerciceslist' , component: ExercicesListComponent },
	{ path: '/exercices/(index|list)/:fieldname/:fieldvalue', name: 'exerciceslist' , component: ExercicesListComponent , props: true },
	{ path: '/exercices/view/:id', name: 'exercicesview' , component: ExercicesViewComponent , props: true},
	{ path: '/exercices/view/:fieldname/:fieldvalue', name: 'exercicesview' , component: ExercicesViewComponent , props: true },
	{ path: '/exercices/add', name: 'exercicesadd' , component: ExercicesAddComponent },
	{ path: '/exercices/edit/:id' , name: 'exercicesedit' , component: ExercicesEditComponent , props: true},
	{ path: '/exercices/edit', name: 'exercicesedit' , component: ExercicesEditComponent , props: true},

	{ path: '/filieres', name: 'filiereslist', component: FilieresListComponent },
	{ path: '/filieres/(index|list)', name: 'filiereslist' , component: FilieresListComponent },
	{ path: '/filieres/(index|list)/:fieldname/:fieldvalue', name: 'filiereslist' , component: FilieresListComponent , props: true },
	{ path: '/filieres/view/:id', name: 'filieresview' , component: FilieresViewComponent , props: true},
	{ path: '/filieres/view/:fieldname/:fieldvalue', name: 'filieresview' , component: FilieresViewComponent , props: true },
	{ path: '/filieres/add', name: 'filieresadd' , component: FilieresAddComponent },
	{ path: '/filieres/edit/:id' , name: 'filieresedit' , component: FilieresEditComponent , props: true},
	{ path: '/filieres/edit', name: 'filieresedit' , component: FilieresEditComponent , props: true},

	{ path: '/matieres', name: 'matiereslist', component: MatieresListComponent },
	{ path: '/matieres/(index|list)', name: 'matiereslist' , component: MatieresListComponent },
	{ path: '/matieres/(index|list)/:fieldname/:fieldvalue', name: 'matiereslist' , component: MatieresListComponent , props: true },
	{ path: '/matieres/view/:id', name: 'matieresview' , component: MatieresViewComponent , props: true},
	{ path: '/matieres/view/:fieldname/:fieldvalue', name: 'matieresview' , component: MatieresViewComponent , props: true },
	{ path: '/matieres/add', name: 'matieresadd' , component: MatieresAddComponent },
	{ path: '/matieres/edit/:id' , name: 'matieresedit' , component: MatieresEditComponent , props: true},
	{ path: '/matieres/edit', name: 'matieresedit' , component: MatieresEditComponent , props: true},

	{ path: '/messages', name: 'messageslist', component: MessagesListComponent },
	{ path: '/messages/(index|list)', name: 'messageslist' , component: MessagesListComponent },
	{ path: '/messages/(index|list)/:fieldname/:fieldvalue', name: 'messageslist' , component: MessagesListComponent , props: true },
	{ path: '/messages/view/:id', name: 'messagesview' , component: MessagesViewComponent , props: true},
	{ path: '/messages/view/:fieldname/:fieldvalue', name: 'messagesview' , component: MessagesViewComponent , props: true },
	{ path: '/messages/add', name: 'messagesadd' , component: MessagesAddComponent },
	{ path: '/messages/edit/:id' , name: 'messagesedit' , component: MessagesEditComponent , props: true},
	{ path: '/messages/edit', name: 'messagesedit' , component: MessagesEditComponent , props: true},

	{ path: '/modules', name: 'moduleslist', component: ModulesListComponent },
	{ path: '/modules/(index|list)', name: 'moduleslist' , component: ModulesListComponent },
	{ path: '/modules/(index|list)/:fieldname/:fieldvalue', name: 'moduleslist' , component: ModulesListComponent , props: true },
	{ path: '/modules/view/:id', name: 'modulesview' , component: ModulesViewComponent , props: true},
	{ path: '/modules/view/:fieldname/:fieldvalue', name: 'modulesview' , component: ModulesViewComponent , props: true },
	{ path: '/modules/add', name: 'modulesadd' , component: ModulesAddComponent },
	{ path: '/modules/edit/:id' , name: 'modulesedit' , component: ModulesEditComponent , props: true},
	{ path: '/modules/edit', name: 'modulesedit' , component: ModulesEditComponent , props: true},

	{ path: '/note', name: 'notelist', component: NoteListComponent },
	{ path: '/note/(index|list)', name: 'notelist' , component: NoteListComponent },
	{ path: '/note/(index|list)/:fieldname/:fieldvalue', name: 'notelist' , component: NoteListComponent , props: true },
	{ path: '/note/view/:id', name: 'noteview' , component: NoteViewComponent , props: true},
	{ path: '/note/view/:fieldname/:fieldvalue', name: 'noteview' , component: NoteViewComponent , props: true },
	{ path: '/note/add', name: 'noteadd' , component: NoteAddComponent },
	{ path: '/note/edit/:id' , name: 'noteedit' , component: NoteEditComponent , props: true},
	{ path: '/note/edit', name: 'noteedit' , component: NoteEditComponent , props: true},

	{ path: '/paiement', name: 'paiementlist', component: PaiementListComponent },
	{ path: '/paiement/(index|list)', name: 'paiementlist' , component: PaiementListComponent },
	{ path: '/paiement/(index|list)/:fieldname/:fieldvalue', name: 'paiementlist' , component: PaiementListComponent , props: true },
	{ path: '/paiement/view/:id', name: 'paiementview' , component: PaiementViewComponent , props: true},
	{ path: '/paiement/view/:fieldname/:fieldvalue', name: 'paiementview' , component: PaiementViewComponent , props: true },
	{ path: '/paiement/add', name: 'paiementadd' , component: PaiementAddComponent },
	{ path: '/paiement/edit/:id' , name: 'paiementedit' , component: PaiementEditComponent , props: true},
	{ path: '/paiement/edit', name: 'paiementedit' , component: PaiementEditComponent , props: true},

	{ path: '/professeurs', name: 'professeurslist', component: ProfesseursListComponent },
	{ path: '/professeurs/(index|list)', name: 'professeurslist' , component: ProfesseursListComponent },
	{ path: '/professeurs/(index|list)/:fieldname/:fieldvalue', name: 'professeurslist' , component: ProfesseursListComponent , props: true },
	{ path: '/professeurs/view/:id', name: 'professeursview' , component: ProfesseursViewComponent , props: true},
	{ path: '/professeurs/view/:fieldname/:fieldvalue', name: 'professeursview' , component: ProfesseursViewComponent , props: true },
	{ path: '/professeurs/add', name: 'professeursadd' , component: ProfesseursAddComponent },
	{ path: '/professeurs/edit/:id' , name: 'professeursedit' , component: ProfesseursEditComponent , props: true},
	{ path: '/professeurs/edit', name: 'professeursedit' , component: ProfesseursEditComponent , props: true},

	{ path: '/salles', name: 'salleslist', component: SallesListComponent },
	{ path: '/salles/(index|list)', name: 'salleslist' , component: SallesListComponent },
	{ path: '/salles/(index|list)/:fieldname/:fieldvalue', name: 'salleslist' , component: SallesListComponent , props: true },
	{ path: '/salles/view/:id', name: 'sallesview' , component: SallesViewComponent , props: true},
	{ path: '/salles/view/:fieldname/:fieldvalue', name: 'sallesview' , component: SallesViewComponent , props: true },
	{ path: '/salles/add', name: 'sallesadd' , component: SallesAddComponent },
	{ path: '/salles/edit/:id' , name: 'sallesedit' , component: SallesEditComponent , props: true},
	{ path: '/salles/edit', name: 'sallesedit' , component: SallesEditComponent , props: true},

	{ path: '/seances', name: 'seanceslist', component: SeancesListComponent },
	{ path: '/seances/(index|list)', name: 'seanceslist' , component: SeancesListComponent },
	{ path: '/seances/(index|list)/:fieldname/:fieldvalue', name: 'seanceslist' , component: SeancesListComponent , props: true },
	{ path: '/seances/view/:id', name: 'seancesview' , component: SeancesViewComponent , props: true},
	{ path: '/seances/view/:fieldname/:fieldvalue', name: 'seancesview' , component: SeancesViewComponent , props: true },
	{ path: '/seances/add', name: 'seancesadd' , component: SeancesAddComponent },
	{ path: '/seances/edit/:id' , name: 'seancesedit' , component: SeancesEditComponent , props: true},
	{ path: '/seances/edit', name: 'seancesedit' , component: SeancesEditComponent , props: true},

	{ path: '/tuteurs', name: 'tuteurslist', component: TuteursListComponent },
	{ path: '/tuteurs/(index|list)', name: 'tuteurslist' , component: TuteursListComponent },
	{ path: '/tuteurs/(index|list)/:fieldname/:fieldvalue', name: 'tuteurslist' , component: TuteursListComponent , props: true },
	{ path: '/tuteurs/view/:id', name: 'tuteursview' , component: TuteursViewComponent , props: true},
	{ path: '/tuteurs/view/:fieldname/:fieldvalue', name: 'tuteursview' , component: TuteursViewComponent , props: true },
	{ path: '/tuteurs/add', name: 'tuteursadd' , component: TuteursAddComponent },
	{ path: '/tuteurs/edit/:id' , name: 'tuteursedit' , component: TuteursEditComponent , props: true},
	{ path: '/tuteurs/edit', name: 'tuteursedit' , component: TuteursEditComponent , props: true},

	{ path: '/users', name: 'userslist', component: UsersListComponent },
	{ path: '/users/(index|list)', name: 'userslist' , component: UsersListComponent },
	{ path: '/users/(index|list)/:fieldname/:fieldvalue', name: 'userslist' , component: UsersListComponent , props: true },
	{ path: '/users/view/:id', name: 'usersview' , component: UsersViewComponent , props: true},
	{ path: '/users/view/:fieldname/:fieldvalue', name: 'usersview' , component: UsersViewComponent , props: true },
	{ path: '/account/edit', name: 'accountedit' , component: AccountEditComponent },
	{ path: '/account', name: 'accountview' , component: AccountViewComponent },
	{ path: '/users/add', name: 'usersadd' , component: UsersAddComponent },
	{ path: '/users/edit/:id' , name: 'usersedit' , component: UsersEditComponent , props: true},
	{ path: '/users/edit', name: 'usersedit' , component: UsersEditComponent , props: true},

	{ path: '/home', name: 'home' , component: HomeComponent },
	{ path: '*', name: 'pagenotfound' , component: ComponentNotFound }
];

if(ActiveUser){
	routes.push({ path: '/', name: 'home' , component: HomeComponent })
}
else{
	routes.push({ path: '/', name: 'index', component: IndexComponent })
	routes.push({ path: '/register', name: 'register', component: RegisterComponent })
}

var router = new VueRouter({
	routes:routes,
	linkExactActiveClass:'active',
	linkActiveClass:'active',
	//mode:'history'
});
router.beforeEach(function(to, from, next) {
	document.body.className = to.name;
	
	if(to.name !='index' && to.name !='register' && !ActiveUser){
		next(
			{
				path: '/' , 
				query:{
					redirect:to.path 
				}
			}
		);
	}
	else{
		next();	
	}

});
var config = {
	errorBagName: 'errors', // change if property conflicts
	fieldsBagName: 'fields', 
	delay: 0, 
	locale: '', 
	dictionary: null, 
	strict: true, 
	classes: false, 
	classNames: {
		touched: 'touched', // the control has been blurred
		untouched: 'untouched', // the control hasn't been blurred
		valid: 'valid', // model is valid
		invalid: 'invalid', // model is invalid
		pristine: 'pristine', // control has not been interacted with
		dirty: 'dirty' // control has been interacted with
	},
	events: 'input|blur',
	inject: true,
	validity: false,
	aria: true,
	i18n: null, // the vue-i18n plugin instance,
	i18nRootKey: 'validations', // the nested key under which the validation messsages will be located
};

Vue.use(VeeValidate,config);
Vue.http.interceptors.push(function(request, next) {
	next(function(response){
		if(response.status == 401 ) {
			if(this.$route.name != 'index'){
				window.location = "/"
				//this.$router.push('index');
			}
		}
		else if(response.status == 403 ) {
			alert(response.statusText);
			window.location = 'errors/forbidden';
		}
	});
});
Vue.mixin({
	data: function() {
		return {
			get ActiveUser() {
				return ActiveUser
			}
		}
	},
	methods: {
		SetPageTitle: function(title, pagename){
			document.title = title;
		},
		setPhotoUrl: function(src, width,height){
			var newSrc = 'helpers/timthumb.php?src=' + src;
			if(width){
				newSrc = newSrc + '&w=' + width
			}
			if(height){
				newSrc = newSrc + '&h=' + height	
			}
			return  newSrc;
		},
		exportPage: function(pagehtml , reporttitle){
			var form = document.getElementById("exportform");
			document.getElementById("exportformdata").value = pagehtml ;
			document.getElementById("exportformtitle").value = reporttitle ;
			form.submit();
		}
	}
});

var app = new Vue({
	el: '#app',
	router: router,
	data:{
		showPageError : false,
		pageErrorMsg : '',
		pageErrorStatus : '',
		modalComponentName: '',
		modalComponentProps: '',
		popoverTarget : '',
		showModalView : false,
		showFlash : false,
		flashMsg : '',
	},
	watch : {
		'$route': function(){
			this.pageErrorMsg = '' ;
			this.showPageError = false ;
		},
	},
	mounted : function(){
		this.$on('requestCompleted' ,  function (msg) {
			this.showModal = false;
			if(msg){
				this.showFlash = 3 ;
				this.flashMsg = msg ;
			}
			bus.$emit('refresh');
		});
		this.$on('requestError' ,  function (response) {
			this.pageErrorMsg = response.bodyText ;
			this.pageErrorStatus = response.statusText ;
			this.showPageError = true ;
		})
		
		this.$on('showPageModal' ,  function (props) {
			if(props.page){
				this.modalComponentName = props.page;
				delete props.page;
				props.resetgrid = true; // reset columns so that page components will fit well
				this.modalComponentProps = props;
				this.showModalView = true;
			}
			else{
				console.error("No Page Defined")
			}
		})
		
		this.$on('showPopOver' ,  function (props) {
			if(props.page && props.target){
				this.modalComponentName = props.page;
				this.popoverTarget = props.target;
				delete props.page;
				delete props.target;
				props.resetgrid=true;
				this.modalComponentProps = props;
			}
			else{
				console.error("No Page or Target  Defined")
			}
		})
		
		this.$on('showListModal' ,  function (arr) {
			this.modalComponentName = arr[0];
			this.modalFieldName = arr[1];
			this.modalFieldValue = arr[2];
			this.showModalList = true;
		})
	}
});


Vue.filter('toUSD', function (value) {
	return '$'+ value;
});
Vue.filter('upper', function (value) {
	return value.toUpperCase();
});
Vue.filter('lower', function (value) {
	return value.toLowerCase();
});
Vue.filter('proper', function (value) {
	return value.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
});
Vue.filter('truncate', function (text, length, suffix) {
	return text.substring(0, length) + suffix;
});
Vue.filter('toFixed', function (price, limit) {
	return price.toFixed(limit);
});
Vue.filter('makeRead', function (str) {
	return str.replace(/[-_]/g, " ");
});
Vue.filter('humanDate', function (datestr) {
	var timeStamp = new Date(datestr);
	return timeStamp.toDateString();
});
Vue.filter('humanTime', function (datestr) {
	var timeStamp = new Date(datestr);
	return timeStamp.toLocaleTimeString();
});

Vue.filter('toLocaleString', function (val) {
	return val.toLocaleString();
});
