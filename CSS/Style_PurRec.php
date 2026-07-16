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
  font-size: 28px;
  justify-content: space-between;
  padding: 0 20px;
}


.page-title {
  text-align: center;       
  font-size: 28px;
  margin: 0 auto 15px auto;  
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
  margin-left: 220px;
  width: calc(100% - 220px);
  padding: 50px;
  box-sizing: border-box;
  animation: fadeIn 0.7s ease forwards;
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
  background: #fff;
  table-layout: fixed;
  word-wrap: break-word;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
  word-break: break-word;
}

th {
  background: var(--accent-light);
  color: var(--primary-dark);
}

tr:hover {
  background: rgba(0, 25, 77, 0.05);
}


.top-bar-wrapper {
  margin-left: 220px;
  width: calc(100% - 220px);
  box-sizing: border-box;
  padding: 0 20px;
}

.top-bar-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  margin-left: 220px;
  width: calc(100% - 220px);
  box-sizing: border-box;
  flex-wrap: wrap;
  gap: 10px;
}

.left-buttons {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

.btn-export,
.btn-add {
  padding: 10px 20px;
  min-width: 130px;
  text-align: center;
  background-color: var(--primary);
  color: var(--text-light);
  border: none;
  border-radius: 25px;
  cursor: pointer;
  font-weight: bold;
  text-decoration: none;
  transition: background-color var(--transition-speed), transform 0.2s ease, box-shadow 0.2s ease;
}

.btn-export:hover,
.btn-add:hover {
  background-color: var(--primary-dark);
  transform: translateY(-2px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}


.search-bar-style {
  display: flex;
  align-items: center;
  background-color: #fefefe;
  border-radius: 30px;
  border: 1px solid #ccc;
  padding: 5px 10px;
  width: 260px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
}

.search-bar-style input[type="text"] {
  flex: 1;
  border: none;
  outline: none;
  background: transparent;
  padding: 8px 12px;
  font-size: 14px;
  color: #333;
  border-radius: 30px;
}

.search-bar-style button {
  background-color: #f0f0f0;
  border: none;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.3s;
}

.search-bar-style button:hover {
  background-color: #ddd;
}


.right-buttons {
  display: flex;
  gap: 10px;
}


.table-wrapper {
  margin-left: 220px;
  width: calc(100% - 220px);
  height: calc(100vh - 160px); 
  overflow-y: auto;  
  overflow-x: hidden; 
  box-sizing: border-box;
  padding: 20px;
  position: relative;
}


@media (max-width: 768px) {
  .top-bar-container {
    flex-direction: column;
    align-items: stretch;
    gap: 10px;
  }

  .left-buttons,
  .search-bar-container {
    justify-content: center;
  }

  .top-bar-wrapper,
  .table-wrapper,
  .content {
    margin-left: 0;
    width: 100%;
  }

  .sidebar {
    display: none;
  }

  .header {
    margin-left: 0;
    width: 100%;
  }
}
.search-wrapper {
  display: flex;
  align-items: center;
  gap: 5px;
  background-color: transparent;
}

.search-wrapper input[type="text"] {
  padding: 10px 15px;
  border: 1px solid #ccc;
  border-radius: 25px;
  font-size: 14px;
  width: 250px;
  outline: none;
  transition: border 0.3s;
}

.search-wrapper input[type="text"]:focus {
  border-color: #888;
}

.search-wrapper button {
  background-color: #e0e0e0;
  border: 1px solid #ccc;
  border-radius: 50%;
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background-color 0.3s;
}

.search-wrapper button:hover {
  background-color: #ccc;
}