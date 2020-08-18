<template>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">General Info</h3>
                <div class="d-none">{{ schoolStudentCandidate }}</div>
            </div>
            <div class="card-body pl-lg-5">
                <el-form :inline="true" :model="student" class="demo-form-inline" :rules="rules.studentRules" ref="ruleStudentForm">
                      
                    <div class="form-row mx-3 pl-lg-5">
                        <div class="col-12 col-md-9 col-lg-9">
                            <div class="form-row">
                                <el-form-item class="col-12 col-md-5 col-lg-5" prop="firstName">
                                    <label>First Name</label>
                                    <el-input v-model="student.firstName" placeholder="Student's first name" ></el-input>
                                </el-form-item>

                                <el-form-item class="col-12 col-md-5 col-lg-5" prop="lastName">
                                    <label>Last Name</label>
                                    <el-input v-model="student.lastName" placeholder="Student's last name"></el-input>
                                </el-form-item>
                            </div>

                            <div class="form-row">
                                <el-form-item class="col-12 col-md-5 col-lg-5" prop="middleName">
                                    <label>Middle Name</label>
                                    <el-input v-model="student.middleName" placeholder="Student's middle name" ></el-input>
                                </el-form-item>

                                <el-form-item class="col-6 col-md-3 col-lg-3" prop="gender">
                                    <label>Gender</label>
                                    <el-select v-model="student.gender">
                                        <el-option label="Male" value="Male"></el-option>
                                        <el-option label="Female" value="Female"></el-option>
                                        <el-option label="Other" value="Other"></el-option>
                                        <el-option label="Prefer not to say" value="Prefer not to say"></el-option>
                                    </el-select>
                                </el-form-item>
                            </div>

                                    
                            <div class="form-row">
                                <el-form-item class="col-6 col-md-5 col-lg-5" prop="dateOfBirth">
                                    <label>Date of birth</label>
                                    <el-date-picker
                                        v-model="student.dateOfBirth"
                                        type="date"
                                        placeholder="Pick a date"
                                        default-value="2010-10-01">
                                    </el-date-picker>
                                </el-form-item>


                                <el-form-item class="col-12 col-md-3 col-lg-5" prop="nationality">
                                    <label>Nationality</label>
                                    <el-input v-model="student.nationality" placeholder="Student's nationality" ></el-input>
                                </el-form-item>

                            </div>
                        </div>

                        <div class="col-12 col-md-3 col-lg-3">
                            <div class="form-row">
                                <el-form-item class="col-12 col-md-3 col-lg-12" prop="picture">
                                    <label>Picture</label>
                                    <div class="imagePreviewWrapper el-upload el-upload--picture-card mb-2 custom-file"
                                        :style="{ 'background-image': `url(${previewImage})` }"
                                        @click="selectImage">
                                        <i v-if="!picked" class="el-icon-plus"></i>

                                    </div>
                                    <input ref="fileInput" type="file" @input="pickFile" class="custom-file-input">                                
                                </el-form-item>
                            </div>
                        </div>
                    </div>

                  
                    <div class="form-row ml-4 pl-lg-5">
                        <label>Place of birth</label>
                    </div>
                    <div class="form-row mx-3 mb-3 pl-lg-5">
                        <el-form-item class="col-12 col-md-4 col-lg-4">
                            <el-form-item prop="countryOfBirth">
                                <country-select class="custom-select" v-model="student.countryOfBirth" :country="student.countryOfBirth" topCountry="BI" />
                            </el-form-item>
                        </el-form-item>

                        <el-form-item class="col-12 col-md-4 col-lg-4">
                            <el-form-item prop="regionOfBirth">
                                <region-select class="custom-select" v-model="student.regionOfBirth" :country="student.countryOfBirth" :region="student.regionOfBirth" />
                            </el-form-item>
                        </el-form-item>

                        <el-form-item class="col-12 col-md-3 col-lg-3">
                            <el-form-item prop="cityOfBirth">
                                <el-input v-model="student.cityOfBirth" placeholder="City"></el-input>
                            </el-form-item>
                        </el-form-item>
                    </div>

                            
                    <div class="form-row ml-4 pl-lg-5">
                        <label>Place of residency</label>
                    </div>
                    <div class="form-row mx-3 pl-lg-5">
                        <el-form-item class="col-12 col-md-4 col-lg-4">
                            <el-form-item prop="countryOfResidency">
                                <country-select class="custom-select" v-model="student.countryOfResidency" :country="student.countryOfResidency" topCountry="BI" />
                            </el-form-item>
                        </el-form-item>

                        <el-form-item class="col-12 col-md-4 col-lg-4">
                            <el-form-item prop="regionOfResidency">
                               <region-select class="custom-select" v-model="student.regionOfResidency" :country="student.countryOfResidency" :region="student.regionOfResidency" />
                            </el-form-item>
                        </el-form-item>

                        <el-form-item class="col-12 col-md-3 col-lg-3">
                            <el-form-item prop="cityOfResidency">
                               <el-input v-model="student.cityOfResidency" placeholder="City"></el-input>
                            </el-form-item>
                        </el-form-item>
                    </div>

                    <div class="form-row ml-3 pl-lg-5">
                        <el-form-item class="col-12 col-md-4 col-lg-4" prop="address">
                            <el-input v-model="student.address" placeholder="Address"/>
                        </el-form-item>
                        <el-form-item class="col-12 col-md-4 col-lg-4" prop="postalCode">
                            <el-input v-model="student.postalCode" placeholder="Postal Code" ></el-input>
                        </el-form-item>
                    </div>

                    <div class="form-row mt-3 ml-4 pl-lg-5">
                        <label>Family situation</label>
                    </div>      
                    <div class="form-row mx-3 pl-lg-5">
                        <el-form-item class="col-6 col-md-3 col-lg-4" prop="situationOfParents">
                            <el-select v-model="student.situationOfParents" placeholder="Parents are...">
                            <el-option label="Parents are Married" value="Married"></el-option>
                            <el-option label="Parents are Single" value="Single"></el-option>
                            <el-option label="Parents are Divorced" value="Divorced"></el-option>
                            <el-option label="Parents are Separated" value="Separated"></el-option>
                            <el-option label="Widower" value="Widower"></el-option>
                            </el-select>          
                        </el-form-item>
                        <el-form-item class="col-6 col-md-3 col-lg-4" prop="situationOfTheChild">
                            <el-select v-model="student.situationOfTheChild" placeholder="Student lives with...">
                            <el-option label="Lives with both parents" value="Lives with both parents"></el-option>
                            <el-option label="Lives with mother" value="Lives with mother"></el-option>
                            <el-option label="Lives with father" value="Lives with father"></el-option>
                            <el-option label="Lives with brother or sister" value="Lives with brother or sister"></el-option>
                            <el-option label="Lives in another family" value="Lives in another family"></el-option>
                            <el-option label="Lives in shelter" value="Lives in shelter"></el-option>
                            </el-select>          
                        </el-form-item>
                    </div>

                </el-form>
            </div>
        </div>
