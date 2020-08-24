<template>
  <v-card>
    <v-form :inline="true" :model="responsible2" class="demo-form-inline" ref="ruleResponsible2Form3" :disabled="showForm">
        <v-card-title class="blue darken-1">
            <v-row>
                <v-col cols="12">
                    <span class="white--text">Responsible A: {{ responsible2.relationship }} </span>
                </v-col>               
            </v-row>
            <v-row>
                <v-col cols="12" md="6">
                    <v-autocomplete
                        :items="relationshipOptions"
                        :filter="customFilter"
                        color="white"
                        item-text="value"
                        label="Relationship"
                        v-model="responsible2.relationship"
                        :rules="rules.responsible2Rules.relationship"
                        dark
                    ></v-autocomplete>
                </v-col>
                <v-col cols="12" md="4">
                    <v-text-field
                        v-model="responsible2.nationalId"
                        label="National Id"
                        :rules="rules.responsible2Rules.nationalId"
                        dark
                        required
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="2">
                    <v-row class="justify-center">
                        <v-btn
                            color="blue lighten-1"
                            fab
                            small
                            dark
                            @click="reset"
                            :disabled='!isComplete'
                            ref='button'
                        >
                            <v-icon v-if="showForm" color="red darken-1">mdi-trash-can-outline</v-icon>
                            <v-icon v-else>mdi-pencil</v-icon>
                        </v-btn>
                    </v-row>
                </v-col>
            </v-row>
        </v-card-title>
    </v-form>
            <v-card-text :class="!showForm ? 'collapse' : 'show'">
                <v-form :inline="true" :model="responsible2" class="demo-form-inline" :rules="rules.responsible2Rules" lazy-validation ref="ruleResponsible2Form" :disabled="!showForm">
                     <v-container>
                        <v-row>
                          <v-col cols="12" md="4">
                              <v-text-field
                                  v-model="responsible2.firstName"
                                  label="First Name"
                                  :rules="rules.responsible2Rules.firstName"
                                  required
                              ></v-text-field>
                          </v-col>

                          <v-col cols="12" md="4">
                              <v-text-field
                                  v-model="responsible2.lastName"
                                  label="Last Name"
                                  :rules="rules.responsible2Rules.lastName"
                                  required
                              ></v-text-field>
                          </v-col>
                          <v-col cols="12" md="4">
                              <v-text-field
                                  v-model="responsible2.middleName"
                                  label="Middle Name"
                                  required
                              ></v-text-field>
                          </v-col>
                      </v-row>
                      <v-row>
                          <v-col cols="12" md="4">
                              <v-menu
                                  ref="menu"
                                  v-model="menu"
                                  :close-on-content-click="false"
                                  transition="scale-transition"
                                  offset-y
                                  min-width="290px"
                              >
                                  <template v-slot:activator="{ on, attrs }">
                                  <v-text-field
                                      v-model="responsible2.dateOfBirth"
                                      label="Date of Birth"
                                      readonly
                                      v-bind="attrs"
                                      v-on="on"
                                      :rules="rules.responsible2Rules.dateOfBirth"
                                  ></v-text-field>
                                  </template>
                                  <v-date-picker
                                  ref="picker"
                                  v-model="responsible2.dateOfBirth"
                                  :max="new Date().toISOString().substr(0, 10)"
                                  min="1950-01-01"
                                  @change="save"
                                  ></v-date-picker>
                              </v-menu>
                          </v-col>

                          <v-col cols="12" md="4">
                              <v-select
                                  v-model="responsible2.gender"
                                  :items="genderOptions"
                                  label="Gender"
                                  :rules="rules.responsible2Rules.gender"
                                  required
                              ></v-select>
                          </v-col>

                          <v-col cols="12" md="4">
                              <v-text-field
                                  v-model="responsible2.nationality"
                                  label="Nationality"
                                  :rules="rules.responsible2Rules.nationality"
                                  required
                              ></v-text-field>
                          </v-col>
                      </v-row>

                      <el-form :inline="true" :model="responsible2" class="demo-form-inline" :rules="rules.responsible2Rules" ref="ruleResponsible2Form2">
                        <v-row class="pl-3 mt-5">
                            <v-label>Country of Birth:</v-label>
                        </v-row>
                        <v-row>
                                <v-col cols="12" md="4">
                                    <el-form-item prop="countryOfBirth">
                                        <country-select :disabled="!showForm" class="custom-select" v-model="responsible2.countryOfBirth" :country="responsible2.countryOfBirth" topCountry="BI" />
                                    </el-form-item>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <el-form-item prop="regionOfBirth">
                                        <region-select :disabled="!showForm" class="custom-select" v-model="responsible2.regionOfBirth" :country="responsible2.countryOfBirth" :region="responsible2.regionOfBirth" />
                                    </el-form-item>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        class="p-0 m-0"
                                        v-model="responsible2.cityOfBirth"
                                        label="City"
                                        :rules="rules.responsible2Rules.cityOfBirth"
                                        required
                                    ></v-text-field>
                                </v-col>
                        </v-row>

                        <v-row class="pl-3 mt-5">
                            <v-label>Country of Residency:</v-label>
                        </v-row>
                        <v-row>
                                <v-col cols="12" md="4">
                                    <el-form-item prop="countryOfResidency">
                                        <country-select :disabled="!showForm" class="custom-select" v-model="responsible2.countryOfResidency" :country="responsible2.countryOfResidency" topCountry="BI" />
                                    </el-form-item>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <el-form-item prop="regionOfResidency">
                                    <region-select :disabled="!showForm" class="custom-select" v-model="responsible2.regionOfResidency" :country="responsible2.countryOfResidency" :region="responsible2.regionOfResidency" />
                                    </el-form-item>        
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        class="p-0 m-0"
                                        v-model="responsible2.cityOfResidency"
                                        label="City"
                                        :rules="rules.responsible2Rules.cityOfResidency"
                                        required
                                    ></v-text-field>
                                </v-col>
                        </v-row>
                      </el-form>

                        <v-row>
                            <v-col cols="12" md="8">
                                <v-text-field
                                    class="p-0 m-0"
                                    v-model="responsible2.address"
                                    label="Address"
                                    :rules="rules.responsible2Rules.address"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    class="p-0 m-0"
                                    v-model="responsible2.postalCode"
                                    label="Postal Code"
                                    :rules="rules.responsible2Rules.postalCode"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-row class="pl-3 mt-5">
                            <v-label>Contact Information:</v-label>
                        </v-row>

                        <v-row>
                            <v-col cols="12" md="4">
                                  <v-text-field
                                      class="p-0 m-0"
                                      v-model="responsible2.homePhone"
                                      label="Home Phone"
                                      :rules="rules.responsible2Rules.homePhone"
                                      required
                                  ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    class="p-0 m-0"
                                    v-model="responsible2.workPhone"
                                    label="Work Phone"
                                    :rules="rules.responsible2Rules.workPhone"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    class="p-0 m-0"
                                    v-model="responsible2.email"
                                    label="Email"
                                    :rules="rules.responsible2Rules.email"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>  
                </v-form>
            </v-card-text>
        </v-card>

    <!--<el-form :inline="true" :model="responsible2" class="demo-form-inline" :rules="rules.responsible2Rules" ref="ruleResponsible2Form">

        <div class="card card-primary">
            <div class="card-header">
                <div class="form-row mb-2 pl-lg-5">
                  <h3 class="card-title" id="responsible2">Responsible A: {{ responsible2.relationship }} </h3>
                </div>
                <div class="form-row pl-lg-5">
                  <el-form-item class="col-12 col-md-3 col-lg-3" prop="relationship">
                    <label class="mr-3">Relationship with student </label>
                    <el-autocomplete
                        class="inline-input"
                        v-model="responsible2.relationship"
                        :fetch-suggestions="querySearch"
                        placeholder="Relationship with the student"
                        id="txtRelationship1"
                        @select="handleSelect"
                    ></el-autocomplete>
                  </el-form-item>

                  <el-form-item class="col-12 col-md-3 col-lg-3" prop="nationalId">
                      <label>National Id</label>
                      <el-input v-model="responsible2.nationalId" placeholder="Responsible's national Id"></el-input>
                  </el-form-item>
              </div>
                <div class="card-tools">
                  <button type="button" class="btn btn-light" id="btnAddRelationship" data-target="#demo" data-toggle="collapse" title="Collapse">
                  Add info</button>
                </div>
            </div>
            <div id="demo" class="card-body collapse pl-lg-5">
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
      </el-form>-->
