<template>
  <div class="card">
      <div class="card-header">{{ ('Student Management') }}</div>
      <div class="card-body">
        <div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="addStudent" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <form @submit.prevent="updateStudent(student)" v-if="editMode">
                    <h3>Edit Student</h3>
                    <input type="text" class="form-control mb-2" 
                      placeholder="First Name" v-model="student.first_name">
                    <input type="text" class="form-control mb-2" 
                      placeholder="Last Name" v-model="student.last_name">
                    <input type="text" class="form-control mb-2" 
                      placeholder="Date of birth" v-model="student.date_of_birth">
                    <input type="text" class="form-control mb-2" 
                      placeholder="Class" v-model="student.class">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-danger" type="submit" data-dismiss="modal"
                      @click="cancelEdit">Cancel</button>

                  </form>
                  <form @submit.prevent="add" v-else>
                    <h3>Add Student</h3>
                    <input type="text" class="form-control mb-2" 
                      placeholder="First Name" v-model="student.first_name">
                    <input type="text" class="form-control mb-2" 
                      placeholder="Last Name" v-model="student.last_name">
                    <input type="text" class="form-control mb-2" 
                      placeholder="Date of birth" v-model="student.date_of_birth">
                    <input type="text" class="form-control mb-2" 
                      placeholder="Class" v-model="student.class">
                    <button class="btn btn-primary" type="submit">Add</button>
                    <button class="btn btn-danger" type="submit" data-dismiss="modal"
                      @click="cancelEdit">Cancel</button>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
        </div>

        <h3>List of Students:</h3>
          
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Student ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Class</th>
                <th colspan="2" scope="col"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudent">Add Student</button></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in students" :key="index" >
                <td>{{item.id}}</td>
                <td>{{item.first_name}}</td>
                <td>{{item.last_name}}</td>
                <td>{{item.date_of_birth}}</td>
                <td>{{item.class}}</td>
                <td scope="col">
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addStudent"
                        @click="editForm(item)">Edit</button></td>
                <td scope="col">
                    <button class="btn btn-danger btn-sm" 
                        @click="deleteStudent(item, index)">Delete</button></td>
              </tr>
            </tbody>
          </table>
        </div>
        <a class="btn btn-link" href="/home">Back</a>
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      students: [],
      editMode: false,
      student: {first_name: '', last_name: '', date_of_birth: '', class: ''}
    }
  },
  created(){
    axios.get('api/students').then(res=>{
      this.students = res.data;
    })
  },
  methods:{
    add(){
      if(this.student.first_name.trim() === '' || this.student.last_name.trim() === '' || this.student.date_of_birth.trim() === '' || this.student.class.trim() === ''){
        alert('Please complete all the fields');
        return;
      }
      const newStudent = this.student;
      this.student = {first_name: '', last_name: '', date_of_birth: '', class: ''};    
      axios.post('api/students', newStudent)
        .then((res) =>{
          const studentServer = res.data;
          this.students.push(studentServer);
        })

        $('#addStudent').modal('hide');

        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Student created successfully',
          showConfirmButton: false,
          timer: 2200
        })
    },
    editForm(item){
      this.student.first_name = item.first_name;
      this.student.last_name = item.last_name;
      this.student.date_of_birth = item.date_of_birth;
      this.student.class = item.class;
      this.student.id = item.id;
      this.editMode = true;
    },
    updateStudent(student){
      const params = {first_name: student.first_name, last_name: student.last_name, date_of_birth: student.date_of_birth, class: student.class};
      axios.put(`api/students/${student.id}`, params)
        .then(res=>{
          this.editMode = false;
          const index = this.students.findIndex(item => item.id === student.id);
          this.students[index] = res.data;

          axios.get('api/students').then(res=>{
            this.students = res.data;
          })

          this.student = {first_name: '', last_name: '', date_of_birth: '', class: ''};    

        })

        $('#addStudent').modal('hide');

        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Student updated successfully',
          showConfirmButton: false,
          timer: 2200
        })

    },
    deleteStudent(student, index){
      Swal.fire({
        title: `Delete student ${student.first_name + ' ' + student.last_name}?`,
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Student deleted successfully',
          showConfirmButton: false,
          timer: 2200
          })

          axios.delete(`api/students/${student.id}`)
          .then(()=>{
            this.students.splice(index, 1);
          })
        }
      })
    },
    cancelEdit(){
      this.editMode = false;
      this.student = {first_name: '', last_name: '', date_of_birth: '', class: ''};
    }
  }
}
</script>