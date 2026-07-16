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
  transition: background 1s ease;
}


.sidebar {
  width: 220px;
  height: 100vh;
  background-color: #002366; 
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


.sidebar p {
  margin-bottom: 20px;
  font-size: 18px; 
  color: #fff;     
  text-align: center;
  line-height: 1.4;
}

.sidebar a {
  display: block;
  width: 85%; 
  padding: 12px 20px;
  margin: 5px 0;
  text-decoration: none;
  color: #fff;
  font-size: 16px;
  padding-left: 30px;
  padding-right: 10px;
  border-radius: 25px 0 0 25px; 
  transition: all 0.3s ease;
  margin-left: auto; 
  margin-right: 0;  
}


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
  padding: 10px 20px;
  font-weight: bold;
  font-size: 22px;
  margin-left: 200px;
  position: relative;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
  transition: background var(--transition-speed);
}

.header .logo {
  height: 50px;
  margin-left: auto;
  cursor: pointer;
  transition: transform var(--transition-speed), filter var(--transition-speed);
}

.header .logo:hover {
  transform: rotate(-3deg) scale(1.1);
  filter: brightness(1.1);
}

.header:hover {
  background: var(--primary-dark);
}


.content {
  margin-left: 240px;
  padding: 20px;
  animation: fadeIn 0.7s ease forwards;
  overflow-x: auto;
}

.content #purchaseTable {
  margin-top: 80px; /* adjust as needed */
}


.page-title {
  text-align: center;
  font-size: 24px;
  margin-bottom: 20px;
  color: var(--primary-dark);
}


button, .btn {
  background: var(--primary);
  color: var(--text-light);
  padding: 8px 16px;
  border: none;
  margin: 5px;
  cursor: pointer;
  border-radius: 4px;
  font-size: 14px;
  transition: all var(--transition-speed) ease;
}

button:hover, .btn:hover {
  background: var(--primary-dark);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  transform: translateY(-2px);
}

button:active {
  transform: scale(0.95);
}

.buttons {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 20px;
}

.table-wrapper {
  overflow-x: auto;
}

#purchaseTable {
  min-width: 1300px;
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
  font-size: 14px;
  background: #fff;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
  overflow: auto;
  max-width: 180px;
  white-space: nowrap;
}

th {
  background: var(--accent-light);
  color: var(--primary-dark);
}

tr:hover {
  background: rgba(0, 25, 77, 0.05);
}


input[type="text"],
input[type="number"],
input[type="date"],
select {
  padding: 6px 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 13px;
  width: 100%;
  min-width: 100px;
  max-width: 180px;
  box-sizing: border-box;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}


.summary {
  display: flex;
  justify-content: center;
  gap: 30px;
  margin-top: 20px;
  font-weight: bold;
  color: var(--primary-dark);
}

.summary label {
  display: flex;
  align-items: center;
  gap: 5px;
}

.summary input {
  width: 100px;
  text-align: right;
  background: #f9f9f9;
}


@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes gradientScroll {
  0% {background-position: 0% 50%;}
  100% {background-position: 100% 50%;}
}


@media(max-width: 768px) {
  .content {
    margin-left: 0;
  }
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .header {
    margin-left: 0;
  }
  .buttons {
    justify-content: center;
  }
}

.medium-input {
  width: 150px;
  min-width: 120px;
  max-width: 200px;
}

.buttons .medium-input {
  width: 150px;
}


#purchaseTable th.sticky,
#purchaseTable td.sticky {
  position: sticky;
  background: #fff;
  z-index: 2;
}

#purchaseTable th.sticky-1, #purchaseTable td.sticky-1 { left: 0; z-index: 3; }
#purchaseTable th.sticky-2, #purchaseTable td.sticky-2 { left: 100px; }
#purchaseTable th.sticky-3, #purchaseTable td.sticky-3 { left: 200px; }
#purchaseTable th.sticky-4, #purchaseTable td.sticky-4 { left: 300px; }
#purchaseTable th.sticky-5, #purchaseTable td.sticky-5 { left: 400px; }
#purchaseTable th.sticky-6, #purchaseTable td.sticky-6 { left: 500px; }
#purchaseTable th.sticky-7, #purchaseTable td.sticky-7 { left: 600px; }

#purchaseTable th.sticky, #purchaseTable td.sticky {
  border-right: 1px solid #ccc;
}


.action-bar {
  position: sticky;
  top: 0;
  right: 0;
  z-index: 10;
  padding: 10px;
  text-align: right;
  border-bottom: 1px solid #ddd;
}

.action-bar .btn {
  margin-right: 9px;
}

.action-bar-fixed {
  position: fixed;
  top: 140px; /* adjust depending on your header height */
  right: 10px;
  z-index: 1000;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}


.page-title {
  text-align: center;         
  font-size: 26px;
  margin: 0 auto 15px auto;   
  
  color: var(--primary-dark);
  font-weight: bold;
  border-bottom: 2px solid var(--primary);
  padding-bottom: 4px;
  
}
.required {
  color: red;
  font-weight: bold;
}