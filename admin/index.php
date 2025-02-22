<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <?php include('sidebar.php'); ?>
        <div class="main">
            <h1>Dashboard</h1>
            <div class="date">
                <input type="date">
            </div>
            <div class="insight">
                <!-- Sales -->
                <div class="sales">
                    <span class="material-symbols-outlined">trending_up</span>
                    <div class="middle">
                        <div class="mleft">
                            <h3>Today's Sales</h3>
                            <h1>25,050</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle r="30" cy="40" cx="40"></circle>
                            </svg>
                            <div class="number">80%</div>
                        </div>
                    </div>
                    <small>Last 24 Hr</small>
                </div>
                <!-- Expenses -->
                <div class="expenses">
                    <span class="material-symbols-outlined">local_mall</span>
                    <div class="middle">
                        <div class="mleft">
                            <h3>Today's Expenses</h3>
                            <h1>12,500</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle r="30" cy="40" cx="40"></circle>
                            </svg>
                            <div class="number">65%</div>
                        </div>
                    </div>
                    <small>Last 24 Hr</small>
                </div>
                <!-- Income -->
                <div class="income">
                    <span class="material-symbols-outlined">stacked_line_chart</span>
                    <div class="middle">
                        <div class="mleft">
                            <h3>Today's Income</h3>
                            <h1>37,550</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle r="30" cy="40" cx="40"></circle>
                            </svg>
                            <div class="number">90%</div>
                        </div>
                    </div>
                    <small>Last 24 Hr</small>
                </div>
            </div>
            <!-- Recent Orders -->
            <div class="recentorder">
                <h1>Recent Orders</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Number</th>
                            <th>Payments</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Matkadhau</td>
                            <td>456</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Right Panel -->
        <div class="right">
            <div class="rtop">
                <button id="menubar">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="theme">
                    <span class="material-symbols-outlined active">light_mode</span>
                    <span class="material-symbols-outlined">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p><b>Robot</b></p>
                        <p>Admin</p>
                    </div>
                    <div class="profilephoto">
                        <img src="image/pphoto.jpg" alt="Profile Photo">
                    </div>
                </div>
            </div>
            <!-- Recent Updates -->
            <div class="recentupdate">
                <h2>Recent Updates</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profilephoto">
                            <img src="image/pphoto.jpg" alt="Profile Photo">
                        </div>
                        <div class="message">
                            <p><b>Luffy</b> received his order</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales Analytics -->
            <div class="salesanalytics">
                <h2>Sales Analytics</h2>
                <div class="itemonline">
                    <div class="icon">
                        <span class="material-symbols-outlined">shopping_cart</span>
                    </div>
                    <div class="righttext">
                        <div class="info">
                            <h3>Online Orders</h3>
                            <small class="textmuted">Last seen 2 Hours</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>3,493</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>