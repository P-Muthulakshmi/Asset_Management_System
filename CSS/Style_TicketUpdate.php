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
  background: #f5f7fb;
  color: var(--text-dark);
  display: grid;
  grid-template-columns: 220px 1fr;
  grid-template-rows: 60px 1fr;
  grid-template-areas:
    "sidebar header"
    "sidebar content";
  height: 100vh;
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

.header::before {
  content: "Ticket Update Portal";
}


.content {
  grid-area: content;
  margin-left: 220px;
  padding: 20px;
  overflow-y: auto;
}

/* Ticket Box */
.ticket-box {
  background: #fff;
  max-width: 800px;
  margin: auto;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  border: 1px solid var(--accent-light);
  transition: transform 0.3s, box-shadow 0.3s;
}

.ticket-box:hover {
  transform: scale(1.01);
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.ticket-box h2 {
  text-align: center;
  color: var(--primary-dark);
  margin-bottom: 20px;
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
  margin-bottom: 4px;
  font-weight: 600;
  color: var(--primary);
}

.input-box input,
.input-box select,
.input-box textarea {
  padding: 8px 10px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background: #fff;
  color: #333;
  transition: border-color 0.3s, box-shadow 0.3s;
}

.input-box input:focus,
.input-box select:focus,
.input-box textarea:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 4px rgba(0, 35, 102, 0.3);
}

textarea {
  resize: none;
}


.btn-group {
  text-align: center;
  margin-top: 25px;
}

.btn-group button {
  background: var(--primary);
  color: var(--text-light);
  border: none;
  padding: 8px 20px;
  margin: 0 10px;
  font-size: 14px;
  border-radius: 4px;
  cursor: pointer;
  transition: background 0.3s, transform 0.3s;
}

.btn-group button:hover {
  background: var(--primary-dark);
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.btn-group button:active {
  transform: scale(0.95);
}


@media (max-width: 768px) {
  body {
    grid-template-columns: 1fr;
    grid-template-rows: 60px auto;
    grid-template-areas:
      "header"
      "content";
  }

  .sidebar {
    display: none;
  }

  .content {
    margin-left: 0;
  }

  .ticket-grid {
    grid-template-columns: 1fr;
  }
}
