    <template id="absencesView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Vue Absences</h3>
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
                                                    <th class="title"> Id Absence :</th>
                                                    <td class="value"><router-link :to="'/absences/view/' +  data.id_absence">{{data.id_absence}}</router-link></td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Justifie :</th>
                                                    <td class="value"> {{ data.justifie }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Id Seance :</th>
                                                    <td class="value"> {{ data.id_seance }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Id Etudiant :</th>
                                                    <td class="value"> {{ data.id_etudiant }} </td>
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
                                                    <th class="title"> Deleted At :</th>
                                                    <td class="value"> {{ data.deleted_at }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/absences/edit/'  + data.id_absence">
                                            <i class="fa fa-edit"></i> Modifier
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/absences/delete/' + data.id_absence">
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
	var AbsencesViewComponent = Vue.component('absencesView', {
		template : '#absencesView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'absences',
			},
			routename : {
				type : String,
				default : 'absencesview',
			},
			apipath: {
				type : String,
				default : 'absences/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id_absence: '',justifie: '',id_seance: '',id_etudiant: '',created_at: '',update_at: '',deleted_at: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Vue Absences';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id_absence: '',justifie: '',id_seance: '',id_etudiant: '',created_at: '',update_at: '',deleted_at: '',
				}
			},
		},
	});
	</script>
