<template>
    <form-wizard @on-complete="onComplete" shape="circle" color="#20a0ff" error-color="#ff4949">
      
        <tab-content title="Student Information" icon="fas fa-user-graduate" :before-change="validateFirstStep">
          <student-admissions-form ref="student" :nationalId = "nationalId" 
                                                 :typeOfAdmission = "typeOfAdmission" 
                                                 :schoolCandidate = "schoolCandidate"
                                                 @schoolCandidate = "schoolCandidateAction" />
        </tab-content>


        <tab-content title="Responsibles Information" icon="fas fa-users" :before-change="validateSecondStep">
          <responsible-admissions-section ref="responsibles" :responsibleA = "responsibleA"
                                                             @responsibleA = "responsibleAAction"/>
        </tab-content>


        <!--
        <tab-content title="Emergency Contact" icon="fas fa-phone" :before-change="validateThirdStep">
            <emergency-admissions-form ref="emergencyContact"/>
        </tab-content>

        <tab-content title="Medical Records" icon="fas fa-heartbeat">
          <medical-admissions-form />
        </tab-content>-->

        <tab-content title="Agreements" icon="fas fa-clipboard-list" :before-change="validateFifthStep">
            <agreement-admissions-form ref="agreements"/>
        </tab-content>
        

      <v-btn type="primary" slot="prev" @click.native="scrollToTop"><i class="fas fa-arrow-circle-left "></i> Back</v-btn>
      <v-btn type="primary" slot="next" @click.native="scrollToTop">Next <i class="fas fa-arrow-circle-right "></i></v-btn>
      <v-btn type="primary" slot="finish">Finish <i class="fas fa-check-circle"></i></v-btn>
    </form-wizard>
</template>

<script>



import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'
// configure language
locale.use(lang)

import {FormWizard, TabContent} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
//component code
components: {
  FormWizard,
  TabContent
} 

