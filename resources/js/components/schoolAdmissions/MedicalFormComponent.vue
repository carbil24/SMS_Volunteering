<template>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Medical Info</h3>
            </div>
            <div class="card-body pl-lg-5">
                <el-form :inline="true" :model="student" class="demo-form-inline" :rules="rules.studentRules" ref="ruleStudentForm">
                    Here will be the medical records Info
                </el-form>
            </div>
        </div>
</template>

<script>
export default {
    data() {
        return {
            student:{
                    firstName: '', lastName: '', middleName: '', dateOfBirth:'', gender:'', nationality:'', countryOfBirth: '', 
                    regionOfBirth: '', cityOfBirth: '', countryOfResidency: '', regionOfResidency: '', cityOfResidency: '', address: '',
                    zipCode: '', situationOfParents: '', situationOfTheChild: ''
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
        }
    },
    methods: {
        validateFourthStep() {
            console.log(this.$refs.ruleStudentForm)
            return new Promise((resolve, reject) => {
                this.$refs.ruleStudentForm.validate((valid) => {
                resolve(valid);
                });
            })
        },
    },
}
</script>
