<?php 
$can_addc = PageAccessManager::is_allowed('classes/add');
?>  

    <template id="filieresView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Vue Filieres</h3>

                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">

                        <div class="col-md-12 comp-grid" :class="setGridSize">
                            <div class=" animated fadeIn">
                                <div v-show="!loading">
                                    <div ref="datatable" id="datatable">
                                        <table class="table table-hover table-borderless table-striped">
                                            <!-- Table Body Start -->
                                            <tbody>
                                                <tr>
                                                    <th class="title"> Nom d'une Filiere :</th>
                                                    <td class="value">
                                                        {{data.libelle_filiere}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span>

                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton" :to="'/filieres/edit/'  + data.id_filiere">
                                                <i class="fa fa-edit"></i> Modifier
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/filieres/delete/' + data.id_filiere">
                                                <i class="fa fa-times"></i> Effacer</button>
                                        </span>
                                        <button @click="exportRecord" class="btn btn-sm btn-primary" v-if="exportbutton">
                                            <i class="fa fa-save"></i> Exportation
                                        </button>
                                    </div>


  <?php
    if($can_addc){

?>
                                    <br>
                                    <router-link class="btn btn-sm btn-outline-primary" title="View Record" :to="'/filieres/view/' +'C1-' + data.id_filiere">
                                        <i class="fa fa-eye"></i> Ajouter Class 1ere annee
                                    </router-link>
                                <router-link class="btn btn-sm btn-outline-primary" title="View Record" :to="'/filieres/view/' +'C2-' + data.id_filiere">
                                        <i class="fa fa-eye"></i> Ajouter Class 2eme annee
                                    </router-link>
                                </div>

  <?php
    }
    ?>
        
                                <div v-show="loading" class="load-indicator static-center">
                                    <span class="animator">
                                        <clip-loader :loading="loading" color="gray" size="20px">
                                        </clip-loader>
                                    </span>
                                    <h4 style="color:gray" class="loading-text">Chargement...</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 comp-grid" :class="setGridSize">
                            <div class="">
                                <classes-list headertitle="" emptyrecordmsg="Aucun Enregistrement Trouvé" :limit="20" fieldname="id_filiere" :fieldvalue="data.id_filiere" sortby="annee_scolaire" sorttype="DESC" :showheader="false" :addbutton="false" :editbutton="true" :viewbutton="true" :deletebutton="true" :exportbutton="false" :importbutton="false" :searchfield="false" :listsequence="true" :multicheckbox="false" :paginate="true" :resetgrid="false" v-if="ready"></classes-list>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
        var FilieresViewComponent = Vue.component('filieresView', {
            template: '#filieresView',
            mixins: [ViewPageMixin],
            props: {
                pagename: {
                    type: String,
                    default: 'filieres',
                },
                routename: {
                    type: String,
                    default: 'filieresview',
                },
                apipath: {
                    type: String,
                    default: 'filieres/view',
                },
            },
            data: function() {
                return {
                    data: {
                        default: {
                            id_filiere: '',
                            libelle_filiere: '',
                        },
                    },
                }
            },
            computed: {
                pageTitle: function() {
                    return 'Vue Filieres';
                },
            },
            methods: {
                resetData: function() {
                    this.data = {
                        id_filiere: '',
                        libelle_filiere: '',
                    }
                },
            },
        });
    </script>