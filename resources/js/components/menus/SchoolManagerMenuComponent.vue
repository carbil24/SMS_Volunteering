<template>
    <!--<div>
        <h1 class="col-12 text-primary text-center display-5 mb-3">{{ 'Dear school manager please select an option: '}} </h1>
        <a class="btn btn-primary btn-lg btn-block" href="/teachers">Teachers</a>
        <a class="btn btn-primary btn-lg btn-block" href="/students">Students</a>
        <a class="btn btn-primary btn-lg btn-block" href="/employees">Employees</a>
        <a class="btn btn-primary btn-lg btn-block" href="">Reports</a>
        <a class="btn btn-primary btn-lg btn-block" href="">Attendance</a>
        <a class="btn btn-primary btn-lg btn-block" href="">Cerificates</a>
    </div>-->

        <ul class="nav nav-treeview">
            <li class="nav-item">
                <router-link to="/teachers" class="nav-link active">
                <i class="fas fa-circle nav-icon"></i>
                <p>Teachers</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/students" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Students</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/employees" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Employees</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Reports</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Attendance</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Certificates</p>
                </router-link>
            </li>
        </ul>
</template>

<script>

</script>
