<?php 
$can_add = PageAccessManager::is_allowed('notegenerales/add');
$can_edit = PageAccessManager::is_allowed('notegenerales/edit');
$can_view = PageAccessManager::is_allowed('notegenerales/view');
$can_delete = PageAccessManager::is_allowed('notegenerales/delete');
?>
<template id="notegeneralesView">
    <section class="page-component">
        <div v-if="showheader" class="bg-light p-3 mb-3">
            <div class="container">
                <div class="row ">
                    <div  class="col-12 comp-grid" :class="setGridSize">
                        <h3 class="record-title">Vue Notegenerales</h3>
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
                                                <th class="title"> Nom De Examen :</th>
                                                <td class="value"> {{ data.libelle_examen }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Nom De Filiere :</th>
                                                <td class="value"> {{ data.libelle_filiere }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Nom De Module :</th>
                                                <td class="value"> {{ data.Libelle_module }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Nom De  Matiere :</th>
                                                <td class="value"> {{ data.Libelle_matiere }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Note :</th>
                                                <td class="value"> {{ data.note }} </td>
                                            </tr>
                                        </tbody>
                                        <!-- Table Body End -->
                                    </table>
                                </div>
                                <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                    <span >
                                        <?php 
                                        if($can_edit){
                                        ?>
                                        <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/notegenerales/edit/'  + data.id">
                                        <i class="fa fa-edit"></i> Modifier
                                        </router-link>
                                        <?php 
                                        }
                                        ?>
                                        <?php 
                                        if($can_delete){
                                        ?>
                                        <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/notegenerales/delete/' + data.id">
                                        <i class="fa fa-times"></i> Effacer</button>
                                        <?php 
                                        }
                                        ?>
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
	var NotegeneralesViewComponent = Vue.component('notegeneralesView', {
		template : '#notegeneralesView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'notegenerales',
			},
			routename : {
				type : String,
				default : 'notegeneralesview',
			},
			apipath: {
				type : String,
				default : 'notegenerales/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						libelle_examen: '',libelle_filiere: '',Libelle_module: '',Libelle_matiere: '',id: '',note: '',id_filiere: '',id_matiere: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Vue Notegenerales';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					libelle_examen: '',libelle_filiere: '',Libelle_module: '',Libelle_matiere: '',id: '',note: '',id_filiere: '',id_matiere: '',
				}
			},
		},
	});
	</script>
