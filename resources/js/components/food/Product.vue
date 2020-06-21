<template>
<div>
  <div class="content-wrapper">     
    <!-- Content Header (Page header) -->
              <div class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Category</h1>
                              </div><!-- /.col -->
                                <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                  <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                  <li class="breadcrumb-item active">Starter Page</li>
                                </ol>
                              </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
              </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">
                      <button type="button" @click="newProduct"
                          class="btn btn-outline-primary btn-sm">
                          Create New Category
                      </button>
                  </div>

                  <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                              <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                  </div>
                </div>
                      <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>photo</th>
                              <th>Name</th>
                              <th>Price</th>
                              <th>Photo</th>
                              <th></th>
                            </tr>
                          </thead>
                        <tbody>
                            
                          <tr v-for="pro in products.data" :key="pro.id">
                           
                             <td>
                                <ul class="list-inline">
                                  <li class="list-inline-item">
                                    <img alt="Avatar" v-bind:src="'img/food/' + pro.photo"  width="80px" height="80px">
                                  </li>
                                </ul>
                             </td>
                            <th>
                                <strong>{{ pro.name+"-"+ pro.name_kh}}</strong>
                                <br/>
                                <span> price {{ pro.price }}</span>
                            </th>
                             <td>{{ pro.dsc }}</td>
                            <td>
                              <div class="btn-group">
                                <button type="button" @click="infoProduct(pro)" class="btn btn-outline-primary btn-sm">File</button>
                                <button type="button" @click="infoProduct(pro)" class="btn btn-outline-primary btn-sm">Update</button>
                                <button type="button" @click="deleteProduct(pro.id)" class="btn btn-outline-danger btn-sm">Delete</button>
                              </div>
                            </td>
                          </tr>
                        
                        </tbody>
                    </table>
                  </div>
                      <!-- /.card-body -->
                    <div class="card footer">
                        <pagination :data="products" 
                        @pagination-change-page="getProduct" 
                        :limit="2" align="right">
                        </pagination>
                    </div>
                  </div>

                </div>
                <!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
          <!-- /.content -->
      </div>
      
  </div> 
  
  
        <div class="modal fade" id="modal-product">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form @submit.prevent="method ? editProduct() : createProduct()"  role="form" method="post">
                  <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                 
                  <div class="modal-body">
                     <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" :class="{ 'is-invalid' : form.errors.has('name') }"
                            v-model="form.name"  
                            id="name" name="name" 
                            placeholder="Enter Name" >
                            <label v-show="form.errors.has('name')" for="name" class="col-form-tabel text-danger"> 
                              <strong >
                                <i class="fas fa-times-circel-0"> </i> {{ error }}
                              </strong>
                            </label>
                      </div>
                        <div class="form-group">
                            <label for="name_kh">Name_kh</label>
                            <input type="text" class="form-control" 
                            v-model="form.name_kh"
                            id="name_kh" name="name_kh" 
                            placeholder="Enter Name" >
                      </div>
                      <div class="row">
                       <div class="form-group col-sm-6">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" 
                            v-model="form.price"
                            id="price" name="price" 
                            placeholder="Enter Price"  >
                      </div>

                      <div class="form-group col-sm-6">
                        <label>Category</label>
                        <multiselect 
                            v-model="selected"
                            :options="category"
                            :custom-label="CategoryLabel"
                            :searchable="false">
                        </multiselect>
                      </div>
                      </div>


                      <div class="form-group">
                            <label for="dsc">DSC</label>
                            <input type="text" class="form-control" 
                            v-model="form.dsc"
                            id="dsc" name="dsc" 
                            placeholder="Enter dsc">
                      </div>

                  
                 <div class="col-lg-6">
                 <div class="row">
                    <div class="col-sm-12">  
                       <div class="card"> 
                          <div class="card-header"> 
                             <label for="photo" class="mb-0">photo</label>
                             <div class="card-tools"> 
                               <button type="button" class="btn btn-tool text-primary" @click="BrowseImage">
                                <i class="fas fa-paperclip"> &nbsp;</i> Choice Photo
                               </button>
                             </div>
                          <div class="card-body text-center min--hight">
                             <input type="file" @change="onImageChange" name="photo" class="d-none"  id="photo">
                                <img alt="photo" v-bind:src="action ? 'img/food/' + this.form.photo : this.form.photo"  class="img-fluid">
                          </div>
                           
                          </div>
                          </div>
                       </div>
                    </div> 
                 </div>
                  
                 </div>

                 
                  <div class="modal-footer justify-content-between">
                  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
        </div>
            
 </div>
</template>

<script>
    import bsCustomFileInput from 'bs-custom-file-input';
    export default {
      props: ['category'],
        data(){
            return{
              selected:{
                id:"",
                name: "",
                name_kh:""
              },
              
              action:false,
              method: false,
                products: {},
                form: new Form({
                  id: "",
                  name: "",
                  name_kh: "",
                  price:"",
                  photo:"",
                  dsc:"",
                  category: ""
                  // _token: token
                })
                
            }
        },
        mounted(){
            this.getProduct();
            this.chooseImage();

            Fire.$on('onCreated', (page =1)=> {
            this.getProduct(page);
        });
        },
        methods:{
            newProduct(){
                this.method = false;
                this.action = false;

                this.form.reset();
                
                this.selected.id="";
                this.selected.name = "";
                this.selected.name_kh="";
 
                $('.custom-file-label').text('photossss');
                $('#modal-product').modal('show');
            },
            getProduct(page = 1){
                 axios.get('product/rows?page=' + page)
                  .then(res => {
                  this.products = res.data;
                  //console.log(res.data);
                }).catch(err =>console.log(err));
            },
            infoProduct(pro){
              this.method = true;
              this.action = true;

              this.form.reset();
              this.form.fill(pro);

              let find = this.category.find(({id}) => id == pro.category);


              this.selected.id= find.id;
              this.selected.name= find.name;
              this.selected.name_kh= find.name_kh;
                 
                $('.custom-file-label').text(this.form.photo);
                $('#modal-product').modal('show');
            },
            deleteProduct(id){

            },
            editProduct(){
               this.form.category = this.selected.id;
              this.form.put('product/' + this.form.id)
                  .then(res => {
                    $('#modal-product').modal('hide');
                      Fire.$emit('onCreated', this.products.current_page);

                  }).catch(err => console.log(err));

            },

            createProduct(){
              this.form.category = this.selected.id;
              this.form.post('product')
                  .then(res =>{
                        $('#modal-product').modal('hide');
                          Fire.$emit('onCreated', 1);
                  }).catch(err => console.log(err));
                  //alert('test');
            },
            chooseImage(){
                 bsCustomFileInput.init();
            },
            onImageChange(event){
                let files = event.target.files;
                if(!files.length) return;

                this.action = false;

                let reader = new FileReader();
                reader.onload = (file) =>{
                  this.form.photo = file.target.result;
                };
                reader.readAsDataURL(files[0]);
            },
            CategoryLabel({name, name_kh}){
              return `${name}-${name_kh}`

            },
            BrowseImage() {
              $('#photo').trigger('click');
            }


        }
    }
</script>

<style scoped>
  .text-fint-12 {
    font-size:  12px;
  }
  .text-font-14 {
    font-size: 14px;
  }
  .min--hight{
    min-height: 210px;
  }
</style>