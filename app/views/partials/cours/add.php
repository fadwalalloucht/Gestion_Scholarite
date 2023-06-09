    <template id="coursAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Ajouter un nouveau</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="cours/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('description')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="description">Description <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.description"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Description"
                                                    class="form-control "
                                                    type="text"
                                                    name="description"
                                                    placeholder="Enter Description"
                                                    />
                                                    <small v-show="errors.has('description')" class="form-text text-danger">
                                                        {{ errors.first('description') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('photo')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="photo">Piéce-joint <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <niceupload
                                                        fieldname="photo"
                                                        control-class="upload-control"
                                                        dropmsg="Drop files here to upload"
                                                        uploadpath="uploads/files/"
                                                        filenameformat="random" 
                                                        :filesize="3" 
                                                        :maximum="1" 
                                                        name="photo"
                                                        v-model="data.photo"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Piéce-joint"
                                                        >
                                                    </niceupload>
                                                    <small v-show="errors.has('photo')" class="form-text text-danger">{{ errors.first('photo') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary"  :disabled="errors.any()" type="submit">
                                            <i class="load-indicator">
                                                <clip-loader :loading="saving" color="#fff" size="15px"></clip-loader>
                                            </i>
                                            {{submitbuttontext}}
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
	var CoursAddComponent = Vue.component('coursAdd', {
		template : '#coursAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'cours',
			},
			routename : {
				type : String,
				default : 'coursadd',
			},
			apipath : {
				type : String,
				default : 'cours/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					description: '',photo: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Ajouter un nouveau';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/cours');
			},
			resetForm : function(){
				this.data = {description: '',photo: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
