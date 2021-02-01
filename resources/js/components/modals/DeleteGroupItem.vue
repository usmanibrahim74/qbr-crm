<template>
<!--  <div class="modal fade" id="" tabindex="-1" role="dialog" aria-hidden="true">-->
<!--    <div class="modal-dialog modal-dialog-centered" role="document">-->
<!--      <form action="#" method="post" class="modal-content">-->
<!--        <div class="modal-header">-->
<!--          <h5 class="modal-title">Add group item</h5>-->
<!--          <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--            <i class="material-icons">close</i>-->
<!--          </button>-->
<!--        </div>-->
<!--        <div class="modal-body">-->

<!--        </div>-->
<!--        <div class="modal-footer">-->
<!--          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--          <button type="submit" class="btn btn-primary">Add item</button>-->
<!--        </div>-->
<!--      </form>-->
<!--    </div>-->
<!--  </div>-->

  <div>
    <b-modal v-model="show" centered title="BootstrapVue">
      <template #modal-header="{close}">
        <h5>Add New Group</h5>
        <button type="button" class="close" @click="close">
          <i class="material-icons">close</i>
        </button>
      </template>
      <div class="form-group">
        <label for="add-item-name">Group Name</label>
        <input type="text" class="form-control"id="add-item-name" v-model="group_name" placeholder="e.g. Web">
      </div>

      <template #modal-footer="{ close }">

        <b-button variant="secondary" @click="close()">
          Cancel
        </b-button>
        <b-button variant="primary" @click="close()">
          Add
        </b-button>
      </template>
    </b-modal>
  </div>
</template>

<script>

    export default {
      name: "DeleteGroupItem",
      props:['value'],
      data(){
        return {
          group_name:""
        }
      },
      computed:{

        show:{
          get(){
            return this.value;
          },
          set(val){
            this.$emit('input', val);
          }
        }
      },
      methods:{
        close(){
          this.group_name = ""
          this.$emit('input', false);
        }
      }

    }
</script>

<style scoped>

</style>