export default {
  data() {
    return {
      schoolCandidates: [],
      schoolCandidate: '',
      responsibles: [],
      responsibleA: '',
      responsibleB: '',
      students_responsibles: [],
      nationalId: '',
      typeOfAdmission:'',
      editMode: false,
    }
  },
  created(){
    axios.get('api/schoolCandidates').then(res=>{
      this.schoolCandidates = res.data;
    });
    axios.get('api/responsibles').then(res=>{
      this.responsibles = res.data;
    });
  },
  methods: {
    onComplete: function() {
      Swal.fire({
        title: `Please confirm the submition`,
        text: "Are you sure all the information provided is correct and the form is ready to be submitted?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, submit the form',
        cancelButtonText: 'No, I will verify again'
      }).then((result) => {
        if (result.value) {
          if(this.editMode){
              axios.put(`api/schoolCandidates/${this.schoolCandidate.id}`, this.schoolCandidate)
              Swal.fire({
              icon: 'success',
              title: "Your application was updated successfully!",
              showConfirmButton: false,
              timer: 4000
            }).then(() => {
              window.location.replace("/");
            })
          }
          else{
            axios.post('api/schoolCandidates', this.schoolCandidate)
            .then((res) =>{
              this.schoolCandidate = res.data;
            });
            axios.post('api/responsibles', this.responsibleA)
              .then((res) =>{
                this.responsibleA = res.data;
            });
            axios.post(`api/schoolCandidates/1/responsibles`, this.responsibleA)
              
            
            Swal.fire({
              icon: 'success',
              title: "Congratulations! your Registration process is done! You'll get feedback in 3 business days.",
              showConfirmButton: false,
              //timer: 5000
            }).then(() => {
              //window.location.replace("/");
            })
          }


        }
      })
    },
    validateFirstStep() {
      return this.$refs.student.validateFirstStep();
    },
    validateSecondStep() {
      return this.$refs.responsibles.validateSecondStep();
    },
    /*validateThirdStep() {
      return this.$refs.emergencyContact.validateThirdStep();
    },*/
    validateFifthStep() {
      return this.$refs.agreements.validateFifthStep();
    },
    showModal() {
      Swal.mixin({
        allowOutsideClick: false,
        confirmButtonText: 'Next &rarr;',
        showCancelButton: true,
        progressSteps: ['1', '2'],
        inputValidator: (value) => {
          return !value && 'Please give a value'
        },
      }).queue([
        {
          title: "Please enter the candidate's national Id",
          input: 'text',
        },   
        {
          title: 'Which type of institution you want to apply for?',
          input: 'select',
          inputPlaceholder: '-Select an option-',
          inputOptions: {
              'Elementary: Daycare Service': 'Elementary: Daycare Service',
              'Elementary: Preschool': 'Elementary: Preschool', 
              'Primary school': 'Primary school',
              'Secondary School': 'Secondary School',
              'K-12 school': 'K-12 school', 
              'College: Junior': 'College: Junior',
              'College: Senior': 'College: Senior',
              'University': 'University', 
              'Career Academy': 'Career Academy',
              'Coaching': 'Coaching',
              'International University Pathway': 'International University Pathway', 
              'Distance Education': 'Distance Education',
              'Online/Offline education': 'Online/Offline education',
              'Daily Quiz Hunting': 'Daily Quiz Hunting',
            },
            inputValidator: (value) => {
              return !value && 'You need to select an option'
            },          
        },  
      ]).then((result) => {
        if (result.value) {
          this.nationalId = result.value[0];
          this.typeOfAdmission = result.value[1];

          this.schoolCandidate = this.schoolCandidates.find(el => el.nationalId === this.nationalId && 
                                                                                el.typeOfAdmission === this.typeOfAdmission);


          let timerInterval;
          Swal.fire({
            allowOutsideClick: false,
            title: 'Candidate Verification',
            html: 'We are searching in the data base.',
            timer: 1500,
            timerProgressBar: true,
            onBeforeOpen: () => {
              Swal.showLoading()
              timerInterval = setInterval(() => {
                const content = Swal.getContent()
                if (content) {
                  const b = content.querySelector('b')
                  if (b) {
                    b.textContent = Swal.getTimerLeft()
                  }
                }
              }, 100)
            },
          }).then((result) => {
            this.$refs.student.showInfo();
            if(!this.schoolCandidate){
              Swal.fire({
                title: 'Candidate Verification',
                allowOutsideClick: false,
                showCancelButton: true,
                html: `The candidate with Id ${this.nationalId} has never applied for this category.`,
                confirmButtonText: 'Fill an application'
              }).then((result) => {
                  if(!result.value)
                    window.location.replace("/");
                  else{
                    //console.log(this.schoolCandidate);
                  }
              })
            }
            else{
              axios.get(`api/schoolCandidates/${this.schoolCandidate.id}/responsibles`).then(res=>{
                this.students_responsibles = res.data;
                //console.log(this.students_responsibles);
              });

              Swal.fire({
                title: 'Candidate Verification',
                allowOutsideClick: false,
                showCancelButton: true,
                html: `The candidate with Id ${this.nationalId} has an application for this category in process.`,
                confirmButtonText: 'Next &rarr;'
              }).then((result) => {
                if(!result.value)
                  window.location.replace("/");
                else{
                  Swal.fire({
                    title: 'Please select an option to continue',
                    input: 'radio',
                    inputOptions: {
                      'update': 'Update application',
                      'withdrwaw': 'Withdraw application'
                    },
                    confirmButtonText: 'Next &rarr;',
                    showCancelButton: true,
                    inputValidator: (value) => {
                      return !value && 'You need to select an option'
                    },
                  }).then((result) => {
                    if(!result.value)
                      window.location.replace("/");
                    else{
                      if(result.value == 'update'){
                        this.editMode = true;
                      }
                      else{
                        Swal.fire({
                          allowOutsideClick: false,
                          title: `Withdraw the application for ${this.schoolCandidate.firstName + ' ' + this.schoolCandidate.lastName}?`,
                          text: "You won't be able to revert this!",
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Yes, withdraw the application'
                        }).then((result) => {
                          if (result.value) {
                              axios.delete(`api/schoolCandidates/${this.schoolCandidate.id}`)
                              Swal.fire({
                              icon: 'success',
                              title: 'Application withdrawn successfully',
                              showConfirmButton: false,
                              timer: 2200
                            }).then(() => {
                              window.location.replace("/");
                            })
                          }
                          else{
                            window.location.replace("/");
                          }
                        })
                      }
                    }
                  })
                }
              })
            }
          })  
        }
        else{
          window.location.replace("/");
        }
      })    
    },
    schoolCandidateAction(data){
      this.schoolCandidate = data;
    },
    responsibleAAction(data){
      this.responsibleA = data;
    },
    scrollToTop() {
      window.scrollTo(0,0);
    }
  },
  mounted() {
    this.showModal();
  }
}

</script>