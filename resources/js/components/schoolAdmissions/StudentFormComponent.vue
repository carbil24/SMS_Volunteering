<template>
    <v-card>
        <v-card-title class="blue darken-1">
                <span class="headline white--text">General Info</span>
                <div class="d-none">{{ schoolCandidate }}</div>
        </v-card-title>
            <v-card-text>
                <v-form :inline="true" :model="student" class="demo-form-inline" :rules="rules.studentRules" lazy-validation ref="ruleStudentForm">
                     <v-container>
                        <v-row>
                            <v-col cols="12" md="8" lg="8">
                                <v-row>
                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="student.firstName"
                                            label="First Name"
                                            :rules="rules.studentRules.firstName"
                                            required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="student.lastName"
                                            label="Last Name"
                                            :rules="rules.studentRules.lastName"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="student.middleName"
                                            label="Middle Name"
                                            required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-select
                                            v-model="student.gender"
                                            :items="genderOptions"
                                            label="Gender"
                                            :rules="rules.studentRules.gender"
                                            required
                                        ></v-select>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12" md="6">
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
                                                v-model="student.dateOfBirth"
                                                label="Date of Birth"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                                :rules="rules.studentRules.dateOfBirth"
                                            ></v-text-field>
                                            </template>
                                            <v-date-picker
                                            ref="picker"
                                            v-model="student.dateOfBirth"
                                            :max="new Date().toISOString().substr(0, 10)"
                                            min="1950-01-01"
                                            @change="save"
                                            ></v-date-picker>
                                        </v-menu>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="student.nationality"
                                            label="Nationality"
                                            :rules="rules.studentRules.nationality"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-col>
                            <v-col cols="12" md="4" lg="4">
                                <v-col cols="12" xs="8" class="text-xs-center text-sm-center text-md-center text-lg-center">
                                <v-text-field label="Select Image" @click='pickFile' v-model='student.picture' prepend-icon='mdi-camera-plus'></v-text-field>
                                <input
                                    type="file"
                                    style="display: none"
                                    ref="image"
                                    accept="image/*"
                                    @change="onFilePicked"
                                >
                                <img :src="imageUrl" height="200" v-if="imageUrl"/>
                                </v-col>    
                            </v-col>
                        </v-row>

                        <el-form :inline="true" :model="student" class="demo-form-inline" :rules="rules.studentRules" ref="ruleStudentForm2">
                        <v-row class="pl-3 mt-5">
                            <v-label>Country of Birth:</v-label>
                        </v-row>
                        <v-row>
                                <v-col cols="12" md="4">
                                    <el-form-item prop="countryOfBirth">
                                        <country-select class="custom-select" v-model="student.countryOfBirth" :country="student.countryOfBirth" topCountry="BI" />
                                    </el-form-item>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <el-form-item prop="regionOfBirth">
                                        <region-select class="custom-select" v-model="student.regionOfBirth" :country="student.countryOfBirth" :region="student.regionOfBirth" />
                                    </el-form-item>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        class="p-0 m-0"
                                        v-model="student.cityOfBirth"
                                        label="City"
                                        :rules="rules.studentRules.cityOfBirth"
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
                                        <country-select class="custom-select" v-model="student.countryOfResidency" :country="student.countryOfResidency" topCountry="BI" />
                                    </el-form-item>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <el-form-item prop="regionOfResidency">
                                    <region-select class="custom-select" v-model="student.regionOfResidency" :country="student.countryOfResidency" :region="student.regionOfResidency" />
                                    </el-form-item>        
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        class="p-0 m-0"
                                        v-model="student.cityOfResidency"
                                        label="City"
                                        :rules="rules.studentRules.cityOfResidency"
                                        required
                                    ></v-text-field>
                                </v-col>
                        </v-row>
                        </el-form>

                        <v-row>
                            <v-col cols="12" md="8">
                                <v-text-field
                                    class="p-0 m-0"
                                    v-model="student.address"
                                    label="Address"
                                    :rules="rules.studentRules.address"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    class="p-0 m-0"
                                    v-model="student.postalCode"
                                    label="Postal Code"
                                    :rules="rules.studentRules.postalCode"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-row class="pl-3 mt-5">
                            <v-label>Family Situation:</v-label>
                        </v-row>

                        <v-row>
                            <v-col cols="12" md="6">
                                <v-select
                                    v-model="student.situationOfParents"
                                    :items="parentSituationOptions"
                                    label="Parents are..."
                                    :rules="rules.studentRules.situationOfParents"
                                    required
                                ></v-select>
                            </v-col>
                                <v-col cols="12" md="6">
                                    <v-select
                                        v-model="student.situationOfTheChild"
                                        :items="studentSituationOptions"
                                        label="Student lives with..."
                                        :rules="rules.studentRules.situationOfTheChild"
                                        required
                                    ></v-select>
                                </v-col>
                        </v-row>
                    </v-container>  
                </v-form>
            </v-card-text>
        </v-card>
