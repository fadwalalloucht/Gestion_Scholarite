    <template id="etudiantsView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Vue Etudiants</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-12 comp-grid" :class="setGridSize">
                            <div class=" animated fadeIn">
                                <div class="profile-bg mb-2">
                                    <div class="profile">
                                        <div class="">
                                            <div class="avatar">
                                                <niceimg width="100" height="100" :path="data.photo"></niceimg>
                                            </div>
                                        </div>
                                        <h2 class="title">{{data.nom}}</h2>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="text-bold">Détail du compte</h5>
                                    <hr />
                                    <table class="table table-hover table-borderless table-striped">
                                        <tbody>
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
                                                <th class="title"> Type :</th>
                                                <td class="value"> {{ data.type }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Lieu Naissance :</th>
                                                <td class="value"> {{ data.lieu_naissance }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Date Naissance :</th>
                                                <td class="value"> {{ data.date_naissance }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Genre :</th>
                                                <td class="value"> {{ data.genre }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Cin :</th>
                                                <td class="value"> {{ data.cin }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Adresse :</th>
                                                <td class="value"> {{ data.adresse }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Tuteur :</th>
                                                <td class="value">
                                                    <b-btn size="sm" variant="primary" @click="showPageModal({page:'tuteursView' , fieldname:'id_tuteur' , fieldvalue:data.id_tuteur})">Tuteur<i class="fa fa-eye"></i></b-btn>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div v-if="editbutton || deletebutton || exportbutton" class="mt-2">
                                    <span>
                                        <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton" :to="'/etudiants/edit/'  + data.id_etudiant">
                                            <i class="fa fa-edit"></i> Modifier
                                        </router-link>
                                        <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/users/delete/' + data.id_etudiant">
                                            <i class="fa fa-times"></i> Effacer</button>
                                    </span>
                                </div>
                                <div v-show="loading" class="load-indicator static-center">
                                    <span class="animator">
                                        <clip-loader :loading="loading" color="gray" size="20px">
                                        </clip-loader>
                                    </span>
                                    <h4 style="color:gray" class="loading-text">Chargement...</h4>
                                </div>
                                <div class="text-muted" v-if="!data && emptyrecordmsg != '' && !loading">
                                    <h4><i class="fa fa-ban"></i> Aucun Enregistrement Trouvé</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
        var EtudiantsViewComponent = Vue.component('etudiantsView', {
            template: '#etudiantsView',
            mixins: [ViewPageMixin],
            props: {
                pagename: {
                    type: String,
                    default: 'etudiants',
                },
                routename: {
                    type: String,
                    default: 'etudiantsview',
                },
                apipath: {
                    type: String,
                    default: 'etudiants/view',
                },
            },
            data: function() {
                return {
                    data: {
                        default: {
                            id_etudiant: '',
                            id_tuteur: '',
                            CNE: '',
                            id_user: '',
                            created_at: '',
                            update_at: '',
                            deleted_at: '',
                            id_classe: '',
                            users_id_user: '',
                            nom: '',
                            Prenom: '',
                            email: '',
                            telephone: '',
                            mot_passe: '',
                            type: '',
                            lieu_naissance: '',
                            date_naissance: '',
                            genre: '',
                            cin: '',
                            adresse: '',
                            photo: '',
                            users_created_at: '',
                            users_update_at: '',
                            users_deleted_at: '',
                        },
                    },
                }
            },
            computed: {
                pageTitle: function() {
                    return 'Vue Etudiants';
                },
            },
            methods: {
                resetData: function() {
                    this.data = {
                        id_etudiant: '',
                        id_tuteur: '',
                        CNE: '',
                        id_user: '',
                        created_at: '',
                        update_at: '',
                        deleted_at: '',
                        id_classe: '',
                        users_id_user: '',
                        nom: '',
                        Prenom: '',
                        email: '',
                        telephone: '',
                        mot_passe: '',
                        type: '',
                        lieu_naissance: '',
                        date_naissance: '',
                        genre: '',
                        cin: '',
                        adresse: '',
                        photo: '',
                        users_created_at: '',
                        users_update_at: '',
                        users_deleted_at: '',
                    }
                },
            },
        });
    </script>