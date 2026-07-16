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

.page-title {
  text-align: center;
  font-size: 26px;
  margin: 0 0 15px 0;
  color: var(--primary-dark);
  margin-left: 10px;
  font-weight: bold;
  border-bottom: 2px solid var(--primary);
  padding-bottom: 4px;
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


.header .logo {
  height: 50px;
  cursor: pointer;
  transition: transform var(--transition-speed), filter var(--transition-speed);
}

.header .logo:hover {
  transform: rotate(-3deg) scale(1.1);
  filter: brightness(1.1);
}


.content {
  margin-left: 240px;
  padding: 20px;
  animation: fadeIn 0.7s ease forwards;
}


.asset-info {
  background: #fff;
  padding: 15px;
  border: 2px solid var(--primary);
  border-radius: 6px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.asset-info h3 {
  text-align: left;
  font-size: 20px;
  margin-bottom: 15px;
  color: var(--primary-dark);
  border-bottom: 2px solid var(--primary);
  padding-bottom: 5px;
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
 

.available {
  color: green;
  font-weight: bold;
}
.available {
  color: green;
  font-weight: bold;
  text-decoration: none;
}
.available:hover {
  text-decoration: underline;
}




.top-bar-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding: 0 20px;
}


.raise-ticket-btn {
  padding: 10px 20px;
  background-color: #002366;
  color: #fff;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.raise-ticket-btn:hover {
  background-color: #00194d;
}


.search-bar-container {
  display: flex;
  align-items: center;
  justify-content: flex-end;
}


.search-form {
  display: flex;
}


.search-form input[type="text"] {
  padding: 8px 12px;
  width: 160px;
  border: 1px solid #aaa;
  border-right: none;
  border-radius: 25px 0 0 25px;
  font-size: 14px;
  background-color: #f9f9f9;
  color: #222;
  outline: none;
}

.search-form button {
  padding: 8px 10px;
  background-color: #eaeaea;
  border: 1px solid #aaa;
  border-left: none;
  border-radius: 0 25px 25px 0;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.search-form button i {
  font-size: 14px;
}

.search-form button:hover {
  background-color: #dcdcdc;
}
.asset-search-wrapper {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  margin: 20px;
}

.search-bar-container {
  display: flex;
  align-items: center;
  gap: 5px;
}

.search-bar-container input[type="text"] {
  padding: 8px 12px;
  width: 200px;
  border: 1px solid #aaa;
  border-radius: 25px;
  font-size: 14px;
  background-color: #f9f9f9;
  color: #222;
  outline: none;
}

.search-bar-container button {
  padding: 8px 10px;
  background-color: #eaeaea;
  border: 1px solid #aaa;
  border-radius: 25px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.search-bar-container button:hover {
  background-color: #dcdcdc;
}

