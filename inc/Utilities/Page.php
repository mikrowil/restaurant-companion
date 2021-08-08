<?php


class Page
{
    public static $title;
    public static $tab;

    public static function header()
    { ?>


        <!doctype html>
        <html lang="en">
        <head>

            <style>
                body{
                    overflow: scroll;
                }
            </style>

            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


            <!-- UIkit CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.17/dist/css/uikit.min.css"/>

            <!-- UIkit JS -->
            <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.17/dist/js/uikit.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.17/dist/js/uikit-icons.min.js"></script>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <title><?php echo self::$title; ?></title>
        </head>
        <body>
        <div class="uk-container .uk-container-small">
        <h1 class="uk-heading-medium"><?php echo self::$title; ?></h1>
        <hr>

    <?php }

    public static function tabs(){ ?>
        <nav class="uk-navbar-container uk-navbar">
            <div class="uk-navbar-left">
                <ul class="uk-navbar-nav">
                    <li class="<?php echo (self::$tab == "add") ? "uk-active" : "" ?>"><a
                                href="App.php?tab=<?php echo "add" ?> ">Add Employee</a></li>
                    <li class="<?php echo (self::$tab == "show") ? "uk-active" : "" ?> "><a
                                href="App.php?tab=<?php echo "show" ?> ">Show Employees</a></li>
                    <li class="<?php echo (self::$tab == "shift") ? "uk-active" : "" ?> "><a
                                href="App.php?tab=<?php echo "shift" ?> ">Shifts</a></li>


                </ul>
            </div>

            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="submit" id="btnLogout"
                       class="uk-button uk-button-default uk-button-small uk-position-right" name="Logout"
                       value="Logout">
                <input type="hidden" name="action" value="logout">
            </form>
        </nav>
    <?php }

    public static function footer()
    { ?>

        </div>
        <!-- Optional JavaScript; choose one of the two! -->


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
                integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
                integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
                crossorigin="anonymous"></script>

        </body>
        </html>

    <?php }


    public static function AddEmployee()
    { ?>


        <form class=".uk-form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
              enctype="multipart/form-data">
            <label for="username" class=".uk-form-label">Username:</label>
            <input class="uk-input" id="username" name="username" type="text" required/>

            <label for="password" class=".uk-form-label">Password:</label>
            <input class="uk-input" id="password" name="password" type="password" required/>


            <label for="firstName" class=".uk-form-label">First Name:</label>
            <input class="uk-input" id="firstName" name="firstName" type="text" required/>


            <label for="lastName" class=".uk-form-label">Last Name:</label>
            <input class="uk-input" id="lastName" name="lastName" type="text"/>

            <label for="age" class=".uk-form-label">Age:</label>
            <input class="uk-input" id="age" name="age" type="number" required/>

            <label for="email" class=".uk-form-label">Email:</label>
            <input class="uk-input" id="email" name="email" type="email" required/>

            <input type="hidden" name="action" value="add">
            <div class="uk-margin">
                <input class="uk-button" type="submit"/>
            </div>

        </form>

    <?php }

    public static function newUserNotification(Employee $employee)
    {
        echo "<div>";
        echo $employee->getFirstName() . " has been added";
        echo "</div>";
    }

    public static function showEmployees($employees)
    {

        echo "<table class='uk-table uk-table-divider uk-table-hover'>";

        echo "<thead>
                <tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Age</td>
                    <td>Email</td>
                </tr>
               </thead>";

        for ($i = 0; $i < sizeof($employees); $i += 1) {
            echo "<tr>
                        <td>" . $employees[$i]->getFirstName() . "</td>
                        <td>" . $employees[$i]->getLastName() . "</td>
                        <td>" . $employees[$i]->getAge() . "</td>
                        <td>" . $employees[$i]->getEmail() . "</td>
                        <td><a href='index.php?action=delete&user=" . $employees[$i]->getUsername() . "'>Delete</a></td>
                   </tr>";
        }

        echo "</table>";
    }

    public static function login()
    { ?>



        <form class=".uk-form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
              enctype="multipart/form-data">
            <label for="username" id="username">Username</label>
            <input name="username" type="text" required/>
            <label for="password" id="password">Password</label>
            <input name="password" type="password" required/>

            <input type="hidden" name="action" value="login"/>

            <input type="submit" value="Submit">

        </form>

        <div class="uk-margin">
            <a href="Register.php?action=register">Register here</a>
        </div>
    <?php }

    public static function shifts(array $shifts){ ?>
            <hr>
        <div class="uk-grid">
        <div class="uk-width-1-3">
        <h2>Add a shift</h2>
            <form class="uk-form-width-medium" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                  enctype="multipart/form-data">
                <input class="uk-input" type="date" name="startDate" required/>
                <input class="uk-input" type="time" name="startTime" required/>
                <input class="uk-input" type="date" name="endDate" required/>
                <input class="uk-input" type="time" name="endTime" required/>
                <input type="hidden" name="action" value="shift">
                <input type="hidden" name="tab" value="shift">
                <input class="uk-input" value="Add Shift" type="submit">
            </form>
        </div>

<div class="">

        <h2>Upcoming shifts</h2>

        <?php
            if($shifts){
                echo '<table class="uk-table-small">';

                echo '<tr>
<td>Date</td>
<td>Start</td>
<td>End</td>
</tr>';

                foreach ($shifts as $shift){

                    try {
                        $startDate = new DateTime($shift->getStartDate());
                        $endDate = new DateTime($shift->getEndDate());



                        echo '<tr>';
                        echo '<td>'.$startDate->format("M-d-D").'</td>';
                        echo '<td>'.$startDate->format("h:i a").'</td>';
                        echo '<td>'.$endDate->format("h:i a").'</td>';
                        echo "<td><a href='index.php?action=delShift&tab=shift&id=".$shift->getShiftId()."' >Delete</a></td>";
                        echo '</tr>';
                    } catch (Exception $e) {

                    }

                }

                echo '</table>';
            }
        ?>
</div>
        </div>

    <?php }



}

