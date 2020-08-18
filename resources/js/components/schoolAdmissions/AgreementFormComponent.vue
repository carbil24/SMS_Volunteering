<template>
      <el-form :inline="true" :model="agreement" class="demo-form-inline" :rules="rules.agreementRules" ref="ruleAgreementForm">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Agreement 1. Medical release Information</h3>
            </div>
            <div class="card-body">
                  <div class="form-row">
                    <el-form-item class="col-12 col-md-12 col-lg-12" prop="agreement1">
                        <p>If I am unavailable, I hereby give permission for emergency care and treatment which could include hospitalization,
                           anesthesia and surgery for my child if deemed necessary.</p>
                        <el-checkbox-group v-model="agreement.agreement1">
                          <el-checkbox label="I agree"></el-checkbox>
                        </el-checkbox-group>
                    </el-form-item>                 
                  </div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Agreement 2. Financial Information</h3>
            </div>
            <div class="card-body">
                  <div class="form-row">
                    <el-form-item class="col-12 col-md-12 col-lg-12" prop="agreement2">
                        <p>Day Care rates will remain fixed throughout the entire year, your rate will be set by the age of your child in September 
                           and will not change at the child’s birthday. Payments for Day Care must be paid weekly. If payment is withheld for two weeks,
                           a $ 10.00 penalty will be added. If payment is withheld beyond two weeks, your child must be with- drawn from Day Care until
                           your account is current.</p>
                        <el-checkbox-group v-model="agreement.agreement2">
                          <el-checkbox label="I agree"></el-checkbox>
                        </el-checkbox-group>
                    </el-form-item>                 
                  </div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Agreement 3. Annual asbestos notices</h3>
            </div>
            <div class="card-body">
                  <div class="form-row">
                    <el-form-item class="col-12 col-md-12 col-lg-12" prop="agreement3">
                        <p>In compliance with the Asbestos Hazard Emergency Response Act (AHERA) we are providing you with the required annual notice
                           of the availability of our Asbestos Management Plan. This plan will be available for inspection at our offices without cost
                           or restriction during normal office hours.</p>
                        <el-checkbox-group v-model="agreement.agreement3">
                          <el-checkbox label="I agree"></el-checkbox>
                        </el-checkbox-group>
                    </el-form-item>                 
                  </div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Agreement 4. Dismissal notices</h3>
            </div>
            <div class="card-body">
                  <div class="form-row">
                    <el-form-item class="col-12 col-md-12 col-lg-12" prop="agreement4">
                        <p>I understand that Jceki's Preschool and day Care reserves the right to dismiss my child if deemed necessary.</p>
                        <el-checkbox-group v-model="agreement.agreement4">
                          <el-checkbox label="I agree"></el-checkbox>
                        </el-checkbox-group>
                    </el-form-item>                 
                  </div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Agreement 5. Home and school guide</h3>
            </div>
            <div class="card-body">
                  <div class="form-row">
                    <el-form-item class="col-12 col-md-12 col-lg-12" prop="agreement5">
                        <p>My child and I have read and agree to abide by the rules as stated in the John C and Elie K International 
                           Home and School Guide.</p>
                        <el-checkbox-group v-model="agreement.agreement5">
                          <el-checkbox label="I agree"></el-checkbox>
                        </el-checkbox-group>
                    </el-form-item>                 
                  </div>
            </div>
        </div>
        
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Agreement 6. Student advertisement permission and statement of cooperation</h3>
            </div>
            <div class="card-body">
                  <div class="form-row">
                    <el-form-item class="col-12 col-md-12 col-lg-12" prop="agreement6">
                        <p>I agree to allow John C and Elie K International (JCKI): Preschool and Daycare School the use
                           of my child’s picture (likeness) and/or name to appear in the annual yearbook, the Jceki Apps, website, and newspapers.</p>
                        <el-checkbox-group v-model="agreement.agreement6">
                          <el-checkbox label="I agree"></el-checkbox>
                        </el-checkbox-group>
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
      agreement:{  
                agreement1: [], agreement2: [], agreement3: [], agreement4: [], agreement5: [], agreement6: [],
              },
      rules: {
        agreementRules:{
          agreement1: [{
            required: true,
            message: "Please read the agreement and click I agree to continue",
            trigger: 'change'
          }],
          agreement2: [{
            required: true,
            message: "Please read the agreement and click I agree to continue",
            trigger: 'change'
          }],
          agreement3: [{
            required: true,
            message: "Please read the agreement and click I agree to continue",
            trigger: 'change'
          }],
          agreement4: [{
            required: true,
            message: "Please read the agreement and click I agree to continue",
            trigger: 'change'
          }],
          agreement5: [{
            required: true,
            message: "Please read the agreement and click I agree to continue",
            trigger: 'change'
          }],
          agreement6: [{
            required: true,
            message: "Please read the agreement and click I agree to continue",
            trigger: 'change'
          }],
        },
      }
    }
  },
  methods: {
    validateFifthStep() {
        console.log(this.$refs.ruleAgreementForm)
        return new Promise((resolve, reject) => {
            this.$refs.ruleAgreementForm.validate((valid) => {
            resolve(valid);
            });
        })
    },
  },
}
</script>