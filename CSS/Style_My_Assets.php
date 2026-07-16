<?php header("Content-type: text/css"); ?>
:root {
  --primary-dark: #00194d;
  --primary: #002366;
  --accent-light: #e9f0fb;
  --text-dark: #222;
  --text-light: #fff;
  --transition-speed: 0.3s;
}

body {
  margin: 0;
  font-family: "Segoe UI", Arial, sans-serif;
  background: linear-gradient(135deg, var(--accent-light), #fff);
  min-height: 100vh;
  color: var(--text-dark);
}

/* Sidebar container */
.sidebar {
  width: 220px;
  height: 100vh;
  background-color: #002366; /* navy blue */
  color: #fff;
  position: fixed;
  font-weight: bold;
  left: 0;
  top: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 20px;
  font-size: 18px;
  font-family: Arial, sans-serif;
}

/* Welcome message */
.sidebar p {
  margin-bottom: 20px;
  font-size: 18px; /* slightly bigger */
  color: #fff;     /* pure white */
  text-align: center;
  line-height: 1.4;
}

.sidebar a {
  display: block;
  width: 85%; /* only occupy 85% of sidebar width */
  padding: 12px 20px;
  margin: 5px 0;
  text-decoration: none;
  color: #fff;
  font-size: 16px;
  padding-left: 30px;
  padding-right: 10px;
  border-radius: 25px 0 0 25px; /* smooth left curve */
  transition: all 0.3s ease;
  margin-left: auto; /* pushes it away from left edge a little */
  margin-right: 0;   /* keeps it aligned to right edge of the sidebar container */
}

/* Active & hover */
.sidebar a:hover,
.sidebar a.active {
  background-color: #e6ebfa;
  color: #002366;
  font-weight: bold;
  font-size: 18px;
}


.header {
  background-color: var(--primary);
  color: var(--text-light);
  margin-left: 200px;
  position: relative;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
  display: flex;
  align-items: center;
  height: 80px;
  font-size: 24px;
  justify-content: space-between;
  padding: 0 20px;
}

/* Page Title */
.page-title {
  text-align: center;         /* Center it horizontally */
  font-size: 26px;
  margin: 0 auto 15px auto;   /* top, horizontal auto, bottom */
  color: var(--primary-dark);
  font-weight: bold;
  border-bottom: 2px solid var(--primary);
  padding-bottom: 4px;
  
}

.header .logo {
  height: 50px;
  cursor: pointer;
  transition: transform var(--transition-speed), filter var(--transition-speed);
}

.header .logo:hover {
  transform: rotate(-3deg) scale(1.1);
  filter: brightness(1.1);
}

/* Content */
.content {
  margin-left: 220px;
  padding: 20px;
  animation: fadeIn 0.7s ease forwards;
}


table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
  background: #fff;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
}

th {
  background: var(--accent-light);
  color: var(--primary-dark);
}

tr:hover {
  background: rgba(0, 25, 77, 0.05);
}


td:empty::after {
  content: "-";
  color: #bbb;
}


@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}
 
.top-bar-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding: 0 20px;
}