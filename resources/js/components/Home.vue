<template>
    <div class="content pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                    <div class="row">
                       <div class="col-sm-6">
                          <div class="form-group">
                            <label >Category</label>
                            <select v-model="category" :options="orders.categories" name="category">
                               <option value="__all"> 
                                  category
                              </option>
                            </select>
                            
                          </div>

                       </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label >Table</label>
                              <select v-model="table" :options="orders.tables" name="table">
                               
                             </select>
                              
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-sm-3 mb-2">
                         <div class="product-image-thumbs m-0">
                           <div class="product-image-thumb p-0" style="margin: 0 auto;">
                             <img src="img/avatar.png" alt="food">
                           </div>
                       </div>
                       <div class="text-center">
                         <strong>Name</strong><br>
                         <label class="badge badge-danger">Price</label>

                       </div>

                       </div>
                    </div>
              </div>
            </div>

          </div>
            <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                        <table class="table ">
                            <thead>
                             <tr>
                              <th>N</th>
                              <th>Product</th>
                              <th>Qty</th>
                              <th>Price</th>
                             </tr>
                            </thead>
                            <tbody>
                               <tr>
                                <td>1</td>
                                <td>Check</td>
                                <th>1</th>
                                <th>$100</th>
                               </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th colspan="3">Total</th>
                                <th>$100</th>

                              </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                         <button type="submit" class="btn btn-primary">Submit</button>
                       </div>
                    
                  </div>
            </div>
        </div>
      </div>
    </div>
</template>

<script>
  export default {
      props: ['orders'],
        data(){
            return {
               category: "__all",
               table: "1",
               items:""
            }
        },
        mounted() {
          this.getItems();
        },
        methods: {
          getItems() {
             axios.get('product/rows/' + this.category)
                  .then(res =>{
                    this.items = res.data;

                  }).catch(err => console.log(err));
          }
        }
    }
</script>

<style scoped>

</style>