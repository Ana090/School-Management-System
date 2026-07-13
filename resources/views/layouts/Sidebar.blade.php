<aside  class="app-sidebar sidebar-custom shadow">        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="#" class="brand-link">
            <!--begin::Brand Image-->
           

            <img 
    src="{{ asset('asset/img/AdminLTELogo.png') }}" 
    alt="User Avatar"
              class="brand-image opacity-75 shadow"
/>
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">SCS SCHOOL</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          
          <nav class="mt-2">
  <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" data-accordion="false">

    <!-- Dashboard -->
    <li  class="nav-item" >
      <a href='{{ url('/') }}' style="background-color: aliceblue" class="nav-link active">
        <i class="nav-icon bi bi-speedometer2"></i>
        <p>Dashboard</p>
      </a>
    </li>

     
    <!-- Classes -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon bi bi-door-open-fill"></i>
        <p>
          Classes
          <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{Route('classRoom.index')}}" class="nav-link">
            <i class="bi bi-list"></i>
            <p>All Classes</p>
          </a>
        </li>
        {{-- s --}}
      </ul>
    </li>

    <!-- Teachers -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon bi bi-person-badge-fill"></i>
        <p>
          Teachers
          <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{Route('teacher.index')}}" class="nav-link">
            <i class="bi bi-list"></i>
            <p>All Teachers</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{Route('teacher.create')}}" class="nav-link">
            <i class="bi bi-plus"></i>
            <p>Add Teacher</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Students -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon bi bi-people-fill"></i>
        <p>
          Students
          <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
      </a>
      <ul style="color: aliceblue" class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{Route('Student.index')}}" class="nav-link">
            <i class="bi bi-list"></i>
            <p style="color: aliceblue" >All Students</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{Route('Student.create')}}" class="nav-link">
            <i class="bi bi-plus"></i>
            <p>Add Student</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Subjects -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon bi bi-book-fill"></i>
        <p>
          Subjects
          <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ Route('subject.index') }}" class="nav-link">
            <i class="bi bi-circle"></i>
            <p>All Subjects</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="bi bi-circle"></i>
            <p>Add Subject</p>
          </a>
        </li>
      </ul>
    </li>

  
@can('admin')
    <!-- Fees -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon bi bi-cash-stack"></i>
        <p>
          Fees
          <i class="nav-arrow bi bi-chevron-right"></i>
        </p> 
       
      </a>
      <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="{{ Route('TuitionFee.index') }}" class="nav-link">
            <i class="bi bi-circle"></i>
            <p> tuition fees</p>   
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ Route('Invoice.index') }}" class="nav-link">
            <i class="bi bi-circle"></i>
            <p>   Invoices</p>    
          </a>
        </li>
      
        <li class="nav-item">
          <a href="{{ Route('student.accounts.report') }}" class="nav-link">
            <i class="bi bi-circle"></i>
            <p>Fees Report</p>
          </a>
        </li>
      </ul>
    </li>
     <!-- promotions -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon bi bi-pencil-square"></i>
        <p>
          promotions
          <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('Student_promotions.create') }}" class="nav-link">
            <i class="bi bi-circle"></i>
            <p>add  promotions</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('Student_promotions.index') }}" class="nav-link">
            <i class="bi bi-circle"></i>
            <p>  promotions list</p>
          </a>
        </li>
      </ul>
    </li> 

     <!-- User -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon bi bi-bar-chart-fill"></i>
        <p>
          User
          <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ Route('Users.index') }}" class="nav-link">
            <i class="bi bi-circle"></i>
            <p>All User</p>
          </a>
        </li>
         <li class="nav-item">
          <a href="{{ Route('Users.create') }}" class="nav-link">
            <i class="bi bi-circle"></i>
            <p>Create User</p>
          </a>
        </li>
      </ul>
    </li> 
    <!-- Settings -->
    <li class="nav-item">
      <a href="{{ Route('setting.index') }}" class="nav-link">
        <i class="nav-icon bi bi-gear-fill"></i>
        <p>Settings</p>
      </a>
    </li>
@endcan

  </ul>
</nav>

        </div>
        <!--end::Sidebar Wrapper-->
      </aside>