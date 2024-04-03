<nav class="navbar navbar-expand-lg navbar-dark bg-dark menu">
  <div class="container-fluid">
    <!-- Brand -->
    <!-- <a class="navbar-brand" href="#">نظام ادارة معلومات الموظفين</a> -->

    <!-- Toggle button for mobile view -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar items and search box -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item active">
          <a class="nav-link" href="../pages/home.php">الرئيسية</a>
        </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            المخزن
          </a>
          <ul class="dropdown-menu" style="text-align:center">
            <li><a class="dropdown-item" href="../pages/insert.php">سند ادخال</a></li>
            <li><a class="dropdown-item" href="../pages/takeout.php">سند اخراج</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../pages/view_insert.php">عرض سندات الادخال</a></li>
            <li><a class="dropdown-item" href="../pages/view_takeout.php">عرض سندات الاخراج</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../pages/quantity_report.php">جرد المخزن</a></li>
          </ul>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            المجهزين
          </a>
          <ul class="dropdown-menu" style="text-align:center">
            <li><a class="dropdown-item" href="../pages/add_vendors.php">تعريف المجهزين</a></li>
            <li><a class="dropdown-item" href="../pages/vendor_view.php">عرض المجهزين</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            الذمم
          </a>
          <ul class="dropdown-menu" style="text-align:center">
            <li><a class="dropdown-item" href="../pages/add_emp.php">اضافة الموظفين</a></li>
            <li><a class="dropdown-item" href="../pages/thmam_single_emp.php">اضافة قيد ذمة </a></li>
            <li><a class="dropdown-item" href="../pages/view_thmam_single.php">عرض قيود الذمة </a></li>
            <li><a class="dropdown-item" href="../pages/view_emp.php">عرض الموظفين والذمم </a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../pages/add_dep.php">اضافة الاقسام او الدوائر</a></li>
            <li><a class="dropdown-item" href="../pages/view_dep.php">عرض الاقسام او الدوائر والذمم</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            المواد
          </a>
          <ul class="dropdown-menu" style="text-align:center">
            <li><a class="dropdown-item" href="../pages/add_products.php">تعريف المواد</a></li>
            <li><a class="dropdown-item" href="../pages/view_products.php">عرض المواد</a></li>
          </ul>
        </li>
   
        
        <li class="nav-item">
          <a class="nav-link" href="../auth/addusers.php">اضافة مستخدمين</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../auth/logout.php">تسجيل خروج</a>
        </li>
        <div id="movetxt">تصميم وبرمجة قسم تكنولوجيا المعلومات - المبرمج محمد عزيز    </div>
        <!-- Add more navbar items as needed -->

        <!-- Search box -->
        <!-- <li class="nav-item">
          <form class="d-flex" method="POST" action="search.php" >
            <input  class="form-control me-2" type="search" placeholder="ابحث عن  ..." aria-label="Search"  name="keyword">
            <button class="btn btn-success" type="submit">بحث</button>
          </form>
        </li> -->
      </ul>
    </div>
  </div>
</nav>