</template>

<script>
export default {
    props: ['nationalId', 'typeOfAdmission', 'schoolStudentCandidate'],
    data() {
        return {
            schoolStudentCandidates: [],
            student:{
                    nationalId: '', typeOfAdmission: '', firstName: '', lastName: '', middleName: '', dateOfBirth:'', gender:'', nationality:'', countryOfBirth: '', 
                    regionOfBirth: '', cityOfBirth: '', countryOfResidency: '', regionOfResidency: '', cityOfResidency: '', address: '',
                    postalCode: '', situationOfParents: '', situationOfTheChild: '', picture: '',
                  },
            rules:  {
                studentRules:{
                    firstName: [{
                        required: true,
                        message: "Please input Student's first name",
                        trigger: 'blur'
                    }],
                    lastName: [{
                        required: true,
                        message: "Please input Student's last name",
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
                        situationOfParents: [{
                        required: true,
                        message: 'Please select situation of parents',
                        trigger: 'change'
                    }],
                    situationOfTheChild: [{
                        required: true,
                        message: 'Please select situation of the student',
                        trigger: 'change'
                    }],
                },
            },
        previewImage: null,
        picked: false,
        mutableSchoolStudentCandidate: this.schoolStudentCandidate,
        }
    },
    updated(){
        if(this.schoolStudentCandidate){
            this.student.id = this.schoolStudentCandidate.id;
            this.student.firstName = this.schoolStudentCandidate.firstName;
            this.student.lastName = this.schoolStudentCandidate.lastName;
            this.student.middleName = this.schoolStudentCandidate.middleName;
            this.student.dateOfBirth = this.schoolStudentCandidate.dateOfBirth;
            this.student.gender = this.schoolStudentCandidate.gender;
            this.student.nationality = this.schoolStudentCandidate.nationality;
            this.student.countryOfBirth = this.schoolStudentCandidate.countryOfBirth;
            this.student.regionOfBirth = this.schoolStudentCandidate.regionOfBirth;
            this.student.cityOfBirth = this.schoolStudentCandidate.cityOfBirth;
            this.student.countryOfResidency = this.schoolStudentCandidate.countryOfResidency;
            this.student.regionOfResidency = this.schoolStudentCandidate.regionOfResidency;
            this.student.cityOfResidency = this.schoolStudentCandidate.cityOfResidency;
            this.student.address = this.schoolStudentCandidate.address;
            this.student.postalCode = this.schoolStudentCandidate.postalCode;
            this.student.situationOfParents = this.schoolStudentCandidate.situationOfParents;
            this.student.situationOfTheChild = this.schoolStudentCandidate.situationOfTheChild;
            this.previewImage = this.schoolStudentCandidate.picture;
            this.picked = true;
            this.validateFirstStep();
        }
    },
    methods: {
        validateFirstStep() {
            return new Promise((resolve, reject) => {
                this.$refs.ruleStudentForm.validate((valid) => {
                resolve(valid);
                    if (valid){
                        this.setData();
                    }
                });
            })
        },
        selectImage(){
            this.$refs.fileInput.click()
        },
        pickFile(){
            let input = this.$refs.fileInput
            let file = input.files
            if (file && file[0]) {
            let reader = new FileReader
            reader.onload = e => {
                console.log(e)
                this.previewImage = e.target.result
            }
            reader.readAsDataURL(file[0])
            this.$emit('input', file[0])
            this.picked = true;
            }
        },
        setData(){
            this.mutableSchoolStudentCandidate = this.student;
            this.mutableSchoolStudentCandidate.nationalId = this.nationalId;
            this.mutableSchoolStudentCandidate.typeOfAdmission = this.typeOfAdmission;
            this.mutableSchoolStudentCandidate.picture = this.previewImage;
            this.$emit('schoolStudentCandidate', this.mutableSchoolStudentCandidate);
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