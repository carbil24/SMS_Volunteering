<template>

  <div class="card">
      <div class="card-header">{{('Teacher Management') }}</div>

      <div class="card-body">
      <div class="modal fade" id="addTeacher" tabindex="-1" role="dialog" aria-labelledby="addTeacher" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-body">
                <form @submit.prevent="updateTeacher(teacher)" v-if="editMode">
                  <h3>Edit Teacher</h3>
                  <input type="text" class="form-control mb-2" 
                    placeholder="First Name" v-model="teacher.first_name">
                  <input type="text" class="form-control mb-2" 
                    placeholder="Last Name" v-model="teacher.last_name">
                  <input type="text" class="form-control mb-2" 
                    placeholder="Date of birth" v-model="teacher.date_of_birth">
                  <input type="text" class="form-control mb-2" 
                    placeholder="Class" v-model="teacher.class">
                  <button class="btn btn-primary" type="submit">Save</button>
                  <button class="btn btn-danger" type="submit" data-dismiss="modal"
                    @click="cancelEdit">Cancel</button>

                </form>
                <form @submit.prevent="add" v-else>
                  <h3>Add Teacher</h3>
                  <input type="text" class="form-control mb-2" 
                    placeholder="First Name" v-model="teacher.first_name">
                  <input type="text" class="form-control mb-2" 
                    placeholder="Last Name" v-model="teacher.last_name">
                  <input type="text" class="form-control mb-2" 
                    placeholder="Date of birth" v-model="teacher.date_of_birth">
                  <input type="text" class="form-control mb-2" 
                    placeholder="Class" v-model="teacher.class">
                  <button class="btn btn-primary" type="submit">Add</button>
                  <button class="btn btn-danger" type="submit" data-dismiss="modal"
                    @click="cancelEdit">Cancel</button>
                </form>
                <hr>
              </div>
          </div>
        </div>
      </div>

      <h3>List of Teachers:</h3>
          
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Teacher ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Date of Birth</th>
              <th scope="col">Class</th>
              <th colspan="2" scope="col"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTeacher">Add Teacher</button></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in teachers" :key="index" >
              <td>{{item.id}}</td>
              <td>{{item.first_name}}</td>
              <td>{{item.last_name}}</td>
              <td>{{item.date_of_birth}}</td>
              <td>{{item.class}}</td>
              <td scope="col">
                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addTeacher"
                      @click="editForm(item)">Edit</button></td>
              <td scope="col">
                  <button class="btn btn-danger btn-sm" 
                      @click="deleteTeacher(item, index)">Delete</button></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--<ul class="list-group">
          <li class="list-group-item" 
              v-for="(item, index) in teachers" :key="index" >
            <span class="badge badge-primary float-right">
              {{item.updated_at}}
            </span>
            <p>{{item.id}} {{item.first_name}} {{item.last_name}}</p>
            <p>{{item.date_of_birth}}</p>
            <p>{{item.class}}</p>
            <p>
              <button class="btn btn-warning btn-sm" 
                  @click="editForm(item)">Edit</button>
              <button class="btn btn-danger btn-sm" 
                  @click="deleteTeacher(item, index)">Delete</button>
            </p>
          </li>
      </ul> -->
      <a class="btn btn-link" href="/home">Back</a>
      </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      teachers: [],
      editMode: false,
      teacher: {first_name: '', last_name: '', date_of_birth: '', class: ''}
    }
  },
  created(){
    axios.get('api/teachers/').then(res=>{
      this.teachers = res.data;
    })
  },
  methods:{
    add(){
      if(this.teacher.first_name.trim() === '' || this.teacher.last_name.trim() === '' || this.teacher.date_of_birth.trim() === '' || this.teacher.class.trim() === ''){
        alert('Please complete all the fields');
        return;
      }
      const newTeacher = this.teacher;
      this.teacher = {first_name: '', last_name: '', date_of_birth: '', class: ''};    
      axios.post('api/teachers/', newTeacher)
        .then((res) =>{
          const teacherServer = res.data;
          this.teachers.push(teacherServer);
        })

        $('#addTeacher').modal('hide');

        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Teacher created successfully',
          showConfirmButton: false,
          timer: 2200
        })
    },
    editForm(item){
      this.teacher.first_name = item.first_name;
      this.teacher.last_name = item.last_name;
      this.teacher.date_of_birth = item.date_of_birth;
      this.teacher.class = item.class;
      this.teacher.id = item.id;
      this.editMode = true;
    },
    updateTeacher(teacher){
      const params = {first_name: teacher.first_name, last_name: teacher.last_name, date_of_birth: teacher.date_of_birth, class: teacher.class};
      axios.put(`api/teachers/${teacher.id}`, params)
        .then(res=>{
          this.editMode = false;
          const index = this.teachers.findIndex(item => item.id === teacher.id);
          this.teachers[index] = res.data;

          axios.get('api/teachers').then(res=>{
            this.teachers = res.data;
          })

          this.teacher = {first_name: '', last_name: '', date_of_birth: '', class: ''};    

        })

        $('#addTeacher').modal('hide');

        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Teacher updated successfully',
          showConfirmButton: false,
          timer: 2200
        })
    },
    deleteTeacher(teacher, index){
      Swal.fire({
        title: `Delete teacher ${teacher.first_name + ' ' + teacher.last_name}?`,
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
          title: 'Teacher deleted successfully',
          showConfirmButton: false,
          timer: 2200
          })

          axios.delete(`api/teachers/${teacher.id}`)
          .then(()=>{
            this.teachers.splice(index, 1);
          })
        }
      })
    },
    cancelEdit(){
      this.editMode = false;
      this.teacher = {first_name: '', last_name: '', date_of_birth: '', class: ''};
    }
  }
}
</script>