</template>

<script>

//local registration
import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(Element)

export default {
  data() {
    return {
      showForm: null,
      date: null,
      menu: false,
      relationships: [],
      state: '',
      responsible2:{  
                      firstName: '', lastName: '', middleName: '', dateOfBirth:'', gender:'', nationality:'', countryOfBirth: '', 
                      regionOfBirth: '', cityOfBirth: '', countryOfResidency: '', regionOfResidency: '', cityOfResidency: '', address: '',
                      postalCode: '', homePhone: '', workPhone: '', email: '', relationship:'', nationalId: '',
                    },
      rules: {
        responsible2Rules:{
          firstName:[v => !!v || "Please input Student's First name"],
          lastName: [v => !!v || "Please input Student's Last name"],
          dateOfBirth: [v => !!v || "Please input Student's Birthday"],
          gender: [v => !!v || "Please select Gender"],
          nationality: [v => !!v || "Please input Student's Nationality"],
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
          cityOfBirth: [v => !!v || "Please input the city"],
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
          cityOfResidency: [v => !!v || "Please input the city"],
          address: [v => !!v || "Please input the address"],
          homePhone: [v => !!v || "Please input the home phone number"],
          email: [v => !!v || "Please input the email"],
          relationship: [v => !!v || "Please input the relationship"],
          nationalId: [v => !!v || "Please input the national Id"],
        },
      },
      genderOptions: [
        'Male',
        'Female',
        'Other', 
        'Prefer not to say',
      ],
      relationshipOptions: [
        { value: "Agency Representative"},
        { value: "Babysitter"},
        { value: "Cousin"},
        { value: "Custodian"},
        { value: "DLSA - CBE Diversity & Learning Support Advisor"},
        { value: "Family Friend"},
        { value: "Father"},
        { value: "Foster Parent"},
        { value: "Grandparent"},
        { value: "Group Home Case Worker"},
        { value: "Home Stay Parent"},
        { value: "Interpreter"},
        { value: "Legal Guardian"},
        { value: "Mother"},
        { value: "Outside School Care"},
        { value: "Parent"},
        { value: "Partner"},
        { value: "Physician"},
        { value: "Probation Officer"},
        { value: "Psychologist"},
        { value: "Relative"},
        { value: "Sibling"},
        { value: "Social Worker"},
        { value: "Sponsor"},
        { value: "Spouse"},
        { value: "Stepfather"},
        { value: "Stepmother"},
        { value: "Stepparent"},
        { value: "Stepsibling"},
        { value: "System AP, Global Learning"},
        { value: "Other"},
        { value: "Unspecified"},
      ],
    }
  },
  methods: {
    validateSecondStep() {
        if(!this.isComplete){
            return this.$refs.ruleResponsible2Form3.validate();
        }
        else{
            //this.setData();
            this.$refs.ruleResponsible2Form.validate()
            if(!this.responsible2.countryOfBirth || !this.responsible2.regionOfBirth ||
                !this.responsible2.countryOfResidency || !this.responsible2.regionOfResidency){
                return new Promise((resolve, reject) => {
                    this.$refs.ruleResponsible2Form2.validate((valid) => {
                        resolve(valid);
                    });
                })
            }
            else{
                this.$refs.ruleResponsible2Form2.validate();
                return this.$refs.ruleResponsible2Form.validate();
            }
        }
        
    },
    save (date) {
        this.$refs.menu.save(date)
    },
    customFilter (item, queryText, itemText) {
      const textOne = item.value.toLowerCase()
      const searchText = queryText.toLowerCase()

      return textOne.indexOf(searchText) > -1
    },
      reset () {
        this.showForm = !this.showForm
        this.$refs.ruleResponsible2Form.reset();
        this.responsible2.countryOfBirth = '';
        this.responsible2.regionOfBirth = '';
        this.responsible2.countryOfResidency = '';
        this.responsible2.regionOfResidency = '';
        if(!this.showForm){
          this.responsible2.relationship = '';
          this.responsible2.nationalId = '';
        }
        this.$emit('clickShowForm', this.showForm);
      },
  },
  watch: {
      menu (val) {
          val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
      },
  },
  computed: {
    isComplete () {
        return this.responsible2.relationship && this.responsible2.nationalId;
    }
 }   
}
</script>