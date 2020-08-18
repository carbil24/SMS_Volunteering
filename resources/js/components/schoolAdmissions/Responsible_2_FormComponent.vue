<template>
    <el-form :inline="true" :model="responsible2" class="demo-form-inline" :rules="rules.responsible2Rules" ref="ruleResponsible2Form">

          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title" id="responsible">Responsible B</h3>

              <div class="card-tools">
              <el-form-item prop="relationship">
                <label class="mr-3">Relationship with the student </label>
                  <el-autocomplete
                    class="inline-input"
                    v-model="responsible2.relationship"
                    :fetch-suggestions="querySearch"
                    placeholder="Please Input"
                    id="txtRelationship"
                    @select="handleSelect"
                  ></el-autocomplete>
                  <button type="button" class="btn btn-tool" id="btnAddRelationship" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </el-form-item>
              </div>
            </div>
            <div class="card-body show">
              
                  <div class="form-row m-3 pl-lg-5">
                    <el-form-item class="col-12 col-md-3 col-lg-3" prop="firstName">
                        <label>First Name</label>
                        <el-input v-model="responsible2.firstName" placeholder="Responsible's first name" ></el-input>
                    </el-form-item>

                    <el-form-item class="col-12 col-md-3 col-lg-3" prop="lastName">
                        <label>Last Name</label>
                        <el-input v-model="responsible2.lastName" placeholder="Responsible's last name"></el-input>
                      </el-form-item>


                    <el-form-item class="col-12 col-md-3 col-lg-3" prop="middleName">
                        <label>Middle Name</label>
                        <el-input v-model="responsible2.middleName" placeholder="Responsible's middle name"></el-input>
                    </el-form-item>
                 
                  </div>

                  <div class="form-row m-3 pl-lg-5">
                    
                      <el-form-item class="col-6 col-md-5 col-lg-3" prop="dateOfBirth">
                          <label>Date of birth</label>
                          <el-date-picker
                            v-model="responsible2.dateOfBirth"
                            type="date"
                            placeholder="Pick a date"
                            default-value="2010-10-01">
                          </el-date-picker>
                      </el-form-item>

                      
                    <el-form-item class="col-6 col-md-3 col-lg-3" prop="gender">
                        <label>Gender</label>
                        <el-select v-model="responsible2.gender">
                          <el-option label="Male" value="Male"></el-option>
                          <el-option label="Female" value="Female"></el-option>
                          <el-option label="Other" value="Other"></el-option>
                          <el-option label="Prefer not to say" value="Prefer not to say"></el-option>
                        </el-select>
                      </el-form-item>

                      <el-form-item class="col-12 col-md-3 col-lg-3" prop="nationality">
                        <label>Nationality</label>
                        <el-input v-model="responsible2.nationality" placeholder="Responsible's nationality" ></el-input>
                    </el-form-item>

                  </div>

                  
                  <div class="form-row mt-3 ml-3 pl-lg-5">
                      <label>Place of birth</label>
                  </div>
                  <div class="form-row mx-3 mb-3 pl-lg-5">
                      <el-form-item class="col-12 col-md-4 col-lg-3">
                          <el-form-item prop="countryOfBirth">
                            <country-select class="custom-select" v-model="responsible2.countryOfBirth" :country="responsible2.countryOfBirth" topCountry="BI" />
                          </el-form-item>
                      </el-form-item>

                      <el-form-item class="col-12 col-md-4 col-lg-3">
                          <el-form-item prop="regionOfBirth">
                            <region-select class="custom-select" v-model="responsible2.regionOfBirth" :country="responsible2.countryOfBirth" :region="responsible2.regionOfBirth" />
                          </el-form-item>
                      </el-form-item>

                      <el-form-item class="col-12 col-md-4 col-lg-2">
                          <el-form-item prop="cityOfBirth">
                            <el-input v-model="responsible2.cityOfBirth" placeholder="City"></el-input>
                          </el-form-item>
                      </el-form-item>
                  </div>

                            
                  <div class="form-row mt-3 ml-3 pl-lg-5">
                      <label>Place of residency</label>
                  </div>
                  <div class="form-row mx-3 pl-lg-5">
                      <el-form-item class="col-12 col-md-4 col-lg-3">
                          <el-form-item prop="countryOfResidency">
                            <country-select class="custom-select" v-model="responsible2.countryOfResidency" :country="responsible2.countryOfResidency" topCountry="BI" />
                          </el-form-item>
                      </el-form-item>

                      <el-form-item class="col-12 col-md-4 col-lg-3">
                          <el-form-item prop="regionOfResidency">
                            <region-select class="custom-select" v-model="responsible2.regionOfResidency" :country="responsible2.countryOfResidency" :region="responsible2.regionOfResidency" />
                          </el-form-item>
                      </el-form-item>

                      <el-form-item class="col-12 col-md-4 col-lg-2">
                          <el-form-item prop="cityOfResidency">
                            <el-input v-model="responsible2.cityOfResidency" placeholder="City"></el-input>
                          </el-form-item>
                      </el-form-item>
                  </div>

                  <div class="form-row ml-3 pl-lg-5">
                    <el-form-item class="col-12 col-md-4 col-lg-3" prop="address">
                      <el-input v-model="responsible2.address" placeholder="Address"></el-input>
                    </el-form-item>
                    <el-form-item class="col-12 col-md-4 col-lg-3" prop="postalCode">
                      <el-input v-model="responsible2.postalCode" placeholder="Postal Code" ></el-input>
                    </el-form-item>
                  </div>
                
                  <div class="form-row m-3 pl-lg-5">
                      <el-form-item class="col-12 col-md-3 col-lg-3" prop="homePhone">
                          <label>Home phone</label>
                          <el-input v-model="responsible2.homePhone" placeholder="Responsible's home phone" ></el-input>
                      </el-form-item>

                      <el-form-item class="col-12 col-md-3 col-lg-3" prop="workPhone">
                          <label>Work phone</label>
                          <el-input v-model="responsible2.workPhone" placeholder="Responsible's work phone"></el-input>
                      </el-form-item>

                      <el-form-item class="col-12 col-md-3 col-lg-3" prop="email">
                          <label>Email</label>
                          <el-input v-model="responsible2.email" placeholder="Responsible's email"></el-input>
                      </el-form-item>
                  </div>
              
            </div>
          </div>
    </el-form>

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
      responsible2:{  
                      firstName: '', lastName: '', middleName: '', dateOfBirth:'', gender:'', nationality:'', countryOfBirth: '', 
                      regionOfBirth: '', cityOfBirth: '', countryOfResidency: '', regionOfResidency: '', cityOfResidency: '', address: '',
                      zipCode: '', homePhone: '', workPhone: '', email: '', relationship:''
                    },
      rules: {
        responsible2Rules:{
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
          relationship: [{
            required: true,
            message: 'Please input the relationship',
            trigger: 'blur'
          }],
        },
      }
    }
  },
  methods: {
    validateSecondStep() {
        return new Promise((resolve, reject) => {
          this.$refs.ruleResponsible2Form.validate((valid) => {
            resolve(valid);
            if(valid){
              Swal.fire({
                title: 'Please note that an emergency contact is a person to ask for or contact if we are unable to reach parents or the guardian.',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
              })
            }
          });
        })
    },
    querySearch(queryString, cb) {
      var relationships = this.relationships;
      var results = queryString ? relationships.filter(this.createFilter(queryString)) : relationships;
      // call callback function to return suggestions
      cb(results);
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