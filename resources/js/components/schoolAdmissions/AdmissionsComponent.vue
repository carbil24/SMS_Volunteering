<template>
  <div>
    <form-wizard @on-complete="onComplete" shape="circle" color="#20a0ff" error-color="#ff4949">
      
        <tab-content title="Student Information" icon="fas fa-user-graduate" :before-change="validateFirstStep">
          <student-admissions-form ref="student" :nationalId = "nationalId" 
                                                 :typeOfAdmission = "typeOfAdmission" 
                                                 :schoolStudentCandidate = "schoolStudentCandidate"
                                                 @schoolStudentCandidate = "schoolStudentCandidateAction" />
        </tab-content>

        <!--<tab-content title="Responsibles Information" icon="fas fa-users" :before-change="validateSecondStep">
          <responsible-admissions-section ref="responsibles"/>
        </tab-content>
      
        <tab-content title="Emergency Contact" icon="fas fa-phone" :before-change="validateThirdStep">
            <emergency-admissions-form ref="emergencyContact"/>
        </tab-content>

        <tab-content title="Medical Records" icon="fas fa-heartbeat">
          <medical-admissions-form />
        </tab-content>-->

        <tab-content title="Agreements" icon="fas fa-clipboard-list" :before-change="validateFifthStep">
            <agreement-admissions-form ref="agreements"/>
        </tab-content>
        

      <el-button type="primary" slot="prev" @click.native="scrollToTop"><i class="fas fa-arrow-circle-left"></i> Back</el-button>
      <el-button type="primary" slot="next" @click.native="scrollToTop">Next <i class="fas fa-arrow-circle-right"></i></el-button>
      <el-button type="primary" slot="finish">Finish <i class="fas fa-check-circle"></i></el-button>
    </form-wizard>
  </div>
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
      schoolStudentCandidates: [],
      schoolStudentCandidate: '',
      nationalId: '',
      typeOfAdmission:'',
      editMode: false,
    }
  },
  created(){
    axios.get('api/schoolStudentCandidates').then(res=>{
      this.schoolStudentCandidates = res.data;
    })
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
              axios.put(`api/schoolStudentCandidates/${this.schoolStudentCandidate.id}`, this.schoolStudentCandidate)
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
            axios.post('api/schoolStudentCandidates', this.schoolStudentCandidate);
            Swal.fire({
              icon: 'success',
              title: "Congratulations! your Registration process is done! You'll get feedback in 3 business days.",
              showConfirmButton: false,
              timer: 5000
            }).then(() => {
              window.location.replace("/");
            })
          }


        }
      })
    },
    validateFirstStep() {
      return this.$refs.student.validateFirstStep();
    },
    /*validateSecondStep() {
      return this.$refs.responsibles.validateSecondStep();
    },
    validateThirdStep() {
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
      }
      ).queue([
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

          this.schoolStudentCandidate = this.schoolStudentCandidates.find(el => el.nationalId === this.nationalId && el.typeOfAdmission === this.typeOfAdmission);
          if(!this.schoolStudentCandidate){

            Swal.fire({
              title: 'Candidate verification',
              allowOutsideClick: false,
              showCancelButton: true,
              html: `
                The candidate with Id ${this.nationalId} has never applied for this category.
              `,
              confirmButtonText: 'Fill the form'
            }).then((result) => {
                if(!result.value)
                  window.location.replace("/");
                else{
                  console.log(this.schoolStudentCandidate);
                }
            })
          }
          else{
            Swal.fire({
            title: 'Candidate verification',
            allowOutsideClick: false,
            showCancelButton: true,
            html: `
              The candidate with Id ${this.nationalId} has an application for this category in process.
            `,
            confirmButtonText: 'Update the form'
          }).then((result) => {
              if(!result.value)
                window.location.replace("/");
              else{
                  this.editMode = true;
              }
          })
          }


        }
        else{
          window.location.replace("/");
        }
      })    
    },
    schoolStudentCandidateAction(data){
      this.schoolStudentCandidate = data;
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