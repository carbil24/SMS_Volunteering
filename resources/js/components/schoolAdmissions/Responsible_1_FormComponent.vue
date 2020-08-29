<template>
  <v-card>
    <v-form :inline="true" :model="responsible1" class="demo-form-inline" ref="ruleResponsible1Form3" :disabled="showForm">
        <v-card-title class="blue darken-1">
            <v-row>
                <v-col cols="12">
                    <span class="white--text">Responsible A: {{ responsible1.relationship }} </span>
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
                        v-model="responsible1.relationship"
                        :rules="rules.responsible1Rules.relationship"
                        dark
                    ></v-autocomplete>
                </v-col>
                <v-col cols="12" md="4">
                    <v-text-field
                        v-model="responsible1.nationalId"
                        label="National Id"
                        :rules="rules.responsible1Rules.nationalId"
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
                <v-form :inline="true" :model="responsible1" class="demo-form-inline" :rules="rules.responsible1Rules" lazy-validation ref="ruleResponsible1Form" :disabled="!showForm">
                     <v-container>
                        <v-row>
                          <v-col cols="12" md="4">
                              <v-text-field
                                  v-model="responsible1.firstName"
                                  label="First Name"
                                  :rules="rules.responsible1Rules.firstName"
                                  required
                              ></v-text-field>
                          </v-col>

                          <v-col cols="12" md="4">
                              <v-text-field
                                  v-model="responsible1.lastName"
                                  label="Last Name"
                                  :rules="rules.responsible1Rules.lastName"
                                  required
                              ></v-text-field>
                          </v-col>
                          <v-col cols="12" md="4">
                              <v-text-field
                                  v-model="responsible1.middleName"
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
                                      v-model="responsible1.dateOfBirth"
                                      label="Date of Birth"
                                      readonly
                                      v-bind="attrs"
                                      v-on="on"
                                      :rules="rules.responsible1Rules.dateOfBirth"
                                  ></v-text-field>
                                  </template>
                                  <v-date-picker
                                  ref="picker"
                                  v-model="responsible1.dateOfBirth"
                                  :max="new Date().toISOString().substr(0, 10)"
                                  min="1950-01-01"
                                  @change="save"
                                  ></v-date-picker>
                              </v-menu>
                          </v-col>

                          <v-col cols="12" md="4">
                              <v-select
                                  v-model="responsible1.gender"
                                  :items="genderOptions"
                                  label="Gender"
                                  :rules="rules.responsible1Rules.gender"
                                  required
                              ></v-select>
                          </v-col>

                          <v-col cols="12" md="4">
                              <v-text-field
                                  v-model="responsible1.nationality"
                                  label="Nationality"
                                  :rules="rules.responsible1Rules.nationality"
                                  required
                              ></v-text-field>
                          </v-col>
                      </v-row>

                      <el-form :inline="true" :model="responsible1" class="demo-form-inline" :rules="rules.responsible1Rules" ref="ruleResponsible1Form2">
                        <v-row class="pl-3 mt-5">
                            <v-label>Country of Birth:</v-label>
                        </v-row>
                        <v-row>
                                <v-col cols="12" md="4">
                                    <el-form-item prop="countryOfBirth">
                                        <country-select :disabled="!showForm" class="custom-select" v-model="responsible1.countryOfBirth" :country="responsible1.countryOfBirth" topCountry="BI" />
                                    </el-form-item>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <el-form-item prop="regionOfBirth">
                                        <region-select :disabled="!showForm" class="custom-select" v-model="responsible1.regionOfBirth" :country="responsible1.countryOfBirth" :region="responsible1.regionOfBirth" />
                                    </el-form-item>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        class="p-0 m-0"
                                        v-model="responsible1.cityOfBirth"
                                        label="City"
                                        :rules="rules.responsible1Rules.cityOfBirth"
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
                                        <country-select :disabled="!showForm" class="custom-select" v-model="responsible1.countryOfResidency" :country="responsible1.countryOfResidency" topCountry="BI" />
                                    </el-form-item>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <el-form-item prop="regionOfResidency">
                                    <region-select :disabled="!showForm" class="custom-select" v-model="responsible1.regionOfResidency" :country="responsible1.countryOfResidency" :region="responsible1.regionOfResidency" />
                                    </el-form-item>        
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        class="p-0 m-0"
                                        v-model="responsible1.cityOfResidency"
                                        label="City"
                                        :rules="rules.responsible1Rules.cityOfResidency"
                                        required
                                    ></v-text-field>
                                </v-col>
                        </v-row>
                      </el-form>

                        <v-row>
                            <v-col cols="12" md="8">
                                <v-text-field
                                    class="p-0 m-0"
                                    v-model="responsible1.address"
                                    label="Address"
                                    :rules="rules.responsible1Rules.address"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    class="p-0 m-0"
                                    v-model="responsible1.postalCode"
                                    label="Postal Code"
                                    :rules="rules.responsible1Rules.postalCode"
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
                                      v-model="responsible1.homePhone"
                                      label="Home Phone"
                                      :rules="rules.responsible1Rules.homePhone"
                                      required
                                  ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    class="p-0 m-0"
                                    v-model="responsible1.workPhone"
                                    label="Work Phone"
                                    :rules="rules.responsible1Rules.workPhone"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    class="p-0 m-0"
                                    v-model="responsible1.email"
                                    label="Email"
                                    :rules="rules.responsible1Rules.email"
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
    props: ['responsibleA', 'relationshipA'],
  data() {
    return {
      showForm: null,
      date: null,
      menu: false,
      relationships: [],
      state: '',
      responsible1:{  
                      firstName: '', lastName: '', middleName: '', dateOfBirth:'', gender:'', nationality:'', countryOfBirth: '', 
                      regionOfBirth: '', cityOfBirth: '', countryOfResidency: '', regionOfResidency: '', cityOfResidency: '', address: '',
                      postalCode: '', homePhone: '', workPhone: '', email: '', relationship:'', nationalId: '',
                    },
      rules: {
        responsible1Rules:{
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
        responsibleAA: '',
    }
  },
  methods: {
    validateSecondStep() {
        if(!this.isComplete){
            return this.$refs.ruleResponsible1Form3.validate();
        }
        else{
            this.setData();
            this.$refs.ruleResponsible1Form.validate()
            if(!this.responsible1.countryOfBirth || !this.responsible1.regionOfBirth ||
                !this.responsible1.countryOfResidency || !this.responsible1.regionOfResidency){
                return new Promise((resolve, reject) => {
                    this.$refs.ruleResponsible1Form2.validate((valid) => {
                        resolve(valid);
                    });
                })
            }
            else{
                this.$refs.ruleResponsible1Form2.validate();
                return this.$refs.ruleResponsible1Form.validate();
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
        this.$refs.ruleResponsible1Form.reset();
        this.responsible1.countryOfBirth = '';
        this.responsible1.regionOfBirth = '';
        this.responsible1.countryOfResidency = '';
        this.responsible1.regionOfResidency = '';
        if(!this.showForm){
          this.responsible1.relationship = '';
          this.responsible1.nationalId = '';
        }
        this.$emit('clickShowForm', this.showForm);
      },
    setData(){
        this.responsibleAA = this.responsible1;
        this.$emit('responsibleAA', this.responsibleAA);
    },
    showInfo(){
        if(this.responsibleA){
            this.showForm = !this.showForm
            this.responsible1.id = this.responsibleA.id;
            this.responsible1.nationalId = this.responsibleA.nationalId;
            this.responsible1.relationship = this.relationshipA;
            this.responsible1.firstName = this.responsibleA.firstName;
            this.responsible1.lastName = this.responsibleA.lastName;
            this.responsible1.middleName = this.responsibleA.middleName;
            this.responsible1.dateOfBirth = this.responsibleA.dateOfBirth;
            this.responsible1.gender = this.responsibleA.gender;
            this.responsible1.nationality = this.responsibleA.nationality;
            this.responsible1.countryOfBirth = this.responsibleA.countryOfBirth;
            this.responsible1.regionOfBirth = this.responsibleA.regionOfBirth;
            this.responsible1.cityOfBirth = this.responsibleA.cityOfBirth;
            this.responsible1.countryOfResidency = this.responsibleA.countryOfResidency;
            this.responsible1.regionOfResidency = this.responsibleA.regionOfResidency;
            this.responsible1.cityOfResidency = this.responsibleA.cityOfResidency;
            this.responsible1.address = this.responsibleA.address;
            this.responsible1.postalCode = this.responsibleA.postalCode;
            this.responsible1.homePhone = this.responsibleA.homePhone;
            this.responsible1.workPhone = this.responsibleA.workPhone;
            this.responsible1.email = this.responsibleA.email;

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
        return this.responsible1.relationship && this.responsible1.nationalId;
    }
 }   
}
</script>