</template>

<script>
export default {
    props: ['nationalId', 'typeOfAdmission', 'schoolCandidate'],
    data() {
        return {
            date: null,
            menu: false,
            schoolCandidates: [],
            student:{
                    nationalId: '', typeOfAdmission: '', firstName: '', lastName: '', middleName: '', dateOfBirth:'', gender:'', nationality:'', countryOfBirth: '', 
                    regionOfBirth: '', cityOfBirth: '', countryOfResidency: '', regionOfResidency: '', cityOfResidency: '', address: '',
                    postalCode: '', situationOfParents: '', situationOfTheChild: '', picture: '', responsibleA: '', responsibleB: '' 
                  },
            rules:  {
                studentRules:{
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
                    situationOfParents: [v => !!v || "Please select situation of parents"],
                    situationOfTheChild: [v => !!v || "Please select situation of the student"],
                },
            },
            genderOptions: [
                'Male',
                'Female',
                'Other', 
                'Prefer not to say',
            ],
            parentSituationOptions: [
                'Parents are Married',
                'Parents are Single',
                'Parents are Divorced', 
                'Parents are Separated',
                'Widower',
            ],
            studentSituationOptions: [
                'Lives with both parents',
                'Lives with mother',
                'Lives with father', 
                'Lives with brother or sister',
                'Lives in another family',
                'Lives in shelter',
            ],
            previewImage: null,
            picked: false,
            mutableSchoolCandidate: this.schoolCandidate,
            imageName: '',
            imageUrl: '',
            imageFile: ''
        }
    },
    methods: {
        validateFirstStep() {
            this.setData();
            this.$refs.ruleStudentForm.validate()
            if(this.student.countryOfBirth == '' || this.student.regionOfBirth == '' ||
                this.student.countryOfResidency == '' || this.student.regionOfResidency == ''){
                return new Promise((resolve, reject) => {
                    this.$refs.ruleStudentForm2.validate((valid) => {
                        resolve(valid);
                    });
                })
            }
            else{
                this.$refs.ruleStudentForm2.validate();
                return this.$refs.ruleStudentForm.validate();
            }
        },
        pickFile() {
        this.$refs.image.click()
        },
        onFilePicked(e) {
            const files = e.target.files
            if (files[0] !== undefined) {
                this.imageName = files[0].name
                if (this.imageName.lastIndexOf('.') <= 0) {
                return
                }
                const fr = new FileReader()
                fr.readAsDataURL(files[0])
                fr.addEventListener('load', () => {
                this.imageUrl = fr.result
                this.imageFile = files[0] // this is an image file that can be sent to server...
                })
            } else {
                this.imageName = ''
                this.imageFile = ''
                this.imageUrl = ''
            }
        },
        setData(){
            this.mutableSchoolCandidate = this.student;
            this.mutableSchoolCandidate.nationalId = this.nationalId;
            this.mutableSchoolCandidate.typeOfAdmission = this.typeOfAdmission;
            this.mutableSchoolCandidate.picture = this.imageUrl;
            this.$emit('schoolCandidate', this.mutableSchoolCandidate);
        },
        showInfo(){
            if(this.schoolCandidate){
                this.student.id = this.schoolCandidate.id;
                this.student.firstName = this.schoolCandidate.firstName;
                this.student.lastName = this.schoolCandidate.lastName;
                this.student.middleName = this.schoolCandidate.middleName;
                this.student.dateOfBirth = this.schoolCandidate.dateOfBirth;
                this.student.gender = this.schoolCandidate.gender;
                this.student.nationality = this.schoolCandidate.nationality;
                this.student.countryOfBirth = this.schoolCandidate.countryOfBirth;
                this.student.regionOfBirth = this.schoolCandidate.regionOfBirth;
                this.student.cityOfBirth = this.schoolCandidate.cityOfBirth;
                this.student.countryOfResidency = this.schoolCandidate.countryOfResidency;
                this.student.regionOfResidency = this.schoolCandidate.regionOfResidency;
                this.student.cityOfResidency = this.schoolCandidate.cityOfResidency;
                this.student.address = this.schoolCandidate.address;
                this.student.postalCode = this.schoolCandidate.postalCode;
                this.student.situationOfParents = this.schoolCandidate.situationOfParents;
                this.student.situationOfTheChild = this.schoolCandidate.situationOfTheChild;
                
                if(this.schoolCandidate.picture == null)
                    this.picked = false;
                else
                    this.picked = true;

                this.imageUrl = this.schoolCandidate.picture;
                this.validateFirstStep();
            }
        },
        save (date) {
            this.$refs.menu.save(date)
        },
    },
    watch: {
        menu (val) {
            val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
        },
    },
}
</script>

<style scoped lang="scss">
.imagePreviewWrapper {
    width: 180px;
    height: 230px;
    display: block;
    cursor: pointer;
    background-size: cover;
    background-position: center center;
}
</style>
