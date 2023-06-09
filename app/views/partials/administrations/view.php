    <template id="administrationsView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Vue Administrations</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <div v-show="!loading">
                                    <div ref="datatable" id="datatable">
                                        <table class="table table-hover table-borderless table-striped">
                                            <!-- Table Body Start -->
                                            <tbody>
                                                <tr>
                                                    <th class="title"> Nom de L' ecole :</th>
                                                    <td class="value"> {{ data.nom_ecole }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Address :</th>
                                                    <td class="value"> {{ data.address }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Capital :</th>
                                                    <td class="value"> {{ data.capital }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Ville :</th>
                                                    <td class="value"> {{ data.ville }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Code Postal :</th>
                                                    <td class="value"> {{ data.code_postal }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Telephone :</th>
                                                    <td class="value"> {{ data.telephone }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Created At :</th>
                                                    <td class="value"> {{ data.created_at }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Update At :</th>
                                                    <td class="value"> {{ data.update_at }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> CNSS :</th>
                                                    <td class="value"> {{ data.cnss }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> ICE :</th>
                                                    <td class="value"> {{ data.ice }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Num Patente :</th>
                                                    <td class="value"> {{ data.num_patente }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Site Web :</th>
                                                    <td class="value"> {{ data.site_web }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Email :</th>
                                                    <td class="value"> {{ data.email }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> RS :</th>
                                                    <td class="value"> {{ data.rs }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/administrations/edit/'  + data.nom_ecole">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/administrations/delete/' + data.nom_ecole">
                                            <i class="fa fa-times"></i> </button>
                                        </span>
                                        <button @click="exportRecord" class="btn btn-sm btn-primary" v-if="exportbutton">
                                            <i class="fa fa-save"></i> Exportation
                                        </button>
                                    </div>
                                </div>
                                <div v-show="loading" class="load-indicator static-center">
                                    <span class="animator">
                                        <clip-loader :loading="loading" color="gray" size="20px">
                                        </clip-loader>
                                    </span>
                                    <h4 style="color:gray" class="loading-text">Chargement...</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
	var AdministrationsViewComponent = Vue.component('administrationsView', {
		template : '#administrationsView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'administrations',
			},
			routename : {
				type : String,
				default : 'administrationsview',
			},
			apipath: {
				type : String,
				default : 'administrations/view',
			},
			editbutton: {
				type: Boolean,
				default: false,
			},
			deletebutton: {
				type: Boolean,
				default: false,
			},
		},
		data: function() {
			return {
				data : {
					default :{
						nom_ecole: '',address: '',capital: '',ville: '',code_postal: '',telephone: '',created_at: '',update_at: '',cnss: '',ice: '',num_patente: '',site_web: '',email: '',rs: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Vue Administrations';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					nom_ecole: '',address: '',capital: '',ville: '',code_postal: '',telephone: '',created_at: '',update_at: '',cnss: '',ice: '',num_patente: '',site_web: '',email: '',rs: '',
				}
			},
		},
	});
	</script>
