<template>
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header vino">
                <h5 class="modal-title" id="exampleModalLongTitle">Cambiar estatus</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
                <select v-model="status_id" :size="status.length" id="select" @change="update_status()">                  
                  <option class="text-left text-dark" v-for="statu in status" :key="statu.id" :value="statu.id" v-text="statu.name"></option>
                </select>

              </div>
              <div class="modal-footer vino">
                <small>@abraham.r.j</small>
              </div>            
            </div>
        </div>
    </div>
</template>
<script>

  export default {
    props: ['status','task'],   
    data() {
      return {
        status_id: ''
      }
    },
    methods: {
      update_status() {
        this.$emit('update',this.status_id,this.task)
      }      
    },
}
</script>