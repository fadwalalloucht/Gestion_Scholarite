    <template id="professeursView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Vue Professeurs</h3>
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
                                                    <th class="title"> Photo :</th>
                                                    <td class="value"> {{ data.photo }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Cin :</th>
                                                    <td class="value"> {{ data.cin }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Cnp :</th>
                                                    <td class="value"> {{ data.cnp }} </td>
                                                </tr>
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
                                                    <th class="title"> Adresse :</th>
                                                    <td class="value"> {{ data.adresse }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Genre :</th>
                                                    <td class="value"> {{ data.genre }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Date Naissance :</th>
                                                    <td class="value"> {{ data.date_naissance }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Lieu Naissance :</th>
                                                    <td class="value"> {{ data.lieu_naissance }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span>
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton" :to="'/professeurs/edit/'  + data.id_prof">
                                                <i class="fa fa-edit"></i> Modifier
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/professeurs/delete/' + data.id_prof">
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
        var ProfesseursViewComponent = Vue.component('professeursView', {
            template: '#professeursView',
            mixins: [ViewPageMixin],
            props: {
                pagename: {
                    type: String,
                    default: 'professeurs',
                },
                routename: {
                    type: String,
                    default: 'professeursview',
                },
                apipath: {
                    type: String,
                    default: 'professeurs/view',
                },
            },
            data: function() {
                return {
                    data: {
                        default: {
                            id_prof: '',
                            photo: '',
                            cin: '',
                            cnp: '',
                            nom: '',
                            Prenom: '',
                            email: '',
                            telephone: '',
                            adresse: '',
                            genre: '',
                            date_naissance: '',
                            lieu_naissance: '',
                        },
                    },
                }
            },
            computed: {
                pageTitle: function() {
                    return 'Vue Professeurs';
                },
            },
            methods: {
                resetData: function() {
                    this.data = {
                        id_prof: '',
                        photo: '',
                        cin: '',
                        cnp: '',
                        nom: '',
                        Prenom: '',
                        email: '',
                        telephone: '',
                        adresse: '',
                        genre: '',
                        date_naissance: '',
                        lieu_naissance: '',
                    }
                },
            },
        });
    </script>