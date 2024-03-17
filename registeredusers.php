<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add any necessary CSS links here -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <!-- Your sidebar or other content -->
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 style="font-size: medium;">Registered Users:</h2>
                <div class="users-students">
                        
                <?php
                    // Establishing connection to the database
                    include "database.php";

                    $sql = "SELECT r.lrn, u.full_name, u.email FROM registrar r INNER JOIN users u ON r.lrn = u.lrn";
                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        die("Error in SQL query: " . mysqli_error($conn));
                    }

                    echo "<table class='table table-striped'>";
                    echo "<tr>";
                    echo "<th>LRN</th>";
                    echo "<th>Username</th>";
                    echo "<th>Email</th>";
                    echo "<th>Student Info</th>"; // New column for student info
                    echo "<th>Accept</th>";
                    echo "<th>Decline</th>";
                    echo "</tr>";

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $lrn = $row['lrn'];
                            $full_name = $row['full_name'];
                            $email = $row['email'];

                            echo "<tr>";
                            echo "<td>$lrn</td>";
                            echo "<td>$full_name</td>";
                            echo "<td>$email</td>";
                            
                            // Fetch and display student info
                            $sql_student_info = "SELECT info FROM student_info WHERE lrn = '$lrn'";
                            $result_student_info = mysqli_query($conn, $sql_student_info);
                            
                            if ($result_student_info && mysqli_num_rows($result_student_info) > 0) {
                                $student_info = mysqli_fetch_assoc($result_student_info);
                                echo "<td>{$student_info['info']}</td>";
                            } else {
                                echo "<td>N/A</td>";
                            }

                            // Buttons for admin actions
                            echo "<td><button class='btn btn-success'>Accept</button></td>";
                            echo "<td><button class='btn btn-danger'>Decline</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No registered users found.</td></tr>";
                    }

                    echo "</table>";

                    // Close the MySQLi connection after all queries have been executed
                    mysqli_close($conn);
                ?>


                    </table>
                </div>
            </div>
        </div>

        <!-- Display registered students -->
        <div class="row mt-4">
            <div class="col">
                <h2 style="font-size: medium;">Registered Students:</h2>
                <ul class="list-group">
                    <?php
                    // Query to fetch registered students
                    $sql_students = "SELECT * FROM users WHERE role = 'student'";
                    $result_students = mysqli_query($conn, $sql_students);

                    if (mysqli_num_rows($result_students) > 0) {
                        while ($row_student = mysqli_fetch_assoc($result_students)) {
                            echo "<li class='list-group-item'>" . $row_student['full_name'] . "</li>";
                        }
                    } else {
                        echo "<li class='list-group-item'>No registered students found.</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Your JavaScript code -->
    <script>
    function validateForm() {
        var lrn = document.getElementById('lrn').value;
        var strand = document.getElementById('strand').value;

        if (lrn === "" || strand === "") {
            alert("Please fill up LRN and select a strand.");
            return false;
        }
        return true;
    }
</script>
