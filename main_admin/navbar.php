<style>
    /*
    DEMO STYLE
*/
    @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";


    body {
        font-family: 'Poppins', sans-serif;
        background: #fafafa;
    }

    p {
        font-family: 'Poppins', sans-serif;
        font-size: 1.1em;
        font-weight: 300;
        line-height: 1.7em;
        color: #999;
    }

    a,
    a:hover,
    a:focus {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s;
    }

    .navbar {
        padding: 15px 10px;
        background: rgb(39, 58, 74);
        border: none;
        border-radius: 0;
        margin-bottom: 40px;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .navbar-btn {
        box-shadow: none;
        outline: none !important;
        border: none;
    }

    .line {
        width: 100%;
        height: 1px;
        border-bottom: 1px dashed #ddd;
        margin: 40px 0;
    }

    /* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */
    .wrapper {
        display: flex;
        align-items: stretch;
    }

    #sidebar {
        min-width: 250px;
        max-width: 250px;
        background-color: rgb(39, 58, 74);
        color: #fff;
        transition: all 0.3s;
    }

    #sidebar.active {
        margin-left: -250px;
    }

    #sidebar .sidebar-header {
        padding: 20px;
        background: rgb(39, 58, 74);
    }

    #sidebar ul.components {
        padding: 20px 0;
        border-bottom: 1px solid #47748b;
    }

    #sidebar ul p {
        color: #fff;
        padding: 10px;
    }

    #sidebar ul li a {
        padding: 10px;
        font-size: 1.1em;
        display: block;
    }

    #sidebar ul li a:hover {
        color: black;
        background: #fff;
    }

    #sidebar ul li.active>a,
    a[aria-expanded="true"] {
        color: #fff;
        background: #6d7fcc;
    }


    a[data-toggle="collapse"] {
        position: relative;
    }

    a[aria-expanded="false"]::before,
    a[aria-expanded="true"]::before {
        content: '\e259';
        display: block;
        position: absolute;
        right: 20px;
        font-family: 'Glyphicons Halflings';
        font-size: 0.6em;
    }

    a[aria-expanded="true"]::before {
        content: '\e260';
    }


    ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
        background: rgb(39, 58, 74);
    }

    ul.CTAs {
        padding: 20px;
    }

    ul.CTAs a {
        text-align: center;
        font-size: 0.9em !important;
        display: block;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    a.download {
        background: #fff;
        color: rgb(39, 58, 74);
    }

    a.article,
    a.article:hover {
        background: rgb(39, 58, 74) !important;
        color: #fff !important;
    }



    /* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */
    #content {
        padding: 20px;
        min-height: 100vh;
        transition: all 0.3s;
    }

    /* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */
    @media (max-width: 768px) {
        #sidebar {
            margin-left: -250px;
        }

        #sidebar.active {
            margin-left: 0;
        }

        #sidebarCollapse span {
            display: none;
        }

    }
</style>
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Vatan Textiles Ltd.</h3>
    </div>

    <ul class="list-unstyled components">
        <p>Main Admin</p>

        <li>
            <a href="dash.php"><i class="fas fa-angle-right" style="width: 25px;"></i>

                Dashboard</a>
        </li>
        <li>
            <a href="addAdmin.php"><i class="fas fa-angle-right" style="width: 25px;"></i>
                Add Sub Admins</a>
        </li>
        <li>
            <a href="listadmin.php"><i class="fas fa-angle-right" style="width: 25px;"></i>
                List of Sub Admins</a>
        </li>
        <li>
            <a href="list_emp.php"><i class="fas fa-angle-right" style="width: 25px;"></i>
                List of Employees</a>
        </li>
        <li>
            <a href="change_shift.php"><i class="fas fa-angle-right" style="width: 25px;"></i>
                Change Shift of worker</a>
        </li>
        <li>
            <a href="leave_approval.php"><i class="fas fa-angle-right" style="width: 25px;"></i>
                Approve Leaves</a>
        </li>
        <li>
            <a href="buffer.php"><i class="fas fa-angle-right" style="width: 25px;"></i>
                Change Buffer Time</a>
        </li>
        <li>
            <a href="logout.php"><i class="fas fa-angle-right" style="width: 25px;"></i>
                Logout</a>
        </li>
    </ul>


</nav>