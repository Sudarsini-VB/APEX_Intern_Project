# Employee Management System

A **Real-World Full Stack Web Application** for managing employee records, attendance, roles, and analytics — designed to demonstrate end-to-end full-stack development skills.

Built as part of the **APEX INTERN PROJECT** – *Task 5: Real-World Full Stack Project.*

---

## Live Localhost Link

 {http://localhost/apex_intern/APEX_Intern_Project/task4/}

*(Update the link if deployed online — e.g., 000WebHost, Replit, or GitHub Pages with backend.)*

---

## 🎯 Project Objective

> Apply learned skills to develop a functional, real-world **Employee Management System** with modern features and professional UI.

### ✅ Core Goals
- Design and build a **database schema** for employees, departments, roles, and admins.  
- Implement **Authentication** (Register, Login, Forgot Password).  
- Create an **Admin Dashboard** with statistics and analytics.  
- Build full **CRUD modules** for Employees, Departments, and Tasks.  
- Enable **Search, Filters, and Pagination** for records.  
- Include **User Roles:** Admin, Manager, Employee.  
- Ensure **responsive UI**, **real-time updates**, and a **secure backend**.  

---

## 🧱 Project Phases

### 1. 🧩 Requirement Documentation
- Define **features**, **user roles**, and **use-case scenarios**.  
- Create **wireframes** using *Figma* or *Canva* for UI layout planning.  

### 2. 🗃️ Database Design
- Schema includes `users`, `employees`, `departments`, `attendance`, and `tasks`.  
- Foreign keys and indexes added for performance optimization.  
- Database name: **employee_db**

### 3. 🔐 Authentication Module
- Register, Login, Forgot Password using PHP sessions.  
- Passwords hashed for security.  

### 4. 📊 Dashboard & Admin Panel
- View statistics:
  - Total Employees  
  - Active Employees  
  - Attendance Summary  
  - Tasks Assigned per Department  
- Manage users, employees, and departments.  

### 5. ⚙️ Core Development
- Create **CRUD operations** for Employees, Departments, and Tasks.  
- Add **Search, Sort, and Pagination** to large datasets.  
- Implement **analytics** using Chart.js for visualization.  
- Responsive, interactive front-end with real-time feedback (AJAX).  

---

## 🧰 Languages & Tools Used

| Type | Technologies / Tools |
|------|----------------------|
| **Frontend** | ![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat&logo=html5&logoColor=white) ![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat&logo=css3&logoColor=white) ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat&logo=javascript&logoColor=black) |
| **Backend** | ![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white) |
| **Database** | ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white) |
| **Design & Prototyping** | ![Figma](https://img.shields.io/badge/Figma-F24E1E?style=flat&logo=figma&logoColor=white) ![Canva](https://img.shields.io/badge/Canva-00C4CC?style=flat&logo=canva&logoColor=white) |
| **Version Control** | ![Git](https://img.shields.io/badge/Git-F05032?style=flat&logo=git&logoColor=white) ![GitHub](https://img.shields.io/badge/GitHub-181717?style=flat&logo=github&logoColor=white) |
| **Deployment / Testing** | ![XAMPP](https://img.shields.io/badge/XAMPP-FB7A24?style=flat&logo=xampp&logoColor=white) ![Replit](https://img.shields.io/badge/Replit-667881?style=flat&logo=replit&logoColor=white) |
| **IDE** | ![VSCode](https://img.shields.io/badge/VS%20Code-0078D4?style=flat&logo=visualstudiocode&logoColor=white) |

---

---

## ⚙️ Setup Instructions

1. Install **XAMPP** or **WAMP**.
2. Place the project folder inside:
C:\xampp\htdocs\
3. Start **Apache** and **MySQL** services.
4. Open [phpMyAdmin](http://localhost/phpmyadmin).
5. Create a new database named `employee_db`.
6. Import the file `sql/employee_db.sql`.
7. Run the project in your browser:


---

## 📈 Dashboard Features

- **Total Employees**  
- **Active vs Inactive Employees**  
- **Attendance Analytics**  
- **Department-wise Performance Charts**  
- **Recent Tasks & Alerts**

---

---

## 📈 Dashboard Features

- **Total Employees**  
- **Active vs Inactive Employees**  
- **Attendance Analytics**  
- **Department-wise Performance Charts**  
- **Recent Tasks & Alerts**

---

## 🧠 Future Enhancements

- Integrate **Email Notifications** for employees.  
- Add **Role-Based Access Control** (RBAC).  
- Include **Export to Excel / PDF** options.  
- Build **AI Insights Dashboard** (e.g., performance prediction).  
- Deploy on a **cloud platform** (AWS / Render / Replit).  

---

## 🎥 Deliverables

- **Functional Web Application** with Admin Panel & CRUD Features  
- **GitHub Repository** (documented with screenshots & ER Diagram)  
- **10-minute Demo Video Presentation**


---

## 🧩 ER Diagram

```mermaid
erDiagram
 USERS {
     int user_id PK
     varchar username
     varchar password
     varchar role
 }

 EMPLOYEES {
     int emp_id PK
     varchar name
     varchar email
     varchar department
     varchar status
 }

 DEPARTMENTS {
     int dept_id PK
     varchar dept_name
 }

 TASKS {
     int task_id PK
     varchar task_name
     int assigned_to FK
     varchar deadline
 }

 USERS ||--o{ EMPLOYEES : manages
 DEPARTMENTS ||--o{ EMPLOYEES : includes
 EMPLOYEES ||--o{ TASKS : assigned
