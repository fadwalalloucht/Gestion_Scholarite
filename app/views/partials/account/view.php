    <template id="accountView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Mon compte</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <div class="profile-bg mb-2">
                                    <div class="profile">
                                        <div class="d-flex flex-row">
                                            <img src="<?php print_link("assets/images/avatar.png") ?>" /> 
                                            </div>
                                            <h2 class="title">{{data.nom}}</h2>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <b-tabs vertical pills card class="" >
                                        <b-tab title='<i class="fa fa-user"></i> Mon compte'>
                                        <div>
                                            <div>
                                                <h5 class="text-bold">Détail du compte</h5>
                                                <hr />
                                                <table class="table table-hover table-borderless table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th class="title"> Nom :</th>
                                                            <td class="value"> {{ data.nom }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="title"> Prenom :</th>
                                                            <td class="value"> {{ data.Prenom }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="title"> Email :</th>
                                                            <td class="value"> {{ data.email }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="title"> Telephone :</th>
                                                            <td class="value"> {{ data.telephone }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="title"> Type :</th>
                                                            <td class="value"> {{ data.type }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="title"> Lieu Naissance :</th>
                                                            <td class="value"> {{ data.lieu_naissance }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="title"> Date Naissance :</th>
                                                            <td class="value"> {{ data.date_naissance }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="title"> Genre :</th>
                                                            <td class="value"> {{ data.genre }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="title"> Cin :</th>
                                                            <td class="value"> {{ data.cin }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="title"> Adresse :</th>
                                                            <td class="value"> {{ data.adresse }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="title"> Photo :</th>
                                                            <td class="value"><niceimg :path="data.photo" width="400" height="400" ></niceimg> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div v-show="loading" class="load-indicator static-center">
                                                <span class="animator">
                                                    <clip-loader :loading="loading" color="gray" size="20px">
                                                    </clip-loader>
                                                </span>
                                                <h4 style="color:gray" class="loading-text">Chargement...</h4>
                                            </div>
                                            <div class="text-muted" v-if="!data && emptyrecordmsg != '' && !loading">
                                                <h4><i class="fa fa-ban"></i> Aucun Enregistrement Trouvé</h4>
                                            </div>
                                        </div>
                                        </b-tab>
                                        <b-tab title='<i class="fa fa-edit"></i> Modifier le compte'>
                                        <account-edit :resetgrid="true" v-if="ready"></account-edit>
                                        </b-tab>
                                        <b-tab title='<i class="fa fa-key"></i> réinitialiser le mot de passe'>
                                        <?php $this->load_view('passwordmanager/index.php') ?>
                                        </b-tab>
                                        <b-tab title='<i class="fa fa-envelope"></i> Changer l'e-mail'>
                                        <?php $this->load_view('account/change_email.php') ?>
                                        </b-tab>
                                        </b-tabs>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </template>
        <script>
	var AccountViewComponent = Vue.component('accountView', {
		template : '#accountView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'account',
			},
			routename : {
				type : String,
				default : 'accountaccountview',
			},
			apipath: {
				type : String,
				default : 'account',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id_user: '',nom: '',Prenom: '',email: '',telephone: '',type: '',lieu_naissance: '',date_naissance: '',genre: '',cin: '',adresse: '',photo: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Mon compte';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id_user: '',nom: '',Prenom: '',email: '',telephone: '',type: '',lieu_naissance: '',date_naissance: '',genre: '',cin: '',adresse: '',photo: '',
				}
			},
		},
	});
	</script>
