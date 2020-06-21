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
                      <button type="button" @click="newCategory"
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
                              <th>ID</th>
                              <th>NAME</th>
                              <th>Name_ks</th>
                              <th>DSC</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                        <tbody>
                            
                          <tr v-for="cus in categoris.data" :key="cus.id">
                            <th>{{ cus.id }}</th>
                            <td>{{ cus.name }}</td>
                            <td>{{ cus.name_kh }}</td>
                            <td>{{cus.dsc }}</td>
                            <td>
                              <div class="btn-group">
                                <button type="button" @click="infoCategory(cus)" class="btn btn-outline-primary btn-sm">Update</button>
                                <button type="button" @click="deleteCategory(cus.id)" class="btn btn-outline-danger btn-sm">Delete</button>
                              </div>
                            </td>
                          </tr>
                        
                        </tbody>
                    </table>
                  </div>
                      <!-- /.card-body -->
                    <div class="card footer">
                        <pagination :data="categoris" 
                        @pagination-change-page="getCategory" 
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
  
        <div class="modal fade" id="modal-category">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form @submit.prevent="method ? editCategory() : createCategory()"  role="form" method="post">
                  <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                     <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control"
                            v-model="form.name" 
                            id="name" name="name" 
                            placeholder="Enter Name" autocomplete="name" autofocus required>
                      </div>
                      <div class="form-group">
                            <label for="name">Name_kh</label>
                            <input type="text" class="form-control" 
                            v-model="form.name_kh"
                            id="name_kh" name="name_kh" 
                            placeholder="Enter Name" autocomplete="name_kh" autofocus required>
                      </div>
                      <div class="form-group">
                            <label for="dsc">DSC</label>
                            <input type="text" class="form-control" 
                            v-model="form.dsc"
                            id="dsc" name="dsc" 
                            placeholder="Enter dsc" autocomplete="dsc" autofocus required>
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
    export default {
       props: ['token'],
      data(){
        return{
          categoris: {},
            form: new Form({
              id: "",
              name: "",
              name_kh: "",
              dsc: "",
               _token: this.token.value
            })
        }
      },
      mounted(){
       this.getCategory();

        Fire.$on('create', (page =1)=>{
          this.getCategory(page);
        });
      },


      methods: {
        newCategory(){
           this.method = false;
              this.form.reset();       
              $('#modal-category').modal('show');
        },
         infoCategory(cus){
             this.method = true;
             this.form.reset();

             this.form.fill(cus);
             this.form._token = this.token.value; 
             $('#modal-category').modal('show');
           },
        createCategory(){
          this.form.post('category')
                .then(res => {
                    Fire.$emit('onCreated', 1);
                    $('#modal-category').modal('hide');
                    // console.log(res.data);
                })
                .catch(error => console.log(error));

                setTimeout(function () {
                        location.reload(true)
                    }, 500)
        },

        getCategory(page = 1){
           axios.get('category/get/all?page=' + page)
         
          .then(res => {
            this.categoris = res.data;
          })
          .catch(err =>console.log(err));
        },


         editCategory(){
             this.form.put('category/' + this.form.id)
              .then(res =>{
                Fire.$emit('onCreated', this.categoris.current_page);

                $('#modal-category').modal('hide');
                console.log(res);
              }).catch(err => console.log(err));

               
          },


        deleteCategory(id){
               
                  Vue.swal({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.value) {
                    this.form.delete('category/' + id)
                    .then(() => {
                    Vue.swal(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    );
                    Fire.$emit('onCreated', this.categoris.current_page);
                    }).catch(err => console.log(err));

                     setTimeout(function () {
                        location.reload(true)
                    }, 500)
                  }
                })
                
             
           },

         

      
     
      }
    }
</script>

<style scoped>
    .pagination.pagination-sm{
      margin-bottom: -px !important;
    }
</style>