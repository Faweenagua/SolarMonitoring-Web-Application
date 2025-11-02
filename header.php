<?php session_start(); ?>
<?php 

echo '
<!-- loader-->
<link href="assets/css/pace.min.css" rel="stylesheet" />
<script src="assets/js/pace.min.js"></script>
<!-- Bootstrap CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="assets/css/bootstrap-extended.css" rel="stylesheet" />
<link
  href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap"
  rel="stylesheet"
/>
<link href="assets/css/app.css" rel="stylesheet" />
<link href="assets/css/icons.css" rel="stylesheet" />

<title>Biogas Monitoring System</title>
</head>

<body class="bg-theme bg-theme3">
<!--wrapper-->
<div class="wrapper">
  <!--sidebar wrapper -->
  <div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
      <div>
        <img
          src="assets/images/logo-icon.png"
          class="logo-icon"
          alt="logo icon"
        />
      </div>
      <div>
        <h4 class="logo-text">AReL - Biogas</h4>
      </div>
      <div class="toggle-icon ms-auto">
        <i class="bx bx-arrow-to-left"></i>
      </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
      <li>
        <a href="index.php">
          <div class="parent-icon"><i class="bx bxs-dashboard"></i></div>
          <div class="menu-title">Dashboard</div>
        </a>
      </li>
      <li>
        <a href="addUnits.php">
          <div class="parent-icon"><i class="bx bx-ruler"></i></div>
          <div class="menu-title">Add Unit</div>
        </a>
      </li>
      <li>
        <a href="addFeedItem.php">
          <div class="parent-icon"><i class="bx bx-plus"></i></div>
          <div class="menu-title">Add Feed Item</div>
        </a>
      </li>
      <li>
        <a href="addCategory.php">
          <div class="parent-icon"><i class="bx bx-category"></i></div>
          <div class="menu-title">Add Category</div>
        </a>
      </li>
      <li>
        <a href="recordfeed.php">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Record Feed</div>
        </a>
      </li>
      <li>
        <a href="previousFeeds.php">
          <div class="parent-icon"><i class="bx bx-food-menu"></i></div>
          <div class="menu-title">Feed History</div>
        </a>
      </li>
      <li>
        <a href="setAlerts.php">
          <div class="parent-icon"><i class="bx bx-error"></i></div>
          <div class="menu-title">Set Alerts</div>
        </a>
      </li>
      <li>
        <a class="has-arrow" href="javascript:;">
          <div class="parent-icon"><i class="bx bx-cloud-download"></i></div>
          <div class="menu-title">Export Sensor Data</div>
        </a>
        <ul>
          <li> <a href="exportData.php?range=0"><i class="bx bx-right-arrow-alt"></i>Last 7 Days</a>
          </li>
          <li> <a href="exportData.php?range=1"><i class="bx bx-right-arrow-alt"></i>Last 14 Days</a>
          </li>
          <li> <a href="exportData.php?range=2"><i class="bx bx-right-arrow-alt"></i>Last 30 Days</a>
          </li>
          <li> <a href="exportData.php?range=3"><i class="bx bx-right-arrow-alt"></i>All Data</a>
          </li>
				</ul>
      </li>
      <li>
        <a class="has-arrow" href="javascript:;">
          <div class="parent-icon"><i class="bx bx-cloud-download"></i></div>
          <div class="menu-title">Export Feed Data</div>
        </a>
        <ul>
          <li> <a href="exportFeedData.php?range=0"><i class="bx bx-right-arrow-alt"></i>Last 7 Days</a>
          </li>
          <li> <a href="exportFeedData.php?range=1"><i class="bx bx-right-arrow-alt"></i>Last 14 Days</a>
          </li>
          <li> <a href="exportFeedData.php?range=2"><i class="bx bx-right-arrow-alt"></i>Last 30 Days</a>
          </li>
          <li> <a href="exportFeedData.php?range=3"><i class="bx bx-right-arrow-alt"></i>All Data</a>
          </li>
				</ul>
      </li>
      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Something</div>
        </a>
      </li>
    </ul>
    <!--end navigation-->
  </div>
  <!--end sidebar wrapper -->
  <!--start header -->
  <header>
    <div class="topbar d-flex align-items-center">
      <nav class="navbar navbar-expand">
        <div class="mobile-toggle-menu"><i class="bx bx-menu"></i></div>
        <div
          class="title-head position-absolute top-50 start-50 translate-middle"
        >
          <h4 class="text-center">Biogas Monitoring System</h4>
        </div>
        <div class="top-menu ms-auto">
          <ul class="navbar-nav align-items-center">
            <li class="nav-item dropdown dropdown-large">
              <a
                class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <a href="javascript:;"> </a>
                <div class="header-notifications-list">
                  <a class="dropdown-item" href="javascript:;"> </a>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown dropdown-large">
              <a
                class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <div class="header-message-list">
                  <a class="dropdown-item" href="javascript:;"> </a>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="user-box dropdown">
          <a
            class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <img '.'src="'.
              $_SESSION['profilePic'].'"'
              .' class="user-img"
              alt="user avatar"
            />
            <div class="user-info ps-3">
              <p class="user-name mb-0">'.$_SESSION['first_name'] ." ". $_SESSION['last_name'].'</p>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="javascript:;"
                ><i class="bx bx-user"></i><span>Profile</span></a
              >
            </li>
            <li>
              <a class="dropdown-item" href="javascript:;"
                ><i class="bx bx-cog"></i><span>Settings</span></a
              >
            </li>
            <li>
              <div class="dropdown-divider mb-0"></div>
            </li>
            <li>
              <a class="dropdown-item" href="login_test.php"
                ><i class="bx bx-log-out-circle"></i><span>Logout</span></a
              >
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
    ';
 ?>