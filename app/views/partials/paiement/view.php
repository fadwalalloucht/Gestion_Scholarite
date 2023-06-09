    <template id="paiementView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Vue Paiement</h3>
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
                                                    <th class="title"> Date Paiement :</th>
                                                    <td class="value"> {{ data.Date_Paiement }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Montant :</th>
                                                    <td class="value"> {{ data.Montant }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Type Paiement :</th>
                                                    <td class="value"><router-link :to="'/paiement/view/' +  data.id_paiement">{{data.Type_paiement}}</router-link></td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Nom :</th>
                                                    <td class="value"> {{ data.nom }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> CNE :</th>
                                                    <td class="value"> {{ data.CNE }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/paiement/edit/'  + data.id_paiement">
                                            <i class="fa fa-edit"></i> Modifier
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/paiement/delete/' + data.id_paiement">
                                            <i class="fa fa-times"></i> Effacer</button>
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
        </section>
    </template>
    <script>
	var PaiementViewComponent = Vue.component('paiementView', {
		template : '#paiementView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'paiement',
			},
			routename : {
				type : String,
				default : 'paiementview',
			},
			apipath: {
				type : String,
				default : 'paiement/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id_paiement: '',Date_Paiement: '',Montant: '',Type_paiement: '',nom: '',CNE: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Vue Paiement';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id_paiement: '',Date_Paiement: '',Montant: '',Type_paiement: '',nom: '',CNE: '',
				}
			},
		},
	});
	</script>
