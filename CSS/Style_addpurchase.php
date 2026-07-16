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
  font-size: 24px;
  margin-bottom: 20px;
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

.content {
  margin-left: 240px;
  padding: 20px;
  animation: fadeIn 0.7s ease forwards;
  overflow-x: auto;
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
  max-width: 100%;
}

#purchaseTable {
  min-width: 1200px;
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
  font-size: 14px;
  background: #fff;
  border-collapse: collapse;
  width: max-content;
  overflow-x: auto;
}

#purchaseTable th, #purchaseTable td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
  white-space: nowrap;
}

#purchaseTable thead th {
  position: sticky;
  top: 0;
  background: #f9f9f9;
  z-index: 2;
}

#purchaseTable tbody td:nth-child(-n+7),
#purchaseTable thead th:nth-child(-n+7) {
  position: sticky;
  left: 0;
  background: #fff;
  z-index: 1;
}


#purchaseTable td:nth-child(2),
#purchaseTable th:nth-child(2) {
  min-width: 180px;
  max-width: 220px;
}

#purchaseTable td:nth-child(3),
#purchaseTable th:nth-child(3) {
  min-width: 150px;
  max-width: 200px;
}

#purchaseTable td:nth-child(4),
#purchaseTable th:nth-child(4) {
  min-width: 140px;
  max-width: 180px;
}

#purchaseTable td:nth-child(5),
#purchaseTable th:nth-child(5) {
  min-width: 140px;
  max-width: 180px;
}

#purchaseTable td:nth-child(6),
#purchaseTable th:nth-child(6) {
  min-width: 140px;
  max-width: 180px;
}

#purchaseTable td:nth-child(7),
#purchaseTable th:nth-child(7) {
  min-width: 140px;
  max-width: 180px;
}

#purchaseTable th:nth-child(7),
#purchaseTable td:nth-child(7) {
  position: sticky;
  left: 920px; /* or appropriate sum of column widths */
  z-index: 2;
  background: #fff;
  min-width: 140px;
}


input[type="text"], input[type="number"], input[type="date"], select {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 14px;
  width: 100%;
  min-width: 120px;
  max-width: 300px;
  box-sizing: border-box;
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
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes gradientScroll {
  0% { background-position: 0% 50%; }
  100% { background-position: 100% 50%; }
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

.date-picker-wrapper {
  position: relative;
  display: inline-block;
}

.date-picker-wrapper input {
  padding-right: 30px; 
}

.calendar-icon {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 18px;
  pointer-events: none; 
}


.capitalize-input {
  text-transform: capitalize;
}


.table-scroll {
  overflow: auto;
  max-height: 500px; 
  border: 1px solid #ddd;
  position: relative;
}


#purchaseTable thead th {
  position: sticky;
  top: 0;
  z-index: 5;
  background: #f9f9f9;
}


#purchaseTable th:first-child,
#purchaseTable td:first-child {
  position: sticky;
  left: 0;
  z-index: 4;
  background: #fff;
}


#purchaseTable th:nth-child(2),
#purchaseTable td:nth-child(2) {
  position: sticky;
  left: 180px; 
  z-index: 3;
  background: #fff;
}
#purchaseTable th:nth-child(1),
#purchaseTable td:nth-child(1) {
  position: sticky;
  left: 0;
  z-index: 2;
  background: #fff;
  min-width: 180px;
}

#purchaseTable th:nth-child(2),
#purchaseTable td:nth-child(2) {
  position: sticky;
  left: 180px;
  z-index: 2;
  background: #fff;
  min-width: 160px;
}

#purchaseTable th:nth-child(3),
#purchaseTable td:nth-child(3) {
  position: sticky;
  left: 340px;
  z-index: 2;
  background: #fff;
  min-width: 160px;
}

#purchaseTable th:nth-child(4),
#purchaseTable td:nth-child(4) {
  position: sticky;
  left: 500px;
  z-index: 2;
  background: #fff;
  min-width: 140px;
}

#purchaseTable th:nth-child(5),
#purchaseTable td:nth-child(5) {
  position: sticky;
  left: 640px;
  z-index: 2;
  background: #fff;
  min-width: 140px;
}

#purchaseTable th:nth-child(6),
#purchaseTable td:nth-child(6) {
  position: sticky;
  left: 780px;
  z-index: 2;
  background: #fff;
  min-width: 140px;
}

 

#purchaseTable th:nth-child(1),
#purchaseTable td:nth-child(1) {
  position: sticky;
  left: 0;
  z-index: 2;
}

#purchaseTable th:nth-child(2),
#purchaseTable td:nth-child(2) {
  position: sticky;
  left: 180px;
  z-index: 2;
}


