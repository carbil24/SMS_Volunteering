<template>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Emergency Contact's Info</h3>
            </div>
            <div class="card-body pl-lg-5">
              <el-form :inline="true" :model="emergencyContact" class="demo-form-inline" :rules="rules.emergencyContactRules" ref="ruleEmergencyContactForm">
                  <div class="form-row m-3 pl-lg-5">
                    <el-form-item class="col-12 col-md-3 col-lg-3" prop="firstName">
                        <label>First Name</label>
                        <el-input v-model="emergencyContact.firstName" placeholder="Emergency Contact's first name" ></el-input>
                    </el-form-item>

                    <el-form-item class="col-12 col-md-3 col-lg-3" prop="lastName">
                        <label>Last Name</label>
                        <el-input v-model="emergencyContact.lastName" placeholder="Emergency Contact's last name"></el-input>
                      </el-form-item>


                    <el-form-item class="col-12 col-md-3 col-lg-3" prop="middleName">
                        <label>Middle Name</label>
                        <el-input v-model="emergencyContact.middleName" placeholder="Emergency Contact's middle name"></el-input>
                    </el-form-item>
                 
                  </div>

                 
                  <div class="form-row m-3 pl-lg-5">
                      <el-form-item class="col-12 col-md-3 col-lg-3" prop="homePhone">
                          <label>Home phone</label>
                          <el-input v-model="emergencyContact.homePhone" placeholder="Emergency Contact's home phone" ></el-input>
                      </el-form-item>

                      <el-form-item class="col-12 col-md-3 col-lg-3" prop="workPhone">
                          <label>Work phone</label>
                          <el-input v-model="emergencyContact.workPhone" placeholder="Emergency Contact's work phone"></el-input>
                      </el-form-item>

                      <el-form-item class="col-12 col-md-3 col-lg-3" prop="email">
                          <label>Email</label>
                          <el-input v-model="emergencyContact.email" placeholder="Emergency Contact's email"></el-input>
                      </el-form-item>
                  </div>
              </el-form>
            </div>
        </div>
</template>

<script>

//local registration
import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(Element)

export default {
data() {
    return {
      relationships: [],
      state: '',
      emergencyContact:{  
                      firstName: '', lastName: '', middleName: '', dateOfBirth:'', gender:'', nationality:'', countryOfBirth: '', 
                      regionOfBirth: '', cityOfBirth: '', countryOfResidency: '', regionOfResidency: '', cityOfResidency: '', address: '',
                      zipCode: '', homePhone: '', workPhone: '', email: '',
                    },
      rules: {
        emergencyContactRules:{
          firstName: [{
            required: true,
            message: "Please input Responsible's first name",
            trigger: 'blur'
          }],
          lastName: [{
            required: true,
            message: "Please input Responsible's last name",
            trigger: 'blur'
          }],
          dateOfBirth: [{
            required: true,
            message: 'Please select date',
            trigger: 'change'
          }],
          gender: [{
            required: true,
            message: 'Please select gender',
            trigger: 'change'
          }],
            nationality: [{
            required: true,
            message: 'Please input nationality',
            trigger: 'blur'
          }],
          countryOfBirth: [{
            required: true,
            message: 'Please select country',
            trigger: 'change'
          }],
          regionOfBirth: [{
            required: true,
            message: 'Please select region',
            trigger: 'change'
          }],
          cityOfBirth: [{
            required: true,
            message: 'Please select city',
            trigger: 'change'
          }],
          countryOfResidency: [{
            required: true,
            message: 'Please select country',
            trigger: 'change'
          }],
          regionOfResidency: [{
            required: true,
            message: 'Please select region',
            trigger: 'change'
          }],
          cityOfResidency: [{
            required: true,
            message: 'Please select city',
            trigger: 'change'
          }],
          address: [{
            required: true,
            message: 'Please input the address',
            trigger: 'blur'
          }],
          homePhone: [{
            required: true,
            message: 'Please input the home phone',
            trigger: 'blur'
          }],
          email: [{
            required: true,
            message: 'Please input the email',
            trigger: 'blur'
          }],
        },
      }
    }
  },
  methods: {
    showForm() {
        var value = document.getElementById('txtRelationship').value;
        document.getElementById('emergencyContact').innerHTML = value + "'s Info";
    },
    validateThirdStep() {
        console.log(this.$refs.ruleEmergencyContactForm)
        return new Promise((resolve, reject) => {
            this.$refs.ruleEmergencyContactForm.validate((valid) => {
            resolve(valid);
            });
        })
    },
    querySearch(queryString, cb) {
      var relationships = this.relationships;
      var results = queryString ? relationships.filter(this.createFilter(queryString)) : relationships;
      // call callback function to return suggestions
      cb(results);
        var btnAddRelationship = document.getElementById("btnAddRelationship");
        if (txtRelationship.value.trim() != "") {
            //Enable the TextBox when TextBox has value.
            btnAddRelationship.disabled = false;
        } else {
            //Disable the TextBox when TextBox is empty.
            btnAddRelationship.disabled = true;
        }
    },
    createFilter(queryString) {
      return (relationship) => {
        return (relationship.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
      };
    },
    loadAll() {
      return [
        { "value": "Agency Representative"},
        { "value": "Babysitter"},
        { "value": "Cousin"},
        { "value": "Custodian"},
        { "value": "DLSA - CBE Diversity & Learning Support Advisor"},
        { "value": "Family Friend"},
        { "value": "Father"},
        { "value": "Foster Parent"},
        { "value": "Grandparent"},
        { "value": "Group Home Case Worker"},
        { "value": "Home Stay Parent"},
        { "value": "Interpreter"},
        { "value": "Legal Guardian"},
        { "value": "Mother"},
        { "value": "Outside School Care"},
        { "value": "Parent"},
        { "value": "Partner"},
        { "value": "Physician"},
        { "value": "Probation Officer"},
        { "value": "Psychologist"},
        { "value": "Relative"},
        { "value": "Sibling"},
        { "value": "Social Worker"},
        { "value": "Sponsor"},
        { "value": "Spouse"},
        { "value": "Stepfather"},
        { "value": "Stepmother"},
        { "value": "Stepparent"},
        { "value": "Stepsibling"},
        { "value": "System AP, Global Learning"},
        { "value": "Other"},
        { "value": "Unspecified"},
      ];
    },
    handleSelect(item) {
       
    },
  },
  mounted() {
    this.relationships = this.loadAll();
  }
}
</script>