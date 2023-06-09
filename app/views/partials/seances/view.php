    <template id="seancesView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Vue Seances</h3>
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
                                                    <th class="title"> Date de Séance :</th>
                                                    <td class="value"> {{ data.date_seance }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Heur de debut :</th>
                                                    <td class="value"> {{ data.heurDebut_seance }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Heur de fin  :</th>
                                                    <td class="value"> {{ data.heurFin_seance }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Salle :</th>
                                                    <td class="value"> {{ data.libelle }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title">  Matiere :</th>
                                                    <td class="value"> {{ data.Libelle_matiere }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/seances/edit/'  + data.id_seance">
                                            <i class="fa fa-edit"></i> Modifier
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/seances/delete/' + data.id_seance">
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
	var SeancesViewComponent = Vue.component('seancesView', {
		template : '#seancesView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'seances',
			},
			routename : {
				type : String,
				default : 'seancesview',
			},
			apipath: {
				type : String,
				default : 'seances/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id_seance: '',date_seance: '',heurDebut_seance: '',heurFin_seance: '',libelle: '',Libelle_matiere: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Vue Seances';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id_seance: '',date_seance: '',heurDebut_seance: '',heurFin_seance: '',libelle: '',Libelle_matiere: '',
				}
			},
		},
	});
	</script>
