<template>
    <div class="card">
    <div class="card-header">{{('Employee Management') }}</div>

      <div class="card-body">
        <div class="modal fade" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="addEmployee" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                  <form @submit.prevent="updateEmployee(employee)" v-if="editMode">
                    <h3>Edit Employee</h3>
                    <input type="text" class="form-control mb-2" 
                      placeholder="First Name" v-model="employee.first_name">
                    <input type="text" class="form-control mb-2" 
                      placeholder="Last Name" v-model="employee.last_name">
                    <input type="text" class="form-control mb-2" 
                      placeholder="Date of birth" v-model="employee.date_of_birth">
                    <select class="form-control mb-2" 
                        v-model="employee.position" id="position" name="position">
                        <option value="" selected disabled hidden>-Select position-</option>
                        <option value="School Manager">School Manager</option>
                        <option value="Recepcionist">Recepcionist</option>
                        <option value="Accounter">Accounter</option>
                        <option value="Driver">Driver</option>
                    </select>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-danger" type="submit" data-dismiss="modal"
                      @click="cancelEdit">Cancel</button>

                  </form>
                  <form @submit.prevent="add" v-else>
                    <h3>Add Employee</h3>
                    <input type="text" class="form-control mb-2" 
                      placeholder="First Name" v-model="employee.first_name">
                    <input type="text" class="form-control mb-2" 
                      placeholder="Last Name" v-model="employee.last_name">
                    <input type="text" class="form-control mb-2" 
                      placeholder="Date of birth" v-model="employee.date_of_birth">
                    <select class="form-control mb-2" 
                        v-model="employee.position" id="position" name="position">
                        <option value="" selected disabled hidden>-Select position-</option>
                        <option value="School Manager">School Manager</option>
                        <option value="Recepcionist">Recepcionist</option>
                        <option value="Accounter">Accounter</option>
                        <option value="Driver">Driver</option>
                    </select>
                    <button class="btn btn-primary" type="submit">Add</button>
                    <button class="btn btn-danger" type="submit" data-dismiss="modal"
                      @click="cancelEdit">Cancel</button>
                  </form>
                  <hr>
                </div>
            </div>
          </div>
        </div>
            
    <h3>List of Employees:</h3>
        
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Employee ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Class</th>
            <th colspan="2" scope="col"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEmployee">Add Employee</button></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in employees" :key="index" >
            <td>{{item.id}}</td>
            <td>{{item.first_name}}</td>
            <td>{{item.last_name}}</td>
            <td>{{item.date_of_birth}}</td>
            <td>{{item.position}}</td>
            <td scope="col">
                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addEmployee"
                    @click="editForm(item)">Edit</button></td>
            <td scope="col">
                <button class="btn btn-danger btn-sm" 
                    @click="deleteEmployee(item, index)">Delete</button></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--<ul class="list-group">
         <li class="list-group-item" 
            v-for="(item, index) in employees" :key="index" >
          <span class="badge badge-primary float-right">
            {{item.updated_at}}
          </span>
          <p>{{item.id}} {{item.first_name}} {{item.last_name}}</p>
          <p>{{item.date_of_birth}}</p>
          <p>{{item.position}}</p>
          <p>
            <button class="btn btn-warning btn-sm" 
                @click="editForm(item)">Edit</button>
            <button class="btn btn-danger btn-sm" 
                @click="deleteEmployee(item, index)">Delete</button>
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
      employees: [],
      editMode: false,
      employee: {first_name: '', last_name: '', date_of_birth: '', position: ''}
    }
  },
  created(){
    axios.get('api/employees').then(res=>{
      this.employees = res.data;
    })
  },
  methods:{
    add(){
      if(this.employee.first_name.trim() === '' || this.employee.last_name.trim() === '' || this.employee.date_of_birth.trim() === '' || this.employee.position.trim() === ''){
        alert('Please complete all the fields');
        return;
      }
      const newEmployee = this.employee;
      this.employee = {first_name: '', last_name: '', date_of_birth: '', position: ''};    
      axios.post('api/employees', newEmployee)
        .then((res) =>{
          const employeeServer = res.data;
          this.employees.push(employeeServer);
        })

        $('#addEmployee').modal('hide');

        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Employee created successfully',
          showConfirmButton: false,
          timer: 2200
        })
    },
    editForm(item){
      this.employee.first_name = item.first_name;
      this.employee.last_name = item.last_name;
      this.employee.date_of_birth = item.date_of_birth;
      this.employee.position = item.position;
      this.employee.id = item.id;
      this.editMode = true;
    },
    updateEmployee(employee){
      const params = {first_name: employee.first_name, last_name: employee.last_name, date_of_birth: employee.date_of_birth, position: employee.position};
      axios.put(`api/employees/${employee.id}`, params)
        .then(res=>{
          this.editMode = false;
          const index = this.employees.findIndex(item => item.id === employee.id);
          this.employees[index] = res.data;

          axios.get('api/employees').then(res=>{
            this.employees = res.data;
          })

          this.employee = {first_name: '', last_name: '', date_of_birth: '', position: ''};    

        })

        $('#addEmployee').modal('hide');

        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Employee updated successfully',
          showConfirmButton: false,
          timer: 2200
        })
    },
    deleteEmployee(employee, index){
      Swal.fire({
        title: `Delete employee ${employee.first_name + ' ' + employee.last_name}?`,
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
          title: 'Employee deleted successfully',
          showConfirmButton: false,
          timer: 2200
          })

          axios.delete(`api/employees/${employee.id}`)
          .then(()=>{
            this.employees.splice(index, 1);
          })
        }
      })
    },
    cancelEdit(){
      this.editMode = false;
      this.employee = {first_name: '', last_name: '', date_of_birth: '', position: ''};
    }
  }
}
</script>
