    <template id="tuteursView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Tuteurs</h3>
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

                                        </tbody>
                                    </table>
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
        var TuteursViewComponent = Vue.component('tuteursView', {
            template: '#tuteursView',
            mixins: [ViewPageMixin],
            props: {
                pagename: {
                    type: String,
                    default: 'tuteurs',
                },
                routename: {
                    type: String,
                    default: 'tuteursview',
                },
                apipath: {
                    type: String,
                    default: 'tuteurs/view',
                },
            },
            data: function() {
                return {
                    data: {
                        default: {
                            id_tuteur: '',
                            cin: '',
                            libelle_tuteur: '',
                            created_at: '',
                            update_at: '',
                            deleted_at: '',
                            id_user: '',
                        },
                    },
                }
            },
            computed: {
                pageTitle: function() {
                    return 'Vue Tuteurs';
                },
            },
            methods: {
                resetData: function() {
                    this.data = {
                        id_tuteur: '',
                        cin: '',
                        libelle_tuteur: '',
                        created_at: '',
                        update_at: '',
                        deleted_at: '',
                        id_user: '',
                    }
                },
            },
        });
    </script>