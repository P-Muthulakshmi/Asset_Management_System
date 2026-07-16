<?php
header("Content-type: text/css");
?>
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

.sidebar a:hover,
.sidebar a.active {
  background-color: var(--accent-light);
  color: var(--primary);
  font-weight: bold;
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




.page-title {
  text-align: center;       
  margin: 0 auto 15px auto;   
  color: var(--primary-dark);
  font-weight: bold;
  border-bottom: 2px solid var(--primary);
  padding-bottom: 30px;
  
}

.content {
  grid-area: content;
  margin-left: 220px;
  padding: 20px;
  overflow-y: auto;
}
/* Required asterisk */
.required {
  color: red;
  font-weight: bold;
}

/* Main Content Area */
.asset-assign-page {
  margin-left: 240px;
  padding: 20px;
  animation: fadeIn 0.7s ease forwards;
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

.form-container {
    background-color: #fff;
    padding: 25px;
    max-width: 800px;
    margin: auto;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(78, 75, 75, 0.96);
}
form {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

form .form-group {
  display: flex;
  flex-direction: column;
}

form .form-group label {
  font-weight: bold;
  margin-bottom: 5px;
  text-align: left;
  color: #002366;
}

form .form-group input,
form .form-group select,
form .form-group textarea {
  padding: 8px 12px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background: #f9f9f9;
}

form .form-group textarea {
  resize: vertical;
  min-height: 60px;
}


form .description-box {
  grid-column: span 2;
}


.form-footer {
  grid-column: span 2;
  display: flex;
  justify-content: center;
  gap: 20px;
}

.btn {
  padding: 10px 20px;
  background-color: #002366;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background 0.3s, transform 0.2s;
}

.btn:hover {
  background: #00194d;
  transform: translateY(-1px);
}

.btn:active {
  transform: scale(0.98);
}


textarea {
  text-transform: capitalize;
}
input[type="text"],
textarea,
select {
  text-transform: capitalize;
}