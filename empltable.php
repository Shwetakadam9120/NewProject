<?php
// empltable.php

session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="cssempltable3.css">

  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Management</title>
  <style>
    .status-circle {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      display: inline-block;
      vertical-align: middle;
    }
    .status-active {
      background-color: green;
    }
    .status-inactive {
      background-color: red;
    }
    .button a {
      margin-right: 15px;
      display: inline-block;
      padding: 10px 20px;
      text-decoration: none;
      color: white;
      background-color: #007bff;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .button a:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <img src="logo19.png" style="width: 50px; height: 50px;"> 
      <span class="logo_name">Virajo.in</span>
    </div>
    
    <ul class="nav-links">
      <li>
        <a href="dashboard.html" class="active">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="team.html">
          <i class='bx bx-group'></i>
          <span class="links_name">Teams</span>
        </a>
      </li>
      <li>
        <a href="employees.html">
          <i class='bx bx-user'></i>
          <span class="links_name">Employees</span>
        </a>
      </li>
      <li>
        <a href="attendance.html">
          <i class='bx bx-calendar'></i>
          <span class="links_name">Attendance</span>
        </a>
      </li>
      <li>
        <a href="leave.html">
          <i class='bx bx-calendar-event'></i>
          <span class="links_name">Leaves</span>
        </a>
      </li>
      <li>
        <a href="payment-list.html">
          <i class='bx bx-dollar-circle'></i>
          <span class="links_name">Payment</span>
        </a>
      </li>
      <li>
        <a href="calendar.php.html">
          <i class='bx bx-calendar'></i>
          <span class="links_name">Calendar</span>
        </a>
      </li>
      <li>
        <a href="report1.html">
          <i class='bx bx-file'></i>
          <span class="links_name">Report</span>
        </a>
      </li>
      <li>
        <a href="notification.html">
          <i class='bx bx-bell'></i>
          <span class="links_name">Notification</span>
        </a>
      </li>
      <li>
        <a href="settings.html">
          <i class='bx bx-cog'></i>
          <span class="links_name">Setting</span>
        </a>
      </li>
      <li class="log_out">
        <a href="logut.html"">
          <i class='bx bx-log-out'></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>


  <section class="home-section">
  <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Employee</span>
      </div>
      <div class="search-box">
        <input type="text" id="searchInput" placeholder="Search ">
        <i class='bx bx-search'></i>
      </div>
      <div class="profile-details">
        <a href="adminpage.html">
          <img src="user3.jpg" alt="">
          <span class="adminpage">ABC</span>
          <i class="bx bx-bell notification-icon"></i> 
        </a>
      </div>
    </nav>


    <div class="home-content">
      <div class="overview-boxes">
        <!-- Overview Boxes Here -->
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title"></div>
          <h1>Employee</h1>
          <div class="sales-details">
            <table id="employeeTable">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Department</th>
                  <th>Edit</th>
                  <th>View Profile</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              <tbody>
                <tr>
                  <td>abc</td>
                  <td>abc@example.com</td>
                  <td>(123) 456-7890</td>
                  <td>Sales</td>
                  <td><a href="empldit.html">Edit</a></td>
                  <td><a href="tviewprofile.html">View</a></td>
                  <td><span class="status-circle status-active"></span></td>
                </tr>
                <tr>
                  <td>xyz</td>
                  <td>xyz@example.com</td>
                  <td>(234) 567-8901</td>
                  <td>Marketing</td>
                  <td><a href="empldit.html">Edit</a></td>
                  <td><a href="tviewprofile.html">View</a></td>
                  <td><span class="status-circle status-inactive"></span></td>
                </tr>
                <tr>
                  <td>qaz</td>
                  <td>qaz@example.com</td>
                  <td>(345) 678-9012</td>
                  <td>HR</td>
                  <td><a href="empldit.html">Edit</a></td>
                  <td><a href="tviewprofile.html">View</a></td>
                  <td><span class="status-circle status-active"></span></td>
                </tr>
                <?php
                if (isset($_SESSION['employees']) && !empty($_SESSION['employees'])) {
                    foreach ($_SESSION['employees'] as $employee) {
                        $statusClass = $employee['status'] == 'active' ? 'status-active' : 'status-inactive';
                        echo "<tr>
                              <td>{$employee['name']}</td>
                              <td>{$employee['email']}</td>
                              <td>{$employee['phone']}</td>
                              <td>{$employee['department']}</td>
                              <td><a href='empldit.html'>Edit</a></td>
                              <td><a href='tviewprofile.html'>View</a></td>
                              <td><span class='status-circle {$statusClass}'></span></td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No employee data available.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="button">
            <a href="newemplRegistration.html" target="_blank"> + Add Employee</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if(sidebar.classList.contains("active")){
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else {
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    }

    let debounceTimer;
    const searchInput = document.getElementById('searchInput');

    function filterTable() {
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => {
        let filter = searchInput.value.toUpperCase();

        let table = document.getElementById('employeeTable');
        let tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
          let tdName = tr[i].getElementsByTagName('td')[0];
          let tdEmail = tr[i].getElementsByTagName('td')[1];
          let tdPhone = tr[i].getElementsByTagName('td')[2];
          let tdDepartment = tr[i].getElementsByTagName('td')[3];

          if (tdName || tdEmail || tdPhone || tdDepartment) {
            let txtValueName = tdName ? tdName.textContent || tdName.innerText : '';
            let txtValueEmail = tdEmail ? tdEmail.textContent || tdEmail.innerText : '';
            let txtValuePhone = tdPhone ? tdPhone.textContent || tdPhone.innerText : '';
            let txtValueDepartment = tdDepartment ? tdDepartment.textContent || tdDepartment.innerText : '';

            if (
              txtValueName.toUpperCase().indexOf(filter) > -1 ||
              txtValueEmail.toUpperCase().indexOf(filter) > -1 ||
              txtValuePhone.toUpperCase().indexOf(filter) > -1 ||
              txtValueDepartment.toUpperCase().indexOf(filter) > -1
            ) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }, 300);
    }

    searchInput.addEventListener('keyup', filterTable);
  </script>
</body>
</html>
