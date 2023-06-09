<template id="matieresView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Vue Matieres</h3>
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
                                                    <th class="title"> Libelle Matiere :</th>
                                                    <td class="value"> {{ data.Libelle_matiere }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/matieres/edit/'  + data.id_matiere">
                                            <i class="fa fa-edit"></i> Modifier
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/matieres/delete/' + data.id_matiere">
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
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                            <div class=""><examens-list  headertitle="" emptyrecordmsg="Aucun Enregistrement Trouvé" :limit="20" fieldname="id_matiere" :fieldvalue=data.id_matiere sortby="" sorttype="DESC" :showheader="true" :addbutton="true" :editbutton="true" :viewbutton="true" :deletebutton="true" :exportbutton="true" :importbutton="true" :searchfield="true" :listsequence="true" :multicheckbox="true" :paginate="true"  :resetgrid="false" v-if="ready"></examens-list></div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                            <div class=""><cours-list  headertitle="" emptyrecordmsg="Aucun Enregistrement Trouvé" :limit="20" fieldname="id_matiere" :fieldvalue=data.id_matiere sortby="" sorttype="DESC" :showheader="true" :addbutton="true" :editbutton="true" :viewbutton="true" :deletebutton="true" :exportbutton="true" :importbutton="true" :searchfield="true" :listsequence="true" :multicheckbox="true" :paginate="true"  :resetgrid="false" v-if="ready"></cours-list></div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                            <div class=""><exercices-list  headertitle="" emptyrecordmsg="Aucun Enregistrement Trouvé" :limit="20" fieldname="id_matiere" :fieldvalue=data.id_matiere sortby="" sorttype="DESC" :showheader="true" :addbutton="true" :editbutton="true" :viewbutton="true" :deletebutton="true" :exportbutton="true" :importbutton="true" :searchfield="true" :listsequence="true" :multicheckbox="true" :paginate="true"  :resetgrid="false" v-if="ready"></exercices-list></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
	var MatieresViewComponent = Vue.component('matieresView', {
		template : '#matieresView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'matieres',
			},
			routename : {
				type : String,
				default : 'matieresview',
			},
			apipath: {
				type : String,
				default : 'matieres/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id_matiere: '',Libelle_matiere: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Vue Matieres';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id_matiere: '',Libelle_matiere: '',
				}
			},
		},
	});
	</script>
