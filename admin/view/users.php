<!-- USERS ACCOUNT PAGE -->
<?php
if (isset($_GET["users"])) { ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-6">
                    <h1>Users Account</h1>
                </div>
                <div class="col-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users Account</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
<section class="content container-fluid">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><a href="?users-add" class="btn btn-primary"><i class="fa fa-plus"></i> New User</a></h3>
        </div>
        <div class="box-body">
            <div class="table-responsive"> <!-- Add responsive wrapper -->
                <table id="users" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>Contact Person</th>
                            <th>User Type</th>
                            <th>Username</th>
                        <!--    <th>Password</th> !-->
                            <th><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php get_users($con); ?>
                    </tbody> <!-- Add single tbody tag here -->
                </table>
            </div>
        </div>
    </div>
</section>
<?php } ?>


<!-- USER ADD FORM -->
<?php
if (isset($_GET["users-add"])) { ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-6">
                    <h1><a href="?cottage">Back</a></h1>
                </div>
                <div class="col-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content container-fluid">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Add User</h3>
            </div>
            <form class="form-horizontal" method="post" action="function/function_crud.php" onsubmit="return validateForm()">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">First Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="fname" maxlength="20" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Middle Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="mname" maxlength="1" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Last Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="lname" maxlength="20" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Contact No</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="contact_no" maxlength="11" required oninput="validatePhoneNumber(this)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Contact Person</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="person_to_contact" maxlength="11" required oninput="validatePhoneNumber(this)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Address</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="uname" maxlength="15" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="pass" maxlength="30" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">User Type</label>
                                <div class="col-sm-8">
                                    <select id="" class="form-control" name="utype" required>
                                        <option value="3">Agent</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"></label>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary" name="btnAddUser">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php } ?>


<!-- USER EDIT FORM -->
<?php
if (isset($_GET["users-edit"])) { ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="?users"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content container-fluid">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Edit User</h3>
            </div>
            <?php
            $getid = $_GET["users-edit"];
            $sql = "SELECT * FROM user WHERE `user_id` = '$getid'";
            $query = mysqli_query($con, $sql);
            $fetch = mysqli_fetch_assoc($query);
            ?>
            <form class="form-horizontal" method="post" action="function/function_crud.php" onsubmit="return validateForm()">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">First Name</label>
                                <div class="col-sm-8">
                                    <input type="hidden" class="form-control" value="<?php echo $fetch["user_id"]?>" name="id">
                                    <input type="text" class="form-control" value="<?php echo $fetch["fname"]?>" name="fname" maxlength="20" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Middle Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo $fetch["mname"]?>" name="mname" maxlength="1" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Last Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo $fetch["lname"]?>" name="lname" maxlength="20" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" value="<?php echo $fetch["email"]?>" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Contact No</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo $fetch["contact_no"]?>" name="contact_no" maxlength="11" required oninput="validatePhoneNumber(this)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Contact Person</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo $fetch["person_to_contact"]?>" name="person_to_contact" maxlength="11" required oninput="validatePhoneNumber(this)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Address</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo $fetch["address"]?>" name="address" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo $fetch["uname"]?>" name="uname" maxlength="15" required>
                                </div>
                            </div>
                          <!--  <div class="form-group">
                                <label class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo $fetch["pass"]?>" name="pass" maxlength="30" required>
                                </div>
                            </div> !-->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">User Type</label>
                                <div class="col-sm-8">
                                    <select id="" class="form-control" name="utype" required>
                                        <option value="3">Agent</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"></label>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary" name="updateuser">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php } ?>

<!-- Validation Scripts -->
<script>
    function validatePhoneNumber(input) {
        const phoneNumber = input.value;

        // Allow typing but validate when length reaches 11 digits
        if (phoneNumber.length === 11) {
            // Check if it starts with '09'
            if (!phoneNumber.startsWith('09')) {
                alert("Phone number must start with '09'.");
                input.value = '';
                return;
            }

            // Check if it contains only digits
            const regex = /^[0-9]+$/;
            if (!regex.test(phoneNumber)) {
                alert("Phone number must contain only digits.");
                input.value = '';
            }
        }

        // If the number is longer than 11 digits, trim it
        if (phoneNumber.length > 11) {
            input.value = phoneNumber.slice(0, 11);
        }
    }

    function validateForm() {
        const firstName = document.querySelector('input[name="fname"]').value;
        const middleName = document.querySelector('input[name="mname"]').value;
        const lastName = document.querySelector('input[name="lname"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const address = document.querySelector('input[name="address"]').value;

        const nameRegex = /^[A-Za-z\s]+$/; // Letters and spaces only
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Valid email format
        const addressRegex = /^[a-zA-Z\s]+,\s*[a-zA-Z\s]+,\s*[a-zA-Z\s]+$/; // Pattern for "part1, part2, part3" allowing letters and spaces with commas

        // Validate first, middle, and last names
        if (!nameRegex.test(firstName)) {
            alert("First name can only contain letters.");
            return false;
        }
        if (!nameRegex.test(middleName)) {
            alert("Middle name can only contain letters.");
            return false;
        }
        if (!nameRegex.test(lastName)) {
            alert("Last name can only contain letters.");
            return false;
        }

        // Validate email
        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address.");
            return false;
        }

        // Validate address for the pattern "part1, part2, part3"
        if (!addressRegex.test(address)) {
            alert("Address must follow the format 'part1, part2, part3' (e.g., kagwangan, pili, bantayan).");
            return false;
        }

        // All checks passed
        return true;
    }
</script>
