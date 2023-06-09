    <template id="exercicesView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Vue Exercices</h3>
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
                                                    <th class="title"> Nom de L' Exercice :</th>
                                                    <td class="value"> {{ data.libelle_Exercice }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Description De L'Exercice :</th>
                                                    <td class="value"> {{ data.description_Exercice }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Nom De Matiere :</th>
                                                    <td class="value"> {{ data.Libelle_matiere }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/exercices/edit/'  + data.id_Exercice">
                                            <i class="fa fa-edit"></i> Modifier
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/exercices/delete/' + data.id_Exercice">
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
	var ExercicesViewComponent = Vue.component('exercicesView', {
		template : '#exercicesView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'exercices',
			},
			routename : {
				type : String,
				default : 'exercicesview',
			},
			apipath: {
				type : String,
				default : 'exercices/view',
			},
			exportbutton: {
				type: Boolean,
				default: false,
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id_Exercice: '',libelle_Exercice: '',description_Exercice: '',Libelle_matiere: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Vue Exercices';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id_Exercice: '',libelle_Exercice: '',description_Exercice: '',Libelle_matiere: '',
				}
			},
		},
	});
	</script>
