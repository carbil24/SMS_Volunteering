<template>
  <div>
    <responsible1-admissions-form ref="reponsible1" @clickShowForm="showForm = $event" 
                                                    :responsibleA = "responsibleA"
                                                    :relationshipA = "relationshipA"
                                                    @responsibleAA = "responsibleAAction" 
                                                    class="mt-3">
    </responsible1-admissions-form>
    <responsible2-admissions-form v-if="responsible2Added" ref="reponsible2"
                                                    :responsibleB = "responsibleB"
                                                    :relationshipB = "relationshipB"
                                                    @responsibleBB = "responsibleBAction" >
    </responsible2-admissions-form>

    <v-btn type="button" 
            class="blue darken-1 mt-2"  
            @click="addResponsible"
            v-if="showForm"
            dark
            block
        ><i class="fas fa-plus"></i> add another responsible
    </v-btn>
  </div>
</template>

<script>
export default {
  props: ['responsibleA', 'responsibleB', 'relationshipA', 'relationshipB'],

data() {
    return {
      responsible2Added: false,
      showForm: '',
    }
  },
  methods: {
    validateSecondStep() {
        if(this.responsible2Added){
            this.$refs.reponsible1.validateSecondStep()
            return this.$refs.reponsible2.validateSecondStep();
        }
        else{
              console.log(this.responsibleA)
              if(this.$refs.reponsible1.validateSecondStep() == true){
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

          return this.$refs.reponsible1.validateSecondStep()
        }

    },
    addResponsible() {
        if(this.$refs.reponsible1.validateSecondStep() == true){
          this.showForm = false
            this.responsible2Added = true;
        }
    },
    responsibleAAction(data){
      this.$emit('responsibleAA', data); 
      console.log(data)   
    },
    responsibleBAction(data){
      this.$emit('responsibleBB', data); 
      console.log(data)   
    },
    showResponsibleAInfo(){
      this.$refs.reponsible1.showInfo()
    },
    showResponsibleBInfo(){
      this.$refs.reponsible2.showInfo()
    }
  },


}
</script>