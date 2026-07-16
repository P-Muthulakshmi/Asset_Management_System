<?php header("Content-type: text/css"); ?>

:root {
  --primary-color: #4a90e2;
  --primary-color-hover: #357ABD;
  --background-overlay: rgba(255, 255, 255, 0.92);
  --shadow-color: rgba(0, 0, 0, 0.3);
  --font-family: Arial, sans-serif;
  --container-width: 350px;
  --container-padding: 30px;
}

body {
  margin: 0;
  padding: 0;
  font-family: var(--font-family);
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(
        rgba(0, 0, 0, 0.4),
        rgba(0, 0, 0, 0.4)
      ),
      url('../Images/Login2.jpg') center/cover no-repeat fixed;
}

.login-wrapper {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.outside-text {
  font-size: 28px;
  font-family: 'Dancing Script', cursive;
  color: #f9f9f9;
  text-align: center;
  margin-bottom: 60px;
  text-shadow: 1px 1px 3px rgba(246, 242, 242, 0.99);
}

.login-container,
.forgot-container {
  width: var(--container-width);
  max-width: 90%;
  padding: var(--container-padding);
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.3);
  backdrop-filter: blur(10px) saturate(180%);
  -webkit-backdrop-filter: blur(10px) saturate(180%);
  border-radius: 12px;
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
  text-align: center;
  position: relative;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  margin-bottom: 20px;
}

.login-container:hover,
.forgot-container:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px var(--shadow-color);
}

.logo h3 {
  color: #fff;
  font-family: 'Poppins', cursive;
  font-size: 20px;
  text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
  margin-top: 10px;
}

.logo img {
  margin-bottom: 10px;
  max-width: 80px;
}

.title {
  font-size: 22px;
  margin-bottom: 20px;
  color: white;
  font-weight: bold;
}

.form-group {
  text-align: left;
  margin: 10px 0;
}

.form-group label {
  display: block;
  font-weight: bold;
  color: white;
  font-size: 15px;
  margin-bottom: 5px;
}

.required {
  color: red;
  margin-left: 2px;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 5px;
  border: 1px solid #ccc;
  border-radius: 6px;
  box-sizing: border-box;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input[type="text"]:focus,
input[type="password"]:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 5px var(--primary-color);
  outline: none;
}

.forgot-password {
  text-align: right;
  margin-bottom: 10px;
}

.forgot-password a {
  font-size: 14px;
  color: #f9f9f9;
  text-decoration: none;
}

.forgot-password a:hover {
  color: #ddd;
  text-decoration: underline;
}

.submit-btn,
.btn {
  background-color: var(--primary-color);
  color: white;
  border: none;
  padding: 10px 18px;
  font-size: 16px;
  border-radius: 6px;
  cursor: pointer;
  margin-top: 10px;
  transition: background-color 0.3s ease, transform 0.2s ease;
  width: auto;
  min-width: 80px;
}

.submit-btn:hover,
.btn:hover {
  background-color: var(--primary-color-hover);
  transform: scale(1.02);
}

.btn-group {
  display: flex;
  justify-content: space-between;
  gap: 10px;
  margin-top: 15px;
}

.error,
.error-msg {
  color: red;
  font-size: 14px;
  margin: 5px 0;
}

.success-msg {
  color: limegreen;
  font-size: 14px;
  margin: 5px 0;
}

@media (max-width: 768px) {
  .login-container,
  .forgot-container {
    width: 90%;
  }
}

@media (max-width: 480px) {
  .title {
    font-size: 18px;
  }
  .submit-btn,
  .btn {
    font-size: 14px;
  }
  .logo img {
    max-width: 60px;
  }
}
.password-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.password-wrapper input {
    width: 100%;
    padding-right: 40px;
}

.toggle-password {
    position: absolute;
    right: 10px;
    cursor: pointer;
    font-size: 20px;
    color: #333;
}