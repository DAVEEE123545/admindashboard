<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>


<html lang="en">
<head>
    <meta name="viewport" content="device-width", initial-scale="1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<script>
 
  // Function to module content
  function toggleSubmodules() {
        clearModuleContent(); // Clear previous module content

        const moduleContent = document.getElementById("module-content");
        moduleContent.innerHTML = `
        <p>Welcome to your module 1!</p>
        <div class="container mt-3">
            <div class="card">
                <div class="card-header">
                    <h4>module 1- Content Here</h4>
                </div>
                <div class="card-body">
                    <p>module 1 content is loaded here.</p>
                </div>
            </div>
        </div>`;
 }


</script>


<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <!-- Logo for LGU -->
    <img id="lgu-logo" src="logo.png" alt="LGU Logo" class="lgu-logo">





        <ul class="sidebar-menu">
            <li class="active"><a href="#" id="dashboard"><i class="fas fa-th-large"></i>Dashboard</a></li>
        

      <!-- Dropdown for Module 1 -->
      <li class="list-group-item">
        <a href="#" id="module1" onclick="toggleSubmodules('submodule1-dropdown')">
            <i class="fas fa-wrench"></i>Module 1 <i class="fas fa-chevron-down"></i>
        </a>
        <ul class="submodule-dropdown" id="submodule1-dropdown" style="display: none;">
            <li><a href="#" id="submodule1" onclick="loadSubmodule(1)">Submodule 1</a></li>
            <li><a href="#" id="submodule2" onclick="loadSubmodule(2)">Submodule 2</a></li>
            <li><a href="#" id="submodule3" onclick="loadSubmodule(3)">Submodule 3</a></li>
        </ul>
    </li>

            <li><a href="#" id="module2"><i class="fas fa-wrench"></i>Module 2</a></li>
            <li><a href="#" id="module3"><i class="fas fa-wrench"></i>Module 3</a></li>
            <li><a href="#" id="module4"><i class="fas fa-wrench"></i>Module 4</a></li>

        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <header>
            <div class="menu-toggle" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <div class="header-right">
                <i class="fas fa-comment-dots" id="message-icon"></i>
                <i class="fas fa-bell" id="notification-icon"></i>
                <div class="profile" id="profile-icon">

                    <div class="profile-container">
                        <div class="profile-icon">
<!-- User Profile Icon and Dropdown -->
<div class="user-profile" onclick="toggleDropdown()">
    <img src="wa.jpg" alt="Profile" class="profile-image">
</div>

<!-- Dropdown Menu -->
<div class="dropdown-menu" id="dropdownMenu">
    <div class="dropdown-header">
        <img src="wa.jpg" alt="User Avatar">
        <h3>Hello, Admin!</h3>
    </div>
    <ul>
        <li>
            <a href="edit_profile.php">
                <i class="fas fa-user icon-profile"></i><span>Edit Profile</span>
                <i class="fas fa-chevron-right arrow-icon"></i>
            </a>
        </li>
        <li>
            <i class="fas fa-cog icon-settings"></i><span>Settings & Privacy</span>
            <i class="fas fa-chevron-right arrow-icon"></i>
        </li>
        <li>
            <i class="fas fa-question-circle icon-help"></i><span>Help & Support</span>
            <i class="fas fa-chevron-right arrow-icon"></i>
        </li>
        <li>
            <i class="fas fa-sign-out-alt icon-logout"></i><a href="logout.php">Logout</a>
            <i class="fas fa-chevron-right arrow-icon"></i>
        </li>
    </ul>
</div>



                  
                </div>
            </div>
        </header>
        <main>
            <h1 id="content-title">Dashboard</h1>
            <p>Welcome to your dashboard!</p>
        </main>
    </div>

    
    <script>// Toggle sidebar functionality
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("main-content").classList.toggle("collapsed");
        });
   
        // Change content based on clicked module
        document.querySelectorAll(".sidebar-menu li a").forEach(item => {
            item.addEventListener("click", function (event) {
                // Remove active class from all menu items
                document.querySelectorAll(".sidebar-menu li").forEach(li => li.classList.remove("active"));
                
                // Add active class to clicked menu item
                event.currentTarget.parentElement.classList.add("active");
        
                // Change the content dynamically
                const contentTitle = document.getElementById("content-title");
                contentTitle.textContent = event.currentTarget.textContent.trim();
            });
        });
        
        // Handle profile, notifications, and messages click
        document.getElementById("profile-icon").addEventListener("click", function () {
            const profileIcon = document.getElementById('profileIcon');
const dropdownMenu = document.getElementById('dropdownMenu');

// Toggle the dropdown menu when the profile icon is clicked
profileIcon.addEventListener('click', function() {
  dropdownMenu.classList.toggle('show');
});

// Close the dropdown menu if clicked outside
window.addEventListener('click', function(e) {
  if (!profileIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
    dropdownMenu.classList.remove('show');
  }
});
        });
    
    
   // Function to toggle dropdown menu
   function toggleDropdown() {
        var dropdown = document.getElementById("dropdownMenu");
        dropdown.classList.toggle("active");
    }

    // Close the dropdown if clicked outside
    window.onclick = function(event) {
        if (!event.target.closest('.user-profile')) {
            document.getElementById("dropdownMenu").classList.remove("active");
        }
    }
        
        document.getElementById("notification-icon").addEventListener("click", function () {
            alert("Notifications clicked!");
        });
        
        document.getElementById("message-icon").addEventListener("click", function () {
            alert("Messages clicked!");
        });
        

// Function to toggle the dropdown visibility
function toggleSubmodules(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    if (dropdown.style.display === "none" || dropdown.style.display === "") {
        dropdown.style.display = "block";
    } else {
        dropdown.style.display = "none";
    }
}

// Function to load the specific submodule
function loadSubmodule(submoduleNumber) {
    clearModuleContent(); // Clear previous module content
    const moduleContent = document.getElementById("module-content");

    let submoduleTitle = "";
    let submoduleContent = "";

    switch (submoduleNumber) {
        case 1:
            submoduleTitle = "Submodule 1";
            submoduleContent = "Content for Submodule 1 is loaded here.";
            break;
        case 2:
            submoduleTitle = "Submodule 2";
            submoduleContent = "Content for Submodule 2 is loaded here.";
            break;
        case 3:
            submoduleTitle = "Submodule 3";
            submoduleContent = "Content for Submodule 3 is loaded here.";
            break;
        default:
            submoduleTitle = "Module 1";
            submoduleContent = "Default content for Module 1.";
    }

    moduleContent.innerHTML = `
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4>${submoduleTitle}</h4>
            </div>
            <div class="card-body">
                <p>${submoduleContent}</p>
            </div>
        </div>
    </div>`;
}

// Function to clear previous module content
function clearModuleContent() {
    document.getElementById("module-content").innerHTML = "";
}



        </script>

</body>
</html>