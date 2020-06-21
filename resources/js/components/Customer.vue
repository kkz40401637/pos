<template>
<div>
  <div class="content-wrapper">     
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Customer</h1>
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
                    <button type="button" @click="newCustomer"
                        class="btn btn-outline-primary btn-sm">
                        Create New Customer
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
                      <th>GENDER</th>
                      <th>PHONE</th>
                      <th>ADDRESS</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  <tr v-for="cus in customers.data" :key="cus.id">
                    <th>{{ cus.id }}</th>
                    <td>{{ cus.name }}</td>
                    <td v-show="cus.gender==1">male</td>
                    <td v-show="cus.gender==0">female</td>
                    <td>{{ cus.phone }}</td>
                    <td>{{ cus.address }}</td>
                    <td>
                          <div class="btn-group">
                            <button type="button" @click="infoCustomer(cus)" class="btn btn-outline-primary btn-sm">Update</button>
                            <button type="button" @click="deleteCustomer(cus.id)" class="btn btn-outline-danger btn-sm">Delete</button>
                          </div>
                    </td>
                  </tr>
                 
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card footer">
                <pagination :data="customers" @pagination-change-page="getCustomer" :limit="2" align="right">

                </pagination>
              </div>
            </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content --></div>        


 </div>

 
 <div class="modal fade" id="modal-customer">
        <div class="modal-dialog">
          <div class="modal-content">
                <form @submit.prevent="method ? editCustomer() : createCustomer()" role="form" method="post">
                    <div class="modal-header">
                    <h4 class="modal-title">Customer Form</h4>
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
                            <label for="gender">Gender</label>
                                <select class="form-control" v-model="form.gender" id="gender" name="gender">
                                    <option value="1">male</option>
                                    <option value="0">female</option>
                                </select>
                        </div>

                         <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control"  v-model="form.phone" id="phone" name="phone" 
                            placeholder="Enter Phone">
                        </div>

                         <div class="form-group">
                            <label for="name">Address</label>
                            <input type="text" class="form-control"  v-model="form.address" id="address" name="address" 
                            placeholder="Enter Address">
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
          method: false,
          customers: {},
          form: new Form({
            id: "",
            name: "",
            gender: "1",
            phone: "",
            address: "",
            _token: this.token.value
          })
        }
      },
      mounted(){
        this.getCustomer();

        Fire.$on('create', (page =1)=>{
          this.getCustomer(page);
        });
      },
       methods: {
           newCustomer(){
              this.method = false;
              this.form.reset();       
              $('#modal-customer').modal('show');
           }, //end data

           infoCustomer(cus){
             this.method = true;
             this.form.reset();

             this.form.fill(cus);
             this.form._token = this.token.value; 
             $('#modal-customer').modal('show');
           },

           createCustomer(){
             this.form.post('customer')
                .then(res => {
                    Fire.$emit('onCreated', 1);
                    $('#modal-customer').modal('hide');
                    // console.log(res.data);
                })
                .catch(error => console.log(error));
           },
          editCustomer(){
             this.form.put('customer/' + this.form.id)
              .then(res =>{
                Fire.$emit('onCreated', this.customers.current_page);

                $('#modal-customer').modal('hide');
                console.log(res);
              }).catch(err => console.log(err));

              setTimeout(function () {
                        location.reload(true)
                    }, 500)
          },
        

           getCustomer(page = 1){
             axios.get('/customer/get/all?page=' + page)
                .then(res => {
                  this.customers = res.data;
                  //console.log(res.data);
                })
                .catch(err =>console.log(err));
           },
           deleteCustomer(id){
            
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
                    this.form.delete('customer/' + id)
                    .then(() => {
                    Vue.swal(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    );
                    Fire.$emit('onCreated', this.customers.current_page);
                    }).catch(err => console.log(err));
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