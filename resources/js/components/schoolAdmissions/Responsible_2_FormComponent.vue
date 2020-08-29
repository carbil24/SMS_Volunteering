<template>
  <v-card>
    <v-form :inline="true" :model="responsible2" class="demo-form-inline" ref="ruleResponsible2Form3" :disabled="showForm">
        <v-card-title class="blue darken-1">
            <v-row>
                <v-col cols="12">
                    <span class="white--text">Responsible B: {{ responsible2.relationship }} </span>
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
</template>

<script>

//local registration
import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(Element)

export default {
    props: ['responsibleB', 'relationshipB'],
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
        responsibleBB: '',
    }
  },
  methods: {
    validateSecondStep() {
        if(!this.isComplete){
            return this.$refs.ruleResponsible2Form3.validate();
        }
        else{
            this.setData();
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
    setData(){
        this.responsibleBB = this.responsible2;
        this.$emit('responsibleBB', this.responsibleBB);
    },
    showInfo(){
        if(this.responsibleB){
            this.showForm = !this.showForm
            this.responsible2.id = this.responsibleB.id;
            this.responsible2.nationalId = this.responsibleB.nationalId;
            this.responsible2.relationship = this.relationshipB;
            this.responsible2.firstName = this.responsibleB.firstName;
            this.responsible2.lastName = this.responsibleB.lastName;
            this.responsible2.middleName = this.responsibleB.middleName;
            this.responsible2.dateOfBirth = this.responsibleB.dateOfBirth;
            this.responsible2.gender = this.responsibleB.gender;
            this.responsible2.nationality = this.responsibleB.nationality;
            this.responsible2.countryOfBirth = this.responsibleB.countryOfBirth;
            this.responsible2.regionOfBirth = this.responsibleB.regionOfBirth;
            this.responsible2.cityOfBirth = this.responsibleB.cityOfBirth;
            this.responsible2.countryOfResidency = this.responsibleB.countryOfResidency;
            this.responsible2.regionOfResidency = this.responsibleB.regionOfResidency;
            this.responsible2.cityOfResidency = this.responsibleB.cityOfResidency;
            this.responsible2.address = this.responsibleB.address;
            this.responsible2.postalCode = this.responsibleB.postalCode;
            this.responsible2.homePhone = this.responsibleB.homePhone;
            this.responsible2.workPhone = this.responsibleB.workPhone;
            this.responsible2.email = this.responsibleB.email;

            this.validateSecondStep();
        }
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