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
    font-family: -apple-system, BlinkMacSystemFont,"Segoe UI", Arial, sans-serif;
    background: linear-gradient(135deg, var(--accent-light), #fff);
    min-height: 100vh;
    color: var(--text-dark);
    transition: background 1s ease;
}

.content a {
  display: inline-block;
  background-color: #00194d;
  color: white;
  padding: 8px 12px;
  margin-bottom: 15px;
  text-decoration: none;
  border-radius: 4px;
}

.content a:hover {
  background-color: #00194d;
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
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    transition: background var(--transition-speed);
}

.header:hover {
    background: var(--primary-dark);
}

.header .logo {
  position: absolute;
    top: 10px;
    right: 20px;
    height: 42px;
    cursor: pointer;
    transition: transform var(--transition-speed) ease, filter var(--transition-speed);
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

.page-title {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    color: var(--primary-dark);
}

/* Buttons */
button, .btn {
    background: var(--primary);
    color: var(--text-light);
    padding: 8px 20px;
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

/* Asset Info & History */
.asset-info, .history {
    border: 2px solid var(--primary);
    padding: 15px;
    margin-bottom: 20px;
    background: #fff;
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform var(--transition-speed), box-shadow var(--transition-speed);
}

.asset-info:hover, .history:hover {
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.asset-info h3, .history h3 {
    margin: 0 0 10px;
    color: var(--primary);
}

.info-row {
    display: flex;
    justify-content: flex-start;
    gap: 150px;
}


table {
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
}

th {
    background: var(--accent-light);
    color: var(--primary-dark);
}

tr:hover {
    background: rgba(0, 25, 77, 0.05);
}


:root {
  --primary: #002366;
  --transition-speed: 0.3s;
}

.form-container {
  width: 80%;
  margin: 40px auto;
  padding: 30px;
  background-color: #ffffff;
  border: 5px solid #6b7c9bff; 
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
.form-container form {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
}

.form-container .form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 5px;
}

.form-container .form-group:nth-child(6) {
  grid-column: span 2;
}

.form-container .form-group input,
.form-container .form-group select,
.form-container .form-group textarea {
  padding: 10px;
  border: 1.5px solid #999;
  border-radius: 4px;
  font-size: 14px;
  background-color: #f9f9f9;
  color: #000;
  text-align: left;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
  box-sizing: border-box;
}

.form-container .form-group input:focus,
.form-container .form-group select:focus,
.form-container .form-group textarea:focus {
  outline: none;
  border: 1.5px solid var(--primary);
  box-shadow: 0 0 4px rgba(0, 35, 102, 0.4);
}



@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity: 1;}
}

@keyframes gradientScroll {
    0% {background-position: 0% 50%;}
    100% {background-position: 100% 50%;}
}       this is my old css now combain 


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
  font-size: 26px;
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


.content {
  margin-left: 240px; /* ensure content stays clear */
    padding: 50px;
  animation: fadeIn 0.7s ease forwards;
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
  box-shadow: 0 0 5px rgba(0, 35, 102, 0.1);
  outline: none;
}


.ticket-box {
  background-color: #fff;
  padding: 25px;
  max-width: 800px;
  margin: auto;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.ticket-box h2 {
  text-align: center;
  margin-bottom: 20px;
  color: var(--primary-dark);
}


.ticket-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.input-box {
  display: flex;
  flex-direction: column;
}

.input-box label {
  margin-bottom: 5px;
  font-weight: bold;
  color: var(--text-dark);
}

.input-box input,
.input-box select,
.input-box textarea {
  padding: 8px;
  border-radius: 4px;
  border: 1px solid #ccc;
  font-size: 14px;
  background-color: #f9f9f9;
  color: #333;
  transition: border-color var(--transition-speed), box-shadow var(--transition-speed);
}

.input-box input:focus,
.input-box select:focus,
.input-box textarea:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 5px rgba(0, 35, 102, 0.3);
}

.description-box {
  grid-column: span 2;
}

/* Buttons */
.btn-group {
  text-align: center;
  margin-top: 30px;
}

.btn-group button {
  padding: 10px 20px;
  margin: 0 10px;
  border: none;
  background-color: var(--primary);
  color: white;
  border-radius: 5px;
  cursor: pointer;
  font-size: 14px;
  transition: background var(--transition-speed), transform var(--transition-speed);
}

.btn-group button:hover {
  background-color: var(--primary-dark);
  transform: translateY(-2px);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.btn-group button:active {
  transform: scale(0.95);
}


.asset-info,
.history {
  border: 2px solid var(--primary);
  padding: 15px;
  margin-bottom: 20px;
  background: #fff;
  border-radius: 6px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform var(--transition-speed), box-shadow var(--transition-speed);
}

.asset-info:hover,
.history:hover {
  transform: scale(1.01);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.asset-info h3,
.history h3 {
  margin: 0 0 10px;
  color: var(--primary);
}

/* Table Styles */
table {
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
}

th {
  background: var(--accent-light);
  color: var(--primary-dark);
}

tr:hover {
  background: rgba(0, 25, 77, 0.05);
}

.asset-edit-page {
  background-color: rgba(247, 248, 252, 0.95);
  margin-left: 200px; /* To account for sidebar */
  min-height: calc(100vh - 60px); /* Adjusting for header height */
  padding: 40px;
}

.asset-edit-page .form-card {
  max-width: 250px;
  margin: auto;
  padding: 70px;
  background-color: white; 
  border: 5px solid #00205B;
  border-radius: 5px;
  
}

.asset-edit-page input[type="text"],
.asset-edit-page input[type="date"] {
  width: 100%;
  padding: 12px;
  margin-bottom: 20px;
  background-color: #00205B;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  text-align: left;
  color: var(--primary);
}

.asset-edit-page input[type="text"]::placeholder,
.asset-edit-page input[type="date"]::placeholder {
  color: white;
  font-weight: bold;
}

.asset-edit-page .button-group {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-top: 20px;
}

.asset-edit-page .btn {
  background-color: #00205B;
  color: white;
  padding: 10px 30px;
  font-weight: bold;
  border: none;
  cursor: pointer;
  border-radius: 4px;
  transition: 0.3s;
}

.asset-edit-page .btn:hover {
  background-color: #00194d;
}
 .asset-edit-page label {
  color: #00205B;
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}


.asset-edit-page input[type="date"] {
  background-color: #00205B;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  padding: 12px;
}


.asset-edit-page input[type="date"]::placeholder {
  color: white;
  opacity: 1;
}


.asset-edit-page input[type="date"]::-webkit-calendar-picker-indicator {
  filter: invert(1);  /* inverts black icon to white */
  cursor: pointer;
}
 .asset-edit-page input[readonly] {
  background-color: #00194d;  /* or keep as-is */
  color: white;
  font-weight: bold;
  border: 1px solid #ccc;
  padding: 8px;
  border-radius: 4px;
}



@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes gradientScroll {
  0% {background-position: 0% 50%;}
  100% {background-position: 100% 50%;}
}



.form-container {
  background-color: #fff;
  padding: 25px;
  max-width: 800px;
  margin: auto;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(78, 75, 75, 0.96);
}

.form-container form {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.form-container .form-group {
  display: flex;
  flex-direction: column;
}

.form-container .form-group:nth-child(6) {
  grid-column: span 2; 
}

.form-container .form-group label {
  margin-bottom: 5px;
  font-weight: bold;
  color: var(--text-dark);
}

.form-container .form-group input,
.form-container .form-group select,
.form-container .form-group textarea {
  padding: 8px;
  border-radius: 4px;
  border: 1px solid #ccc;
  font-size: 14px;
  background-color: #f9f9f9;
  color: #333;
  transition: border-color var(--transition-speed), box-shadow var(--transition-speed);
}

.form-container .form-group input:focus,
.form-container .form-group select:focus,
.form-container .form-group textarea:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 5px rgba(241, 242, 244, 0.97);
}


.form-container .btn {
  grid-column: span 1;
  justify-self: center;
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


.search-bar-container input[type="text"] {
  padding: 8px 12px;
  width: 200px;
  border: 1px solid #aaa;
  border-right: none;
  border-radius: 25px 0 0 25px;
  font-size: 14px;
  background-color: #f9f9f9;
  color: #222;
  outline: none;
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




.form-footer-center {
  display: flex;
  justify-content: center;   
  align-items: center;
  gap: 250px;                
  margin-top: 20px;
  grid-column: span 2;
}

.form-footer-center .btn {
  padding: 10px 20px;
  font-weight: bold;
  background-color: var(--primary);
  color: var(--text-light);
  border: none;
  border-radius: 4px;
  transition: background 0.3s ease;
  cursor: pointer;
}

.form-footer-center .btn:hover {
  background-color: var(--primary-dark);
}