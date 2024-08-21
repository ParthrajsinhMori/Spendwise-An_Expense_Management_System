<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <title>Expense Management System</title> -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .navbar-custom {
            background-color: #007bff;
            font-size:17px;
        }
        .navbar-custom .navbar-nav .nav-link {
            color: white;
        }
        .navbar-custom .navbar-nav .nav-link:hover {
            background-color: pink;
            color : blue;
            /* transform: scale(0.95); */
        }
        .navbar-custom .navbar-nav .nav-link.active {
            /* background-color: green; */
            background-color: white;
            color : blue;
            /* transform: scale(0.95); */
            font-weight: 540;
        }
        .navbar-custom .navbar-brand {
            color: black;
            font-weight: 600;
        }
        .navbar-custom .navbar-toggler {
            border-color:white;
        }
        .navbar-custom .navbar-toggler-icon {
            background-image: url('data:image/svg+xml;charset=utf8,%3Csvg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath stroke="rgba%28255, 255, 255, 1%29" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/%3E%3C/svg%3E');
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="index.php">SpendWise</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'index.php'){echo 'active';} ?>" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'income.php' || basename($_SERVER['PHP_SELF']) == 'add_income.php' || basename($_SERVER['PHP_SELF']) == 'update_income.php') {echo 'active';} ?>" href="income.php">Income</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php if(basename($_SERVER['PHP_SELF']) == 'expense.php' || basename($_SERVER['PHP_SELF']) == 'add_expense.php' || basename($_SERVER['PHP_SELF']) == 'update_income.php'){echo 'active';} ?>" href="expense.php">Expenses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'analytics.php'){echo 'active';} ?>" href="analytics.php">Analytics</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'profile.php'){echo 'active';} ?>" href="profile.php"><?php echo $_SESSION["username"];?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

</body>
</html>
