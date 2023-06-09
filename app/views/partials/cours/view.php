    <template id="coursView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Vue Cours</h3>
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
                                                    <th class="title"> Id Cour :</th>
                                                    <td class="value"> {{ data.id_cour }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Id Professeur :</th>
                                                    <td class="value"> {{ data.id_professeur }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Description :</th>
                                                    <td class="value"> {{ data.description }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Id Matiere :</th>
                                                    <td class="value"> {{ data.id_matiere }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Id Exercic :</th>
                                                    <td class="value"> {{ data.id_exercic }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Piéce-joint :</th>
                                                    <td class="value"><a class="btn btn-info btn-sm" target="" v-if="data.photo" :href="data.photo"><i class="fa fa-file"></i></a></td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/cours/edit/'  + data.id_cour">
                                            <i class="fa fa-edit"></i> Modifier
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/cours/delete/' + data.id_cour">
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
	var CoursViewComponent = Vue.component('coursView', {
		template : '#coursView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'cours',
			},
			routename : {
				type : String,
				default : 'coursview',
			},
			apipath: {
				type : String,
				default : 'cours/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id_cour: '',id_professeur: '',description: '',id_matiere: '',id_exercic: '',photo: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Vue Cours';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id_cour: '',id_professeur: '',description: '',id_matiere: '',id_exercic: '',photo: '',
				}
			},
		},
	});
	</script>
