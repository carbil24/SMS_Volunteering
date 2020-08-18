<template>
  <div>
    <responsible1-admissions-form ref="reponsible1"></responsible1-admissions-form>
    <responsible2-admissions-form v-if="responsible2Added" ref="reponsible2"></responsible2-admissions-form>
    <button type="button" 
            class="btn btn-primary btn-block" 
            id="btnAddRelationship1" 
            @click="addResponsible"
            v-if="responsible2Button"
        ><i class="fas fa-plus"></i> add another responsible
    </button>
  </div>
</template>

<script>
export default {
data() {
    return {
      responsible2Button: true,
      responsible2Added: false,
    }
  },
  methods: {
    validateSecondStep() {
        if(this.responsible2Added){
            return this.$refs.reponsible2.validateSecondStep();
        }
        else{
          this.$refs.reponsible1.validateSecondStep().then((valid)=>{
              if(valid){
                Swal.fire({
                  title: 'Please note that a emergency contact is a person to ask for or contact if we are unable to reach parents or a guardian.',
                  showClass: {
                      popup: 'animate__animated animate__fadeInDown'
                  },
                  hideClass: {
                      popup: 'animate__animated animate__fadeOutUp'
                  }
                })
              }
          });
          return this.$refs.reponsible1.validateSecondStep()
        }

    },
    addResponsible() {
        this.$refs.reponsible1.validateSecondStep().then((valid)=>{
          if(valid){
            this.responsible2Added = true;
            this.responsible2Button = false;
          }
        });
    },
  },

}
</script>