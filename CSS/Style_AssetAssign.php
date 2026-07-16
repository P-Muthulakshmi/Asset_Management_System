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
  text-align: left;
  font-size: 22px;
  margin: 0 0 15px 0;
  color: var(--primary-dark);
  margin-left: 10px;
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


.page-title {
  text-align: center;        
  font-size: 26px;
  margin: 0 auto 15px auto;  
  color: var(--primary-dark);
  font-weight: bold;
  border-bottom: 2px solid var(--primary);
  padding-bottom: 4px;
  
}

.content {
  grid-area: content;
  margin-left: 220px;
  padding: 20px;
  overflow-y: auto;
}
.required {
  color: red;
  font-weight: bold;
}



.asset-assign-page {
  margin-left: 240px;
  padding: 20px;
  animation: fadeIn 0.7s ease forwards;
}


.form-card {
  background-color: #fff;
  max-width: 350px;
  margin: 40px auto;
  padding: 25px;
  border: 4px solid var(--primary);
  border-radius: 8px;
  font-size: 16px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: box-shadow var(--transition-speed), transform var(--transition-speed);
}

.form-card:hover {
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
  transform: scale(1.01);
}

form {
  display: grid;
  grid-template-columns: 1fr;
  gap: 15px;
  justify-items: center; /* center elements */
  
}

.form-card label,
.form-card input,
.form-card select,
.form-card button {
  font-size: 16px;
  
}

form label {
  font-weight: bold;
  color: var(--primary);
  font-size: 16px;
  text-align: left;
  width: 250px; /* align label nicely */
}

form input[type="text"],
form input[type="date"],
form select {
  width: 300px;
  max-width: 90%;
  padding: 8px;
  font-size: 16px;
  border: 2px solid #ccc;        
  border-radius: 5px;
  background: #f9f9f9;
  color: #333;
  border: 2px solid var(--primary);
  transition: background var(--transition-speed), transform var(--transition-speed), border-color 0.3s ease;
  box-sizing: border-box;
}

form input:focus,
form select:focus {
  outline: none;
  border: 2px solid var(--primary);
  background: #fff;
  box-shadow: 0 0 5px rgba(0, 35, 102, 0.3);
}

.button-group {
  display: flex;
  justify-content: center;
  gap: 20px;
  font-size: 16px;
  margin-top: 10px;
}

.button-group button {
  flex: 1;
  padding: 8px 20px;
  border: none;
  background: var(--primary);
  color: var(--text-light);
  cursor: pointer;
  border-radius: 4px;
  font-size: 14px;
  transition: all var(--transition-speed);
}

.button-group button:hover {
  background: var(--primary-dark);
  transform: translateY(-2px);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.button-group button:active {
  transform: scale(0.95);
}


@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}


form {
  display: flex;
  flex-direction: column;
  gap: 15px;
  align-items: center; 
}

.form-group {
  width: 100%;
  max-width: 400px;
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.form-group label {
  font-weight: bold;
  color: var(--primary);
  font-size: 16px;
}

.form-group input,
.form-group select {
  width: 300px;
  max-width: 90%;
  padding: 8px;
  font-size: 16px;
  border: 2px solid var(--primary);        
  border-radius: 5px;
  background: #f9f9f9;
  color: #333;
  transition: background var(--transition-speed), transform var(--transition-speed), border-color 0.3s ease;
  box-sizing: border-box;
}

.form-group input:focus,
.form-group select:focus {
  border: 2px solid var(--primary);  
  background: #fff;
  box-shadow: 0 0 5px rgba(0, 35, 102, 0.1);
  outline: none;
}