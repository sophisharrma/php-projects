<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fs-4">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="rawmaterial.php">Raw Material</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="production.php">Production</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link " aria-current="page" href="sales.php">Sales</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="reports.php"
                        <?php
                        if($_SESSION['category']=='User'){?>
                            style="pointer-events: none";
                        <?php } ?> >
                        Reports
                    </a>

                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link " href="myAccount.php">My Account</a>
                </li>
            </ul>
        </div>
        <a href="logout.php" class="btn btn-primary fs-5 px-3 mx-1"> Log Out</a>
    </div>
</nav>